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
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table table-striped table-bordered" id="BankInvestment" width="100%">

                            <thead>
                            <tr>
                                <th>شماره</th>
                                <th>اسم بانک</th>
                                <th>اسم اکونت</th>
                                <th>نمبر اکونت</th>
                                <th>حساب موجوده</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1 ?>
                            @foreach($data as $bi)
                                <tr>
                                    <td>{{ $bi->bank_id }}</td>
                                    <td>{{ $bi->bank_name }}</td>
                                    <td>{{ $bi->account_name }}</td>
                                    <td>{{ $bi->account_no }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
