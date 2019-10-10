@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
 برداشت ها
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

            <li class="active">برداشت ها</li>
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
                                لیست برداشت پول
                            </div>
                        </div>
                    </div>
                    <div class="panel-body table-responsive">

                        <table class="table table-striped table-bordered" id="table1" width="100%">
                            @if( !$withdraw->isEmpty() )
                                <div style="font-size:medium"><span style="font-weight: bold;"  id="company">اسم شریک: </span> <span id="com_val">{{ $withdraw[0]->name }}</span></div>
                                <div style="font-size:medium"><span style="font-weight: bold;" id="responsible">ایمیل آدرس: </span> <span id="res_val">{{ $withdraw[0]->email }}</span></div>
                                <div style="font-size:medium"><span style="font-weight: bold;" id="phone">شماره تماس:</span> <span id="phone_val">{{ $withdraw[0]->phone }}</span></div>
                            @endif
                            <br>
                                <a href = {{ URL::to('admin/list_partners') }}>بازگشت</a>
                            <hr>

                            <thead>
                            <tr>
                                <th>شماره</th>
                                {{--<th>Company</th>--}}
                                {{--<th>Responsible</th>--}}
                                <th>تاریخ</th>
                                <th>توضیحات</th>
                                <th>مقدار برداشت</th>
                                <th>مجموعه</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1 ?>
                            @foreach($withdraw as $wit)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    {{--<td>{{ $rep->company }}</td>--}}
                                    {{--<td>{{ $rep->supplier_name }}</td>--}}
                                    <td>{{ $wit->date }}</td>
                                    <td>{{ $wit->description }}</td>
                                    <td>{{ $wit->amount }}</td>
                                    <td>{{ $wit->balance }}</td>
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
                                <form class="text-center" action="{{ url('admin\delete_supplier') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="modal-header d-flex justify-content-center">
                                        <h4 class="">آیا مطمئین هستید که حذف گردد؟</h4>
                                        <input type="hidden" name="supplier_id" id="setVal">
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
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttonsLedger.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttonsLedger.print.js') }}" ></script>
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
