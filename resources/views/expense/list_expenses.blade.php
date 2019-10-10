@extends('admin/layouts/default2')
@section('title')
    راپور مصارف
@stop

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    صفحه اصلی
                </a>
            </li>

        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary filterable">
                    <div class="panel-heading clearfix  ">
                        <div class="panel-title pull-left">
                            <div class="caption">
                                <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                راپور مصارف
                            </div>
                        </div>
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table table-striped table-bordered" id="ExpensesReport" width="100%">
                            <thead>
                            <tr>
                                <th>شماره</th>
                                <th>نوع مصرف</th>
                                <th>مقدار مصرف</th>
                                <th>تاریخ</th>
                                <th>جزئیات</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1 ?>
                            @foreach($expense as $exp)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $exp->expense_type }}</td>
                                    <td>{{ $exp->amount }}</td>
                                    <td>{{ $exp->date }}</td>
                                    <td>{{ $exp->description }}</td>

                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>

@stop
