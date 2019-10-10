<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerInvoice;
use App\CustomerLedger;
use App\Investment;
use App\Product;
use Morilog\Jalali\Jalalian;
use App\ProductCustomer;
use App\QuantityProduct;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function addProduct(){
        return view('factory.product.add_product');
    }

    public function postProduct(Request $request){
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_type = $request->product_type;
        $product->estimated_price = $request->estimated_price;
        $product->existent_quantity = 0;
        $product->more_info = $request->more_info;
        $product->save();
        if ($product){
            return redirect()->back()->with(['success' => 'عملیه ثبت موففانه صورت گرفت!']);
        }else{
            return redirect()->back()->with(['warning' => 'دوباره کوشش کنید!']);
        }
    }

    public function listProducts(){
        $product = Product::all();
        return view('factory.product.list_products', ['product'=>$product]);
    }

    public function editProduct($id){
        $product = Product::find($id);
        return View('factory.product.edit_product', ['product' => $product]);
    }

    public function postEditProduct(Request $request, $id){
        $product = Product::where('product_id', '=', $id)->update([
            'product_name' => $request->product_name,
            'product_type' => $request->product_type,
            'estimated_price' => $request->estimated_price,
            'more_info' => $request->more_info,
        ]);
        if ($product){
            return redirect()->action('ProductController@listProducts')->with('editRecordMessage', 'تغییرات موفقانه انجام شد!');
        }else{
            return redirect()->back()->with(['warning' => 'دوباره کوشش نمایید!']);
        }
    }

    public function deleteProduct(Request $request){
        $product = Product::where('product_id', $request->product_id)->delete();
        if ($product){
            return redirect()->back()->with('deleted', 'عملیه حذف موفقانه انجام شد!');
        }
        else{
            return redirect()->back()->with('noDeleted', 'دوباره کوشش نمایید!');
        }
    }

    public function addQuantityProduct($id){
        $product = Product::find($id);
        return View('factory.product.add_quantity_product', ['product' => $product]);
    }

    public function postQuantityProduct(Request $request,$id){
        $addQuantity = DB::table('products')->selectRaw('sum(quantity) as quantity')->where('products.product_id', '=' ,$id)->where('quantity_products.add_remove', '=' , 'add')->join('quantity_products','products.product_id','=','quantity_products.product_id')->groupBy('quantity_products.product_id')->get();
        $removeQuantity = DB::table('products')->selectRaw('sum(quantity) as quantity')->where('products.product_id', '=' ,$id)->where('quantity_products.add_remove', '=' , 'remove')->join('quantity_products','products.product_id','=','quantity_products.product_id')->groupBy('quantity_products.product_id')->get();
        $addQuantity->isEmpty() ? $add_existence_quantity = 0  : $add_existence_quantity = $addQuantity[0]->quantity  ;
        $removeQuantity->isEmpty() ? $remove_existence_quantity = 0  :  $remove_existence_quantity = $removeQuantity[0]->quantity ;
        $alreadyExistence = $add_existence_quantity - $remove_existence_quantity;

        $productQuantity = new QuantityProduct();
        $productQuantity->add_remove = 'add';
        $productQuantity->quantity = $request->quantity;
        $productQuantity->existent_quantity = $alreadyExistence + $request->quantity;
        $productQuantity->date = $request->date;
        $productQuantity->more_info = $request->more_info;
        $productQuantity->product_id = $id;
        $productQuantity->save();

        Product::where('product_id', '=', $id)->update([
            'existent_quantity' => $productQuantity->existent_quantity
        ]);

        if ($productQuantity){
            return redirect()->action('ProductController@listProducts')->with('editRecordMessage', 'تغییرات موفقانه انجام شد!');
        }else{
            return redirect()->back()->with(['warning' => 'دوباره کوشش نمایید!']);
        }
    }

    public function listQuantityProduct($id)
    {

        $quantityProduct = DB::table('products')
            ->join('quantity_products', 'products.product_id', '=', 'quantity_products.product_id')
            ->select('*', 'quantity_products.more_info as description')
            ->where('quantity_products.product_id', $id)->get();

        return view('factory.product.list_quantity_product', ['quantityProduct'=> $quantityProduct]);

    }

    public function saleProduct(){
        $customer=Customer::all();
        $product=Product::all();
        $invoiceId =  CustomerInvoice::select('customer_invoice_id')->max('customer_invoice_id') + 1;
        return view('factory.product.sale_product',['customer'=>$customer,'product'=>$product, 'invoiceId'=>$invoiceId]);
    }


    public function InvoiceCode()

    {
        $invoice = CustomerInvoice::all();
        $code = "";

        if (!$invoice->isEmpty()) {
            foreach($invoice as $key => $value)
            {
                $number = $value->customer_invoice_id + 1;
                $code = 'Invoice-'.$number;
            }
        } else {
            $code = 'Invoice-1';
        }
        return $code;
    }

    public function postSaleProduct(Request $request)
    {
//        return dd($request);


        $code = $this->InvoiceCode();

        $numberOfMateril = $request['counter'];


        $receivedDebt = trim($request['received_debt']);
        $payment = trim($request['payment']);
        $mount = Investment::select('amount')->get();
//
        if ($mount->isEmpty()) {
            $investment =new Investment();
            $investment->amount = 0;
            $investment->save();
        }

        $invoice = new CustomerInvoice();
        $invoice->customer_invoice_no = $code;
        $invoice->date = trim($request['date']);
        if($request['other_expense'] == null){
            $invoice->other_expense = 0;
        }
        else{
            $invoice->other_expense = trim($request['other_expense']);
        }
        $invoice->tax = trim($request['tax']);
        $invoice->more_info = trim($request['more_info']);
        $invoice->customer_id = trim($request['customer_id']);
        $invoice->save();
//
        for ($i = 1; $i <= $numberOfMateril; $i++) {
            if ($request['product_id' . $i]) {
                $rs = new ProductCustomer();
                $rs->price = $request['price' . $i];
                $rs->quantity = $request['quantity' . $i];
                $rs->total = ($request['quantity' . $i]) * ($request['price' . $i]);
                $rs->packs = str_replace('+',' ,',$request['packs' . $i]);
                $rs->packsCount = $request['packsCount' . $i];
                $rs->product_id = $request['product_id' . $i];
                $rs->customer_invoice_id = $invoice->customer_invoice_id;
                $rs->save();

                $addQuantity = DB::table('products')->selectRaw('sum(quantity) as quantity')->where('quantity_products.product_id', '=', $request['product_id' . $i])->where('quantity_products.add_remove', '=', 'add')->join('quantity_products', 'products.product_id', '=', 'quantity_products.product_id')->groupBy('products.product_id')->get();
                $removeQuantity = DB::table('products')->selectRaw('sum(quantity) as quantity')->where('quantity_products.product_id', '=', $request['product_id' . $i])->where('quantity_products.add_remove', '=', 'remove')->join('quantity_products', 'products.product_id', '=', 'quantity_products.product_id')->groupBy('products.product_id')->get();
//
//
                $addQuantity->isEmpty() ? $add_existence_quantity = 0 : $add_existence_quantity = $addQuantity[0]->quantity;
                $removeQuantity->isEmpty() ? $remove_existence_quantity = 0 : $remove_existence_quantity = $removeQuantity[0]->quantity;
                $alreadyExistence = $add_existence_quantity - $remove_existence_quantity;
//
                $qr = new QuantityProduct();
                $qr->add_remove = 'remove';
                $qr->quantity = $request['quantity' . $i];
                $qr->date = trim($request['date']);
                $qr->existent_quantity = $alreadyExistence - $request['quantity' . $i];
                $qr->more_info = trim($request['more_info']);
                $qr->product_id = $request['product_id' . $i];
                $qr->save();

                Product::where('product_id', '=', $request['product_id' . $i])->update([
                    'existent_quantity' => $qr->existent_quantity

                ]);
            }
        }
        $rsData = ProductCustomer::where('customer_invoice_id', $invoice->customer_invoice_id)->sum('total');
        $updateIn = DB::table('customer_invoices')
            ->where('customer_invoice_id', $invoice->customer_invoice_id)
            ->update(
                [
                    'all_total' => $rsData,
                    'all_money' => ($rsData + $invoice->other_expense),
                ]
            );
        $INdata = CustomerInvoice::select('all_total')->where('customer_invoice_id', $invoice->customer_invoice_id)->get();
        $invoice->all_money = $INdata[0]->all_total + $request->other_expense;
        $ledger = new CustomerLedger();
        $ledger->date = $invoice->date;
        $ledger->type = "فروش";
        $ledger->extra_expense = $request->other_expense;
        $ledger->sale = $INdata[0]->all_total;
        $ledger->total = $INdata[0]->all_total + $request->other_expense;
//
//
        if ($payment == 'debt') {
            $debtAmount = Customer::select('remaining_debt')->where('customer_id', $invoice->customer_id)->get();
            $remainingMoney = $INdata[0]->all_total - $receivedDebt;
            DB::table('customers')->where('customer_id', $invoice->customer_id)
                ->update(['remaining_debt' => $debtAmount[0]->remaining_debt + $remainingMoney]);

            $ledger->received_debt = $receivedDebt;
        } else {
            $ledger->received_debt = $ledger->total;
        }
        $ledger->more_info = $invoice->more_info;
        $ledger->customer_id = $invoice->customer_id;

        $allPurchase = DB::table('customers')->selectRaw('sum(total) as total')->where('customer_ledgers.customer_id', '=', $request->customer_id)->join('customer_ledgers', 'customers.customer_id', '=', 'customer_ledgers.customer_id')->groupBy('customer_ledgers.customer_id')->get();
        $allReceives = DB::table('customers')->selectRaw('sum(received_debt) as received_debt')->where('customer_ledgers.customer_id', '=', $invoice->customer_id)->join('customer_ledgers', 'customers.customer_id', '=', 'customer_ledgers.customer_id')->groupBy('customer_ledgers.customer_id')->get();

        $allPurchase->isEmpty() ? $all_sales = 0 : $all_sales = $allPurchase[0]->total;
        $allReceives->isEmpty() ? $all_recieves = 0 : $all_recieves = $allReceives[0]->received_debt;

        $receivedDebt == null ? $received_debt = $invoice->all_money : $received_debt = $receivedDebt;
        $balance = ($all_sales + $ledger->total) - ($all_recieves + $received_debt);
        $ledger->balance = $balance;

        DB::table('customers')
            ->where('customer_id', $invoice->customer_id)
            ->update(['remaining_debt' => $balance]);

        $ledger->save();

        $mount2 = Investment::select('amount')->get();

        DB::table('investments')
            ->update(['amount' => $mount2[0]->amount + $ledger->received_debt]);

        if ($invoice && $ledger && $rs) {
//
            $invoice = customerInvoice::join('customers', 'customers.customer_id', '=', 'customer_invoices.customer_id')
                ->join('customer_ledgers', 'customer_ledgers.customer_id', '=', 'customers.customer_id')
                ->where('customer_invoices.customer_invoice_id', $invoice->customer_invoice_id)
                ->where('customer_ledgers.customer_ledger_id', $ledger->customer_ledger_id)
                ->get();


            $cp = ProductCustomer::join('customer_invoices', 'customer_invoices.customer_invoice_id', '=', 'product_customers.customer_invoice_id')
                ->join('products', 'products.product_id', '=', 'product_customers.product_id')
                ->where('product_customers.customer_invoice_id', $rs->customer_invoice_id)
                ->get();

            return redirect()->back()->with(['invoice'=>$invoice,'cp'=>$cp]);;

        } else {
            return redirect()->back()->with(['warning' => 'دوباره کوشش نمایید']);
        }
    }

    public function listCustomerInvoices(){
        $invoice = DB::table('customers')->join('customer_invoices','customers.customer_id','=','customer_invoices.customer_id')->where('customer_invoices.deleted_at', '=', Null)->get();
        return view('factory.product.list_customer_invoices', ['invoice'=>$invoice]);
    }

    public function customerInvoiceDetail($id){
        $productCustomer = DB::table('customers')
            ->select('customers.*', 'customer_invoices.*', 'product_customers.*', 'products.*', 'customer_invoices.more_info as extra_info')
            ->join('customer_invoices','customers.customer_id','=','customer_invoices.customer_id')
            ->join('product_customers','customer_invoices.customer_invoice_id','=','product_customers.customer_invoice_id')
            ->join('products','product_customers.product_id','=','products.product_id')
            ->where('product_customers.customer_invoice_id',$id)
            ->get();

        $invoice = CustomerInvoice::find($id);
        return view('factory.product.customer_invoice_detail', ['productCustomer' => $productCustomer, 'invoice'=>$invoice]);
    }

    public function customerInvoiceReturn(Request $request){

        $invoice = CustomerInvoice::where('customer_invoice_id','=',$request->customer_invoice_id)->get();
        $customerLedger = CustomerLedger::where('customer_id','=',$invoice[0]->customer_id)->orderBy('created_at', 'desc')->first();
        $productCustomer = ProductCustomer::where('customer_invoice_id','=',$request->customer_invoice_id)->get();
        $product = Product::all();




        $ledger = new CustomerLedger();
        $ledger->date = Jalalian::fromDateTime(Carbon::now())->format('Y-m-d');
        $ledger->type = "بازگشت";
        $ledger->extra_expense = $invoice[0]->other_expense;
        $ledger->sale = $invoice[0]->all_total;
        $ledger->total = $invoice[0]->all_money;
        $ledger->received_debt = $invoice[0]->all_money;
        $ledger->more_info = trim($request->more_info);
        $ledger->customer_id = $invoice[0]->customer_id;
        $ledger->balance = $customerLedger->balance - $invoice[0]->all_money;
        $ledger->save();

        Customer::where('customer_id', '=', $invoice[0]->customer_id)->update([
                'remaining_debt' => $ledger->balance,
            ]
        );

        CustomerInvoice::where('customer_invoice_id', '=', $request->customer_invoice_id)->delete();
        ProductCustomer::where('customer_invoice_id', '=', $request->customer_invoice_id)->delete();

        for ($i = 0; $i < count($productCustomer); $i++) {
            for($j = 0; $j < count($product); $j++){
                if($productCustomer[$i]->product_id == $product[$j]->product_id){
                    $quantityProduct = QuantityProduct::where('product_id','=',$product[$j]->product_id)->orderBy('created_at', 'desc')->first();

                    $qr = new QuantityProduct();
                    $qr->add_remove = 'add';
                    $qr->quantity = $productCustomer[$i]->quantity;
                    $qr->date = $ledger->date;
                    $qr->existent_quantity = $quantityProduct->existent_quantity + $productCustomer[$i]->quantity;
                    $qr->more_info = trim($request['more_info']);
                    $qr->product_id = $product[$j]->product_id;
                    $qr->save();

                    Product::where('product_id', '=', $product[$j]->product_id)->update([
                        'existent_quantity' => $qr->existent_quantity

                    ]);


                }

            }
        }

        $amount = Investment::select('amount')->get();
        DB::table('investments')->update(['amount' => $amount[0]->amount - $invoice[0]->all_money]);

        return redirect()->action('ProductController@listCustomerInvoices')->with('returnInvoice', 'بل مورد نظر موفقانه برگشت نمود!');



    }
}
