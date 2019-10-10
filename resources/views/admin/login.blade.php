<!DOCTYPE html>
<html  dir="rtl">

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- global level css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <!-- end of global level css -->
    <!-- page level css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/login.css') }}" />
    <link href="{{ asset('assets/vendors/iCheck/css/square/blue.css') }}" rel="stylesheet"/>
    <!-- end of page level css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/rtl_custom.css')}}">

    <style>
        @font-face {
            font-family: 'samim';
            src:url("{{ asset('assets/fonts/Samim.ttf') }}");
        }

        body,h1,h2,h3,h4,li,span,*{
            font-family: samim;
        }

        .help-block{
            text-align: left !important;
            direction: ltr !important;
        }


    </style>
</head>

<body onload="getBetweenDate();">
<div class="container">
    <div class="row vertical-offset-100">
        <!-- Notifications -->
        <div id="notific">
            @include('notifications')
        </div>

        @if(session('yesReg'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
                <strong >{{ session('yesReg') }}</strong>
            </div>
        @endif
        <div style="display: none">
            <div id="updated_at">{{ $re[0]->updated_at }}</div>
            <div id="days">{{ $re[0]->days }}</div>
            <div id="reg_code">{{ $re[0]->reg_code }}</div>
        </div>
        <!--Modal: modalConfirmDelete-->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sd modal-notify modal-danger">
                <!--Header-->
                <div class="modal-content text-center" >

                    <form class="text-center" action="{{ route('reg') }}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-header d-flex justify-content-center">
                            <h3 class="" style="color: #d9534f">سیستم اکسپایر شده است!</h3>
                            {{--<input type="hidden" name="customer_id" id="setVal">--}}
                        </div>
                        <!--Body-->
                        <div class="modal-body" style="text-align: right;">
                            <i class="fa fa-times fa-4x animated rotateIn" style="color:#f56954 "></i>
                            <span style="font-size: 18px"> سیستم اکسپایر گردیده است!</span><br>
                            <span style="font-size: 18px; margin-bottom:12px;"> لطفا کود را وارد نمایید:</span>


                            <div class="form-group" style="margin-top: 20px">
                                <input id="company" name="code" type="text" placeholder="کود را وارد نمایید." class="form-control" required>
                            </div>

                            @if(session('noReg'))
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
                                    <strong >{{ session('noReg') }}</strong>
                                </div>
                            @endif

                        </div>
                        <!--Footer-->
                        <div class="modal-footer flex-center">
                            <button type="submit" href="" class="btn btn-default">بلی</button>
                            {{--<a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">نخیر</a>--}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Modal: modalConfirmDelete-->



        <div class="col-sm-6 col-sm-offset-3  col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
            <div id="container_demo">
                <a class="hiddenanchor" id="toregister"></a>
                <a class="hiddenanchor" id="tologin"></a>
                <a class="hiddenanchor" id="toforgot"></a>
                <div id="wrapper">
                    <div id="login" class="animate form">
                        <form action="{{ route('signin') }}" autocomplete="on" method="post" role="form" id="login_form">
                            <h3 class="black_bg">
                                <span style="color: white; font-weight: bold">شرکت ابریشم ابراهیمی</span>
                                <br>ورود</h3>
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                <label style="margin-bottom:0px;" for="email" class="uname control-label">
                                    ایمیل آدرس
                                </label>
                                <input id="" name="email" type="email" placeholder="ایمیل آدرس" class="" style=" width: 86%;"
                                       value="{!! old('email') !!}"
                                />
                                <div class="col-sm-12">
                                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->first('password', 'has-error') }}">
                                <label style="margin-bottom:0px;" for="password" class="youpasswd">
                                    پسورد
                                </label>
                                <input id="" name="password" type="password" placeholder="پسورد را وارد نمایید" style=" width: 86%;"/>
                                <div class="col-sm-12">
                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>

                            <p class="login button">
                                <input type="submit" value="ورود" class="btn btn-success login" />
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- global js -->
<script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
<!--livicons-->
<script src="{{ asset('assets/js/raphael-min.js') }}"></script>
<script src="{{ asset('assets/js/livicons-1.4.min.js') }}"></script>
<script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/login.js') }}" type="text/javascript"></script>
<!-- end of global js -->
<script type="text/javascript">
    //    function getBetweenDate(){
    $(document).ready(function(){
        //const date1 = new Date('2019-09-10 08:04:06');
        // const date2 = new Date('2019-06-25 07:44:31');
        const days = $("div#days").text();
        const nowDate = new Date();
        const updatedDate = $("div#updated_at").text();
        const updateDate = new Date(updatedDate);
        const diffTime = Math.abs(nowDate.getTime() - updateDate.getTime());
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        if(diffDays > days) {

            $('#myModal').modal({
                backdrop: 'static',
                keyboard: false
            });

            var id = $(this).data('id');
            $('#myModal').data('id', id).modal('show');
        }
    });
</script>
</body>
</html>