<?php

namespace App\Http\Controllers;

use App\Investment;
use App\QuantityRawMaterial;
use App\RawMaterial;
use App\RawSupplier;
use App\Supplier;
use App\SupplierInvoice;
use App\SupplierLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use vendor\project\StatusTest;

class RawMaterialController extends Controller
{
    public function addRawMaterial(){
        return view('factory.material.add_raw_material');
    }

    public function postRawMaterial(Request $request){
        $rawMaterial = new RawMaterial();
        $rawMaterial->raw_material_name = $request->raw_material_name;
        $rawMaterial->raw_material_type = $request->raw_material_type;
        $rawMaterial->estimated_price = $request->estimated_price;
        $rawMaterial->unit = $request->unit;
        $rawMaterial->existent_quantity = 0;
        $rawMaterial->more_info = $request->more_info;
        $rawMaterial->save();
        if ($rawMaterial){
            return redirect()->back()->with(['success' => 'عملیه ثبت موففانه صورت گرفت!']);
        }else{
            return redirect()->back()->with(['warning' => 'دوباره کوشش کنید!']);
        }
    }

    public function listRawMaterials(){
        $rawMaterial = RawMaterial::all();
        return view('factory.material.list_raw_materials', ['rawMaterial'=>$rawMaterial]);
    }

    public function editRawMaterial($id){
        $rawMaterial = RawMaterial::find($id);
        return View('factory.material.edit_raw_material', ['rawMaterial' => $rawMaterial]);
    }

    public function postEditRawMaterial(Request $request, $id){
        $rawMaterial = RawMaterial::where('raw_material_id', '=', $id)->update([
            'raw_material_name' => $request->raw_material_name,
            'raw_material_type' => $request->raw_material_type,
            'estimated_price' => $request->estimated_price,
            'unit' => $request->unit,
            'more_info' => $request->more_info,
        ]);
        if ($rawMaterial){
            return redirect()->action('RawMaterialController@listRawMaterials')->with('editRecordMessage', 'تغییرات موفقانه انجام شد!');
        }else{
            return redirect()->back()->with(['warning' => 'دوباره کوشش نمایید!']);
        }
    }

    public function deleteRawMaterial(Request $request){
        $rawMaterial = RawMaterial::where('raw_material_id', $request->raw_material_id)->delete();
        if ($rawMaterial){
            return redirect()->back()->with('deleted', 'عملیه حذف موفقانه انجام شد!');
        }
        else{
            return redirect()->back()->with('noDeleted', 'دوباره کوشش نمایید!');
        }
    }

    public function useRawMaterial($id){
        $rawMaterial = RawMaterial::find($id);
        return View('factory.material.use_raw_material', ['rawMaterial' => $rawMaterial]);
    }

    public function postUseRawMaterial(Request $request,$id){
        $addQuantity = DB::table('raw_materials')->selectRaw('sum(quantity) as quantity')->where('raw_materials.raw_material_id', '=' ,$id)->where('quantity_raw_materials.add_remove', '=' , 'add')->join('quantity_raw_materials','raw_materials.raw_material_id','=','quantity_raw_materials.raw_material_id')->groupBy('quantity_raw_materials.raw_material_id')->get();
        $removeQuantity = DB::table('raw_materials')->selectRaw('sum(quantity) as quantity')->where('raw_materials.raw_material_id', '=' ,$id)->where('quantity_raw_materials.add_remove', '=' , 'remove')->join('quantity_raw_materials','raw_materials.raw_material_id','=','quantity_raw_materials.raw_material_id')->groupBy('quantity_raw_materials.raw_material_id')->get();
        $addQuantity->isEmpty() ? $add_existence_quantity = 0  : $add_existence_quantity = $addQuantity[0]->quantity  ;
        $removeQuantity->isEmpty() ? $remove_existence_quantity = 0  :  $remove_existence_quantity = $removeQuantity[0]->quantity ;
        $alreadyExistence = $add_existence_quantity - $remove_existence_quantity;

        $rawQuantity = new QuantityRawMaterial();
        $rawQuantity->add_remove = 'remove';
        $rawQuantity->quantity = $request->quantity;
        $rawQuantity->existent_quantity = $alreadyExistence - $request->quantity;
        $rawQuantity->date = $request->date;
        $rawQuantity->more_info = $request->more_info;
        $rawQuantity->raw_material_id = $id;
        $rawQuantity->save();

        RawMaterial::where('raw_material_id', '=', $id)->update([
            'existent_quantity' => $rawQuantity->existent_quantity
        ]);

        if ($rawQuantity){
            return redirect()->action('RawMaterialController@listRawMaterials')->with('editRecordMessage', 'تغییرات موفقانه انجام شد!');
        }else{
            return redirect()->back()->with(['warning' => 'دوباره کوشش نمایید!']);
        }
    }

