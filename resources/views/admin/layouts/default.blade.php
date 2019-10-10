<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
            {{--| Josh Admin Template--}}
        @show
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>


    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon2.ico') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <script src="{{ asset('assets/js/buttons.print.js') }}"></script>

    <![endif]-->
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- global css -->
    <link href="{{ asset('assets/css/app.css') }}"  rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/persianDatepicker.css') }}">


    <!-- font Awesome -->

    <!-- end of global css -->
    <!--page level css-->
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
<!--end of page level css-->

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
                {{--                                @include('admin.layouts._messages')--}}
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
                            <a href="{{ URL::to('admin/users') }}/{{Sentinel::getUser()->id}}">
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

<!-- global js -->
<script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/manual.js') }}"></script>

<!-- end of global js -->
<!-- begin page level js -->
<script>

    //$(document).ready(function() {
    //    $('#back-to-top').on('hover', function () {
    //        $('.tooltip').addClass('display');
    //    });
    //});
</script>
<script src="{{ asset('assets/js/persianDatepicker.js') }}"></script>
<script type="text/javascript">
    $("#dateAsguest, #dateAsguest2").persianDatepicker({
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
