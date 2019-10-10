@extends('admin.layouts.default2')
@section('title')
آمد پول
@stop
@section('header_styles')
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
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
                <div class="panel panel-primary" id="hidepanel1">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            آمد پول
                        </h3>
                        <span class="pull-right"><i class="glyphicon glyphicon-chevron-up clickable"></i></span>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal basic1" action="{{ url('admin/add_bank_investment_record') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="amount">اسم بانک :</label>
                                <div class="col-md-9">
                                  <select  name="bankname" id="bankname" class="form-control" required onchange="showaccountname(event);">
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
                                <label class="col-md-2 control-label" for="date">تاریخ :</label>
                                <div class="col-md-9">
                                    <input id="date" name="date" type="date" placeholder="" value="{{ date('Y-m-d') }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-position">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-responsive btn-primary btn-sm">آمد</button>
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

<script type="text/javascript">
  function showaccountname(event) {
      event.preventDefault();
          var bankid=$("#bankname").val();
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
<!--
    <script type="text/javascript">
    function showaccountno(event) {
        event.preventDefault();
        alert();

            var accountname=$("#accountname").val();
            $.post("{{ route('admin.bankaccountdata') }}",{account_name:accountname,_token:"{{ Session::token() }}"},function (data,status) {
              $("#accountno").empty();
              $.each(data,function (index,data) {
                $("#accountno").append("<option value='"+data.account_no +"'>"+data.account_no+"</option>");
              });
            });
    };
    </script> -->

    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" ></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form_examples.js') }}"></script>

    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" ></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/form_wizard.js') }}"  type="text/javascript"></script>

@stop
