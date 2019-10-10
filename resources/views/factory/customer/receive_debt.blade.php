@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    حصول قرض
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
                <a href="#">مشتریان</a>
            </li>
            <li class="active"> حصول قرض</li>
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
                            <i class="livicon" data-name="money" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            حصول قرض
                        </h3>
                        <span class="pull-right">
                              <i class="glyphicon glyphicon-chevron-up clickable"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal basic1" method="post" action="{{ route('admin.post_receive_debt')  }}">
                        {{--CSRF Token--}}
                        {{ csrf_field() }}
                        <!-- Name input-->

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="select21">مشتری:</label>
                                <div class="col-md-9">
                                    <select id="select21" class="form-control select2" name="customerId" onchange="showdebt(event)">
                                        <option value=""></option>
                                        @foreach($customer as $sup)
                                            <option value="{{ $sup->customer_id }}">{{ $sup->company }} ( {{ $sup->responsible_person }} )</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="dateAsguest">تاریخ :</label>
                                <div class="col-md-9">
                                    <input type="text" id="dateAsguest" name="date"  class="form-control" placeholder="روز-ماه-سال" autocomplete="off" required="required">
                                </div>
                            </div>


                            <div class="form-group" >
                                <label class="col-md-3 control-label" for="remain_money">پول باقی مانده:</label>
                                <div class="col-md-9">
                                    <input id="remainDebt"  type="number" class="form-control" disabled style="color: red ;"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="received_debt">مقدار حصول:</label>
                                <div class="col-md-9">
                                    <input id="received_debt" name="received_debt" type="number" placeholder="مقدار پرداخت" class="form-control"></div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="more_info">معلومات اضافی:</label>
                                <div class="col-md-9">
                                    <textarea class="form-control resize_vertical" id="more_info" name="more_info" placeholder="معلومات اضافی" rows="5"></textarea>
                                </div>
                            </div>

                            <!-- Form actions -->
                            <div class="form-position">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-responsive btn-primary btn-sm left_btn" id='Rbtn'>ثبت</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--md-6 ends-->
        </div>

        <div id="emptyModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="color:red;font-weight:bold;">هشدار</h4>
                    </div>
                    <div class="modal-body">
                        <h4>مقدار پول را وارد نمایید!</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-xs" data-dismiss="modal">close</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="color:red;font-weight:bold;">هشدار</h4>
                    </div>
                    <div class="modal-body">
                        <h4>شما پول بیشتر نظر به قرض خویش وارد نموده اید!</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-xs" data-dismiss="modal">close</button>
                    </div>
                </div>
            </div>
        </div>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('#Rbtn').prop('disabled',true);
            $("#received_debt").blur(function(){

                var val=parseInt($("#received_debt").val());
                var valR=parseInt($("#remainDebt").val());


                    if($("#received_debt").val().length === 0){
                        $('#emptyModal').modal('show');
                    }else{
                        if(val < valR || val == valR){

                            $('#Rbtn').prop('disabled',false);
                        }else{
                            $('#myModal').modal('show');
                            $('#Rbtn').prop('disabled',true);
                        }
                    }
            });

        });
    </script>


    <script type="text/javascript">
        function showdebt(event) {
            event.preventDefault();
            var Id=$("#select21").val();
            $.post("{{ route('admin.debtC') }}",{customerId:Id,_token:"{{ Session::token() }}"},function (data,status) {
                $("#remainDebt").empty();
                $.each(data,function (index,$remainData) {
                    $("#remainDebt").val($remainData.remaining_debt);
//                    $("#debt_id").val($remainData.debt_id);
                });
            });
        };
    </script>
@stop
