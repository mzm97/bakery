@extends('admin/layouts/default2')
@section('title')
    آرشیف معاشات کارمندان
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
            <div class="col-lg-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
                        <strong >{{ session('success') }}</strong>
                    </div>
                @endif


                <div class="panel panel-primary filterable">
                    <div class="panel-heading clearfix  ">
                        <div class="panel-title pull-left">
                            <div class="caption">
                                <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                آرشیف معاشات کارمندان
                            </div>
                        </div>
                        <div class="pull-right">
                        <a href="{{ URL::to('admin/payment') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon"></span>ماه فعلی</a>
                        </div>
                    </div>

                    <div class="panel-body table-responsive">

                        <table class="table table-striped table-bordered" id="archive_salary_sheet" width="100%">
                            <thead>
                            <tr>
                                <th>شماره</th>
                                <th>کارمند</th>
                                <th>موقف وظیفوی</th>
                                <th>ماه</th>
                                <th>معاش</th>
                                <th>غیرحاضری</th>
                                <th>مجموعه</th>
                                <th>پیش پرداخت</th>
                                <th>باقیمانده ماه گذشته</th>
                                <th>اضافه کاری</th>
                                <th>معاش کلی</th>
                                <th>پرداخت شده</th>
                                <th>بیلانس باقی مانده</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1 ?>
                            @foreach($payment as $pay)
                                <span style="display: none">{{$totalAfterAbsent = number_format((($pay->salary/30) * (30 - $pay->absence_quantity)), 0, '.', '')}}</span>
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $pay->employee_name }}</td>
                                    <td>{{ $pay->position }}</td>
                                    <td>{{ Carbon\Carbon::parse($pay->created_at)->format('M-Y') }}</td>
                                    <td>{{ $pay->salary }}</td>
                                    <td>{{ $pay->absence_quantity }}</td>
                                    <td>{{ $totalAfterAbsent }}</td>
                                    <td>{{ $pay->advance }}</td>
                                    <td>{{ $pay->old_balance }}</td>
                                    <td>{{ $pay->over_time }}</td>
                                    <td>{{ $totalAfterAbsent + $pay->old_balance + $pay->over_time - $pay->advance }} </td>
                                    <td>{{ $pay->giving_amount }}</td>
                                    <td>{{ $totalAfterAbsent + $pay->old_balance + $pay->over_time - $pay->advance - $pay->giving_amount }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

@stop

