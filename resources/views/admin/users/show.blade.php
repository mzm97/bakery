@extends('admin/layouts/default')
@section('title')
    User Profile
    @parent
@stop
@section('content')
    <section class="content-header">
        <!-- <h1>Form Examples</h1> -->
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
            <div class="col-lg-8 col-lg-offset-2">
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
                @if(session()->has('editRecordMessage'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: #000;">&times;</button>
                        <span style="color: #3a3131;">{{ session('editRecordMessage') }}</span>
                    </div>
                @endif

                <div class="panel panel-primary" id="hidepanel1">
                    <div class="panel-heading clearfix">
                        <div class="panel-title pull-left">
                            <div class="caption">
                                <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                تصحیح جزییات کاربر
                            </div>
                        </div>
                        <div class="pull-right">
                            <a href="{{ URL::to('admin/users/') }}/{{$user->id}}/{{'edit'}}" class="btn btn-sm btn-default">تصحیح</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="users">

                                        <tr>
                                            <td>اسم</td>
                                            <td>
                                                <p class="user_name_max">{{ $user->first_name }}</p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>تخلص</td>
                                            <td>
                                                <p class="user_name_max">{{ $user->last_name }}</p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>ایمیل</td>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>زمان ایجاد</td>
                                            <td>
                                                {!! $user->created_at->format('Y-m-d') !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>زمان تصحیح</td>
                                            <td>
                                                {!! $user->updated_at->format('Y-m-d') !!}
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
@stop

