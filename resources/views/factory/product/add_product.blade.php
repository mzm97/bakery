@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
    تولید جدید
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />

@stop
{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>اضافه نمودن محصول جدید</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    صفحه عمومی
                </a>
            </li>
            <li>
                <a href="#">تولیدات</a>
            </li>
            <li class="active">اضافه کردن</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <!--main content-->
        <div class="row">
            <!--row starts-->
            <div class="col-lg-8 col-lg-offset-2">
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
                <!--basic form starts-->
                <div class="panel panel-primary" id="hidepanel1">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="plus" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            اضافه نمودن محصول جدید
                        </h3>
                        <span class="pull-right">
                              <i class="glyphicon glyphicon-chevron-up clickable"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal basic1" method="post" action="{{ route('admin.post_product')  }}">
                        {{--CSRF Token--}}
                        {{ csrf_field() }}
                        <!-- Name input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="product_name">محصول:</label>
                                <div class="col-md-9">
                                    <input id="product_name" name="product_name" type="text" placeholder="وارد نمایید" class="form-control" required></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="product_type">نوع:</label>
                                <div class="col-md-9">
                                    <input id="product_type" name="product_type" type="text" placeholder="نوع آن را وارد کنید" class="form-control" required></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="estimated_price">نرخ تخمینی:</label>
                                <div class="col-md-9">
                                    <input id="estimated_price" name="estimated_price" type="number" placeholder="نرخ تخمینی" class="form-control"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="more_info">معلومات اضافی :</label>
                                <div class="col-md-9">
                                    <textarea class="form-control resize_vertical" id="more_info" name="more_info" placeholder="معلومات اضافی" rows="5"></textarea>
                                </div>
                            </div>

                            <!-- Form actions -->
                            <div class="form-position">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-responsive btn-primary btn-sm left_btn">ثبت</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--md-6 ends-->
        </div>

        <!--main content ends-->
    </section>
    <!-- content -->
@stop

{{-- page level scripts --}}
@section('footer_scripts')

    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" ></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form_examples.js') }}"></script>

@stop
