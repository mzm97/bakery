@extends('admin/layouts/default')
@section('title')
پرداخت معاش
@stop
@section('header')

@stop
@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    صفحه عمومی
                </a>
            </li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                @if(session('info'))
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
                        <strong >{{ session('info') }}</strong>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
                        <strong >{{ session('success') }}</strong>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
                @if($payment[0]->giving_amount != 0)
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="" style="text-align: center;">
                                <h2>معاش  این ماه از کارمند مذکور پرداخته شده است.</h2>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="panel panel-primary" id="hidepanel1">
                        <div class="panel-heading">
                            <h3 class="panel-title">

                                <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                پرداخت معاش
                            </h3>
                            <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up clickable"></i>
                                </span>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal basic1" action="{{ route('admin.post_pay_salary') }}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group" style="display: none">
                                    <label class="col-md-3 control-label" for="salary_payment_id">Salary Payment Id:</label>
                                    <div class="col-md-9">
                                        <input id="salary_payment_id" name="salary_payment_id" type="text" class="form-control" readonly style="color: red ;" value="{{ $payment[0]->salary_payment_id }}"></div>
                                </div>

                                <div class="form-group" >
                                    <label class="col-md-3 control-label" for="salary">اسم کارمند:</label>
                                    <div class="col-md-9">
                                        <input id="salary" name="salary" type="text" class="form-control" readonly style="color: red ;" value="{{ $payment[0]->employee_name }}"></div>
                                </div>

                                <div class="form-group" >
                                    <label class="col-md-3 control-label" for="salary">موقف وظیفوی :</label>
                                    <div class="col-md-9">
                                        <input id="salary" name="salary" type="text" class="form-control" readonly style="color: red ;" value="{{ $payment[0]->position }}"></div>
                                </div>

                                <div class="form-group" >
                                    <label class="col-md-3 control-label" for="salary">معاش اصلی :</label>
                                    <div class="col-md-9">
                                        <input id="salary" name="salary" type="text" class="form-control" readonly style="color: red ;" value="{{ $payment[0]->salary }}"></div>
                                </div>

                                <span style="display: none">{{$totalAfterAbsent = number_format((($payment[0]->salary/30) * (30 - $payment[0]->absence_quantity)), 0, '.', '')}}</span>

                                <div class="form-group" >
                                    <label class="col-md-3 control-label" for="salary">معاش قابل پرداخت :</label>
                                    <div class="col-md-9">
                                        <input id="employee_name" name="employee_name" type="text" class="form-control" readonly style="color: red ;" value="{{ $totalAfterAbsent + $payment[0]->old_balance + $payment[0]->over_time - $payment[0]->advance }}"></div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="giving_money">مقدار پول  :</label>
                                    <div class="col-md-9">
                                        @if($payment[0]->giving_amount == 0)
                                            <input id="giving_money" name="giving_money" type="number" placeholder="مقدار پول را وارد نمایید." class="form-control" required value="{{ $payment[0]->giving_amount }}">
                                        @else
                                            <input id="giving_money" name="giving_money" type="text" class="form-control" readonly style="color: red ;" value="{{ $payment[0]->giving_amount }}">
                                        @endif
                                    </div>
                                </div>




                                <div class="form-position">
                                    <div class="col-md-12 text-right">
                                        @if($payment[0]->giving_amount == 0)
                                            <button type="submit" class="btn btn-responsive btn-primary btn-sm">پرداخت</button>
                                        @else
                                            <button type="submit" class="btn btn-responsive btn-primary btn-sm" disabled>پرداخت</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </section>



    {{--@if(session('pay_salary'))--}}

        {{--<section class="content basic1">--}}
            {{--<div class="row" >--}}

                {{--<div class="col-lg-4 col-lg-offset-4">--}}

                    {{--<div class="card pull-right">--}}

                        {{--<div class="content basic1" id="cardForprint">--}}
                            {{--@foreach(session('pay_salary') as $ps)--}}
                                {{--<div class="header1">--}}
                                    {{--<h4>--}}
                                      {{--شرکت کیک B ابراهیمی--}}
                                    {{--</h4>--}}
                                    {{----}}
                                    {{--<h3><b>بل پرداخت معاش</b></h3>--}}
                                {{--</div>--}}

                                {{--<div class="header basic1">--}}
                                    {{--<p style="display:inline-block" ><b>اسم کارمند :</b>&nbsp;&nbsp;{{ $ps->employee_name }} <span id="employeeP"><b>موقف وظیفوی : </b>&nbsp;&nbsp;{{ $ps->position }}</span></p>--}}
                                {{--</div>--}}


                                {{--<div class="details basic1">--}}
                                    {{--<p style="display:inline-block"><b>تاریخ پرداخت معاش :</b>&nbsp;&nbsp;{{ Carbon\Carbon::parse(now())->format('d-M-Y') }}</p>--}}
                                    {{--<p><b>مقدار پول پرداخت شده : </b>&nbsp;&nbsp;{{ $ps->giving_amount }}&nbsp;&nbsp;افغانی</p>--}}
                                {{--</div>--}}
                                {{--<div class="footer basic1">--}}
                                    {{--<p><b>امضا کارمند :</b>&nbsp;&nbsp;........................................</p>--}}
                                {{--</div>--}}


                            {{--@endforeach--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<button class="btn btn-primary btn-sm pull-left" role="button" onclick="$('#cardForprint').printThis();" style="margin-right: 30px;">--}}
                        {{--<span class="glyphicon glyphicon-print"></span> پرینت بل--}}
                    {{--</button>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</section>--}}

    {{--@endif--}}

    <script type="text/javascript">
        function showdebt(event) {
            event.preventDefault();
            var Id=$("#select21").val();
            $.post("{{ route('admin.employee_currency_ajax') }}",{employee:Id,_token:"{{ Session::token() }}"},function (data,status) {
                $("#salary").empty();
                $("#employee_name").empty();
                $.each(data,function (index,$remainData) {
                    $("#salary").val($remainData.salary);
                    $("#employee_name").val($remainData.employee_name);
                    $("#remaining_salary").val($remainData.remaining_salary);
                    $("#employee_id").val($remainData.employee_id);
                });
            });

        };
    </script>

@stop
