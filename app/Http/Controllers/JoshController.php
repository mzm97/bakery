<?php namespace App\Http\Controllers;


use App\Customer;
use App\Employee;
use App\Product;
use App\RawMaterial;
use App\Supplier;
use App\Withdraw;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Morilog\Jalali\Jalalian;
use Sentinel;
use Analytics;
use View;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;
use Charts;
use App\User;
use Illuminate\Support\Facades\DB;
use Spatie\Analytics\Period;
use Illuminate\Support\Carbon;
use File;


class JoshController extends Controller {

    /**
     * Message bag.
     *
     * @var Illuminate\Support\MessageBag
     */
    protected $messageBag = null;

    /**
     * Initializer.
     *
     */
    public function __construct()
    {
        $this->messageBag = new MessageBag;

    }

    /**
     * Crop Demo
     */
    public function crop_demo()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $targ_w = $targ_h = 150;
            $jpeg_quality = 99;

            $src = base_path().'/public/assets/img/cropping-image.jpg';

            $img_r = imagecreatefromjpeg($src);

            $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

            imagecopyresampled($dst_r,$img_r,0,0,intval($_POST['x']),intval($_POST['y']), $targ_w,$targ_h, intval($_POST['w']),intval($_POST['h']));

            header('Content-type: image/jpeg');
            imagejpeg($dst_r,null,$jpeg_quality);

            exit;
        }
    }

//    public function showHome()
//    {
//        if(Sentinel::check())
//            return view('admin.index');
//        else
//            return redirect('admin/signin')->with('error', 'You must be logged in!');
//    }

    public function showView($name=null)
    {

        if(View::exists('admin/'.$name))
        {
            if(Sentinel::check())
                return view('admin.'.$name);
            else
                return redirect('admin/signin')->with('error', 'You must be logged in!');
        }
        else
        {
            abort('404');
        }
    }

    public function activityLogData()
    {
        $logs = Activity::get(['causer_id', 'log_name', 'description','created_at']);
        return DataTables::of($logs)
            ->make(true);
    }



    public function showHome()
    {
        $storagePath = storage_path().'/app/analytics/';
        if (File::exists($storagePath . 'service-account-credentials.json')) {
            //Last week visitors statistics
            $month_visits = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7))->groupBy(function (array $visitorStatistics) {
                return $visitorStatistics['date']->format('Y-m-d');
            })->map(function ($visitorStatistics, $yearMonth) {
                list($year, $month ,$day) = explode('-', $yearMonth);
                return ['date' => "{$year}-{$month}-{$day}", 'visitors' => $visitorStatistics->sum('visitors'), 'pageViews' => $visitorStatistics->sum('pageViews')];
            })->values();

            //yearly visitors statistics
            $year_visits = Analytics::fetchTotalVisitorsAndPageViews(Period::days(365))->groupBy(function (array $visitorStatistics) {
                return $visitorStatistics['date']->format('Y-m');
            })->map(function ($visitorStatistics, $yearMonth) {
                list($year, $month ) = explode('-', $yearMonth);
                return ['date' => "{$year}-{$month}", 'visitors' => $visitorStatistics->sum('visitors'), 'pageViews' => $visitorStatistics->sum('pageViews')];
            })->values();

            // total page visitors and views
            $visitorsData = Analytics::performQuery(Period::days(7), 'ga:visitors,ga:pageviews', ['dimensions' => 'ga:date']);
            $visitorsData = collect($visitorsData['rows'] ?? [])->map(function (array $dateRow) {
                return [

                    'visitors' => (int) $dateRow[1],
                    'pageViews' => (int) $dateRow[2],
                ];
            });
            $visitors =0;
            $pageVisits =0;
            foreach ($visitorsData as $val)
            {
                $visitors += $val['visitors'];
                $pageVisits += $val['pageViews'];

            }
            $analytics_error = 0;
        }else{
            $month_visits = 0;
            $year_visits = 0;
            $visitors =0;
            $pageVisits =0;
            $analytics_error = 1;
        }


        //total users


        // Manual code

        $user_count =User::count();
        $employee_count =Employee::count();
        $supplier_count =Supplier::count();
        $customer_count =Customer::count();

        $customers = Customer::orderBy('customer_id', 'desc')->take(6)->get();
        $suppliers = Supplier::orderBy('supplier_id', 'desc')->take(6)->get();


        $currentMonth = Jalalian::fromDateTime(Carbon::now())->getMonth();
        $currentYear = Jalalian::fromDateTime(Carbon::now())->getYear();



        $purchase = DB::table('supplier_invoices')->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)->sum('all_total');
        $sale = DB::table('customer_invoices')->where(DB::raw('MONTH(date)'), '=',$currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)->sum('all_total');;

        $purchaseSale = Charts::create('donut', 'morris')
            ->title('Purchases VS Sales')
