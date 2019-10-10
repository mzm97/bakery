@extends('admin/layouts/default2')
@section('title')
    پیش پرداخت
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
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary filterable">
                    <div class="panel-heading clearfix  ">
                        <div class="panel-title pull-left">
                            <div class="caption">
                                <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                لیست پیش پرداخت ها
                            </div>
                        </div>
                        <div class="pull-right">
                            <a href="{{ URL::to('admin/add_advance') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span>پیش پرداخت</a>
                        </div>
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table table-striped table-bordered" id="advance" width="100%">
                            <thead>
                            <tr>
                                <th>شماره</th>
                                <th>اسم کارمند</th>
                                <th>موقف وظیفوی</th>
                                <th class="noPrint">لیست پیش پرداخت ها</th>
                                <!-- <th>پول پیش پرداخت</th> -->
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($advanceSalary as $adv)
                                <tr>
                                    <td>{{ $adv->employee_id }}</td>
                                    <td>{{ $adv->employee_name }}</td>
                                    <td>{{ $adv->position }}</td>
                                    <td></td>
                                </tr>
                            @endforeach

                            <tbody>

                              <tfoot>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                              </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
@stop
