@extends('admin.layouts.default2')
@section('title')
مصرف جدید
@stop
@section('header_styles')

    <link type="text/css" href="{{ asset('assets/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/selectize/css/selectize.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/iCheck/css/line/line.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/bootstrap-switch/css/bootstrap-switch.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/switchery/css/switchery.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/formelements.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/printInvoice.css') }}" rel="stylesheet">


@stop

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    صفحه اصلی
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
              @if(session()->has('alertMessage'))
                  <div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: #000;">&times;</button>
                      <span style="color: #3a3131;">{{ session('alertMessage') }}</span>
                  </div>
              @endif

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
                            مصرف جدید
                        </h3>
                        <span class="pull-right"><i class="glyphicon glyphicon-chevron-up clickable"></i></span>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal basic1" action="{{ url('admin/save_expense') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="product_type">نوع مصرف :</label>
                                <div class="col-md-9">
                                    <select id="select22" name="expense_type_id" class="form-control" required="required">
                                        <option value="">نوع مصرف را انتخاب نمایید.</option>
                                        @foreach($expenseType as $exp)
                                            <option value="{{ $exp->expense_type_id }}">{{ $exp->expense_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="product_type">مقدار :</label>
                                <div class="col-md-9">
                                    <input type="number" id="product_type" name="amount" type="text" required="required" placeholder="مقدار پول را وارد نمایید." class="form-control">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="product_type">تاریخ :</label>
                                <div class="col-sm-9">
                                    <input type="text" id="dateAsguest" name="date"  class="form-control" placeholder="روز-ماه-سال" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="description">جزئیات :</label>
                                <div class="col-md-9">
                                    <textarea class="form-control resize_vertical" id="description" style="resize:none;" name="description" placeholder="جزئیات را وارد نمایید." rows="5"></textarea>
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

@section('footer_scripts')
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/sifter/sifter.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/microplugin/microplugin.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/selectize/js/selectize.min.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/bootstrap-switch/js/bootstrap-switch.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/switchery/js/switchery.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/bootstrap-maxlength/js/bootstrap-maxlength.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/card/lib/js/jquery.card.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/js/pages/custom_elements.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/js/printThis.js') }}"></script>
@stop

