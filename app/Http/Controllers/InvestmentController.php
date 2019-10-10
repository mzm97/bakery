<?php

namespace App\Http\Controllers;

use App\Investment;
use App\TransferInvestment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Bank;
use App\BankStatement;
use Morilog\Jalali;
use Morilog\Jalali\CalendarUtils;

class InvestmentController extends Controller
{


              public function investment(){

              $investment = Investment::all();
              $transferInvestment = TransferInvestment::all();
              return view('investment.investment', ['investment' => $investment, 'transferInvestment'=>$transferInvestment]);
              }

              public function editInvestment($id){
              $investment = Investment::find($id);
              return view('investment.edit_investment', ['investment' => $investment]);
              }

              public function editInvestmentRecord(Request $request, $id){
              Investment::where('investment_id', '=', $id)->update([
              'amount' => $request->amount,
              'description' => $request->description,
              ]);

              return redirect()->action('InvestmentController@investment')->with('editRecordMessage', 'Well done, successfully updated!');
              }

              public function addInvestment(){

              $bank=Bank::all();
              return view('investment.add_investment',['bank'=>$bank]);
              }


              public function removeInvestment(){
                $bank=Bank::all();
              return view('investment.remove_investment',['bank'=>$bank]);
              }


                    public function AddBankInvestmentRecord(Request $request){


                        $addMoneyT = new TransferInvestment();
                        $addMoneyT->date = $request->date;
                        $addMoneyT->add_remove = 'آمد';
                        $addMoneyT->amount = $request->amount;
                        $addMoneyT->description = $request->description;

                        $depositExistenceBalance = DB::table('transfer_investments')->selectRaw('sum(amount) as amount')->where('add_remove','=','آمد')->groupBy('add_remove')->get();
                        $withdrawExistenceBalance = DB::table('transfer_investments')->selectRaw('sum(amount) as amount')->where('add_remove','=','رفت')->groupBy('add_remove')->get();
                        $depositExistenceBalance->isEmpty() ? $deposit_balance = 0 : $deposit_balance = $depositExistenceBalance[0]->amount;
                        $withdrawExistenceBalance->isEmpty() ? $withdraw_balance = 0 : $withdraw_balance = $withdrawExistenceBalance[0]->amount;
                        $existence_balance = $deposit_balance - $withdraw_balance;
                        $addMoneyT->balance = $existence_balance + $request->amount;
                        $addMoneyT->save();

                    $addMoney = new BankStatement();
                    $addMoney->date =  $request->date;
                    $addMoney->transection = 'رفت';
                    $addMoney->amount = $request->amount;
                    $addMoney->bank_id = $request->bankId;

                    $depositExistenceBalance = DB::table('bank_statements')->selectRaw('sum(amount) as amount')->where('transection','=','آمد')->where('bank_id',$request->bankId)->groupBy('transection')->get();
                    $withdrawExistenceBalance = DB::table('bank_statements')->selectRaw('sum(amount) as amount')->where('transection','=','رفت')->where('bank_id',$request->bankId)->groupBy('transection')->get();
                    $depositExistenceBalance->isEmpty() ? $deposit_balance = 0 : $deposit_balance = $depositExistenceBalance[0]->amount;
                    $withdrawExistenceBalance->isEmpty() ? $withdraw_balance = 0 : $withdraw_balance = $withdrawExistenceBalance[0]->amount;
                    $existence_balance = $deposit_balance - $withdraw_balance;
                    $addMoney->balance = $existence_balance - $request->amount;
                    $addMoney->save();
                    $existenceInvestment = DB::table('investments')->select('amount')->get();
                    if(!$existenceInvestment->isEmpty()){
                        DB::table('investments')->update(
                            [
                                'amount'=>$existenceInvestment[0]->amount + $request->amount
                            ]
                        );
                    }
                    else {
                        $investment = new Investment();
                        $investment->investment_id = 1;
                        $investment->amount = $request->amount;
                        $investment->save();
                    }
                    if($addMoney)
                    {
                        return redirect()->action('InvestmentController@investment')->with('editRecordMessage', 'موفقانه به ثبت رسید.');
                    }

                }


