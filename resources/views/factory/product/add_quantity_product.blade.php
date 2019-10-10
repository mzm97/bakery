@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
    محصول
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
        <h1>اضافه نمودن محصول مورد نظر</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    صفحه عمومی
                </a>
            </li>
            <li>
                <a href="#">محصولات</a>
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
اضافه نمودن مقدار مورد نظر
                        </h3>
                        <span class="pull-right">
                              <i class="glyphicon glyphicon-chevron-up clickable"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal basic1" method="post" action="{{ url('admin/post_quantity_product')  }}/{{ $product->product_id }}">
                        {{--CSRF Token--}}
                        {{ csrf_field() }}
                        <!-- Name input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="product_name">محصول:</label>
                                <div class="col-md-9">
                                    <input id="product_name" disabled name="product_id" value="{{ $product->product_name }}" type="text" placeholder="وارد نمایید" class="form-control" required></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="product_type">نوعیت:</label>
                                <div class="col-md-9">
                                    <input id="product_type" disabled name="product_type" value="{{ $product->product_type }}" type="text" placeholder="نوع مواد را وارد کنید" class="form-control" required></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="unit">مقدار موجود:</label>
                                <div class="col-md-9">
                                    <input id="unit" name="unit" disabled type="text" value="{{$product->existent_quantity }}" placeholder="" class="form-control"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="quantity">مقدار:</label>
                                <div class="col-md-9">
                                    <input id="quantity" name="quantity" type="number"  placeholder="مقدار مورد نظر را وارد نمایید" class="form-control" required="required"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="dateAsguest">تاریخ:</label>
                                <div class="col-md-9">
                                    <input type="text" id="dateAsguest" name="date"  class="form-control" placeholder="روز-ماه-سال" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="more_info">معلومات اضافی:</label>
                                <div class="col-md-9">
                                    <input id="more_info" name="more_info" type="text" placeholder="معلومات اضافی" class="form-control"></div>
                            </div>

                            <!-- Form actions -->
                            <div class="form-position">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-responsive btn-primary btn-sm left_btn">اضافه</button>
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
