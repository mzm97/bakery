@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    خریداری ها
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
        <h1>لیست خریدها</h1>
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
                                خریداری ها
                            </div>
                        </div>
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table table-striped table-bordered" id="list_supplier_invoices" width="100%">
                            <thead>
                            <tr>
                                <th>شماره</th>
                                <th>شماره بل</th>
                                <th>کمپنی</th>
                                <th>شخص مسؤل</th>
                                <th>خریداری</th>
                                <th>مصارف</th>
                                <th>مجموعه</th>
                                <th>تاریخ</th>
                                <th>معلومات اضافی</th>
                                <th class="payHide">جزییات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1 ?>
                            @foreach($invoice as $inv)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $inv->supplier_invoice_no }}</td>
                                    <td>{{ $inv->company }}</td>
                                    <td>{{ $inv->responsible_person }}</td>
                                    <td>{{ $inv->all_total }}</td>
                                    <td>{{ $inv->other_expense }}</td>
                                    <td>{{ $inv->all_money }}</td>
                                    <td>{{ $inv->date }}</td>
                                    <td>{{ $inv->more_info }}</td>
                                    <td><a href="supplier_invoice_detail/{{ $inv->supplier_invoice_id }}"><i class="livicon" data-name="warning-alt" data-size="18" data-c="#428bca" data-hc="#428bca" data-loop="true"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr style="font-weight: bold">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>مجموعه</td>
                                <td ></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
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

    <script>

        // confirm delete
        function gettingId(value)
        {
            var val = value;
            document.getElementById('setVal').value = val;
        }

        $('#myModal').on('show', function() {
            var id = $(this).data('id'),
                removeBtn = $(this).find('.danger');
        })

        $('.confirm-delete').on('click', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            $('#myModal').data('id', id).modal('show');
        });
        //End confirm delete
    </script>


@stop
