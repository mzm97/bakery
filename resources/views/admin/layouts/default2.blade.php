<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
            {{--کیک و کلچه پزی B ابراهیمی--}}
        @show
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon2.ico') }}">
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.rtl.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/persianDatepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/iCheck/css/all.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/iCheck/css/line/line.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-switch/css/bootstrap-switch.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/switchery/css/switchery.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/awesomeBootstrapCheckbox/awesome-bootstrap-checkbox.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/formelements.css') }}"/>

    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">


    <link href="{{ asset('assets/css/print.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/printInvoice.css') }}" rel="stylesheet">


    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dataTables.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/colReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/rowReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/scroller.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/tables.css') }}" />



    <style>
        @font-face {
            font-family: 'samim';
            src:url("{{ asset('assets/fonts/Samim.ttf') }}");
        }

        body,h1,h2,h3,h4,li,*{
            font-family: samim;

        }
        body{
            background-color: #ebebeb;
        }
        .panel{
            border:none;
        }

        .alert-success{
            background-color: #22ddad !important;
        }

    </style>

@yield('header_styles')

<body class="skin-josh">
<header class="header">
    <a href="{{ route('admin.dashboard') }}" class="logo">
        {{--        <img src="{{ asset('assets/img/logo.png') }}" alt="logo">--}}
        <span style="color: white; font-weight: bold; font-size: 25px">شرکت ابریشم ابراهیمی</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <div class="responsive_nav"></div>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                {{--                @include('admin.layouts._messages')--}}
                {{--                @include('admin.layouts._notifications')--}}
                <li class="dropdown user user-menu rtl_list">
                    <a href="#" class="dropdown-toggle profile_user" data-toggle="dropdown">
                        @if(Sentinel::getUser()->pic)
                            <img src="{!! url('/').'/uploads/users/'.Sentinel::getUser()->pic !!}" alt="img" height="35px" width="35px"
                                 class="img-circle img-responsive pull-left "/>

                        @elseif(Sentinel::getUser()->gender === "male")
                            <img src="{{ asset('assets/images/authors/avatar3.png') }}" alt="img" height="35px" width="35px"
                                 class="img-circle img-responsive pull-left"/>

                        @elseif(Sentinel::getUser()->gender === "female")
                            <img src="{{ asset('assets/images/authors/avatar5.png') }}" alt="img" height="35px" width="35px"
                                 class="img-circle img-responsive pull-left"/>

                        @else
                            <img src="{{ asset('assets/images/authors/no_avatar.jpg') }}" alt="img" height="35px" width="35px"
                                 class="img-circle img-responsive pull-left"/>
                        @endif
                        <div class="riot">
                            <div>
                                <p class="user_name_max">{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</p>
                                <span>
                                        <i class="caret"></i>
                                    </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu profile1">
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">

                            <div class="pull-right logout">
                                <a href="{{ URL::to('admin/logout') }}">
                                    <i class="livicon" data-name="sign-out" data-s="15"></i>
                                    خروج
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper fixed_menu">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side ">
        <section class="sidebar ">
            <div class="page-sidebar sidebar-nav">
                <div class="nav_icons">
                    <ul class="sidebar_threeicons">
                        <li>
                            <a href="{{ URL::to('admin/users') }}">
                                <i class="livicon" data-name="user" title="Users" data-loop="true"
                                   data-color="#6CC66C" data-hc="#6CC66C" data-s="25"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
                <!-- BEGIN SIDEBAR MENU -->
            @include('admin.layouts._left_menu')
            <!-- END SIDEBAR MENU -->
            </div>
        </section>
    </aside>
    <aside class="right-side">

        <!-- Notifications -->
    
	
	{{--<div id="notific">--}}
    {{--@include('notifications')--}}
    {{--</div>--}}

    <!-- Content -->
        @yield('content')

    </aside>
    <!-- right-side -->
</div>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button">
    <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
</a>

<script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/js/printThis.js') }}"></script>
<script src="{{ asset('assets/js/manual.js') }}"></script>



<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/bootstrap-switch/js/bootstrap-switch.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/switchery/js/switchery.js') }}" ></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/bootstrap-maxlength/js/bootstrap-maxlength.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/card/lib/js/jquery.card.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/js/pages/radio_checkbox.js') }}"></script>



<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/jeditable/js/jquery.jeditable.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.buttons.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.colReorder.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.responsive.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.rowReorder.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.colVis.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.html5.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.bootstrap.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/pdfmake.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/vfs_fonts.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.scroller.js') }}" ></script>
<script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" ></script>
<script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
<!-- <script type="text/javascript" src="{{ asset('assets/js/pages/table-advanced.js') }}" ></script> -->
<script type="text/javascript" src="{{ asset('assets/js/custom.js') }}" ></script>
<script src="{{ asset('assets/js/buttons.print.js') }}"></script>

<script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" ></script>
<script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
<script src="{{ asset('assets/js/pages/form_examples.js') }}"></script>
<script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" ></script>
<script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/form_wizard.js') }}"  type="text/javascript"></script>
<script src="{{ asset('assets/js/persianDatepicker.js') }}"></script>




<script type="text/javascript">
    //    var p = new persianDate({ showGregorianDate: true });
    //    $("#dateAsguest, #dateAsguest2").persianDatepicker({
    //        cellWidth: 34,
    //        cellHeight: 30,
    //        fontSize: 13,
    //        startDate: p.now().addDay(0).toString("YYYY/MM/DD"),
    //        endDate: p.now().addYear(50).toString("YYYY/MM/DD"),
    //        showGregorianDate: true,
    //        formatDate: "YYYY-0M-0D"
    //    });

    $("#dateAsguest, #dateAsguest2").persianDatepicker({
        formatDate: "YYYY-0M-0D",
        cellWidth: 34,
        cellHeight: 30,
        fontSize: 13,
        formatDate: "YYYY-0M-0D"
    });

    $("#dateAsguest, #dateAsguest2").keypress(function () {

        $(this).prop('readonly', true);

    });


</script>





@yield('footer_scripts')
<!-- end page level js -->
</body>
</html>
