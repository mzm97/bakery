@extends('admin/layouts/default2')
@section('title')
    لیست بانک ها
@stop
@section('header_styles')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    {{--<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.rtl.min.css') }}">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dataTables.bootstrap.css') }}"/>
    <link href="{{ asset('assets/vendors/sweetalert/css/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/css/select2.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datatables/css/colReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datatables/css/rowReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/scroller.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/tables.css') }}"/>
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
            <div class="col-md-12">
                <div class="panel panel-primary table-edit">
                  <div class="panel-heading clearfix  ">
                      <div class="panel-title pull-left">
                          <div class="caption">
                              <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            لیست بانک ها
                          </div>
                      </div>
                      <div class="pull-right">
                          <a href="add_bank" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span>&nbsp;علاوه نمودن بانک جدید</a>                        </div>
                  </div>
                    <div class="panel-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <div id="sample_editable_1_wrapper" class="">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer sample_editable"
                                   id="banks_list" role="grid" width="100%">
                                <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" style="width: 200px;">
                                        اسم بانک
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="width: 250px;">
                                    اسم اکونت
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="width: 250px;">
                                  نمبر اکونت
                                    </th>
                                    <th class="sorting noPrint" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="width: 88px;">تغییر
                                    </th>
                                    <th class="sorting noPrint" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="width: 125px;">حذف
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p style="text-align:center;font-size:20px;margin-top:15px;">آیا میخواهید بانک مذکور راحذف نمایید ؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sm " data-dismiss="modal">نخیر</button>
                    <button type="submit" class="btn btn-danger btn-sm" id="delete_item" data-dismiss="modal">بلی</button>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
    <div class="modal fade" id="editConfirmModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p style="text-align:center;font-size:20px;margin-top:15px;">موفقانه تغییر داده شد.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danget btn-sm" data-dismiss="modal">بستن</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@stop
