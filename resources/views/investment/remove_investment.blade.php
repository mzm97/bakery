@extends('admin.layouts.default2')
@section('title')
    رفت پول
@stop
@section('header_styles')
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/iCheck/css/all.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/iCheck/css/line/line.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-switch/css/bootstrap-switch.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/switchery/css/switchery.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/awesomeBootstrapCheckbox/awesome-bootstrap-checkbox.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/formelements.css') }}"/>

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
        <br>
        <div class="row">

            <div class="col-lg-7 col-lg-offset-3">

                <div class="well">
                    &nbsp;&nbsp;&nbsp;
                    <div class="form-group basic1" >
                        <label class="col-md-3 control-label text-primary" style="font-size: 20px;">رفت پول به :</label>
                        &nbsp;&nbsp;&nbsp;
                        <label class=" control-label" style="font-size: 20px;">
                            &nbsp;&nbsp;&nbsp;
                            بانک
                            <input type="radio"   id="bank" value="bank"  name="add_money">
                        </label>
                        <label class=" control-label" style="font-size: 20px;">
                            &nbsp;&nbsp;&nbsp;
                            مرجع دیگر
                            <input type="radio"  id="non_bank" value="non_bank" name="add_money">
                        </label>

                    </div>
                </div>

            </div>

        </div>


        <div class="row" id="bankDiv" style="display: none;">
            <div class="col-lg-7 col-lg-offset-3">
                <div class="panel panel-primary" id="hidepanel1">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            رفت پول به بانک
                        </h3>
                        <span class="pull-right"><i class="glyphicon glyphicon-chevron-up clickable"></i></span>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal basic1" action="{{ url('admin/remove_bank_investment_record') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="amount">اسم بانک :</label>
                                <div class="col-md-9">
                                    <select  name="bankId" id="bankId" class="form-control" required onchange="showaccountname(event);">
                                        <option value="">اسم بانک را انتخاب نمایید.</option>
                                        @foreach($bank as $ba)
                                            <option value="{{ $ba->bank_id }}">{{ $ba->bank_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="amount">اسم اکونت</label>
                                <div class="col-md-9">
                                    <select  name="accountname" id="accountname" style="color:red;" class="form-control" onchange="showaccountno(event);">
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="amount">نمبر اکونت</label>
                                <div class="col-md-9">
                                    <select  name="accountno" id="accountno" class="form-control" style="color:red;">

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="amount">مقدار :</label>
                                <div class="col-md-9">
                                    <input id="amount" name="amount" type="number" required placeholder="مقدار پول را وارد نمایید." class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="dateAsguest">تاریخ :</label>
                                <div class="col-md-9">
                                    <input type="text" id="dateAsguest" name="date"  class="form-control" placeholder="روز-ماه-سال" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-position">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-responsive btn-primary btn-sm">رفت پول</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="nonbankDiv" style="display: none;">
            <div class="col-lg-7 col-lg-offset-3">

                <div class="panel panel-primary" id="hidepanel1">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            رفت پول به مرجع دیگر
                        </h3>
                        <span class="pull-right"><i class="glyphicon glyphicon-chevron-up clickable"></i></span>
                    </div>
                    <div class="panel-body">



                        <form class="form-horizontal basic1" action="{{ url('admin/remove_investment_record') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="amount">مقدار :</label>
                                <div class="col-md-9">
                                    <input id="amount" name="amount" type="number" required placeholder="مقدار پول را وارد نمایید." class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="dateAsguest">تاریخ :</label>
                                <div class="col-md-9">
                                    <input type="text" id="dateAsguest2" name="date"  class="form-control" placeholder="روز-ماه-سال" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="description">جزئیات :</label>
                                <div class="col-md-9">
                                    <textarea class="form-control resize_vertical" style="resize:none;"  id="description" name="description" placeholder="جزئیات را وارد نمایید." rows="5"></textarea>
                                </div>
                            </div>


                            <div class="form-position">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-responsive btn-primary btn-sm">رفت پول</button>
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

    <script>
        $('input[type="checkbox"].square, input[type="radio"]#bank').on('click',function () {
            $("#bankDiv").show();
            $("#nonbankDiv").hide();
        });
        $('input[type="checkbox"].square, input[type="radio"]#non_bank').on('click',function () {

            $("#bankDiv").hide();
            $("#nonbankDiv").show();

        });
    </script>

    <script type="text/javascript">
        function showaccountname(event) {
            event.preventDefault();
            var bankid=$("#bankId").val();
            $.post("{{ route('admin.banknamedata') }}",{bank_id:bankid,_token:"{{ Session::token() }}"},function (data,status) {
                $("#accountname").empty();
                $("#accountno").empty();
                $.each(data,function (index,data) {
                    $("#accountname").append("<option value='"+data.account_name +"'>"+data.account_name+"</option>");
                    $("#accountno").append("<option  value='"+data.account_no +"'>"+data.account_no+"</option>");
                });
            });
        };
    </script>

    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/bootstrap-switch/js/bootstrap-switch.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/switchery/js/switchery.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/bootstrap-maxlength/js/bootstrap-maxlength.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/card/lib/js/jquery.card.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/js/pages/radio_checkbox.js') }}"></script>

    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" ></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form_examples.js') }}"></script>

    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" ></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/form_wizard.js') }}"  type="text/javascript"></script>



@stop
