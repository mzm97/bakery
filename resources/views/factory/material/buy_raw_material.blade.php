@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    خریداری مواد
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
        <h1>خریداری مواد</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    دشبورد
                </a>
            </li>
            <li>
                <a href="#">اکمالات</a>
            </li>
            <li class="active">خریداری مواد</li>
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
                            <i class="livicon" data-name="plus" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                           خریداری مواد خام
                        </h3>
                        <span class="pull-right">
                              <i class="glyphicon glyphicon-chevron-up clickable"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal basic1" method="post" action="{{ route('admin.post_buy_raw_material')  }}">
                        {{--CSRF Token--}}
                        {{ csrf_field() }}
                        <!-- Name input-->
                            <input id="counter" value="1" name="counter" style="display: none" type="text">


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="supplier_id">تهیه کننده:</label>
                                <div class="col-md-9">
                                    <select class="form-control select2" name="supplier_id" id="select22" required="required">
                                        <option></option>
                                        @foreach($supplier as $sup)
                                            <option value="{{ $sup->supplier_id }}">{{ $sup->company }} ({{$sup->responsible_person}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="supplier_invoice_no">شماره بل:</label>
                                <div class="col-md-9">
                                    <input id="supplier_invoice_no" name="supplier_invoice_no" type="text" placeholder="شماره بل را وارد نمایید" class="form-control" required></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="dateAsguest">تاریخ:</label>
                                <div class="col-md-9">
                                    <input type="text" id="dateAsguest" name="date"  class="form-control" placeholder="روز-ماه-سال" autocomplete="off">
                                </div>
                            </div>
                            <!-- BEGIN BORDERED TABLE PORTLET-->
                            <div class="portlet col-md-12">
                                <div class="portlet-body col-md-9 col-md-offset-3">
                                    <div class="table-scrollable">

                                        <table id="myTable" class=" table order-list" style="background-color: #e8e8e8">
                                            <thead>
                                            <tr>
                                                <th>مواد</th>
                                                <th>مقدار</th>
                                                <th>قیمت</th>
                                                <th>مجموعه</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="col-sm-3">
                                                    <select class="form-control select2" name="raw_material_id1" id="" required="required">
                                                        <option value=""></option>
                                                        @foreach($rawmaterial as $raw)
                                                            <option value="{{ $raw->raw_material_id }}">{{ $raw->raw_material_name }} ({{ $raw->raw_material_type }})</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="col-sm-3">
                                                    <input type="number" step=any id="" name="quantity1"  class="form-control quantity" placeholder="مقدار" required onchange="quantityPrice()"/>
                                                </td>
                                                <td class="col-sm-3">
                                                    <input type="number" step=any id="" name="price1" placeholder="قیمت" onchange="quantityPrice()" required class="form-control price"/>
                                                </td>
                                                <td class="col-sm-3">
                                                    <input type="number" step="any" id="" name="total1"  class="form-control total" disabled="disabled" value="0" />
                                                </td>

                                            </tr>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td colspan="4" style="text-align: right;">
                                                    <button type="button" class="btn btn-success delete  " id="addrow" value="اضافه کردن" ><i class="glyphicon glyphicon-plus"></i></button>
                                                    <button type="button" class="btn btn-danger delete" id="DelBtn" style="display: none" onclick="myDeleteFunction()"><i class="glyphicon glyphicon-trash"></i></button>
                                                    <span style="float: left;"><input type="number" id="" name="all_total" value="0" disabled="disabled" class="form-control grandTotal"/></span>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        {{--<input type="button" class="btn btn-lg btn-block " id="addrow" value="خریدن مواد بیشتر" />--}}
                                        <div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- END BORDERED TABLE PORTLET-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="other_expense">مصارف اضافی:</label>
                                <div class="col-md-9">
                                    <input id="other_expense" name="other_expense" type="number" placeholder="مصارف اضافی را وارد نمایید" class="form-control"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="more_info">معلومات اضافی:</label>
                                <div class="col-md-9">
                                    <input id="more_info" name="more_info" type="text" placeholder="معلومات اضافی" class="form-control"></div>
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

                            <div class="form-group" style="display: none;" id="giving_moneydiv">
                                <label class="col-md-3 control-label" for="giving_money">مقدار پرداخت</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" id="giving_money" name="giving_money" placeholder="مقدار پول را که میخواهید بپردازید، وارد نمایید">
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

    <script type="text/javascript">
        $('input[type="checkbox"].square, input[type="radio"]#debt').on('click',function () {

            $("#giving_moneydiv").show();
            $("#giving_money").prop('required',true);

        });
        $('input[type="checkbox"].square, input[type="radio"]#paid').on('click',function () {

            $("#giving_moneydiv").hide();
            $("#giving_money").prop('required',false);

        });


    </script>

    <script>
        var counter = 1;
        $(document).ready(function () {

            $("#addrow").on("click", function () {

                counter++;
                if(counter >= 2){
                    $("#DelBtn").show();
                }
                else{
                    $("#DelBtn").hide();
                }
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td><select class="form-control select2" name="raw_material_id' + counter +'" id="select22" required="required"><option value=""></option>@foreach($rawmaterial as $raw)<option value="{{ $raw->raw_material_id }}">{{ $raw->raw_material_name }} ({{ $raw->raw_material_type }})</option>@endforeach</select></td>';
                cols += '<td><input type="number" step=any id="" class="form-control form-control quantity"  placeholder="مقدار" onchange="quantityPrice()"  required name="quantity' + counter + '"/></td>';
                cols += '<td><input type="number" step=any id="price" class="form-control price"  placeholder="قیمت" onchange="quantityPrice()" required name="price' + counter + '"/></td>';
                cols += '<td><input type="number" step=any id="" name="total"  class="form-control total" disabled="disabled" value="0" /></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                $('#counter').val(counter);

            });

            $("#quantity").on("click", function(){
                alert();
                var price = $('.price').val();


                var quantity = $('.quantity').val()

                var total = quantity * price;
                $('.total').val(total);


            });
        });

        function myDeleteFunction() {
            counter -= 1
            document.getElementById("myTable").deleteRow(counter + 1);
            document.getElementById("counter").value = counter;
            if(counter >= 2){
                $("#DelBtn").show();
            }
            else{
                $("#DelBtn").hide();
            }

            quantityPrice();
        }
        function quantityPrice() {
            var price = 0;
            var quantity = 0;
            var grandTotal = 0;
            var c = -1;
            for (var i = 1; i <= counter; i++) {
                c++
                price = document.getElementsByClassName("price")[c].value;
                quantity = document.getElementsByClassName("quantity")[c].value;
                var total = price * quantity;
                document.getElementsByClassName("total")[c].value = parseFloat(total.toFixed(3));
                grandTotal += total;
            }

            document.getElementsByClassName("grandTotal")[0].value = parseFloat(grandTotal.toFixed(3));
        }


        function calculateRow(row) {
            var price = +row.find('input[name^="price"]').val();
        }
        function calculateGrandTotal() {
            var grandTotal = 0;
            $("table.order-list").find('input[name^="price"]').each(function () {
                grandTotal += +$(this).val();
            });
            $("#grandtotal").text(grandTotal.toFixed(2));
        }
    </script>

@stop
