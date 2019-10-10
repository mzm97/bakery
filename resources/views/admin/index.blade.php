@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    صفحه عمومی
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')


    <link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/only_dashboard.css') }}"/>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/morrisjs/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/dashboard2.css') }}"/>

@stop

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <h1><span class="dashboard1"> صفحه عمومی </span></h1>

        <ol class="breadcrumb">
            <li class="active">
                <a href="#">
                    <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                    صفحه عمومی
                </a>
            </li>
        </ol>
    </section>
    {{--<section class="content">--}}

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig animate_rtl">
            <!-- Trans label pie charts strats here-->
            <div class="widget-1">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                            <div class="square_box col-xs-7 text-right animate_rtl">
                                <span>تهیه کننده گان</span>

                                <div class="number" id="myTargetElement3"></div>
                            </div>
                            <span class="widget_circle3 pull-right animate_rtl">
                                    <i class="livicon livicon-evo-holder " data-name="users" data-l="true" data-c="#01BC8C" data-hc="#01BC8C" data-s="40"></i>
                                </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig animate_rtl">
            <!-- Trans label pie charts strats here-->
            <div class="widget-1">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                            <div class="square_box col-xs-7 text-right animate_rtl">
                                <span>استفاده کننده گان</span>

                                <div class="number" id="myTargetElement4"></div>
                            </div>
                            <span class="widget_circle4 pull-right animate_rtl"><i class="livicon livicon-evo-holder " data-name="user" data-l="true" data-c="#F89A14" data-hc="#F89A14" data-s="40"></i>
                                </span>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig animate_rtl">
            <!-- Trans label pie charts strats here-->
            <div class="widget-1">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                            <div class="square_box col-xs-7 text-right animate_rtl">
                                <span>مشتریان</span>

                                <div class="number" id="myTargetElement1"></div>
                            </div>
                            <span class="widget_circle1 pull-right animate_rtl"><i class="livicon livicon-evo-holder " data-name="users" data-l="true" data-c="#e9573f" data-hc="#e9573f" data-s="40"></i>
                                </span>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig animate_rtl">
            <!-- Trans label pie charts strats here-->
            <div class="widget-1">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                            <div class="square_box col-xs-7 text-right animate_rtl">
                                <span>کارمندان</span>

                                <div class="number" id="myTargetElement2"></div>
                            </div>
                            <span class="widget_circle2 pull-right animate_rtl"><i class="livicon livicon-evo-holder " data-name="user" data-l="true" data-c="#418BCA" data-hc="#418BCA" data-s="40"></i>
                                </span>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/row-->
    <div class="raw">
        <div class="col-lg-4 col-md-6 col-sm-12 animate_rtl">
            <!-- Stack charts starts here-->
            <div class="panel panel-border">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="barchart" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i><span>فروشات و خریدهای ماه فعلی</span>
                    </h3>

                </div>
                <div class="panel-body">
                    <div class="app pie_chart">
                        {!! $purchaseSale->html() !!}
                    </div>
                    <!-- End Of Main Application -->
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 animate_rtl">
            <!-- Stack charts strats here-->
            <div class="panel panel-border">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="barchart" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i><span>مصارف و عایدات در ماه فعلی</span>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="app pie_chart">
                        {!! $expenseIncome->html() !!}
                    </div>
                    <!-- End Of Main Application -->
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-5 animate_rtl">
            <div class="panel panel-border">
                <div class="panel-heading border-light">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="users" data-size="18" data-color="#00bc8c" data-hc="#00bc8c"
                           data-l="true"></i>
                        <span> مشتریان جدید</span>
                    </h3>
                </div>
                <div class="panel-body nopadmar users">
                    @foreach($customers as $cus )
                        <div class="media">
                            <div class="media-left">
                                <img src="{{ asset('assets/images/authors/no_avatar.jpg') }}" class="media-object img-circle" >
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading"><span>{{ $cus->responsible_person }}</span></h5>
                                <p>{{ $cus->email }}  <span class="user_create_date pull-right">{{ $cus->created_at->format('d M') }} </span></p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    {{--row--}}
    <div class="row ">
        <div class="col-lg-4 col-md-4 col-sm-12 animate_rtl">
            <div class="panel panel-border">
                <div class="panel-heading border-light">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="users" data-size="18" data-color="#00bc8c" data-hc="#00bc8c"
                           data-l="true"></i>
                        <span>تهیه کننده گان جدید</span>
                    </h3>
                </div>
                <div class="panel-body nopadmar users">
                    @foreach($suppliers as $sup )
                        <div class="media">
                            <div class="media-left">
                                <img src="{{ asset('assets/images/authors/no_avatar.jpg') }}" class="media-object img-circle" >
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading">{{ $sup->responsible_person }}</h5>
                                <p>{{ $sup->email }}  <span class="user_create_date pull-right">{{ $sup->created_at->format('d M') }} </span></p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-12 animate_rtl">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="barchart" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> <span>پول پرداخت شده در این ماه</span>
                    </h3>
                    <span class="pull-right">
                            <span class="clickable"> <i class="glyphicon glyphicon-chevron-up showhide"></i></span>
                        <i class="glyphicon glyphicon-remove removepanel clickable"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="app pie_chart">
                        {!! $payment->html() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 animate_rtl">
            <!-- Stack charts strats here-->
            <div class="panel panel-border">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="barchart" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i><span>راپور قرض</span>
                    </h3>

                </div>
                <div class="panel-body">
                    <div class="app donut_chart" >
                        {!! $debt->html() !!}
                    </div>
                    <!-- End Of Main Application -->
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 animate_rtl">
            <div class="portlet box default">
                <div class="panel-heading" style="color: white; background-color: #01bc8c;">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="barchart" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> <span>سرمایه</span>
                    </h3>
                    <span class="pull-right">
                            <span class="clickable"> <i class="glyphicon glyphicon-chevron-up showhide"></i></span>
                    </span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                            <tr>
                                <th>
                                    <i class="livicon" data-name="briefcase" data-size="16" data-c="#666666" data-hc="#666666" data-loop="true"></i>
                                    شماره
                                </th>
                                <th>
                                    سرمایه
                                </th>
                                <th>
                                    <i class="fa fa-bookAiri Satou"></i>
                                    مجموعه
                                </th>
                                <th> جزییات </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>سرمایه موجود در محصولات</td>
                                <td>
                                    {{ $product }}
                                    اففانی
                                </td>
                                <td>
                                    <a href="{{  URL::to('admin/list_products') }}" class="btn default btn-xs green-stripe"><i class="livicon" data-name="list" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    2
                                </td>
                                <td>سرمایه موجود در مواد خام</td>
                                <td>
                                    {{ $rawMaterial }} اففانی
                                </td>
                                <td>
                                    <a href="{{  URL::to('admin/list_raw_materials') }}" class="btn default btn-xs green-stripe"><i class="livicon" data-name="list" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    3
                                </td>
                                <td>سرمایه موجود بشکل پول نقد</td>
                                <td>
                                    {{ $currentInvestment }} اففانی
                                </td>
                                <td>
                                    <a href="{{ URL::to('admin/investment') }}" class="btn default btn-xs green-stripe"><i class="livicon" data-name="list" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i></a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 animate_rtl">
            <div class="portlet box default">
                <div class="panel-heading" style="color: white; background-color: #ef6f6c;">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="money" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> <span>مجموعه برداشت ها</span>
                    </h3>
                    <span class="pull-right">
                            <span class="clickable"> <i class="glyphicon glyphicon-chevron-up showhide"></i></span>
                    </span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive" style="font-size:20px; text-align: center">
                        <span>مجموعه برداشت ها:</span>
                        <span style="color: #ef6f6c">{{ $totalWithdraws }} اففانی</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                            <tr>
                                <th>
                                    <i class="livicon" data-name="briefcase" data-size="16" data-c="#666666" data-hc="#666666" data-loop="true"></i>
                                    شماره
                                </th>
                                <th>
                                    شریک
                                </th>
                                <th>
                                    شماره تماس
                                </th>
                                <th>
                                    <i class="fa fa-bookAiri Satou"></i>
                                    مقدار برداشت
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1 ?>
                            @foreach($withdraw as $wit)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $wit->name }}</td>
                                    <td>{{ $wit->phone }}</td>
                                    <td>{{ $wit->sum }}   اففانی</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--</section>--}}

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <!--for calendar-->
    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
    <!-- Back to Top-->
    <script type="text/javascript" src="{{ asset('assets/vendors/countUp_js/js/countUp.js') }}"></script>
    {{--<script src="http://demo.lorvent.com/rare/default/vendors/raphael/js/raphael.min.js"></script>--}}
    <script src="{{ asset('assets/vendors/morrisjs/morris.min.js') }}"></script>

    <script>
        var useOnComplete = false,
            useEasing = false,
            useGrouping = false,
            options = {
                useEasing: useEasing, // toggle easing
                useGrouping: useGrouping, // 1,000,000 vs 1000000
                separator: ',', // character to use as a separator
                decimal: '.' // character to use as a decimal
            };
        var demo = new CountUp("myTargetElement1", 200, {{ $customer_count }}, 0, 6, options);
        demo.start();
        var demo = new CountUp("myTargetElement2", 50, {{ $employee_count }}, 0, 6, options);
        demo.start();
        var demo = new CountUp("myTargetElement3", 24, {{ $supplier_count }}, 0, 6, options);
        demo.start();
        var demo = new CountUp("myTargetElement4", 125, {{ $user_count }}, 0, 6, options);
        demo.start();

        $('.blogs').slimScroll({
            color: '#A9B6BC',
            height: 350 + 'px',
            size: '5px'
        });


        function lineChart() {
            Morris.Line({
                element: 'visitors_chart',
                data: week_data,
                lineColors: ['#418BCA', '#00bc8c', '#EF6F6C'],
                xkey: 'date',
                ykeys: ['pageViews', 'visitors'],
                labels: ['pageViews', 'visitors'],
                pointSize: 0,
                lineWidth: 2,
                resize: true,
                fillOpacity: 1,
                behaveLikeLine: true,
                gridLineColor: '#e0e0e0',
                hideHover: 'auto'

            });
        }
        function barChart() {
            Morris.Bar({
                element: 'bar_chart',
                data: year_data.length ? year_data :   [ { label:"No Data", value:100 } ],
                barColors: ['#418BCA', '#00bc8c'],
                xkey: 'date',
                ykeys: ['pageViews', 'visitors'],
                labels: ['pageViews', 'visitors'],
                pointSize: 0,
                lineWidth: 2,
                resize: true,
                fillOpacity: 0.4,
                behaveLikeLine: true,
                gridLineColor: '#e0e0e0',
                hideHover: 'auto'

            });
        }
        lineChart();
        barChart();
        $(".sidebar-toggle").on("click",function () {
            setTimeout(function () {
                $('#visitors_chart').empty();
                $('#bar_chart').empty();
                lineChart();
                barChart();
            },10);
        });

    </script>


    {!! Charts::scripts() !!}

    {!! $purchaseSale->script() !!}
    {!! $expenseIncome->script() !!}
    {!! $payment->script() !!}
    {!! $debt->script() !!}
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.pie.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.resize.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/d3/d3.min.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/d3pie/d3pie.min.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/c3/c3.min.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/morrisjs/morris.min.js') }}"></script>


@stop





