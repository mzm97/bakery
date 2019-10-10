@extends('admin/layouts/default2')
@section('title')
    صورت حساب
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
                                <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                صورت حساب
                            </div>
                        </div>
                        <div class="pull-right">
                            <a href="{{ URL::to('admin/remove_investment') }}" class="btn btn-sm btn-default"><span style="color:red;" class="glyphicon glyphicon-remove"></span>رفت  پول</a>
                        </div>
                        <div class="pull-right">
                            <a href="{{ URL::to('admin/add_investment') }}" class="btn btn-sm btn-default"><span style="color:green;" class="glyphicon glyphicon-plus"></span> آمد پول</a>
                        </div>
                    </div>

                    <div class="panel-body table-responsive">

                        <table class="table table-striped table-bordered" id="investmentsstatements" width="100%">

                            <thead>
                            <tr>
                                <th>شماره</th>
                                <th>تاریخ</th>
                                <th>مقدار</th>
                                <th>رفت/آمد</th>
                                <th>جزئیات</th>
                                <th>مقدار موجوده</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1 ?>
                            @foreach($transferInvestment as $tra)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $tra->date }}</td>
                                    <td>{{ $tra->amount }}&nbsp;&nbsp;افغانی</td>
                                    <td>{{ $tra->add_remove }}</td>
                                    <td>{{ $tra->description }}</td>
                                    <td>{{ $tra->balance }}&nbsp;&nbsp;افغانی</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>


            </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="well">
            <div class="panel-body table-responsive">

                <table class="table table-striped table-bordered" style="margin-top:20px;">

                    <thead>

                    </thead>
                    <tbody>
                    <?php $i = 1 ?>
                    @foreach($investment as $inv)
                        <tr>
                            <td class="text-primary">مقدار پول موجوده کمپنی</td>
                            <td>{{$inv->amount}}&nbsp;&nbsp;افغانی</td>
                        </tr>
                        <tr>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
          </div>
        </div>

    </section>
@stop
