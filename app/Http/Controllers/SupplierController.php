<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Investment;
use App\Product;
use App\Supplier;
use App\SupplierLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function addSupplier()
    {
        return view('factory.supplier.add_supplier');
    }

    public function postSupplier(Request $request){
        $supplier = new Supplier();
        $supplier->company = trim($request['company']);
        $supplier->responsible_person=trim($request['responsible_person']);
        $supplier->phone=trim($request['phone']);
        $supplier->email=trim($request['email']);
        $supplier->address=trim($request['address']);
        $supplier->remaining_debt=0;
        $supplier->more_info=trim($request['more_info']);
        $supplier->save();
        if ($supplier){
            return redirect()->back()->with(['success' => 'عملیه ثبت موففانه صورت گرفت!']);
        }else{
            return redirect()->back()->with(['warning' => 'دوباره کوشش کنید!']);
        }
    }

    public function listSuppliers(){
        $supplier = Supplier::all();
        return view('factory.supplier.list_suppliers',['supplier' => $supplier]);
    }

    public function editSupplier($id){
        $supplier = Supplier::find($id);
        return View('factory.supplier.edit_supplier', ['supplier' => $supplier]);
    }

    public function postEditSupplier($id, Request $request){
        $supplier = Supplier::where('supplier_id', '=', $id)->update([
            'responsible_person' => $request->responsible_person,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'company' => $request->company,
            'more_info' => $request->more_info,
        ]);
        if ($supplier){
            return redirect()->action('SupplierController@listSuppliers')->with('editRecordMessage', 'تغییرات موفقانه انجام شد!');
            }else{
            return redirect()->back()->with(['warning' => 'دوباره کوشش نمایید!']);
        }
    }

    public function deleteSupplier(Request $request){
        $supplier = Supplier::where('supplier_id', $request->supplier_id )->delete();
        if ($supplier){
            return redirect()->back()->with('deleted', 'عملیه حذف موفقانه انجام شد!');
        }
        else{
            return redirect()->back()->with('noDeleted', 'دوباره کوشش نمایید!');
        }
    }

    public function payDebt(){
        $id = Supplier::select(['supplier_id'])->where('remaining_debt',0)->get();
        $supplier=Supplier::whereNotIn('supplier_id',$id)->get();
        return view('factory.supplier.pay_debt',['supplier'=>$supplier]);
    }

    public function debtRemain(Request $request){
        $rawsupplierId = $request["rawsupplierId"];
        $remainData = DB::table('suppliers')->where('supplier_id',$rawsupplierId)->get();
        return response()->json($remainData, 200);
    }

    public function postPayDebt(Request $request){
        $giving_money=$request['giving_money'];
        $supplierId=$request['supplierId'];
//        $debtId=$request['debt_id'];
        $amount=Investment::select('amount')->get();

        if ($amount->isEmpty()) {
            return redirect()->back()->with(['info' => 'Please add money.']);
        }


        $debtAmount=supplier::select('remaining_debt')->where('supplier_id', $supplierId)->get();
        $balance = $debtAmount[0]->remaining_debt - $giving_money;

//        return $debtAmount;

        $debt=new SupplierLedger();
        $debt->date=trim($request['date']);
        $debt->purchase=0;
        $debt->giving_money=$giving_money;
        $debt->balance=$balance;
        $debt->more_info=trim($request['more_info']);
        $debt->supplier_id=$supplierId;
        $debt->save();

        DB::table('suppliers')->where('supplier_id', $supplierId)
            ->update(['remaining_debt' => $balance]);

        $updateinvestment = DB::table('investments')
            ->update(['amount' => $amount[0]->amount - $giving_money]);

        if ($debt && $updateinvestment){
//            return redirect()->back()->with(['success' => 'Done']);
            return redirect()->back()->with('success', 'پرداخت پول موفقانه انجام شد!');
        }else{
            return redirect()->back()->with(['warning' => 'انجام نشد، دوباره کوشش نمایید!']);
        }

    }

    public function listSupplierLedger($id){
        $ledger = DB::table('suppliers')
            ->select('*','supplier_ledgers.more_info as description')
            ->join('supplier_ledgers','suppliers.supplier_id','=','supplier_ledgers.supplier_id')
            ->where('supplier_ledgers.supplier_id' ,$id)->get();

        $remainingDebts = DB::table('suppliers')->selectRaw('*, sum(giving_money) as totalPaid')->join('supplier_ledgers','suppliers.supplier_id','=','supplier_ledgers.supplier_id')->where('supplier_ledgers.supplier_id' ,$id)->groupBy('supplier_ledgers.supplier_id')->get();



        return view('factory.supplier.supplier_ledger', ['ledger' => $ledger, 'remainingDebts'=>$remainingDebts]);
    }


}
