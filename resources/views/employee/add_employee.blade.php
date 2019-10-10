@extends('admin/layouts/default2')
@section('title')
    اضافه نمودن کارمند
@stop
@section('content')

    <section class="content-header">
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    <b>صفحه عمومی</b>
                </a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
          <div class="col-md-8 col-lg-offset-2">

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

              <div class="panel panel-primary">
                  <div class="panel-heading">
                      <h3 class="panel-title">
                          <i class="livicon"  data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                          اضافه نمودن کارمند جدید
                      </h3>
                              <span class="pull-right">
                                  <i class="glyphicon glyphicon-chevron-up clickable"></i>
                                  <i class="glyphicon glyphicon-remove removepanel clickable"></i>
                              </span>
                  </div>
                  <div class="panel-body">
                      <form class="form-horizontal basic1"  method="post" action="{{ route('admin.add_post_employee') }}">
                             {{ csrf_field() }}

                             <div class="form-group">
                                <label class="col-md-3 control-label" for="employee_name">اسم :</label>
                                <div class="col-md-9">
                                    <input id="employee_name" name="name" type="text" autoFocus required placeholder="اسم  را وارد نمایید." class="form-control"
                                      oninvalid="this.setCustomValidity('این بخش حتمی باید وارد شود!')"
                                       oninput="this.setCustomValidity('')"
                                    ></div>
                            </div>
                            <!-- Email input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="position">موقف وظیفوی :</label>
                                <div class="col-md-9">
                                    <input id="position" name="position" type="text" placeholder="موقف وظیفوی را وارد نمایید." class="form-control"></div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="employee_phone">شماره تماس :</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="employee_phone" name="employee_phone" placeholder="شماره تماس را وارد نمایید."></div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="employee_address">آدرس :</label>
                                <div class="col-md-9">
                                    <input type="text" id="employee_address" name="employee_address"  placeholder="آدرس را وارد نمایید." class="form-control"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="employe_salary">معاش :</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" required id="employe_salary" name="salary" placeholder="معاش را وارد نمایید."
                                    oninvalid="this.setCustomValidity('این بخش حتمی باید وارد شود!')"
                                     oninput="this.setCustomValidity('')"
                                    ></div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="employe_moreinformation">معلومات اضافی :</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" style="resize: none;" id="employe_moreinformation" name="more_info" placeholder="معلومات اضافی در مورد کارمند را وارد نمایید." rows="5"></textarea>
                                </div>
                            </div>

                              <div class="form-position">
                                  <div class="col-md-12 text-right">
                                      <button type="submit" class="btn btn-responsive btn-primary btn-sm left_btn">ثبت</button>
                                  </div>
                              </div>
                      </form>
                  </div>
              </div>

          </div>
        </div>

    </section>
@stop
