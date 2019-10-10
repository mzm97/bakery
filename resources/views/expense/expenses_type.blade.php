@extends('admin.layouts.default2')
@section('title')
    لیست انواع مصارف
@stop
@section('header_styles')
    <meta name="_token" content="{!! csrf_token() !!}"/>
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
                          لیست انواع مصارف
                       </div>
                   </div>
           <div class="pull-right">
                       <a href="add_expense_type" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span>&nbsp;نوع جدیدی از مصرف</a>
           </div>
               </div>
                    <div class="panel-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <div id="sample_editable_1_wrapper" class="">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer sample_editable"
                                   id="expensetype_list" role="grid" width="100%">
                                <thead>
                                <tr role="row">

                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_editable_1" rowspan="1"
                                        colspan="1" style="width: 222px;">
                                        اسم نوع مصرف
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1"
                                        colspan="1" aria-label="
                                                 Last Name
                                            : activate to sort column ascending" style="width: 222px;">
                                    جزئیات
                                    </th>
                                    <th class="sorting noPrint" tabindex="0" aria-controls="sample_editable_1" rowspan="1"
                                        colspan="1" aria-label="

                                            : activate to sort column ascending" style="width: 88px;">تغییر
                                    </th>
                                    <th class="sorting noPrint" tabindex="0" aria-controls="sample_editable_1" rowspan="1"
                                        colspan="1" aria-label="

                                            : activate to sort column ascending" style="width: 125px;">حذف
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                      <tfoot>
                                        <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          </tr>
                                      </tfoot>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- content -->
    <!-- <div class="col-lg-2"> -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p style="text-align:center;font-size:20px;margin-top:15px;">آیا میخواهید کارمند مذکور را حذف نمایید ؟</p>
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
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/pdfmake.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.scroller.js') }}"></script>
    <script src="{{ asset('assets/vendors/sweetalert/js/sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/sweetalert/js/sweetalert-dev.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/buttons.print.js') }}"></script>
    <script>
        $( document ).ready(function() {
            $(function () {
                var nEditing = null;
                var table = $('#expensetype_list').DataTable({
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
                    ajax: '{!! route('admin.expense_type_list_data') !!}',
                    columns: [
                        {data: 'expense_type', name: 'expense_type'},
                        {data: 'more_info', name: 'more_info'},
                        {data: 'edit', name: 'edit', orderable: false, searchable: false},
                        {data: 'delete', name: 'delete', orderable: false, searchable: false}
                    ],


      initComplete: function () {
        var j = 0;
        this.api().columns().every(function () {
        var column = this;

          if(j === 0)
          {
                  var column = this;
                  var select = $('<select class="form-control"><option value=""></option></select>')
                      .appendTo($(column.footer()).empty())
                      .on('change', function () {
                          var val = $.fn.dataTable.util.escapeRegex(
                              $(this).val()
                          );
                          column
                              .search(val ? '^' + val + '$' : '', true, false)
                              .draw();
                      });

                  column.data().unique().sort().each(function (d, j) {
                      select.append('<option value="' + d + '">' + d + '</option>')
                  });
          }

      j++;
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


                var expensetypeid,expensetype,moreinfo;
                function editRow(table, nRow) {
                    var aData = table.row(nRow).data();
                    var jqTds = $('>td', nRow);
                    expensetypeid = aData.expense_type_id ? aData.expense_type_id : '';
                    expensetype = aData.expense_type ? aData.expense_type : '';
                    moreinfo = aData.more_info ? aData.more_info : '';

                    jqTds[0].innerHTML = '<input type="text" name="expensetype" id="expensetype" class="form-control input-small" value="' + expensetype + '">';
                    jqTds[1].innerHTML = '<input type="text" name="moreinfo" id="moreinfo" class="form-control input-small" value="' + moreinfo + '">';
                    jqTds[2].innerHTML = '<a class="edit" href="" >Save</a>';
                    jqTds[3].innerHTML = '<a class="cancel" href="">لغو</a>';
                }

                function saveRow(table, nRow) {
                    var jqInputs = $('input', nRow);
                    expensetype = jqInputs[0].value;
                    moreinfo = jqInputs[1].value;

                    var tableData = 'expensetype=' + encodeURIComponent(expensetype)
                        +'&moreinfo=' + encodeURIComponent(moreinfo)
                        + '&_token=' + $('meta[name=_token]').attr('content');

                    $.ajax({
                        type: "post",
                        url: 'expense_type_editable_datatables/' + expensetypeid + '/update',
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

                var nRow, aData, expense_type_id;
                table.on('click', '.delete', function (e) {
                    e.preventDefault();
                    nRow = $(this).parents('tr')[0];
                    aData = table.row(nRow).data();
                    if (nEditing !== null && nEditing != nRow) {
                        $('#editConfirmModal').modal();
                        $('#deleteConfirmModal').modal().hide();
                    }
                    else {
                        expensetypeid = aData.expense_type_id;
                        $('#deleteConfirmModal').on('click', '#delete_item', function (e) {
                            $.ajax({
                                type: "get",
                                url: 'expense_type_editable_datatables/' + expensetypeid + '/delete',
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
