<?php
include_once 'web_builder.php';
use App\User;
use App\Reg;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::pattern('slug', '[a-z0-9- _]+');

Route::group(['prefix' => 'admin', 'namespace'=>'Admin'], function () {

    # Error pages should be shown without requiring login
    Route::get('404', function () {
        return view('admin/404');
    });
    Route::get('500', function () {
        return view('admin/500');
    });
    # Lock screen
    Route::get('{id}/lockscreen', 'UsersController@lockscreen')->name('lockscreen');
    Route::post('{id}/lockscreen', 'UsersController@postLockscreen')->name('lockscreen');
    # All basic routes defined here
    Route::get('login', 'AuthController@getSignin')->name('login');
    Route::get('signin', 'AuthController@getSignin')->name('signin');
    Route::post('signin', 'AuthController@postSignin')->name('postSignin');
    Route::post('signup', 'AuthController@postSignup')->name('admin.signup');
    Route::post('forgot-password', 'AuthController@postForgotPassword')->name('forgot-password');
    Route::get('login2', function () {
        return view('admin/login2');
    });

    Route::post('reg', 'AuthController@reg')->name('reg');

    # Register2
    Route::get('register2', function () {
        return view('admin/register2');
    });
    Route::post('register2', 'AuthController@postRegister2')->name('register2');

    # Forgot Password Confirmation
    Route::get('forgot-password/{userId}/{passwordResetCode}', 'AuthController@getForgotPasswordConfirm')->name('forgot-password-confirm');
    Route::post('forgot-password/{userId}/{passwordResetCode}', 'AuthController@getForgotPasswordConfirm');

    # Logout
    Route::get('logout', 'AuthController@getLogout')->name('logout');

    # Account Activation
    Route::get('activate/{userId}/{activationCode}', 'AuthController@getActivate')->name('activate');
});


Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function () {
    # GUI Crud Generator
    Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('generator_builder');
    Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');
    Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');
    // Model checking
    Route::post('modelCheck', 'ModelcheckController@modelCheck');

    # Dashboard / Index
    Route::get('/', 'JoshController@showHome')->name('dashboard');

    # crop demo
    Route::post('crop_demo', 'JoshController@crop_demo')->name('crop_demo');

    # Activity log
    Route::get('activity_log/data', 'JoshController@activityLogData')->name('activity_log.data');

    // Manual routes
    Route::get('add_supplier', 'SupplierController@addSupplier')->name('add_supplier');
    Route::post('post_supplier', 'SupplierController@postSupplier')->name('post_supplier');
    Route::get('list_suppliers', 'SupplierController@listSuppliers')->name('list_suppliers');
    Route::get('edit_supplier/{id}', 'SupplierController@editSupplier')->name('edit_supplier');
    Route::post('post_edit_supplier/{id}', 'SupplierController@postEditSupplier')->name('post_edit_supplier');
    Route::post('delete_supplier', 'SupplierController@deleteSupplier')->name('delete_supplier');
    Route::get('pay_debt', 'SupplierController@payDebt')->name('pay_debt');
    Route::post('debtR', 'SupplierController@debtRemain')->name('debtR');
    Route::post('post_pay_debt', 'SupplierController@postPayDebt')->name('post_pay_debt');
    Route::get('list_supplier_ledger/{id}', 'SupplierController@listSupplierLedger')->name('list_supplier_ledger');

    Route::get('add_raw_material', 'RawMaterialController@addRawMaterial')->name('add_raw_material');
    Route::post('post_raw_material', 'RawMaterialController@postRawMaterial')->name('post_raw_material');
    Route::get('list_raw_materials', 'RawMaterialController@listRawMaterials')->name('list_raw_material');
    Route::get('edit_raw_material/{id}', 'RawMaterialController@editRawMaterial')->name('edit_raw_material');
    Route::post('post_edit_raw_material/{id}', 'RawMaterialController@postEditRawMaterial')->name('post_edit_raw_material');
    Route::post('delete_raw_material', 'RawMaterialController@deleteRawMaterial')->name('delete_raw_material');
    Route::get('use_raw_material/{id}', 'RawMaterialController@useRawMaterial')->name('use_raw_material');
    Route::post('post_use_raw_material/{id}', 'RawMaterialController@postUseRawMaterial')->name('post_use_raw_material');
    Route::get('list_use_raw_material/{id}', 'RawMaterialController@listUseRawMaterial')->name('list_use_raw_material');
    Route::get('buy_raw_material', 'RawMaterialController@buyRawMaterial')->name('buy_raw_material');
    Route::post('post_buy_raw_material', 'RawMaterialController@postBuyRawMaterial')->name('post_buy_raw_material');
    Route::get('list_supplier_invoices', 'RawMaterialController@listSupplierInvoices')->name('list_supplier_invoices');
    Route::get('supplier_invoice_detail/{id}', 'RawMaterialController@supplierInvoiceDetail')->name('supplier_invoice_detail');


    Route::get('add_customer', 'CustomerController@addCustomer')->name('add_customer');
    Route::post('post_customer', 'CustomerController@postCustomer')->name('post_customer');
    Route::get('list_customers', 'CustomerController@listCustomers')->name('list_customers');
    Route::get('edit_customer/{id}', 'CustomerController@editCustomer')->name('edit_customer');
    Route::post('post_edit_customer/{id}', 'CustomerController@postEditCustomer')->name('post_edit_customer');
    Route::post('delete_customer', 'CustomerController@deleteCustomer')->name('delete_customer');
    Route::get('list_customer_ledger/{id}', 'CustomerController@listCustomerLedger')->name('list_customer_ledger');
    Route::get('receive_debt', 'CustomerController@receiveDebt')->name('receive_debt');
    Route::post('debtC', 'CustomerController@debtRemain')->name('debtC');
    Route::post('post_receive_debt', 'CustomerController@postReceiveDebt')->name('post_receive_debt');


    Route::get('add_product', 'ProductController@addProduct')->name('add_product');
    Route::post('post_product', 'ProductController@postProduct')->name('post_product');
    Route::get('list_products', 'ProductController@listProducts')->name('list_product');
    Route::get('edit_product/{id}', 'ProductController@editProduct')->name('edit_product');
    Route::post('post_edit_product/{id}', 'ProductController@postEditProduct')->name('post_edit_product');
    Route::post('delete_product', 'ProductController@deleteProduct')->name('delete_product');
    Route::get('add_quantity_product/{id}', 'ProductController@addQuantityProduct')->name('add_quantity_product');
    Route::post('post_quantity_product/{id}', 'ProductController@postQuantityProduct')->name('post_quantity_product');
    Route::get('list_quantity_product/{id}', 'ProductController@listQuantityProduct')->name('list_quantity_product');
    Route::get('sale_product', 'ProductController@saleProduct')->name('sale_product');
    Route::post('post_sale_product', 'ProductController@postSaleProduct')->name('post_sale_product');
    Route::get('list_customer_invoices', 'ProductController@listCustomerInvoices')->name('list_customer_invoices');
    Route::get('customer_invoice_detail/{id}', 'ProductController@customerInvoiceDetail')->name('customer_invoice_detail');
//    Route::get('customer_invoice_return/{id}', 'ProductController@customerInvoiceReturn')->name('customer_invoice_return');
    Route::post('customer_invoice_return', 'ProductController@customerInvoiceReturn')->name('customer_invoice_return');

    Route::get('list_partners', 'WithdrawController@listPartners')->name('list_partners');
    Route::get('add_partner', 'WithdrawController@addPartner')->name('add_partner');
    Route::post('post_partner', 'WithdrawController@postPartner')->name('post_partner');
    Route::get('edit_partner/{id}', 'WithdrawController@editPartner')->name('edit_partner');
    Route::post('post_edit_partner/{id}', 'WithdrawController@postEditPartner')->name('post_edit_partner');
    Route::post('delete_partner', 'WithdrawController@deletePartner')->name('delete_partner');
    Route::post('active_partner', 'WithdrawController@activePartner')->name('active_partner');
    Route::get('withdraw_amount', 'WithdrawController@withdrawAmount')->name('withdraw_amount');
    Route::post('post_withdraw', 'WithdrawController@postWithdraw')->name('post_withdraw');
    Route::get('list_partner_withdraws/{id}', 'WithdrawController@listPartnerWithdraws')->name('list_partner_withdraws');

    Route::get('sale_producttt', function (){
        return view('factory.product.sale_producttt');
    });


    //end manual Routes

    // javid route

    Route::get('add_employee', 'EmployeeController@AddEmployee')->name('add_employee');
    Route::post('add_post_employee', 'EmployeeController@AddPostEmployee')->name('add_post_employee');
    Route::get('employee_list', 'EmployeeController@EmployeeList')->name('employee_list');
    Route::get('employee_list_data', 'EmployeeController@EmployeeListData')->name('employee_list_data');
    Route::get('attendance', 'EmployeeController@attendance')->name('attendance');
    Route::post('post_attendance_employee', 'EmployeeController@PostAttendanceEmployee')->name('post_attendance_employee');
    Route::post('editable_datatables/{id}/update', 'EmployeeController@update')->name('update');
    Route::get('editable_datatables/{id}/delete', 'EmployeeController@destroy')->name('editable_datatables.delete');
    Route::get('attendance_status_reports',   'EmployeeController@attendanceStatusReports')->name('attendance_status_reports');
    Route::get('attendance_report','EmployeeController@attendance_report')->name('attendance_report');


    // expense
    Route::get('expenses_type', 'ExpensesController@ExpensesType')->name('expenses_type');
    Route::get('add_expense_type', 'ExpensesController@addExpenseType')->name('add_expense_type');
    Route::post('save_expense_type', 'ExpensesController@saveExpenseType')->name('save_expense_type');
    Route::get('expense_type_list_data', 'ExpensesController@ExpensTypeListData')->name('expense_type_list_data');
    Route::post('expense_type_editable_datatables/{id}/update', 'ExpensesController@update')->name('update');
    Route::get('expense_type_editable_datatables/{id}/delete', 'ExpensesController@destroy')->name('editable_expense_type_editable_datatablesdatatables.delete');
    Route::get('new_expense', 'ExpensesController@NewExpense')->name('new_expense');
    Route::post('save_expense', 'ExpensesController@SaveExpense')->name('save_expense');
    Route::get('list_expenses', 'ExpensesController@ListExpenses')->name('list_expenses');
    // end expense


    // bank
    Route::get('banks', 'BankController@BanksList')->name('banks');
    Route::get('banks_list_data', 'BankController@BanksListData')->name('banks_list_data');
    Route::post('banks_list_editable_datatables/{id}/update', 'BankController@update')->name('update');
    Route::get('banks_list_editable_datatables/{id}/delete', 'BankController@destroy')->name('banks_list_editable_datatables.delete');
    Route::get('add_bank', 'BankController@AddBank')->name('add_bank');
    Route::post('save_bank', 'BankController@SaveBank')->name('save_bank');




    // investment
    Route::get('investment', 'InvestmentController@investment')->name('investment');
    Route::post('add_bank_investment_record', 'InvestmentController@AddBankInvestmentRecord')->name('add_bank_investment_record');
    Route::post('add_investment_record', 'InvestmentController@addInvestmentRecord')->name('add_investment_record');

    Route::get('edit_investment/{id}', 'InvestmentController@editInvestment')->name('edit_investment');
    Route::post('edit_investment_record/{id}', 'InvestmentController@editInvestmentRecord')->name('edit_investment_record');
    Route::get('add_investment', 'InvestmentController@addInvestment')->name('add_investment');
    // end investment


    Route::get('bank_investment', 'BankController@BankInvestment')->name('bank_investment');
    Route::get('edit_bank_investment/{id}', 'BankController@EditBankInvestment')->name('edit_bank_investment');
    Route::post('edit_bank_investment_record/{id}', 'BankController@EditBankInvestmentRecord')->name('edit_bank_investment_record');
    Route::get('remove_investment', 'InvestmentController@removeInvestment')->name('remove_investment');
    Route::post('remove_bank_investment_record', 'InvestmentController@RemoveBankInvestmentRecord')->name('remove_bank_investment_record');
    Route::post('remove_investment_record', 'InvestmentController@RemoveInvestmentRecord')->name('remove_investment_record');
    Route::get('remove_bank_investment', 'BankController@RemoveBankInvestment')->name('remove_bank_investment');
    Route::post('banknamedata', 'BankController@BankNameData')->name('banknamedata');
    Route::post('bankaccountdata', 'BankController@BankAccountData')->name('bankaccountdata');
    Route::get('details/{bankId}/', 'BankController@Details')->name('details');


    Route::get('advance',   'EmployeeController@advance')->name('advance');
    Route::get('add_advance',   'EmployeeController@addAdvance')->name('add_advance');
    Route::post('save_advance',   'EmployeeController@saveAdvance')->name('sav_advance');
    Route::get('advancedetails/{employeeId}/', 'EmployeeController@AdvanceDetails')->name('advancedetails');
    Route::get('over_time',   'EmployeeController@OverTime')->name('over_time');
    Route::get('overtimedetails/{employeeId}/', 'EmployeeController@OverTimeDetails')->name('overtimedetails');
    Route::get('add_over_time',   'EmployeeController@AddOverTime')->name('add_over_time');
    Route::post('save_over_time',   'EmployeeController@SaveOverTime')->name('save_over_time');
    Route::get('payment',   'EmployeeController@ListPayments')->name('payment');
    Route::get('salary_sheet_archive',   'EmployeeController@SalarySheetArchive')->name('salary_sheet_archive');
    Route::get('pay_salary/{id}', 'EmployeeController@PaySalary')->name('pay_salary');
    Route::post('post_pay_salary', 'EmployeeController@PostPaySalary')->name('post_pay_salary');
    Route::post('employee_currency_ajax',   'EmployeeController@EmployeeCurrencyAjax')->name('employee_currency_ajax');
    Route::get('salary_sheet_archive',   'EmployeeController@salarySheetArchive')->name('salary_sheet_archive');
    Route::get('attendance_status_reports',   'EmployeeController@attendanceStatusReports')->name('attendance_status_reports');

    // end route javid

});

