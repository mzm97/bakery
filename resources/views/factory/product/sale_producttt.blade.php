@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    فروش
    @parent
@stop

{{-- page level styles --}}
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

@stop
{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
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
            <li class="active">فروش</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <!--main content-->

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
            @if(session('info'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
                    <strong >{{ session('info') }}</strong>
                </div>
        @endif
        <!--basic form starts-->
            <div class="panel panel-primary" id="hidepanel1">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="money" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        فروش محصولات
                    </h3>
                    <span class="pull-right">
                              <i class="glyphicon glyphicon-chevron-up clickable"></i>
                        </span>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal basic1" method="post" action="{{ route('admin.post_sale_product')  }}">
                    {{--CSRF Token--}}
                    {{ csrf_field() }}
                    <!-- Name input-->
                        <input id="counter" value="1" name="counter" style="display: none" type="text">



                        <div class="form-group">
                            <label class="col-md-3 control-label" for="customer_invoice_no">شماره بل:</label>
                            <div class="col-md-9">
                                <input id="customer_invoice_no" name="customer_invoice_no" type="text" placeholder="شماره بل را وارد نمایید" class="form-control" required></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="date">تاریخ:</label>
                            <div class="col-md-9">
                                <input id="date" name="date" type="date" value="{{ date('Y-m-d') }}" placeholder="" class="form-control"></div>
                        </div>
                        <!-- BEGIN BORDERED TABLE PORTLET-->

                        {{--<div class="row">--}}
                        <div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
                            <div class="col-lg-9 col-md-9" style="background-color: #e8e8e8;  padding-top: 15px;">
                                <div id="adddiv">
                                    <div class="col-lg-3 newphoto" style="float: right;">
                                        <div class="form-group">
                                            <input type="number" name="image1" class="form-control">
                                        </div>

                                        <input type='hidden' id="photoName" value="@lang('form_localization.property_photo')">
                                        <input type='hidden' id="photoAttach" value="@lang('form_localization.attach_photo')">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <div class="col-md-12 col-lg-12" id="">
                                        {{--<div class="form-group">--}}
                                        <div class="col-lg-10 col-md-10">
                                            <label class="col-lg-2 col-md-2" for="other_expense">مجموعه:</label>
                                            <div class="col-lg-10 col-md-10">
                                                <input id="other_expense" name="other_expense" type="number" placeholder="مصارف اضافی را وارد نمایید" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <button type="button" id="btnadd" class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-plus"></span></button>
                                            <button type="button" id="btndelete" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button>
                                        </div>
                                        {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3" style="text-align: left; font-weight: bold">مقدار:</div>
                        </div>



                        <!-- END BORDERED TABLE PORTLET-->
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="more_info">معلومات اضافی:</label>
                                <div class="col-md-9">
                                    <input id="more_info" name="more_info" type="text" placeholder="معلومات اضافی" class="form-control"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">پرداخت:</label>
                            <div class="col-md-9" style="padding-top: 6px;">

                                <label style="padding-right: 8px;">
                                    پرداخت کامل
                                    <input   type="radio" name="payment" value="paid" class="square" id="paid"  checked="checked" required /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                </label>
                                <label>
                                    قرض
                                    <input  type="radio" name="payment" value="debt" class="square"  id="debt"  required />

                                </label>

                            </div>
                        </div>

                        <div class="form-group" style="display: none;" id="received_moneydiv">
                            <label class="col-md-3 control-label" for="received_debt">مقدار پرداخت</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" id="received_debt" name="received_debt" placeholder="مقدار پول را که میخواهید بپردازید، وارد نمایید">
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

    {{--<script type="text/javascript">--}}

    {{--$(document).ready(function () {--}}

    {{--var count=1;--}}
    {{--$('#counter').val(count);--}}
    {{--$(document).one('click', '#btnadd', function(){--}}
    {{--//                $('#btn_div').append('<a role="button" class="btn btn-responsive btn-danger btn-xs" id="btnremove" style="float:right;">Remove Product</a>');--}}
    {{--});--}}

    {{--$(document).on('click', '#btnadd', function(){--}}
    {{--//                $('#btnremove').show();--}}
    {{--count++;--}}
    {{--$('#counter').val(count);--}}
    {{--$('#addDiv').append('<input type="number" class="form-control" name="price1" placeholder="Type price here!" id="price1" required="required">');--}}
    {{--});--}}

    {{--$(document).on('click', '#btnremove', function(){--}}
    {{--var c=count;--}}
    {{--var m=c;--}}
    {{--$('#addDiv'+m).remove();--}}
    {{--count--;--}}
    {{--$('#counter').val(count);--}}

    {{--if(count == 1){--}}
    {{--$('#btn_div #btnremove').hide();--}}
    {{--}--}}
    {{--});--}}

    {{--});--}}
    {{--</script>--}}
    {{--<script type="text/javascript">--}}
    {{--$('input[type="checkbox"].square, input[type="radio"]#debt').on('click',function () {--}}

    {{--$("#giving_moneydiv").show();--}}
    {{--$("#giving_money").prop('required',true);--}}

    {{--});--}}
    {{--$('input[type="checkbox"].square, input[type="radio"]#paid').on('click',function () {--}}

    {{--$("#giving_moneydiv").hide();--}}
    {{--$("#giving_money").prop('required',false);--}}

    {{--});--}}

    {{--</script>--}}

    {{--<script type="text/javascript">--}}
    {{--$('input[type="checkbox"].square, input[type="radio"]#debt').on('click',function () {--}}

    {{--$("#giving_moneydiv").show();--}}
    {{--$("#giving_money").prop('required',true);--}}

    {{--});--}}
    {{--$('input[type="checkbox"].square, input[type="radio"]#paid').on('click',function () {--}}

    {{--$("#giving_moneydiv").hide();--}}
    {{--$("#giving_money").prop('required',false);--}}

    {{--});--}}


    {{--</script>--}}
    <script>
        $(document).ready(function() {
            var id=1;
            var d = 1;
            $("#btndelete").on("click",function () {
                $("#addimg"+id).remove();
                if (id!=1){
                    id--;
                    d--;
                    $('#imageNumber').val(d--);
                }

            });
            $("#btnadd").on("click", function () {
                id = ++id;
                $('#imageNumber').val(++d);
                var p = $('#photoName').val();
                var attach = $('#photoAttach').val();
                $("#adddiv").append('<div class="col-lg-3" style="float: right;" id="addimg' + id + '"><div class="form-group"><input type="number" name="image' + id + '" class="form-control"></div></div>');

            });
        });
    </script>
@stop