    public function listUseRawMaterial($id)
    {

        $quantityMaterial = DB::table('raw_materials')
            ->join('quantity_raw_materials', 'raw_materials.raw_material_id', '=', 'quantity_raw_materials.raw_material_id')
            ->select('*', 'quantity_raw_materials.more_info as description')
            ->where('quantity_raw_materials.raw_material_id', $id)->get();

        return view('factory.material.list_use_raw_material', ['quantityMaterial'=> $quantityMaterial]);

    }

    public function buyRawMaterial(){

        $supplier=Supplier::all();
        $rawmaterial=RawMaterial::all();

        return view('factory.material.buy_raw_material',['supplier'=>$supplier,'rawmaterial'=>$rawmaterial]);
    }

//    public function postBuyRawMaterial(Request $request){
//        return dd($request);
//    }

    public function postBuyRawMaterial(Request $request)
    {
//        return dd($request);
//        $code = $this->InvoiceCode();
        $numberOfMateril = $request['counter'];


        $givingMoney = trim($request['giving_money']);
        $payment = trim($request['payment']);

//
//        if ($mount->isEmpty()) {
//            return redirect()->back()->with(['info' => 'پول موجود نیست!']);
//        }

        $invoice = new SupplierInvoice();
        $invoice->supplier_invoice_no = trim($request['supplier_invoice_no']);
        $invoice->date = trim($request['date']);
        if($request['other_expense'] == null){
            $invoice->other_expense = 0;
        }
        else{
            $invoice->other_expense = trim($request['other_expense']);
        }
        $invoice->more_info = trim($request['more_info']);
        $invoice->supplier_id = trim($request['supplier_id']);
        $invoice->save();
//
        for ($i = 1; $i <= $numberOfMateril; $i++) {
            if ($request['raw_material_id' . $i]) {
                $rs = new RawSupplier();
                $rs->price = $request['price' . $i];
                $rs->quantity = $request['quantity' . $i];
                $rs->total = ($request['quantity' . $i]) * ($request['price' . $i]);
                $rs->raw_material_id = $request['raw_material_id' . $i];
                $rs->supplier_invoice_id = $invoice->supplier_invoice_id;
                $rs->save();

                $addQuantity = DB::table('raw_materials')->selectRaw('sum(quantity) as quantity')->where('quantity_raw_materials.raw_material_id', '=', $request['raw_material_id' . $i])->where('quantity_raw_materials.add_remove', '=', 'add')->join('quantity_raw_materials', 'raw_materials.raw_material_id', '=', 'quantity_raw_materials.raw_material_id')->groupBy('raw_materials.raw_material_id')->get();
                $removeQuantity = DB::table('raw_materials')->selectRaw('sum(quantity) as quantity')->where('quantity_raw_materials.raw_material_id', '=', $request['raw_material_id' . $i])->where('quantity_raw_materials.add_remove', '=', 'remove')->join('quantity_raw_materials', 'raw_materials.raw_material_id', '=', 'quantity_raw_materials.raw_material_id')->groupBy('raw_materials.raw_material_id')->get();
//
//
                $addQuantity->isEmpty() ? $add_existence_quantity = 0 : $add_existence_quantity = $addQuantity[0]->quantity;
                $removeQuantity->isEmpty() ? $remove_existence_quantity = 0 : $remove_existence_quantity = $removeQuantity[0]->quantity;
                $alreadyExistence = $add_existence_quantity - $remove_existence_quantity;
//
                $qr = new QuantityRawMaterial();
                $qr->add_remove = 'add';
                $qr->quantity = $request['quantity' . $i];
                $qr->date = trim($request['date']);
                $qr->existent_quantity = $alreadyExistence + $request['quantity' . $i];
                $qr->more_info = trim($request['more_info']);
                $qr->raw_material_id = $request['raw_material_id' . $i];
                $qr->save();

                RawMaterial::where('raw_material_id', '=', $request['raw_material_id' . $i])->update([
                    'existent_quantity' => $qr->existent_quantity

                ]);
            }
        }
        $rsData = RawSupplier::where('supplier_invoice_id', $invoice->supplier_invoice_id)->sum('total');
        $updateIn = DB::table('supplier_invoices')
            ->where('supplier_invoice_id', $invoice->supplier_invoice_id)
            ->update(
                [
                    'all_total' => $rsData,
                    'all_money' => ($rsData + $invoice->other_expense),
                ]
            );
        $INdata = SupplierInvoice::select('all_total')->where('supplier_invoice_id', $invoice->supplier_invoice_id)->get();
        $invoice->all_money = $INdata[0]->all_total + $request->other_expense;
        $ledger = new SupplierLedger();
        $ledger->date = $invoice->date;
        $ledger->purchase = $INdata[0]->all_total;
//
//
        if ($payment == 'debt') {
            $debtAmount = Supplier::select('remaining_debt')->where('supplier_id', $invoice->supplier_id)->get();
            $remainingMoney = $INdata[0]->all_total - $givingMoney;
            DB::table('suppliers')->where('supplier_id', $invoice->supplier_id)
                ->update(['remaining_debt' => $debtAmount[0]->remaining_debt + $remainingMoney]);

            $ledger->giving_money = $givingMoney;
        } else {
            $ledger->giving_money = $INdata[0]->all_total;
        }
        $ledger->more_info = $invoice->more_info;
        $ledger->supplier_id = $invoice->supplier_id;

        $allPurchase = DB::table('suppliers')->selectRaw('sum(purchase) as purchase')->where('supplier_ledgers.supplier_id', '=', $request->supplier_id)->join('supplier_ledgers', 'suppliers.supplier_id', '=', 'supplier_ledgers.supplier_id')->groupBy('supplier_ledgers.supplier_id')->get();
        $allReceives = DB::table('suppliers')->selectRaw('sum(giving_money) as giving_money')->where('supplier_ledgers.supplier_id', '=', $invoice->supplier_id)->join('supplier_ledgers', 'suppliers.supplier_id', '=', 'supplier_ledgers.supplier_id')->groupBy('supplier_ledgers.supplier_id')->get();

        $allPurchase->isEmpty() ? $all_purchases = 0 : $all_purchases = $allPurchase[0]->purchase;
        $allReceives->isEmpty() ? $all_recieves = 0 : $all_recieves = $allReceives[0]->giving_money;

        $givingMoney == null ? $giving_money = $INdata[0]->all_total : $giving_money = $givingMoney;
        $balance = ($all_purchases + $INdata[0]->all_total) - ($all_recieves + $giving_money);
        $ledger->balance = $balance;

        DB::table('suppliers')
            ->where('supplier_id', $invoice->supplier_id)
            ->update(['remaining_debt' => $balance]);

        $ledger->save();

        $amount = Investment::select('amount')->get();
//
        if ($amount->isEmpty()) {
            $investment =new Investment();
            $investment->amount = 0;
            $investment->save();
        }

        $amount2 = Investment::select('amount')->get();

        DB::table('investments')
            ->update(['amount' => $amount2[0]->amount - ($ledger->giving_money + $invoice->other_expense)]);



        if ($invoice && $ledger && $rs) {
//
//            $invoice = SupplierInvoice::join('suppliers', 'suppliers.supplier_id', '=', 'supplier_invoices.supplier_id')
//                ->join('supplier_ledgers', 'supplier_ledgers.supplier_id', '=', 'suppliers.supplier_id')
//                ->where('supplier_invoices.supplier_invoice_id', $invoice->supplier_invoice_id)
//                ->where('supplier_ledgers.supplier_ledger_id', $ledger->supplier_ledger_id)
//                ->get();
//
//
//            $rs2 = RawSupplier::join('supplier_invoices', 'supplier_invoices.supplier_invoice_id', '=', 'raw_Suppliers.supplier_invoice_id')
//                ->join('raw_materials', 'raw_materials.raw_material_id', '=', 'raw_Suppliers.raw_material_id')
//                ->where('raw_suppliers.supplier_invoice_id', $rs->supplier_invoice_id)
//                ->get();
//
            return redirect()->back()->with(['success' => 'انجام شد!']);

        } else {
            return redirect()->back()->with(['warning' => 'دوباره کوشش نمایید']);
        }
    }

    public function listSupplierInvoices(){
        $invoice = DB::table('suppliers')->join('supplier_invoices','suppliers.supplier_id','=','supplier_invoices.supplier_id')->get();
        return view('factory.material.list_supplier_invoices', ['invoice'=>$invoice]);
    }

    public function supplierInvoiceDetail($id){
        $rawSupplier = DB::table('suppliers')
            ->select('suppliers.*', 'supplier_invoices.*', 'raw_suppliers.*', 'raw_materials.*', 'supplier_invoices.more_info as extra_info')
            ->join('supplier_invoices','suppliers.supplier_id','=','supplier_invoices.supplier_id')
            ->join('raw_suppliers','supplier_invoices.supplier_invoice_id','=','raw_suppliers.supplier_invoice_id')
            ->join('raw_materials','raw_suppliers.raw_material_id','=','raw_materials.raw_material_id')
            ->where('raw_suppliers.supplier_invoice_id',$id)
            ->get();

        $invoice = SupplierInvoice::find($id);
        return view('factory.material.supplier_invoice_detail', ['rawSupplier' => $rawSupplier, 'invoice'=>$invoice]);
    }


}