//            ->colors(['#f89a14', '#01bc8c'])
            ->labels(['خرید مواد', 'فروش محصول'])
            ->responsive(true)
            ->values([$purchase, $sale])
            ->dimensions(0,200);

        $expense = DB::table('expenses')->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)->sum('amount');
        $emp = DB::table('salary_payments')->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)->sum('giving_amount');
        $advancesMoney = DB::table('salary_advances')->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)->sum('advance_money');
        $allEmployeePayments = $emp + $advancesMoney;

        $rawExpense = DB::table('supplier_invoices')->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)->sum('other_expense');
        $rawBuy = DB::table('supplier_ledgers')->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)->sum('giving_money');

        $raw = $rawExpense + $rawBuy;

        $payment = Charts::create('donut', 'morris')
            ->title('My nice chart')
            ->colors(['#f89a14', '#01bc8c','#418bca'])
            ->labels(['مصارف متفرقه', 'خرید مواد', 'پرداخت به کارمندان'])
            ->values([$expense,$raw,$allEmployeePayments])
            ->dimensions(0,400)
            ->responsive(false);

        $supplierLedger = DB::table('supplier_ledgers')->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)->sum('giving_money');
        $otherExpenses = DB::table('supplier_invoices')->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)->sum('other_expense');
        $totalEpenses = $emp + $expense + $supplierLedger + $otherExpenses + $advancesMoney;
        $totalIncomes = Db::table('customer_ledgers')->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)->sum('received_debt');

        $expenseIncome = Charts::create('donut', 'morris')
            ->title('Expenses and Incomes Results')
            ->colors(['#f89a14', '#01bc8c'])
            ->labels(['مقدار پول مصرف شده', 'مقدار پول بدست آمده'])
            ->responsive(true)
            ->values([$totalEpenses,$totalIncomes])
            ->dimensions(400,200);


        // end manual code



        //total Blogs
        $users = User::orderBy('id', 'desc')->take(6)->get();



        $ourDebt = DB::table('suppliers')->sum('remaining_debt');
        $customersDebt = DB::table('customers')->sum('remaining_debt');

        $debt = Charts::create('donut', 'morris')
            ->title('Expenses and Incomes Results')
            ->colors(['#f89a14', '#01bc8c'])
            ->labels(['قرض ما', 'قرض مشتری'])
            ->responsive(true)
            ->values([$ourDebt,$customersDebt])
            ->dimensions(400,200);



        $currentInvestment = DB::table('investments')->sum('amount');
        $rawMaterial = RawMaterial::sum(DB::raw('(estimated_price * existent_quantity)'));
        $product = Product::sum(DB::raw('(estimated_price * existent_quantity)'));
        $totalWithdraws = Withdraw::sum('amount');
        $withdraw = Withdraw::groupBy('withdraws.partner_id')
            ->join('partners', 'withdraws.partner_id', '=', 'partners.partner_id')
            ->selectRaw('*, sum(withdraws.amount) as sum')
            ->get();


        if(Sentinel::check())
            return view('admin.index',[
                'analytics_error'=>$analytics_error,
                'user_count'=>$user_count,
                'month_visits'=>$month_visits,'year_visits'=>$year_visits,
                'customer_count'=>$customer_count,
                'employee_count'=>$employee_count,
                'supplier_count'=>$supplier_count,
                'customers'=>$customers,
                'suppliers'=>$suppliers,
                'purchaseSale'=>$purchaseSale,
                'expenseIncome'=>$expenseIncome,
                'payment'=>$payment,
                'debt'=>$debt,
                'currentInvestment'=>$currentInvestment,
                'rawMaterial'=>$rawMaterial,
                'product'=>$product,
                'totalWithdraws'=>$totalWithdraws,
                'withdraw'=>$withdraw,
            ]);
        else
            return redirect('admin/signin')->with('error', 'You must be logged in!');
    }

}