<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Investment;
use App\Attendance;
use App\OverTime;
use App\SalaryAdvance;
use App\SalaryPayment;
use Illuminate\Support\Facades\DB;
use DataTables;
use Morilog\Jalali;
use Morilog\Jalali\CalendarUtils;

class EmployeeController extends Controller
{
    public function AddEmployee()
    {
        return view('employee.add_employee');
    }

    public function AddPostEmployee(Request $request)
    {

        $currentDate=jdate();
        $employee= new Employee();
        $employee->employee_name=trim($request['name']);
        $employee->salary=trim($request['salary']);
        $employee->employee_phone=trim($request['employee_phone']);
        $employee->employee_address=trim($request['employee_address']);
        $employee->position=trim($request['position']);
        $employee->remaining_salary= 0 ;
        $employee->more_info=trim($request['more_info']);
        $employee->save();


        $salaryPayment = new SalaryPayment();
        $salaryPayment->absence_quantity = 0;
        $salaryPayment->over_time = 0;
        $salaryPayment->advance = 0;
        $salaryPayment->old_balance = 0;
        $salaryPayment->giving_amount = 0;
        $salaryPayment->employee_id = $employee->employee_id;
        $salaryPayment->date = CalendarUtils::strftime('Y-m-d', strtotime($currentDate));
        $salaryPayment->save();


        if ($employee){
            return redirect()->back()->with(['success'=> 'کارمند اضافه شد.']);
        }else{
            return redirect()->back()->with(['error'=> 'دوباره کوشش نمایید.']);
        }
    }


    public function EmployeeList(Request $request)
    {
        $employee = employee::all();
        return view('employee.employee_list', ['employee' => $employee]);
    }

    public function EmployeeListData()
    {
        $tables = employee::get(['employee_id','employee_name', 'employee_phone','employee_address','position','salary','more_info']);
        return DataTables::of($tables)
            ->addColumn('edit', '<a class="edit" href="javascript:;"style="margin-right:10px;"><span class="fa  fa-edit" style="font-size:25px;"></a>')
            ->addColumn('delete', '<a class="delete" href="#" data-target="#deleteConfirmModal" data-toggle="modal" style="margin-right:30px;"><span class="fa  fa-trash" style="font-size:25px;"></a>')
            ->rawColumns(['edit','delete'])
            ->make(true);
    }

    public function update(Request $request, $id)
    {

        $updateEmployye=Employee::where('employee_id',$id)
            ->update([
                'employee_name'=>$request['employeename'],
                'employee_phone'=>$request['employeephone'],
                'employee_address'=>$request['address'],
                'position'=>$request['position'],
                'salary'=>$request['salary'],
                'more_info'=>$request['moreinfo']
            ]);
        return 'success';
    }
    public function destroy($id)
    {
        $row=Employee::find($id);
        $row->delete();
        return 'success';
    }

    public function attendance(Request $request)
    {

        $currentDate=jdate();
        $employees=Employee::all();
        $date=Attendance::where('attendance_date',CalendarUtils::strftime('Y-m-d', strtotime($currentDate)))->get();
        return view('employee.attendance',['employees'=>$employees,'date'=>$date]);
    }

    public function PostAttendanceEmployee(Request $request)
    {


        $currentDate=jdate();
        $currentMonth=jdate()->getMonth();
        $currentYear=jdate()->getYear();


        $salaryPay = DB::table('salary_payments')->select('absence_quantity')->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)->get();


