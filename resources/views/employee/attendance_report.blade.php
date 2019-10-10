@extends('admin/layouts/default2')
@section('title')
    راپور عمومی حاضری
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
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary filterable">
                    <div class="panel-heading clearfix  ">
                        <div class="panel-title pull-left">
                            <div class="caption">
                                <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                راپور عمومی حاضری
                            </div>
                        </div>

                        </div>

                    <div class="panel-body table-responsive">
                        <table class="table table-striped table-bordered" id="attendanceReport" width="100%">
                            <thead>
                            <tr>
                                <th>اسم کارمند</th>
                                <th>حاضری</th>
                                <th>حالت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($EA as $e)
                                <tr>

                                    <td>{{ $e->employee_name }}</td>
                                    <td>{{ $e->attendance_date }}</td>
                                    {{--<td>{{ $e->attendance_status == 'present'? 'حاضر' : 'غیر حاضر'  }}</td>--}}
                                    <td>{{ $e->attendance_status  }}</td>

                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
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

@stop
