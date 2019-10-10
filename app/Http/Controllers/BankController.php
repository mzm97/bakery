<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;
use DataTables;
use App\BankStatement;
use DB;

class BankController extends Controller
{
    public function BanksList()
    {
      return view('bank.bank_list');
    }

    public function BanksListData()
  {
   $tables = Bank::get(['bank_id','bank_name', 'account_name','account_no']);
     return DataTables::of($tables)
         ->addColumn('edit', '<a class="edit" href="javascript:;"style="margin-right:10px;"><span class="fa  fa-edit" style="font-size:25px;"></a>')
         ->addColumn('delete', '<a class="delete" href="#" data-target="#deleteConfirmModal" data-toggle="modal" style="margin-right:30px;"><span class="fa  fa-trash" style="font-size:25px;"></a>')
         ->rawColumns(['edit','delete'])
         ->make(true);
  }

  public function update(Request $request, $id)
  {
      $updateBank=Bank::where('bank_id',$id)
      ->update([
        'bank_name'=>$request['bankname'],
        'account_name'=>$request['accountname'],
        'account_no'=>$request['accountno'],
      ]);
        return 'success';
  }

  public function destroy($id)
 {

     $row=Bank::find($id);
     $row->delete();
     return 'success';
 }
         public function AddBank(){
             return view('bank.add_bank');
         }
         public function SaveBank(Request $request){

             $bank = new Bank();
             $bank->bank_name = $request->input('bankname');
             $bank->account_name = $request->input('accountname');
             $bank->account_no = $request->input('accountno');
             $bank->save();
             return redirect()->action('BankController@BanksList')->with('saveMessage', 'موفقانه به ثبت رسید.');
         }


      public function BankInvestment(){

       $data = Bank::join('bank_statements','bank_statements.bank_id','=','banks.bank_id')
       ->groupBy('banks.account_no')
       ->get();
       $bankstatment = BankStatement::all();
       return view('bank.bank_investment', ['data' => $data, 'bankstatment'=>$bankstatment]);
       }

       public function Details($bankId)
       {

         $data = Bank::join('bank_statements','bank_statements.bank_id','=','banks.bank_id')
         ->where('bank_statements.bank_id',$bankId)
         ->get();

         $data2 = Bank::join('bank_statements','bank_statements.bank_id','=','banks.bank_id')
         ->where('bank_statements.bank_id',$bankId)
         ->groupBy('banks.account_no')
         ->get();

         return view('bank.bank_statement', ['data' => $data, 'data2'=>$data2]);
         }


       public function AddBankInvestment(){

      $bank=Bank::all();
       return view('bank.add_bank_investment',['bank'=>$bank]);
       }

       public function BankNameData(Request $request){

         $data=DB::table('banks')->where('bank_id',$request['bank_id'])->get();
         return response()->json($data, 200);
 }

       public function BankAccountData(Request $request){

         $data=DB::table('banks')->where('account_name',$request['account_name'])->get();
         return response()->json($data, 200);
      }

       public function RemoveBankInvestment(){
       return view('investment.remove_investment');
       }


}
