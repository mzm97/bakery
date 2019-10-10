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
    <link href="{{ asset('assets/css/printInvoice.css') }}" rel="stylesheet">

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
                    <form class="form-horizontal basic1" method="post" action="{{ route('admin.post_sale_product')  }}" id="form1">
                    {{--CSRF Token--}}
                    {{ csrf_field() }}
                    <!-- Name input-->
                        <input id="counter" value="1" name="counter" style="display: none" type="text">


                        <div class="form-group">
                            <label class="col-md-3 control-label" for="customer_id">مشتری:</label>
                            <div class="col-md-9">
                                <select class="form-control select2" name="customer_id" id="select22" required="required"  onchange="showdebt(event)">
                                    <option></option>
                                    @foreach($customer as $cus)
                                        <option value="{{ $cus->customer_id }}">{{ $cus->company }} ({{$cus->responsible_person}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="dateAsguest">تاریخ:</label>
                            <div class="col-md-9">
                                <input type="text" id="dateAsguest" name="date" required="required" class="form-control" placeholder="روز-ماه-سال" autocomplete="off">
                            </div>
                        </div>
                        <!-- BEGIN BORDERED TABLE PORTLET-->
                        <div class="portlet col-md-12">
                            {{--<div class="portlet-body col-md-10 col-md-offset-2">--}}
                            <div class="portlet-body col-md-12">
                                <div class="table-scrollable">

                                    <table id="myTable" class="table order-list" style="background-color: #e8e8e8">
                                        <thead>
                                        <tr>
                                            <th>مواد</th>
                                            <th> مقدار ها&nbsp;(kg)</th>
                                            <th>تعداد بسته ها</th>
                                            <th>مجموعه&nbsp;(kg)</th>
                                            <th>قیمت</th>
                                            <th>مجموعه</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="col-sm-2">
                                                <select class="form-control select2 product" name="product_id1" id="" required="required" onchange="getProduct();">
                                                    <option value=""></option>
                                                    @foreach($product as $pro)
                                                        <option value="{{ $pro->product_id }}">{{ $pro->product_name }} ({{ $pro->product_type }})</option>
                                                    @endforeach
                                                </select>
                                            </td>


                                            <td class="col-sm-2"  style="direction: ltr"id="">
                                                <input type="text" id="getPacks1" name="packs1" class="form-control packs " placeholder="" onchange="allQuantities()" required="required"/>
                                            </td>
                                            <td class="col-sm-2">
                                                <input type="number" step=any id="" name="packsCount1"  readonly="readonly" class="form-control packsCount" placeholder="تعداد بسته ها" required >
                                            </td>
                                            <td class="col-sm-2">
                                                <input type="number" step="0.01" id="" name="quantity1" readonly="readonly"  class="form-control quantity" placeholder="مقدار مجموع" required="required">
                                            </td>
                                            <td class="col-sm-2">
                                                <input type="number" step="0.01" id="" name="price1" placeholder="قیمت" onchange="quantityPrice()" required class="form-control price"/>
                                            </td>
                                            <td class="col-sm-2">
                                                <input type="number" step=any id="" name="total1"  class="form-control total" disabled="disabled" value="0" />
                                            </td>

                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="12" style="text-align: right;">
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

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="other_expense">مصارف اضافی:</label>
                            <div class="col-md-9">
                                <input id="other_expense" name="other_expense" type="number" placeholder="مصارف اضافی را وارد نمایید" class="form-control" onchange="getValues()"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="tax">مالیه:</label>
                            <div class="col-md-9">
                                <input id="tax" name="tax" type="number" placeholder="مقدار مالیه را وارد نمایید" class="form-control"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="more_info">معلومات اضافی:</label>
                            <div class="col-md-9">
                                <input id="more_info" name="more_info" type="text" placeholder="معلومات اضافی" class="form-control" ></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">پرداخت:</label>
                            <div class="col-md-9" style="padding-top: 6px;">

                                <label style="padding-right: 8px;">
                                    پرداخت کامل
                                    <input type="radio" name="payment" value="paid" class="square" id="paid"  checked="checked" required onchange="getValues()" /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                </label>
                                <label>
                                    قرض
                                    <input  type="radio" name="payment" value="debt" class="square"  id="debt"  required onchange="getValues()"/>

                                </label>

                            </div>
                        </div>

                        <div class="form-group" style="display: none;" id="giving_moneydiv">
                            <label class="col-md-3 control-label" for="received_debt">مقدار پرداخت</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" id="received_debt" name="received_debt" placeholder="مقدار پول را که میخواهید بپردازید، وارد نمایید" onchange="getValues()">
                            </div>
                        </div>

                        <!-- Form actions -->
                        <div class="form-position" style="display: none">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-responsive btn-primary btn-sm left_btn" id="primaryButton">ثبت</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!--md-6 ends-->
        <!--main content ends-->
    </section>
    <!-- content -->
    {{--    @if(session('invoice') && session('cp'))--}}
    <section class="content">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-4 col-sm-12 col-sm-offset-6">




                <div id="invoice" >
                    <div class="invoice" style="margin-bottom: 10px; margin-top: 0">
                        <div>
                            <header style="margin-bottom: 0;">
                                <div class="row">



                                    <div class="col company-details" style="text-align: center;">
                                        <h1>
                                            شرکت مواد غذایی ابریشم ابراهیمی
                                        </h1>
                                        <h2>

                                        </h2>
                                        <h4>
                                            عرضه کننده هر نوع کیک، بسکویت، روت، ناشتا، کرملول، میتائی و غیره
                                        </h4>
                                        <h5>
                                            آدرس: جوار شهرک آریا مقابل هوتل اورانوص
                                        </h5>
                                        <h5>
                                            محمد ابراهیم: 0706068912
                                        </h5>

                                        <h5>
                                            محمد اسلم میرزایی: 0799218487
                                        </h5>

                                    </div>
                                </div>
                                <div class="row" style="border: 1px solid silver; padding: 10px; border-radius: 10px;">

                                    <span ><b>اسم مشتری:</b> </span><span style="margin-left: 50px;" id="customerName"></span>
                                    <span style="margin-left: 50px;"><b>نمبر بل:</b> Invoice-{{ $invoiceId }}</span>
                                    <span><b>تاریخ:</b> </span> <span style="direction: rtl;" id="setDate"></span>
                                </div>
                            </header>
                            <main>

                                <table id="myTable2" class="table-bordered table2" cellspacing="0" cellpadding="0">
                                    <thead>
                                    <tr>
                                        <td><b>شماره</b></td>
                                        <td><b>محصول</b></td>
                                        <td><b>نوع</b></td>
                                        <td><b>مقدار &nbsp;(kg)</b></td>
                                        <td><b>قیمت</b></td>
                                        <td><b>مجموعه</b></td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1 ?>

                                    <tr >
                                        <td>1</td>
                                        <td><span class="setProductName"></span></td>
                                        <td><span class="setProductType"></span></td>
                                        <td><span class="setAmount"></span></td>
                                        <td><span class="setPrice"></span></td>
                                        <td><span class="setTotal"></span></td>
                                    </tr>

                                    </tbody>
                                </table>
                                <div class="">
                                    <p style="text-align:right;padding-right:5px;"><b>مصارف اضافی:&nbsp;&nbsp;</b><span id="setOtherExpenses"></span></p>
                                    <p style="text-align:right;padding-right:5px;">--------------------------------------------- </p>
                                    <p style="text-align:right;padding-right:5px;"><b>مجموعه:&nbsp;&nbsp;</b><span id="setGrandTotal"></span></p>
                                    <p style="text-align:right;padding-right:5px;"><b>قرض قبلی:&nbsp;&nbsp;</b><span id="remainDebt"></span></p>
                                    <p style="text-align:right;padding-right:5px;"><b>رسید:&nbsp;&nbsp;</b><span id="pay"></span></p>
                                    <p style="text-align:right;padding-right:5px;"><b>باقی مانده:&nbsp;&nbsp;</b><span id="remainingLoan"></span></p>
                                </div>
                                <br>
                                <div class="notices">

                                </div>

                            </main>

                            <footer>
                                <div class="row">
                                    <span id="note" style="float: right; margin-left:70px;">

                                        نوت: بل هذا بیدون مهر و امضاء مدار اعتبار نیست<br>
                                        جنس فروخته شده واپس گرفته نمی شود.
                                    </span>
                                    <span style="float: right; margin-top: 20px;">محل امضاء: .................................</span>
                                </div>
                                <br>

                                <div id="forPrint" style="text-align: center; direction: ltr; color: silver;">
                                    Developed by Zubair Mohammadi and Javid Salihe (0778978477,0790951911)
                                </div>
                            </footer>
                        </div>
                        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                        <div></div>
                    </div>
                    <div class="row" >
                        <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: white; margin-top: -9px;">
                            {{--<span class ="">aaaaaaaaa</span>--}}
                            <table id="myTable3" class="table table3 table-bordered" style="">
                                <thead>
                                <tr>
                                    <td><b>شماره</b></td>
                                    <td><b>محصول</b></td>
                                    <td><b>بسته ها</b></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1 ?>

                                <tr >
                                    <td>1</td>
                                    <td><span class="setProduct"></span></td>
                                    <td><span class="setPacksDetail"></span></td>

                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>



                </div>



            </div>
            <div style="margin-top: -20px; margin-bottom: 20px; margin-right: 20%">
                <button class="btn btn-success btn-sm" role="button" id="printButton" onclick="$('#invoice').printThis();">
                    <span class="glyphicon glyphicon-print"></span> چاپ
                </button>
                <button disabled="disabled" class="btn btn-primary btn-sm" role="button" onclick="" id="secondaryButton">
                    <span class="glyphicon glyphicon-floppy-save"></span> ثبت
                </button>
            </div>
        </div>
    </section>
    {{--@endif--}}
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
    <script language="javascript" type="text/javascript" src="{{ asset('assets/js/printThis.js') }}"></script>


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
//            $("footer").html("Printed by Mr. Someone");
            $( "footer" ).removeClass( "main-footer" );


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
                cols += '<td><select class="form-control select2 product" name="product_id' + counter +'" id="select22" required="required" onchange="getProduct();"><option value=""></option>@foreach($product as $pro)<option value="{{ $pro->product_id }}">{{ $pro->product_name }} ({{ $pro->product_type }})</option>@endforeach</select></td>';
                cols += '<td style="direction: ltr"><input type="text" id="getPacks' + counter + '" class="packs form-control form-control "  placeholder="" name="packs' + counter + '"  onchange="allQuantities()" required="required"/></td>';
                cols += '<td><input type="number" step=any id="" readonly="readonly" class="form-control form-control packsCount"  placeholder="تعداد بسته ها"  required="required" name="packsCount' + counter + '"/></td>';
                cols += '<td><input type="number" step=any id="" readonly="readonly" class="form-control form-control quantity"  placeholder="مقدار مجموع"  required="required" name="quantity' + counter + '"/></td>';
                cols += '<td><input type="number" step=any id="price" class="form-control price"  placeholder="قیمت" onchange="quantityPrice()" required="required" name="price' + counter + '"/></td>';
                cols += '<td><input type="number" step=any id="" name="total"  class="form-control total" disabled="disabled" value="0" /></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);


                var newRow2 = $("<tr>");
                var cols2 = "";
                cols2 += '<td>' + counter + '</td>';
                cols2 += '<td class="setProductName" ></td>';
                cols2 += '<td class="setProductType"></td>';
                cols2 += '<td class="setAmount"></td>';
                cols2 += '<td class="setPrice"></td>';
                cols2 += '<td class="setTotal"></td>';
                newRow2.append(cols2);
                $("table.table2").append(newRow2);

                var newRow3 = $("<tr>");
                var cols3 = "";
                cols3 += '<td>' + counter + '</td>';
                cols3 += '<td class="setProduct" ></td>';
                cols3 += '<td class="setPacksDetail"></td>';
                newRow3.append(cols3);
                $("table.table3").append(newRow3);


//                $("div.packsDetail").append('<div class="row"><div class="setPacksDetail col-lg-12 col-md-12 col-sm-12" style="background-color: white;"><span class="">' + counter + '</span></div></div>');




                $('#counter').val(counter);



            });

            $('#secondaryButton').click(function(){
                $("#primaryButton").click();
            });

            $('#printButton').click(function(){
//                $('#secondaryButton').removeAttr('disabled');
                setTimeout(function(){
                    $("#secondaryButton").removeAttr('disabled');
                }, 3000);
            });


        });

        function myDeleteFunction() {
            counter -= 1
            document.getElementById("myTable").deleteRow(counter + 1);
            document.getElementById("myTable2").deleteRow(counter + 1);
            document.getElementById("myTable3").deleteRow(counter + 1);
//            document.getElementsByClassName("setPacksDetail")[counter + 1].remove();

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
                c++;
                price = document.getElementsByClassName("price")[c].value;
                quantity = document.getElementsByClassName("quantity")[c].value;
                var total = price * quantity;
                if( packs = document.getElementsByClassName("packs")[c].value == ""){
                    document.getElementsByClassName("packsCount")[c].value = 0;
                }
                document.getElementsByClassName("total")[c].value = parseFloat(total.toFixed(3));
                grandTotal += total;
            }

            document.getElementsByClassName("grandTotal")[0].value = parseFloat(grandTotal.toFixed(3));
            getValues();
        }

        function getProduct() {
            var c = -1;
            for (var i = 1; i <= counter; i++) {
                c++
                el = document.getElementsByClassName("product")[c];
                selectedText = el.options[el.selectedIndex].innerHTML;
                var str = selectedText,
                    prod = selectedText.substring(0, str.indexOf(' (') + ''.length);
                document.getElementsByClassName("setProductName")[c].innerHTML = prod;

                var st = selectedText;
                var type = (st.split("(").pop()).replace(')', '');
                document.getElementsByClassName("setProductType")[c].innerHTML = type;
            }
            getValues();
        }

        function getDate() {
            document.getElementById("setDate").innerHTML = document.getElementById("dateAsguest").value;
        }

        function getValues() {
            var pro;
            var price = 0;
            var quantity = 0;
            var grandTotal = 0;
            var packs = 0;
            var c = -1;
            for (var i = 1; i <= counter; i++) {
                c++
                price = document.getElementsByClassName("price")[c].value;
                packs = document.getElementsByClassName("packs")[c].value;
                p = packs.replace(/\+/g," + ")

                el = document.getElementsByClassName("product")[c];
                pro = el.options[el.selectedIndex].innerHTML;
                document.getElementsByClassName("setProduct")[c].innerHTML = pro;

                document.getElementsByClassName("setPacksDetail")[c].innerHTML = p;

                quantity = document.getElementsByClassName("quantity")[c].value;
                var total = price * quantity;
                document.getElementsByClassName("setAmount")[c].innerHTML = quantity;
                if(price != 0){
                    document.getElementsByClassName("setPrice")[c].innerHTML = price;
                }
                else{
                    document.getElementsByClassName("setPrice")[c].innerHTML = 0;
                }

                document.getElementsByClassName("setTotal")[c].innerHTML = parseFloat(total).toFixed(1);

                el = document.getElementsByClassName("product")[c];
                selectedText = el.options[el.selectedIndex].innerHTML;
                var str = selectedText,
                    prod = selectedText.substring(0, str.indexOf(' (') + ''.length);
                document.getElementsByClassName("setProductName")[c].innerHTML = prod;

                var st = selectedText;
                var type = (st.split("(").pop()).replace(')', '');
                document.getElementsByClassName("setProductType")[c].innerHTML = type;

                grandTotal += total;
            }
            var expenses = document.getElementById("other_expense").value;
            if(expenses == ""){
                var grandExpense = grandTotal;
            }
            else {
                var grandExpense = parseInt(expenses) + grandTotal;
            }

            document.getElementById("setGrandTotal").innerHTML = Math.round(grandExpense);
            document.getElementById("setOtherExpenses").innerHTML = expenses;
            var selectedOption = $("input:radio[name=payment]:checked").val();
            if(selectedOption == 'paid'){
                document.getElementById("pay").innerHTML = grandExpense;
            }
            else{
                document.getElementById("pay").innerHTML = document.getElementById("received_debt").value;
            }

            var remainDebt = parseInt(document.getElementById("remainDebt").innerHTML);
            document.getElementById("remainingLoan").innerHTML = (grandExpense + remainDebt) - document.getElementById("pay").innerHTML;

        }

        function allQuantities() {
            var c = -1;
            for (var k = 1; k <= counter; k++) {
                c++
                var packs = 0
                var packsArrey;
                var totalPacks = 0;
                packs = document.getElementsByClassName("packs")[c].value;
                packsArrey = packs.split("+").map(Number)



                for(var j=0; j < packsArrey.length; j++){
                    totalPacks += parseFloat(packsArrey[j]);
                }
                document.getElementsByClassName("quantity")[c].value = parseFloat(totalPacks.toFixed(3));
                document.getElementsByClassName("packsCount")[c].value = packsArrey.length;
                quantityPrice();
            }
        }

        function calculateRow(row) {
            var price = +row.find('input[name^="price"]').val();
        }
        function calculateGrandTotal() {
            var grandTotal = 0;
            $("table.order-list").find('input[name^="price"]').each(function () {
                grandTotal += +$(this).val();
            });
            $("#grandtotal").text(grandTotal.toFixed(3));
        }





        //ajax
        function showdebt(event) {
            event.preventDefault();

            var Id=$("#select22").val();

            $.post("{{ route('admin.debtC') }}",{customerId:Id,_token:"{{ Session::token() }}"},function (data,status) {
                $("#remainDebt").empty();
                $.each(data,function (index,$remainData) {
                    $("#remainDebt").html($remainData.remaining_debt);
                    $("#customerName").html($remainData.responsible_person);
                });
                getValues();
            });
        };
    </script>

@stop
