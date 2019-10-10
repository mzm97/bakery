@extends('admin/layouts/default2')
@section('title')
  راپور حاضری
@stop
@section('content')

    <section class="content-header">
        {{--<h1>List of employees</h1>--}}
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
                                راپور حاضری
                            </div>
                        </div>
                        <div class="pull-right">
                            <a href="{{ URL::to('admin/attendance_report') }}" class="btn btn-sm btn-default"><span class=""></span>جزئیات حاضری</a>
                        </div>
                        </div>

                    <div class="panel-body table-responsive">
                        <table class="table table-striped table-bordered" id="generalattendancereport" width="100%">
                            <thead>
                            <tr>
                                <th>اسم کارمند </th>
                                <th>موقف وظیفوی</th>
                                <th>ماه</th>
                                <th>حاضر</th>
                                <th>غیر حاضر</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attendanceStatus as $att)
                                <tr>

                                    <td>{{ $att->employee_name }}</td>
                                    <td>{{ $att->position }}</td>
                                    <td>{{ $att->year }}-{{$att->month}}</td>
                                    <td>{{ $att->total_present }}</td>
                                    <td>{{ $att->total - $att->total_present }}</td>

                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                              <tr>
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

@stop