        if ($salaryPay->count() != 0){

            foreach($request->employeeId as $num){

                $attendance = new Attendance();
                $attendance->attendance_date = CalendarUtils::strftime('Y-m-d', strtotime($currentDate));
                $attendance->employee_id = $num;
                $attendance->attendance_status=$request->attend[$num];

                if ($request->attend[$num] == 'حاضر') {
                    $attendance->attendance_status = $request->attend[$num];
                } else {
                    $attendance->attendance_status = $request->attend[$num];

                    $oldOverTime = DB::table('salary_payments')->select('absence_quantity')->where('employee_id', '=', $num)->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)->get();
                    DB::table('salary_payments')->where('employee_id', '=', $num)
                        ->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)
                        ->update([
                            'absence_quantity' => $oldOverTime[0]->absence_quantity + 1
                        ]);
                }
                $attendance->save();
            }

        }else{
            return redirect()->route('logout');
        }
        if($attendance){
            return redirect()->back()->with(['success' => 'حاضری گرفته شد.']);
        }else{
            return redirect()->back()->with(['warning' => 'دوباره کوشش نمایید.']);
        }
    }


    public function attendanceStatusReports()
    {

        $attendanceStatus = DB::table('employees')->select('employees.*', DB::raw( "COUNT('attendance_status') as total, SUM(attendance_status = 'حاضر') AS total_present,  YEAR(attendance_date) as year, MONTH(attendance_date) as month,  COUNT(attendance_status) AS total"))
            ->join('attendances', 'employees.employee_id', '=', 'attendances.employee_id')
            ->groupBy(DB::raw("YEAR(attendance_date),MONTH(attendance_date)"), 'attendances.employee_id')
            ->get();
        return view('employee.attendance_status_reports', ['attendanceStatus'=>$attendanceStatus]);
    }

    public function attendance_report()
    {
        $EA=Employee::join('attendances','attendances.employee_id','=','employees.employee_id')->get();
        return view('employee.attendance_report',['EA'=>$EA]);
    }


    public function advance(){
        $advanceSalary =  DB::table('employees')->join('salary_advances', 'employees.employee_id', '=' ,'salary_advances.employee_id')
            ->groupBy('employees.employee_id')
            ->get();
        return view('employee.advance',['advanceSalary'=>$advanceSalary]);
    }

    public function addAdvance(){
        $emp = Employee::all();
        return view('employee.add_advance',['emp'=>$emp]);
    }

    public function saveAdvance(Request $request){

        $currentDate=jdate();
        $currentMonth=jdate()->getMonth();
        $currentYear=jdate()->getYear();
        $amount=Investment::select('amount')->get();
        $oldAdvance = DB::table('salary_payments')->select('advance')->where('employee_id', '=', $request->employee_id)->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)->get();

        if($oldAdvance->count() != 0){
            $advance =new SalaryAdvance();
            $advance->advance_money = trim($request->advance_money);
            $advance->employee_id = trim($request->employee_id);
            $advance->date = CalendarUtils::strftime('Y-m-d', strtotime($currentDate));
            $advance->save();
            DB::table('salary_payments')->where('employee_id', '=', $request->employee_id)
                ->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)
                ->update([
                    'advance' => $oldAdvance[0]->advance + $advance->advance_money
                ]);
            if($amount->isEmpty()){

                $investment =new Investment();
                $investment->investment_id = 1;
                $investment->amount = -trim($request->advance_money);
                $investment->save();

            }
            else{
                DB::table('investments')
                    ->where('investment_id', '1')
                    ->update(['amount' => $amount[0]->amount - trim($request->advance_money)]);
            }
        }
        else{
            return redirect()->route('logout');

        }

        if ($advance){
            return redirect()->action('EmployeeController@advance')->with('saveMessage', 'موفقانه به ثبت رسید.');
        }else{
            return redirect()->back()->with(['warning' => 'دوباره کوشش نمایید.']);
        }

    }

    public function AdvanceDetails($employeeId)
    {

        $data =  DB::table('employees')->join('salary_advances', 'employees.employee_id', '=' ,'salary_advances.employee_id')
            ->where('employees.employee_id',$employeeId)
            ->get();
        return view('employee.advance_statements',['data'=>$data]);
    }

    public function OverTime()
    {
        $overTime =  DB::table('employees')->join('over_times', 'employees.employee_id', '=' ,'over_times.employee_id')
            ->groupBy('employees.employee_id')
            ->get();
        return view('employee.over_time',['overTime'=>$overTime]);
    }

    public function OverTimeDetails($employeeId)
    {

        $data =  DB::table('employees')->join('over_times', 'employees.employee_id', '=' ,'over_times.employee_id')
            ->where('employees.employee_id',$employeeId)
            ->get();
        return view('employee.overtime_statements',['data'=>$data]);
    }

    public function AddOverTime()
    {
        $emp = Employee::all();
        return view('employee.add_over_time',['emp'=>$emp]);
    }

    public function SaveOverTime(Request $request)
    {

        $currentDate=jdate();
        $currentMonth=jdate()->getMonth();
        $currentYear=jdate()->getYear();

        $oldOverTime = DB::table('salary_payments')->select('over_time')->where('employee_id', '=', $request->employee_id)->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)->get();
        if($oldOverTime->count() != 0){

            $overTime =new OverTime();
            $overTime->over_time_money = trim($request->over_time_money);
            $overTime->employee_id = trim($request->employee_id);
            $overTime->date = CalendarUtils::strftime('Y-m-d', strtotime($currentDate));
            $overTime->save();
            DB::table('salary_payments')->where('employee_id', '=', $request->employee_id)
                ->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)
                ->update([
                    'over_time' => $oldOverTime[0]->over_time + $overTime->over_time_money
                ]);
        }
        else{
            return redirect()->route('logout');

        }
        if ($overTime){
            return redirect()->back()->with('saveMessage', 'موفقانه به ثبت رسید.');
        }else{
            return redirect()->back()->with(['warning' => 'دوباره کوشش نمایید.']);

        }
    }

    public function ListPayments(){

        $currentDate=jdate();
        $currentMonth=jdate()->getMonth();
        $currentYear=jdate()->getYear();

        $payment = Employee::
        join('salary_payments','employees.employee_id','=','salary_payments.employee_id')
            ->where(DB::raw('MONTH(salary_payments.date)'), '=', $currentMonth)->where(DB::raw('YEAR(salary_payments.date)'), '=', $currentYear)
            ->get();
        return view('employee.salary_sheet', ['payment' => $payment]);

    }

    public function SalarySheetArchive(){

        $payment = DB::table('employees')->orderBy('salary_payment_id', 'DESC')
            ->join('salary_payments','employees.employee_id','=','salary_payments.employee_id')
            ->get();
        return view('employee.salary_sheet_archive', ['payment' => $payment]);
    }

    public function PaySalary($id)
    {
        $payment = DB::table('employees')
            ->join('salary_payments','employees.employee_id','=','salary_payments.employee_id')
            ->where(DB::raw('MONTH(salary_payments.created_at)'), '=', date('n'))->where(DB::raw('YEAR(salary_payments.created_at)'), '=', date('Y'))
            ->where('salary_payment_id', '=', $id)
            ->get();
        return view('employee.pay_salary',['payment'=>$payment]);
    }
    public function PostPaySalary(Request $request)
    {
        $currentDate=jdate();
        $currentMonth=jdate()->getMonth();
        $currentYear=jdate()->getYear();
        $amount=Investment::select('amount')->get();

        $oldGivingMoney = DB::table('salary_payments')->where('salary_payment_id', '=', $request->salary_payment_id)->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)->get();

        if($amount->isEmpty()){

            $investment =new Investment();
            $investment->investment_id = 1;
            $investment->amount = -trim($request->advance_money);
            $investment->save();

        }
        else{
            $updateInvestment = DB::table('investments')
                ->where('investment_id', '1')
                ->update(['amount' => $amount[0]->amount + $oldGivingMoney[0]->giving_amount  - trim($request['giving_money'])]);
        }

        $updatePayment= DB::table('salary_payments')
            ->where('salary_payment_id', $request->salary_payment_id)
            ->update(['giving_amount' =>  trim($request['giving_money'])]);

        if ($updatePayment){

            $pay_salary=Employee::join('salary_payments','salary_payments.employee_id','employees.employee_id')
                ->where('salary_payments.salary_payment_id',$request->salary_payment_id)
                ->get();
            return redirect()->back()->with(['pay_salary' => $pay_salary]);
        }else{
            return redirect()->back()->with(['warning' => 'Try again']);
        }
    }

    public function EmployeeCurrencyAjax(Request $request){
        $employee_id = $request["employee"];
        $remainData=Employee::where('employee_id',$employee_id)->get();
        return response()->json($remainData, 200);
    }





}
