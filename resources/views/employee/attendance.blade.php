@extends('admin/layouts/default')
@section('title')
    حاضری کارمندان
@stop

@section('header_styles')

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


    @if(!$date->isEmpty())

        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="alert alert-info alert-dismissible" style="text-align: center;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
                    <h4>حاضری امروز گرفته شده است.</h4>
                </div>
            </div>
        </div>
    @else
        <section class="content">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">

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

                    <div class="panel panel-primary filterable">
                        <div class="panel-heading clearfix  ">
                            <div class="panel-title pull-left">
                                <div class="caption">
                                    <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    حاضری کارمندان
                                </div>

                            </div>

                        </div>


                        <div class="panel-body table-responsive">
                            <form class="form-horizontal" action="{{ route('admin.post_attendance_employee') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="EmNumner" value="{{ count($employees) }}">
                                <table class="table table-striped table-bordered width100" id="table">
                                    <thead>
                                    <tr>
                                        <th>شماره</th>
                                        <th>اسم کارمند</th>
                                        <th>حاضری</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1 ?>
                                    @foreach($employees as $emp)
                                        <input   type="hidden"   name="employeeId[]" value="{{ $emp->employee_id }}">
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $emp->employee_name }}</td>
                                            <td>
                                                حاضر &nbsp;
                                                <input type="radio" name="attend[{{ $emp->employee_id }}]" id="" value="حاضر" checked class="minimal-blue">
                                                &nbsp;&nbsp;&nbsp;
                                                غیر حاضر &nbsp;
                                                <input type="radio" name="attend[{{ $emp->employee_id }}]" id="" value="غیر حاضر" class="minimal-blue">

                                            </td>


                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3"><input type="submit" value="ثبت" class="btn btn-primary btn-xs btn-block"></td>
                                    </tr>
                                    </tbody>

                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @endif
@stop
@section('footer_scripts')
@stop
