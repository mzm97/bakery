<?php

namespace App\Http\Controllers;

use App\Investment;
use Illuminate\Http\Request;
use App\ExpenseType;
use App\Expense;
use Illuminate\Support\Facades\DB;
use DataTables;
use Morilog\Jalali;
use Morilog\Jalali\CalendarUtils;

class ExpensesController extends Controller
{

    public function ExpensTypeListData()
    {
        $tables = ExpenseType::get(['expense_type_id','expense_type', 'more_info']);
        return DataTables::of($tables)
            ->addColumn('edit', '<a class="edit" href="javascript:;"style="margin-right:10px;"><span class="fa  fa-edit" style="font-size:25px;"></a>')
            ->addColumn('delete', '<a class="delete" href="#" data-target="#deleteConfirmModal" data-toggle="modal" style="margin-right:30px;"><span class="fa  fa-trash" style="font-size:25px;"></a>')
            ->rawColumns(['edit','delete'])
            ->make(true);
    }

    public function update(Request $request, $id)
    {

        $updateExpenseType=ExpenseType::where('expense_type_id',$id)
            ->update([
                'expense_type'=>$request['expensetype'],
                'more_info'=>$request['moreinfo'],
            ]);
        return 'success';
    }

    public function destroy($id)
    {

        $row=ExpenseType::find($id);
        $row->delete();
        return 'success';
    }




    public function ExpensesType(){

        $expenseType = ExpenseType::all();
        return view('expense.expenses_type', ['expenseType' => $expenseType]);

    }

    public function addExpenseType(){
        return view('expense.add_expense_type');
    }

    public function saveExpenseType(Request $request){

        $expenseType = new ExpenseType();
        $expenseType->expense_type = $request->input('expense_type');
        $expenseType->more_info = $request->input('more_info');
        $expenseType->save();
        return redirect()->back()->with('saveMessage', 'موفقانه به ثبت رسید.');
    }

    public function deleteExpenseType(Request $request){
        ExpenseType::where('expense_type_id', $request->expense_type_id)->delete();
        return redirect()->back()->with('deleteMessage', 'well done, desired record is successfully deleted!');
    }

    public function editExpenseType($id){
        $expenseType = ExpenseType::find($id);
        return view('expense.edit_expense_type', ['expenseType' => $expenseType]);
    }

    public function editExpenseTypeRecord(Request $request, $id){
        ExpenseType::where('expense_type_id', '=', $id)->update([
            'expense_type' => $request->expense_type,
            'more_info' => $request->more_info,
        ]);

        return redirect()->action('ExpensesController@expensesType')->with('editRecordMessage', 'Well done, Desired record successfully updated!');
    }

    public function newExpense(){
        $expenseType = ExpenseType::all();
        return view('expense.new_expense', ['expenseType' => $expenseType]);
    }

    public function SaveExpense(Request $request){
//        return $request->date;

        $amount=Investment::select('amount')->get();
        $investmentId=Investment::select('investment_id')->get();

        if($amount->isEmpty()){

            $investment =new Investment();
            $investment->investment_id = 1;
            $investment->amount = -trim($request->amount);
            $investment->save();

            $expense = new Expense();
            $expense->date = $request->date;
            $expense->amount = $request->amount;
            $expense->description = $request->description;
            $expense->expense_type_id = $request->expense_type_id;
            $expense->save();

        }
        else{

            $expense = new Expense();
            $expense->date = $request->date;
            $expense->amount = $request->amount;
            $expense->description = $request->description;
            $expense->expense_type_id = $request->expense_type_id;
            $expense->save();
            $remain=$amount[0]->amount - $request['amount'];
            $inv=Investment::where('investment_id',$investmentId[0]->investment_id)->update(['amount'=>$remain,]);
            return redirect()->back()->with('saveMessage', 'موفقانه به ثبت رسید.');
        }


    }

    public function ListExpenses(){
        $expense = DB::table('expense_types')
            ->select('expense_types.*','expenses.*')
            ->join('expenses','expense_types.expense_type_id','=','expenses.expense_type_id')
            ->get();
        return view('expense.list_expenses', ['expense' => $expense]);
    }
}
