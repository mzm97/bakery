@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    شرکا
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
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    صفحه عمومی
                </a>
            </li>
            <li>
                <a href="#">برداشت ها</a>
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
                                <i class="livicon" data-name="list" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                لیست
                            </div>
                        </div>
                        <div class="pull-right">
                            <a style="padding-right: 0px;" href="{{ URL::to('admin/add_partner') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon"></span>شریک جدید</a>
                        </div>
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table table-striped table-bordered" id="table1" width="100%">
                            <thead>
                            <tr>
                                <th>شماره</th>
                                <th>اسم</th>
                                <th>ایمیل آدرس</th>
                                <th>شماره تماس</th>
                                <th>معلومات اضافی</th>
                                <th class="payHide">حالت</th>
                                <th class="payHide">تصحیح</th>
                                <th class="payHide">برداشت ها</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1 ?>
                            @foreach($partner as $par)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $par->name }}</td>
                                    <td>{{ $par->phone }}</td>
                                    <td>{{ $par->email }}</td>
                                    <td>{{ $par->more_info }}</td>
                                    @if( $par->deleted_at == null)
                                        <td style="text-align: center"> فعال <a href="#" role="button" onclick="gettingId({{ $par->partner_id }})" class="confirm-delete" data-id="2" data-toggle="modal"><i class="livicon" data-name="edit" data-size="18" data-c="#6cc66c" data-hc="#6cc66c" data-loop="true"></i></a></td>
                                    @else
                                        <td style="text-align: center"> غیر فعال <a href="#" role="button" onclick="gettingPartnerId({{ $par->partner_id }})" class="confirm-delete-partner" data-id="2" data-toggle="modal"><i class="livicon" data-name="edit" data-size="18" data-c="#6cc66c" data-hc="#6cc66c" data-loop="true"></i></a></td>
                                    @endif

                                    <td>
                                        <a href="edit_partner/{{ $par->partner_id }}">تصحیح</a>
                                    </td>
                                    <td>
                                        <a href="list_partner_withdraws/{{ $par->partner_id}}"><span>برداشت ها</span></a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <!--Modal: modalConfirmDelete-->
                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-notify modal-danger">
                            <!--Header-->
                            <div class="modal-content text-center">
                                <form class="text-center" action="{{ url('admin\delete_partner') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="modal-header d-flex justify-content-center">
                                        <h4 class="">آیا مطمئین هستید که شریک مورد نظر غیر فعال گردد؟</h4>
                                        <input type="hidden" name="partner_id" id="setVal">
                                    </div>
                                    <!--Body-->
                                    <div class="modal-body">
                                        <i class="fa fa-times fa-4x animated rotateIn" style="color:#f56954 "></i>
                                    </div>
                                    <!--Footer-->
                                    <div class="modal-footer flex-center">
                                        <button type="submit" href="" class="btn btn-default">بلی</button>
                                        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">نخیر</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Modal: modalConfirmDelete-->

                    <!--Modal: modalActivePartner-->
                    <div id="myModalActive" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-notify modal-danger">
                            <!--Header-->
                            <div class="modal-content text-center">
                                <form class="text-center" action="{{ url('admin\active_partner') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="modal-header d-flex justify-content-center">
                                        <h4 class="">آیا مطمئین هستید که شریک مورد نظر دوباره فعال گردد؟</h4>
                                        <input type="hidden" name="partner_id" id="setPartnerVal">
                                    </div>
                                    <!--Body-->
                                    <div class="modal-body">
                                        <i class="fa fa-check fa-4x animated rotateIn" style="color:#5cb85c "></i>
                                    </div>
                                    <!--Footer-->
                                    <div class="modal-footer flex-center">
                                        <button type="submit" href="" class="btn btn-success">بلی</button>
                                        <a type="button" class="btn btn-default  waves-effect" data-dismiss="modal">نخیر</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Modal: modalActivePartner-->

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

        // confirm active partner
        function gettingPartnerId(value)
        {
            var val = value;
            document.getElementById('setPartnerVal').value = val;
        }

        $('#myModalActive').on('show', function() {
            var id = $(this).data('id'),
                removeBtn = $(this).find('.danger');
        })

        $('.confirm-delete-partner').on('click', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            $('#myModalActive').data('id', id).modal('show');
        });
        //End confirm active partner


    </script>
@stop