              public function RemoveBankInvestmentRecord(Request $request){

                  $addMoneyT = new TransferInvestment();
                  $addMoneyT->date = $request->date;
                  $addMoneyT->add_remove = 'رفت';
                  $addMoneyT->amount = $request->amount;
                  $addMoneyT->description = $request->description;
                  $depositExistenceBalance = DB::table('transfer_investments')->selectRaw('sum(amount) as amount')->where('add_remove','=','آمد')->groupBy('add_remove')->get();
                  $withdrawExistenceBalance = DB::table('transfer_investments')->selectRaw('sum(amount) as amount')->where('add_remove','=','رفت')->groupBy('add_remove')->get();
                  $depositExistenceBalance->isEmpty() ? $deposit_balance = 0 : $deposit_balance = $depositExistenceBalance[0]->amount;
                  $withdrawExistenceBalance->isEmpty() ? $withdraw_balance = 0 : $withdraw_balance = $withdrawExistenceBalance[0]->amount;
                  $existence_balance = $deposit_balance - $withdraw_balance;
                  $addMoneyT->balance = $existence_balance - $request->amount;
                  $addMoneyT->save();

                $addMoney = new BankStatement();
                $addMoney->date = $request->date;
                $addMoney->transection = 'آمد';
                $addMoney->amount = $request->amount;
                $addMoney->bank_id = $request->bankId;


                $depositExistenceBalance = DB::table('bank_statements')->selectRaw('sum(amount) as amount')->where('transection','=','آمد')->where('bank_id',$request->bankId)->groupBy('transection')->get();
                $withdrawExistenceBalance = DB::table('bank_statements')->selectRaw('sum(amount) as amount')->where('transection','=','رفت')->where('bank_id',$request->bankId)->groupBy('transection')->get();
                $depositExistenceBalance->isEmpty() ? $deposit_balance = 0 : $deposit_balance = $depositExistenceBalance[0]->amount;
                $withdrawExistenceBalance->isEmpty() ? $withdraw_balance = 0 : $withdraw_balance = $withdrawExistenceBalance[0]->amount;
                $existence_balance = $deposit_balance - $withdraw_balance;
                $addMoney->balance = $existence_balance + $request->amount;
                $addMoney->save();
                $existenceInvestment = DB::table('investments')->select('amount')->get();
                if(!$existenceInvestment->isEmpty()){
                    DB::table('investments')->update(
                        [
                            'amount'=>$existenceInvestment[0]->amount - $request->amount
                        ]
                    );
                }
                else {
                    $investment = new Investment();
                    $investment->investment_id = 1;
                    $investment->amount = -$request->amount;
                    $investment->save();
                }

                if($addMoney)
                {
                    return redirect()->action('InvestmentController@investment')->with('editRecordMessage', 'موفقانه به ثبت رسید.');
                }
              }

              public function addInvestmentRecord(Request $request){

            $addMoney = new TransferInvestment();
            $addMoney->date =  $request->date;
            $addMoney->add_remove = 'آمد';
            $addMoney->amount = $request->amount;
            $addMoney->description = $request->description;

            $depositExistenceBalance = DB::table('transfer_investments')->selectRaw('sum(amount) as amount')->where('add_remove','=','آمد')->groupBy('add_remove')->get();
            $withdrawExistenceBalance = DB::table('transfer_investments')->selectRaw('sum(amount) as amount')->where('add_remove','=','رفت')->groupBy('add_remove')->get();
            $depositExistenceBalance->isEmpty() ? $deposit_balance = 0 : $deposit_balance = $depositExistenceBalance[0]->amount;
            $withdrawExistenceBalance->isEmpty() ? $withdraw_balance = 0 : $withdraw_balance = $withdrawExistenceBalance[0]->amount;
            $existence_balance = $deposit_balance - $withdraw_balance;
            $addMoney->balance = $existence_balance + $request->amount;
            $addMoney->save();
            $existenceInvestment = DB::table('investments')->select('amount')->get();
            if(!$existenceInvestment->isEmpty()){
            DB::table('investments')->update(
              [
                  'amount'=>$existenceInvestment[0]->amount + $request->amount
              ]
            );
            }
            else {
            $investment = new Investment();
            $investment->investment_id = 1;
            $investment->amount = $request->amount;
            $investment->save();
            }

            if($addMoney)
            {
            return redirect()->action('InvestmentController@investment')->with('editRecordMessage', 'موفقانه به ثبت رسید.');
            }

            }

                public function RemoveInvestmentRecord(Request $request)
                {
                $addMoney = new TransferInvestment();
                $addMoney->date =  $request->date;
                $addMoney->add_remove = 'رفت';
                $addMoney->amount = $request->amount;
                $addMoney->description = $request->description;
                $depositExistenceBalance = DB::table('transfer_investments')->selectRaw('sum(amount) as amount')->where('add_remove','=','آمد')->groupBy('add_remove')->get();
                $withdrawExistenceBalance = DB::table('transfer_investments')->selectRaw('sum(amount) as amount')->where('add_remove','=','رفت')->groupBy('add_remove')->get();
                $depositExistenceBalance->isEmpty() ? $deposit_balance = 0 : $deposit_balance = $depositExistenceBalance[0]->amount;
                $withdrawExistenceBalance->isEmpty() ? $withdraw_balance = 0 : $withdraw_balance = $withdrawExistenceBalance[0]->amount;

                $existence_balance = $deposit_balance - $withdraw_balance;
                $addMoney->balance = $existence_balance - $request->amount;

                $addMoney->save();
                $existenceInvestment = DB::table('investments')->select('amount')->get();
                if(!$existenceInvestment->isEmpty()){
                DB::table('investments')->update(
                  [
                      'amount'=>$existenceInvestment[0]->amount - $request->amount
                  ]
                );
                }
                else {
                $investment = new Investment();
                $investment->investment_id = 1;
                $investment->amount = -$request->amount;
                $investment->save();
                }
                if($addMoney)
                {
                return redirect()->action('InvestmentController@investment')->with('editRecordMessage', 'موفقانه به ثبت رسید.');
                }
              }

}
