<ul id="menu" class="page-sidebar-menu">

    <li {!! (Request::is('admin') ? 'class="active"' : '') !!}>
        <a href="{{ route('admin.dashboard') }}">
            <i class="livicon" data-name="dashboard" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">صفحه عمومی</span>
        </a>
    </li>
    <li {!! (Request::is('admin/add_supplier') || Request::is('admin/list_suppliers') || Request::is('admin/supplier_pay_debt') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="user" data-size="18" data-c="#F89A14" data-hc="#F89A14"
               data-loop="true"></i>
            <span class="title">تهیه کننده گان</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/add_supplier') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/add_supplier') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span> اضافه کردن</span>
                </a>
            </li>
            <li {!! (Request::is('admin/list_suppliers') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/list_suppliers') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>لیست تهیه کننده گان</span>
                </a>
            </li>
            <li {!! (Request::is('admin/pay_debt') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/pay_debt') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span> پرداخت قرض</span>
                </a>
            </li>
        </ul>
    </li>

    <li {!! (Request::is('admin/add_raw_material') || Request::is('admin/list_raw_materials') || Request::is('admin/buy_raw_material') || Request::is('admin/list_supplier_invoices') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="inbox-in" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">اکمالات</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/add_raw_material') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/add_raw_material') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>اضافه کردن</span>
                </a>
            </li>
            <li {!! (Request::is('admin/list_raw_materials') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/list_raw_materials') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>لیست مواد</span>
                </a>
            </li>
            <li {!! (Request::is('admin/buy_raw_material') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/buy_raw_material') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>خریداری مواد</span>
                </a>
            </li>
            <li {!! (Request::is('admin/list_supplier_invoices') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/list_supplier_invoices') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>لیست خرید ها</span>
                </a>
            </li>
        </ul>
    </li>

    <li {!! (Request::is('admin/add_customer') || Request::is('admin/list_customers') || Request::is('admin/receive_debt') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="users" data-size="18" data-c="#F89A14" data-hc="#F89A14"
               data-loop="true"></i>
            <span class="title">مشتریان</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/add_customer') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/add_customer') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>اضافه کردن</span>
                </a>
            </li>
            <li {!! (Request::is('admin/list_customers') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/list_customers') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>لیست مشتریان</span>
                </a>
            </li>
            <li {!! (Request::is('admin/receive_debt') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/receive_debt') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>اخذ قرض</span>
                </a>
            </li>
        </ul>
    </li>

    <li {!! (Request::is('admin/add_product') || Request::is('admin/list_products') || Request::is('admin/sale_product') || Request::is('admin/list_customer_invoices')? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="inbox-out" data-size="18" data-c="#67C5DF" data-hc="#67C5DF"
               data-loop="true"></i>
            <span class="title">تولیدات</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/add_product') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/add_product') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>اضافه کردن</span>
                </a>
            </li>
            <li {!! (Request::is('admin/list_products') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/list_products') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>لیست تولیدات</span>
                </a>
            </li>
            <li {!! (Request::is('admin/sale_product') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/sale_product') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>فروش</span>
                </a>
            </li>
            <li {!! (Request::is('admin/list_customer_invoices') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/list_customer_invoices') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>لیست فروشات</span>
                </a>
            </li>
        </ul>
    </li>

    <li {!! ( Request::is('admin/add_employee') || Request::is('admin/employee_list') || Request::is('admin/payment') || Request::is('admin/attendance') || Request::is('admin/attendance_status_reports') || Request::is('admin/advance') || Request::is('admin/over_time') ? 'class="active"' : '') !!}>


        <a href="#">
            <i class="livicon" data-name="users" title="Users" data-size="18" data-c="#418BCA" data-hc="#67C5DF"
               data-loop="true"></i>
            <span class="title">کارمندان</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">

            <li {!! (Request::is('admin/add_employee') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/add_employee') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>اضافه نمودن کارمند</span>
                </a>
            </li>

            <li {!! (Request::is('admin/employee_list') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/employee_list') }}" style="font-family:samim;">
                    <i class="fa fa-angle-double-right"></i>
                    <span>لیست کارمندان</span>
                </a>
            </li>

            <li {!! (Request::is('admin/attendance') ? 'class="active"' : '') !!}>
                <a  href="{{ URL::to('admin/attendance') }}" style="font-family:samim;">
                    <i class="fa fa-angle-double-right"></i>
                    <span>حاضری</span>
                </a>
            </li>
            <li {!! (Request::is('admin/attendance_status_reports') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/attendance_status_reports') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>  راپور حاضری</span>
                </a>
            </li>

            <li {!! (Request::is('admin/advance') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/advance') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span> پیش پرداخت</span>
                </a>
            </li>

            <li {!! (Request::is('admin/over_time') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/over_time') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>اضافه کاری</span>
                </a>
            </li>

            <li {!! (Request::is('admin/payment') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/payment') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span> معاشات</span>
                </a>
            </li>


        </ul>
    </li>

    <li {!! (Request::is('admin/expenses_type') || Request::is('admin/new_expense') || Request::is('admin/list_expenses') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="money" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
            <span class="title">مصارف</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/expenses_type') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/expenses_type') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>لیست انواع مصارف</span>
                </a>
            </li>
            <li {!! (Request::is('admin/new_expense') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/new_expense') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span> مصرف جدید</span>
                </a>
            </li>
            <li {!! (Request::is('admin/list_expenses') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/list_expenses') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span> راپور مصارف</span>
                </a>
            </li>
        </ul>
    </li>


    <li {!! (Request::is('admin/banks') || Request::is('admin/bank_investment')  ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="lock" data-size="18" data-c="#67C5DF" data-hc="#67C5DF" data-loop="true"></i>
            <span class="title">بانک</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/banks') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/banks') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>لیست بانک ها</span>
                </a>
            </li>
            <li {!! (Request::is('admin/bank_investment') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/bank_investment') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>سرمایه بانک</span>
                </a>
            </li>

        </ul>
    </li>

    <li {!! (Request::is('admin/list_partners') || Request::is('admin/withdraw_amount')  ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="inbox" data-size="18" data-c="#F89A14" data-hc="#F89A14" data-loop="true"></i>
            <span class="title">برداشت ها</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/list_partners') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/list_partners') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>شرکا</span>
                </a>
            </li>
            <li {!! (Request::is('admin/withdraw_amount') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/withdraw_amount') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span>برداشت</span>
                </a>
            </li>

        </ul>
    </li>

    <li {!! (Request::is('admin/investment') ? 'class="active"' : '') !!}>
        <a href="{{  URL::to('admin/investment') }}">
            <i class="livicon" data-name="money" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
          <span>سرمایه</span>
        </a>
    </li>
        <!-- Menus generated by CRUD generator -->
    @include('admin/layouts/menu')
</ul>