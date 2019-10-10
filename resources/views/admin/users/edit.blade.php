@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    تغییر جزییات
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>تصحیح</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    صفحه عمومی
                </a>
            </li>

            <li><a href="#">کاربران</a></li>
            <li class="active">تصحیح</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-md-6 col-md-offset-3">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
                        <strong >{{ session('success') }}</strong>
                    </div>
                @endif
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                            تصحیح جزییات کاربر
                        </h3>
                        <span class="pull-right clickable">
                                    <i class="glyphicon glyphicon-chevron-up"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        <!--main content-->
                    {!! Form::model($user, ['url' => URL::to('admin/users/'. $user->id.''), 'method' => 'put', 'class' => 'form-horizontal','id'=>'commentForm', 'enctype'=>'multipart/form-data','files'=> true]) !!}
                    <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div id="rootwizard">
                            <ul>
                                {{--<li><a href="#tab1" data-toggle="tab">User Profile</a></li>--}}
                                {{--<li><a href="#tab2" data-toggle="tab">Bio</a></li>--}}
                                {{--<li><a href="#tab3" data-toggle="tab">Address</a></li>--}}
                                {{--<li><a href="#tab4" data-toggle="tab">User Group</a></li>--}}
                            </ul>
                            <div class="tab-content">
                                {{--<div class="tab-pane" id="tab1">--}}
                                <h2 class="hidden">&nbsp;</h2>
                                <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                                    <label for="first_name" class="col-sm-2 control-label">اسم *</label>
                                    <div class="col-sm-10">
                                        <input id="first_name" name="first_name" type="text"
                                               placeholder="First Name" class="form-control required"
                                               value="{!! old('first_name', $user->first_name) !!}"/>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                                    <label for="last_name" class="col-sm-2 control-label">تخلص *</label>
                                    <div class="col-sm-10">
                                        <input id="last_name" name="last_name" type="text" placeholder="Last Name"
                                               class="form-control required"
                                               value="{!! old('last_name', $user->last_name) !!}"/>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                    <label for="email" class="col-sm-2 control-label">ایمیل آدرس *</label>
                                    <div class="col-sm-10">
                                        <input id="email" name="email" placeholder="E-Mail" type="text"
                                               class="form-control required email"
                                               value="{!! old('email', $user->email) !!}"/>

                                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->first('password', 'has-error') }}">
                                    <label for="password" class="col-sm-2 control-label">پسورد *</label>
                                    <div class="col-sm-10">
                                        <input id="password" name="password" type="password" placeholder="Password"
                                               class="form-control required" value="{!! old('password') !!}"/>
                                        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                                    <label for="password_confirm" class="col-sm-2 control-label">تایید پسورد *</label>
                                    <div class="col-sm-10">
                                        <input id="password_confirm" name="password_confirm" type="password"
                                               placeholder="Confirm Password " class="form-control required"/>
                                        {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                {{--<input type="hidden" name="group" value="1">--}}
                                <input type="hidden" id="activate" name="activate" value="1">
                                {{--</div>--}}
                                <ul class="pager wizard">
                                    <li class="next finish" style="display:none;"><a href="javascript:;">تصحیح</a></li>
                                </ul>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--row end-->
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" ></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/adduser.js') }}"></script>
    <script>
        function formatState (state) {
            if (!state.id) { return state.text; }
            var $state = $(
                '<span><img src="{{ asset('assets/img/countries_flags') }}/'+ state.element.value.toLowerCase() + '.png" class="img-flag" width="20px" height="20px" /> ' + state.text + '</span>'
            );
            return $state;

        }
        $("#countries").select2({
            templateResult: formatState,
            templateSelection: formatState,
            placeholder: "select a country",
            theme:"bootstrap"
        });

    </script>
@stop
