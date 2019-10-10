@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    جزییات مواد خریده شده
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/colReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/rowReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/scroller.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/tables.css') }}" />
@stop

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <!--section starts-->
        <h1>لیست</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    صفحه عمومی
                </a>
            </li>
            <li>
                <a href="#">مواد خام</a>
            </li>
            <li class="active">لیست</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">

                @if(session()->has('deleteMessage'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span>{{ session('deleteMessage') }}</span>
                    </div>
                @endif

                @if(session()->has('editRecordMessage'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: #000;">&times;</button>
                        <span style="color: #3a3131;">{{ session('editRecordMessage') }}</span>
                    </div>
                @endif

                @if(session()->has('deleted'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: #000;">&times;</button>
                        <span style="color: #3a3131;">{{ session('deleted') }}</span>
                    </div>
                @endif

                @if(session()->has('noDeleted'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: #000;">&times;</button>
                        <span style="color: #3a3131;">{{ session('noDeleted') }}</span>
                    </div>
                @endif


                <div class="panel panel-primary filterable">
                    <div class="panel-heading clearfix  ">
                        <div class="panel-title pull-left">
                            <div class="caption">
                                <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                جزییات
                            </div>
                        </div>
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table table-striped table-bordered" id="" width="100%">
                            <div style="font-size:medium"><span style="font-weight: bold;"  id="company">شرکت: </span> <span id="com_val">{{ $rawSupplier[0]->company }}</span></div>
                            <div style="font-size:medium"><span style="font-weight: bold;" id="responsible">شخص مسؤل: </span> <span id="res_val">{{ $rawSupplier[0]->responsible_person }}</span></div>
                            <div style="font-size:medium"><span style="font-weight: bold;" id="responsible">بل: </span> <span id="res_val">{{ $rawSupplier[0]->supplier_invoice_no }}</span></div>
                            <div style="font-size:medium"><span style="font-weight: bold;" id="responsible">معلومات اضافی: </span> <span id="res_val">{{ $rawSupplier[0]->extra_info }}</span></div>
                            <div style="font-size:medium"><span style="font-weight: bold;" id="responsible">تاریخ: </span> <span id="res_val">{{ $rawSupplier[0]->date }}</span></div>
                            <hr>


                            <thead>
                            <tr>
                                <th>No</th>
                                <th>مواد</th>
                                <th>نوعیت</th>
                                <th>مقدار</th>
                                <th>قیمت</th>
                                <th>مجموعه</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1 ?>
                            @foreach($rawSupplier as $raw)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $raw->raw_material_name }}</td>
                                    <td>{{ $raw->raw_material_type }}</td>
                                    <td>{{ $raw->quantity }}</td>
                                    <td>{{ $raw->price }}</td>
                                    <td>{{ $raw->total }}</td>
                                </tr>
                            @endforeach
                            <tr style="font-weight: bold">
                                <td colspan="3"></td>
                                <td colspan="2" style="text-align: center">  مجموعه:</td>
                                <td>&nbsp;{{ $invoice->all_total }}</td>
                            </tr>
                            </tbody>
                            <tfoot>

                            <tr>
                                <td colspan="6"><a href = {{ URL::to('admin/list_supplier_invoices') }}>بازگشت</a></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- row-->
        <div style="display: none;">
            <table id="table2">
                <thead>
                <tr>
                    <th class="th_left">#</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
    <!-- content -->

@stop

{{-- page level scripts --}}
@section('footer_scripts')

    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/jeditable/js/jquery.jeditable.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.buttons.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.colReorder.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.responsive.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.rowReorder.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.colVis.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.html5.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/pdfmake.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/vfs_fonts.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.scroller.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/table-advanced.js') }}" ></script>

@stop
