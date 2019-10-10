@extends('admin.layouts.default2')
@section('title')
  اضافه نمودن نوع مصرف
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
                            نوع مصرف جدید
                        </h3>
                        <span class="pull-right"><i class="glyphicon glyphicon-chevron-up clickable"></i></span>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal basic1" action="{{ url('admin/save_expense_type') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="product_type">نوع مصرف :</label>
                                <div class="col-md-9">
                                    <input id="product_type" name="expense_type" type="text" required placeholder="اسم نوع مصرف را وارد نمایید." class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="description">جزئیات :</label>
                                <div class="col-md-9">
                                    <textarea class="form-control resize_vertical" id="description" required name="more_info" style="resize:none;" placeholder="جزئیات را وارد نمایید." rows="5"></textarea>
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

    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" ></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form_examples.js') }}"></script>

    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" ></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/form_wizard.js') }}"  type="text/javascript"></script>

@stop
