@extends('admin/layouts/default2')
@section('title')
  لیست پیش پرداخت ها
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
                @if(session()->has('deleteMessage'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span>{{ session('deleteMessage') }}</span>
                    </div>
                @endif

                @if(session()->has('editRecordMessage'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: #000;">&times;</button>
                        <span style="color: #3a3131;">{{ session('editRecordMessage') }}</span>
                    </div>
                @endif

                <div class="panel panel-primary filterable">
                    <div class="panel-heading clearfix  ">
                        <div class="panel-title pull-left">
                            <div class="caption">
                      لیست پیش پرداخت ها
                            </div>
                        </div>
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table table-striped table-bordered" id="advance_statement" width="100%">

                            <thead>
                            <tr>
                                <th>شماره</th>
                                <th>اسم کارمند</th>
                                <th>موقف وظیفوی</th>
                                <th>تاریخ</th>
                                <th>مقدار به افغانی</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1 ?>
                            @foreach($data as $da)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $da->employee_name }}</td>
                                    <td>{{ $da->position }}</td>
                                    <td>{{ $da->date }}</td>
                                    <td>{{ $da->advance_money }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                              <td></td>
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