@section('footer_scripts')

    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.buttons.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.colReorder.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.responsive.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.rowReorder.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.colVis.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.html5.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.bootstrap.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}"></script> -->
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/pdfmake.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.scroller.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
    <script src="{{ asset('assets/vendors/sweetalert/js/sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/sweetalert/js/sweetalert-dev.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/buttons.print.js') }}"></script>
    <script>
        $( document ).ready(function() {
            $(function () {
                var nEditing = null;
                var table = $('#banks_list').DataTable({
                    processing: true,
                    serverSide: true,
                    oLanguage: {
                      sSearch: "جستجوی عمومی",
                      sSearchPlaceholder: "جستجو ....",
                      sLengthMenu: "نمایش _MENU_ ریکارد",
                      sZeroRecords: "ریکاردی موجود نیست.",
                      sLoadingRecords: "لطفا منتظر باشید!",
                      sInfo: "مجموعه ریکارد ها _TOTAL_",
                      "sInfoFiltered": "(نتیجه جستجو از  _MAX_ ریکارد)",
                      sLengthMenu: 'انتخاب <select>'+
                      '<option value="5">5</option>'+
                      '<option value="10">10</option>'+
                      '<option value="20">20</option>'+
                      '<option value="30">30</option>'+
                      '<option value="40">40</option>'+
                      '<option value="-1">همه</option>'+
                      '</select> ریکارد',
                      oPaginate: {
                          sPrevious: "قبلی",
                          sNext: "بعدی",
                      },
                  },
                    dom: 'Bfrtip',
              buttons : [
                {
                        extend: 'print',
                        exportOptions: {
                            columns: "thead th:not(.noPrint)"
                        },
                    }
              ],
                    ajax: '{!! route('admin.banks_list_data') !!}',
                    columns: [
                        {data: 'bank_name', name: 'bank_name'},
                        {data: 'account_name', name: 'account_name'},
                        {data: 'account_no', name: 'account_no'},
                        {data: 'edit', name: 'edit', orderable: false, searchable: false},
                        {data: 'delete', name: 'delete', orderable: false, searchable: false}
                    ],
                    initComplete : function () {
                      this.api().columns().every(function () {
                          var column = this;
                          var input ="<input type='text' class='form-control'>";
                          $(input).appendTo($(column.footer()).empty())
                              .on('change', function () {
                                  var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                  column.search(val ? val : '', true, false).draw(false);
                              });

                      });
                  },

                });
                table.on('draw', function () {
                    $('.livicon').each(function () {
                        $(this).updateLivicon();
                    });
                });

                function restoreRow(table, nRow) {
                    var aData = table.row(nRow).data();
                    var jqTds = $('>td', nRow);

                    for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                        table.cell().data(aData[i], nRow, i, false);
                    }
                    table.draw(false);
                }

                var bankid,bankname,accountname,accountno;
                function editRow(table, nRow) {
                    var aData = table.row(nRow).data();
                    var jqTds = $('>td', nRow);
                    bankid = aData.bank_id ? aData.bank_id : '';
                    bankname = aData.bank_name ? aData.bank_name : '';
                    accountname = aData.account_name ? aData.account_name : '';
                    accountno = aData.account_no ? aData.account_no : '';

                    // jqTds[0].innerHTML = expensetypeid;
                    jqTds[0].innerHTML = '<input type="text" name="bankname" id="bankname" class="form-control input-small" value="' + bankname + '">';
                    jqTds[1].innerHTML = '<input type="text" name="accountname" id="accountname" class="form-control input-small" value="' + accountname + '">';
                    jqTds[2].innerHTML = '<input type="text" name="accountno" id="accountno" class="form-control input-small" value="' + accountno + '">';
                    jqTds[3].innerHTML = '<a class="edit" href="" >Save</a>';
                    jqTds[4].innerHTML = '<a class="cancel" href="">لغو</a>';
                }

                function saveRow(table, nRow) {

                    var jqInputs = $('input', nRow);
                    bankname = jqInputs[0].value;
                    accountname = jqInputs[1].value;
                    accountno = jqInputs[2].value;

                    var tableData = 'bankname=' + encodeURIComponent(bankname)
                        +'&accountname=' + encodeURIComponent(accountname)
                        +'&accountno=' + encodeURIComponent(accountno)
                        + '&_token=' + $('meta[name=_token]').attr('content');
                    $.ajax({
                        type: "post",
                        url: 'banks_list_editable_datatables/' + bankid + '/update',
                        data: tableData,
                        success: function (result) {
                            if(result!='success') {
                                console.log(result);
                                swal("There is some error!", result);
                                editRow(table, nRow);
                                nEditing = nRow;
                            }
                            else {
                                table.draw(false);
                            }
                        },
                        error: function (result) {
                            if (result.status = 442)


                            console.log( result.responseText.errors);

                        }

                    });

                }

                /*
                 Cancel Edit functionality
                 */

                function cancelEditRow(table, nRow) {
                    var aData = table.row(nRow).data();
                    var jqTds = $('>td', nRow);

                    for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                        table.cell().data(aData[i], nRow, i, false);
                    }

                    table.draw(false);
                }

                /*
                 Delete Functionality
                 */
                var nRow, aData, bankid;
                table.on('click', '.delete', function (e) {
                    e.preventDefault();
                    nRow = $(this).parents('tr')[0];
                    aData = table.row(nRow).data();
                    if (nEditing !== null && nEditing != nRow) {
                        /* Currently editing - but not this row - restore the old before continuing to edit mode */
                        $('#editConfirmModal').modal();
                        $('#deleteConfirmModal').modal().hide();
                    }
                    else {
                        bankid = aData.bank_id;
                        $('#deleteConfirmModal').on('click', '#delete_item', function (e) {
                            $.ajax({
                                type: "get",
                                url: 'banks_list_editable_datatables/' + bankid + '/delete',
                                success: function (result) {
                                    console.log('row ' + result + ' deleted');
                                    table.draw(false);
                                },
                                error: function (result) {
                                    console.log(result)
                                }
                            });
                        });
                    }
                });

                /*
                 When clicked on cancel button
                 */
                table.on('click', '.cancel', function (e) {
                    e.preventDefault();

                    restoreRow(table, nEditing);
                    nEditing = null;

                });

                /*
                 When clicked on edit button
                 */

                table.on('click', '.edit', function (e) {
                    e.preventDefault();
                    var nRow = $(this).parents('tr')[0];

                    if (nEditing !== null && nEditing != nRow) {
                        /* Currently editing - but not this row - restore the old before continuing to edit mode */
                        $('#editConfirmModal').modal();

                    } else if (nEditing == nRow && this.innerHTML == "Save") {
                        /* Editing this row and want to save it */
                        saveRow(table, nEditing);
                        nEditing = null;

                    } else {
                        /* No edit in progress - let's start one */
                        editRow(table, nRow);
                        nEditing = nRow;
                    }
                });
            });
            setTimeout(function(){
                $('input[type=search], th, #sample_editable_1_length select').on('mousedown',function(){
                    $('.cancel').click();
                });
                $('#sample_editable_1').on( 'page.dt', function () {
                    $('.cancel').click();
                } );
                },10);
        });


    </script>


@stop
