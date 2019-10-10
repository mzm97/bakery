@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
    مواد خام
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
        <h1>تصحیح</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    دشبورد
                </a>
            </li>
            <li>
                <a href="#">مواد خام</a>
            </li>
            <li class="active">تصحیح</li>
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
                            <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            تصحیح
                        </h3>
                        <span class="pull-right">
                              <i class="glyphicon glyphicon-chevron-up clickable"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal basic1" method="post" action="{{ url('admin/post_edit_raw_material')  }}/{{ $rawMaterial->raw_material_id }}">
                        {{--CSRF Token--}}
                        {{ csrf_field() }}
                        <!-- Name input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="raw_material_name">مواد:</label>
                                <div class="col-md-9">
                                    <input id="raw_material_name" name="raw_material_name" value="{{ $rawMaterial->raw_material_name }}" type="text" placeholder="وارد نمایید" class="form-control" required></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="raw_material_type">نوع مواد:</label>
                                <div class="col-md-9">
                                    <input id="raw_material_type" name="raw_material_type" value="{{ $rawMaterial->raw_material_type }}" type="text" placeholder="نوع مواد را وارد کنید" class="form-control" required></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="estimated_price">نرخ تخمینی:</label>
                                <div class="col-md-9">
                                    <input id="estimated_price" name="estimated_price" value="{{ $rawMaterial->estimated_price }}" type="number" placeholder="نرخ تخمینی" class="form-control"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="unit">واحد اندازه گیری:</label>
                                <div class="col-md-9">
                                    <input id="unit" name="unit" type="text" value="{{ $rawMaterial->unit }}" placeholder="واحد اندازه گیری را وارد کنید" class="form-control"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="more_info">معلومات اضافی:</label>
                                <div class="col-md-9">
                                    <input id="more_info" name="more_info" value="{{ $rawMaterial->more_info }}" type="text" placeholder="معلومات اضافی" class="form-control"></div>
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
