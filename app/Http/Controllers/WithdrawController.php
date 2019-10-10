<?php

namespace App\Http\Controllers;

use App\Investment;
use App\Partner;
use App\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class WithdrawController extends Controller
{
    public function listPartners(){
        $partner = DB::table('partners')->get();
        return view('factory.withdraw.list_partners',['partner' => $partner]);
    }

    public function addPartner(){
        return view('factory.withdraw.add_partner');
    }

    public function postPartner(Request $request){
        $partner =new Partner();
        $partner->name = trim($request['name']);
        $partner->email = trim($request['email']);
        $partner->phone = trim($request['phone']);
        $partner->more_info = trim($request['more_info']);
        $partner->save();
        if ($partner){
            return redirect()->back()->with(['success' => 'عملیه ثبت موففانه صورت گرفت!']);
        }else{
            return redirect()->back()->with(['warning' => 'دوباره کوشش کنید!']);
        }
    }

    public function editPartner($id){
        $partner = DB::table('partners')->where('partner_id','=',$id)->get();
//        return $partner = Partner::find($id);
        return View('factory.withdraw.edit_partner', ['partner' => $partner]);
    }

    public function postEditPartner($id, Request $request){
        $partner = DB::table('partners')->where('partner_id', '=', $id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'more_info' => $request->more_info,
        ]);
        if ($partner){
            return redirect()->action('WithdrawController@listPartners')->with('editRecordMessage', 'تغییرات موفقانه انجام شد!');
        }else{
            return redirect()->back()->with(['warning' => 'دوباره کوشش نمایید!']);
        }
    }

    public function deletePartner(Request $request){
        $partner = Partner::where('partner_id', $request->partner_id )->delete();
        if ($partner){
            return redirect()->back()->with('editRecordMessage', 'موفقانه انجام شد!');
        }
        else{
            return redirect()->back()->with('warning', 'دوباره کوشش نمایید!');
        }
    }

    public function activePartner(Request $request){

        $partner = DB::table('partners')->where('partner_id', '=', $request->partner_id)->update([
            'deleted_at' => null,
        ]);


        if ($partner){
            return redirect()->back()->with('deleted', 'موفقانه انجام شد!');
        }
        else{
            return redirect()->back()->with('noDeleted', 'دوباره کوشش نمایید!');
        }
    }

    public function withdrawAmount(){
        $partner = Partner::all();
        return view('factory.withdraw.withdraw_amount',['partner'=>$partner]);
    }

    public function postWithdraw(Request $request){


//        DB::table('withdraws')->where('partner_id', $request->partner_id)->get();
//        $previousBalance = DB::table('withdraws')->orderBy('withdraw_id', 'desc')->first();
        $previousBalance =  DB::table('withdraws')->select('balance')->where('partner_id', '=', $request->partner_id)->orderBy('created_at', 'desc')->get();
        $perBalance = 0;
        $previousBalance->isEmpty() ? $perBalance = 0 : $perBalance = $previousBalance[0]->balance;
        $withdraw = new Withdraw();
        $withdraw->date = trim($request['date']);
        $withdraw->amount=trim($request['amount']);
        $withdraw->balance=$perBalance + trim($request['amount']);
        $withdraw->more_info=trim($request['more_info']);
        $withdraw->partner_id=trim($request['partner_id']);
        $withdraw->save();

        $amount = Investment::select('amount')->get();
//
        if ($amount->isEmpty()) {
            $investment =new Investment();
            $investment->amount = 0;
            $investment->save();
        }

        $amount2 = Investment::select('amount')->get();

        DB::table('investments')
            ->update(['amount' => $amount2[0]->amount - trim($request['amount'])]);

        if ($withdraw){
            return redirect()->back()->with(['success' => 'برداشت پول موفقانه صورت گرفت!']);
        }else{
            return redirect()->back()->with(['warning' => 'دوباره کوشش کنید!']);
        }
    }

    public function listPartnerWithdraws($id){
        $withdraw = DB::table('partners')
            ->select('*','withdraws.more_info as description')
            ->join('withdraws','partners.partner_id','=','withdraws.partner_id')
            ->where('withdraws.partner_id' ,$id)->get();



        return view('factory.withdraw.list_partner_withdraws', ['withdraw' => $withdraw]);
    }

}
