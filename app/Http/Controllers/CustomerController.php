<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerLedger;
use App\Investment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function addCustomer()
    {
        return view('factory.customer.add_customer');
    }

    public function postCustomer(Request $request){
        $customer = new Customer();
        $customer->company = trim($request['company']);
        $customer->responsible_person=trim($request['responsible_person']);
        $customer->phone=trim($request['phone']);
        $customer->email=trim($request['email']);
        $customer->address=trim($request['address']);
        $customer->remaining_debt=0;
        $customer->more_info=trim($request['more_info']);
        $customer->save();
        if ($customer){
            return redirect()->back()->with(['success' => 'عملیه ثبت موففانه صورت گرفت!']);
        }else{
            return redirect()->back()->with(['warning' => 'دوباره کوشش کنید!']);
        }
    }

    public function listCustomers(){
        $customer = Customer::all();
        return view('factory.customer.list_customers',['customer' => $customer]);
    }

    public function editCustomer($id){
        $customer = Customer::find($id);
        return View('factory.customer.edit_customer', ['customer' => $customer]);
    }

    public function postEditCustomer($id, Request $request){
        $customer = Customer::where('customer_id', '=', $id)->update([
            'responsible_person' => $request->responsible_person,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'company' => $request->company,
            'more_info' => $request->more_info,
        ]);
        if ($customer){
            return redirect()->action('CustomerController@listCustomers')->with('editRecordMessage', 'تغییرات موفقانه انجام شد!');
        }else{
            return redirect()->back()->with(['warning' => 'دوباره کوشش نمایید!']);
        }
    }

    public function deleteCustomer(Request $request){
        $customer = Customer::where('customer_id', $request->customer_id )->delete();
        if ($customer){
            return redirect()->back()->with('deleted', 'عملیه حذف موفقانه انجام شد!');
        }
        else{
            return redirect()->back()->with('noDeleted', 'دوباره کوشش نمایید!');
        }
    }

    public function listCustomerLedger($id){
        $ledger = DB::table('customers')
            ->select('*','customer_ledgers.more_info as description')
            ->join('customer_ledgers','customers.customer_id','=','customer_ledgers.customer_id')
            ->where('customer_ledgers.customer_id' ,$id)->get();

        $remainingDebts = DB::table('customers')->selectRaw('*, sum(received_debt) as totalPaid')->join('customer_ledgers','customers.customer_id','=','customer_ledgers.customer_id')->where('customer_ledgers.customer_id' ,$id)->groupBy('customer_ledgers.customer_id')->get();



        return view('factory.customer.customer_ledger', ['ledger' => $ledger, 'remainingDebts'=>$remainingDebts]);
    }

    public function receiveDebt(){
        $id = Customer::select(['customer_id'])->where('remaining_debt',0)->get();
        $customer=Customer::whereNotIn('customer_id',$id)->get();
        return view('factory.customer.receive_debt',['customer'=>$customer]);
    }

    public function debtRemain(Request $request){
        $customerId = $request["customerId"];
        $remainData = DB::table('customers')->where('customer_id',$customerId)->get();
        return response()->json($remainData, 200);
    }
    
    public function postReceiveDebt(Request $request){
        $received_debt=$request['received_debt'];
        $customerId=$request['customerId'];
//        $debtId=$request['debt_id'];
        $amount=Investment::select('amount')->get();

       


        $debtAmount=customer::select('remaining_debt')->where('customer_id', $customerId)->get();
        $balance = $debtAmount[0]->remaining_debt - $received_debt;

//        return $debtAmount;

        $debt=new CustomerLedger();
        $debt->date=trim($request['date']);
        $debt->sale=0;
        $debt->extra_expense=0;
        $debt->total=0;
        $debt->type="حصول قرض";
        $debt->received_debt=$received_debt;
        $debt->balance=$balance;
        $debt->more_info=trim($request['more_info']);
        $debt->customer_id=$customerId;
        $debt->save();

        DB::table('customers')->where('customer_id', $customerId)
            ->update(['remaining_debt' => $balance]);

        $updateinvestment = DB::table('investments')
            ->update(['amount' => $amount[0]->amount + $received_debt]);

        if ($debt && $updateinvestment){
//            return redirect()->back()->with(['success' => 'Done']);
            return redirect()->back()->with('success', 'حصول پول موفقانه انجام شد!');
        }else{
            return redirect()->back()->with(['warning' => 'انجام نشد، دوباره کوشش نمایید!']);
        }

    }
}
