@extends('admin.layouts.default2')
@section('title')
    Edit investment
    @parent
@stop
@section('header_styles')
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">


@stop
@section('content')
    <section class="content-header">
        <!-- <h1>Form Examples</h1> -->
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#">Investments</a>
            </li>
            <li class="active">Edit Investment</li>

        </ol>
    </section>
    <section class="content">


        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-primary" id="hidepanel1">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Update investment
                        </h3>
                        <span class="pull-right"><i class="glyphicon glyphicon-chevron-up clickable"></i></span>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ url('admin/edit_investment_record') }}/{{$investment->investment_id}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="amount">Investment Account :</label>
                                <div class="col-md-9">
                                    <input id="amount" name="amount" type="text" placeholder="Write investment name here!" class="form-control" value="{{$investment->amount}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="currency">Currency :</label>
                                <div class="col-md-9">
                                    <input id="investment_type" name="currency" type="text" placeholder="Write investment type here!" class="form-control" value="{{$investment->currency}}">
                                </div>


                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="description">Description :</label>
                                <div class="col-md-9">
                                    <textarea class="form-control resize_vertical" id="description" name="description" placeholder="Write description here!" rows="5">{{$investment->description}}</textarea>
                                </div>
                            </div>


                            <div class="form-position">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-responsive btn-primary btn-sm">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </section>
@stop
@section('footer_scripts')

    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" ></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form_examples.js') }}"></script>

    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" ></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/form_wizard.js') }}"  type="text/javascript"></script>

@stop
