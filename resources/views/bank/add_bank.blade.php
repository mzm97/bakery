@extends('admin.layouts.default2')
@section('title')
  علاوه نمودن بانک جدید

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
                @if(session()->has('saveMessage'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: #000;">&times;</button>
                    <span style="color: #3a3131;">{{ session('saveMessage') }}</span>
                </div>
                @endif
                <div class="panel panel-primary" id="hidepanel1">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="plus" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                          علاوه نمودن بانک جدید
                        </h3>
                        <span class="pull-right"><i class="glyphicon glyphicon-chevron-up clickable"></i></span>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal basic1" action="{{ url('admin/save_bank') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="bankname">اسم بانک :</label>
                                <div class="col-md-9">
                                    <input id="bankname" name="bankname" type="text" required placeholder="اسم بانک را وارد نمایید." class="form-control">
                                </div>
                            </div>

                       <div class="form-group">
                                <label class="col-md-3 control-label" for="accountname">اسم اکونت :</label>
                                <div class="col-md-9">
                                    <input id="accountname" name="accountname" type="text" required placeholder="اسم اکونت را وارد نمایید." class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="accountno">نمبر اکونت</label>
                                <div class="col-md-9">
                                    <input id="accountno" name="accountno" type="text" required placeholder="نمبر اکونت را وارد نمایید." class="form-control">
                                </div>
                            </div>




                            <div class="form-position">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-responsive btn-primary btn-sm">ثبت</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </section>
@stop