Route::group(['prefix' => 'admin','namespace'=>'Admin', 'middleware' => 'admin', 'as' => 'admin.'], function () {

    # User Management
    Route::group([ 'prefix' => 'users'], function () {
        Route::get('data', 'UsersController@data')->name('users.data');
        Route::get('{user}/delete', 'UsersController@destroy')->name('users.delete');
        Route::get('{user}/confirm-delete', 'UsersController@getModalDelete')->name('users.confirm-delete');
        Route::get('{user}/restore', 'UsersController@getRestore')->name('restore.user');
//        Route::post('{user}/passwordreset', 'UsersController@passwordreset')->name('passwordreset');
        Route::post('passwordreset', 'UsersController@passwordreset')->name('passwordreset');

    });
    Route::resource('users', 'UsersController');

    Route::get('deleted_users',['before' => 'Sentinel', 'uses' => 'UsersController@getDeletedUsers'])->name('deleted_users');

    Route::get('crop_demo', function () {
        return redirect('admin/imagecropping');
    });

});

# Remaining pages will be called from below controller method
# in real world scenario, you may be required to define all routes manually

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('{name?}', 'JoshController@showView');
});

Route::get('/', ['as' => 'home', function () {
    return view('admin.login');
}]);
view()->composer('admin.login', function ($view) {
    $re = Reg::select('days','reg_code','updated_at')->get();
    $view->with('re', $re);
});
