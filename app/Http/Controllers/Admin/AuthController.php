<?php namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\JoshController;
use App\Http\Requests\ConfirmPasswordRequest;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\UserRequest;
use App\Mail\ForgotPassword;
use App\Reg;
use App\SalaryPayment;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Mail;
use Reminder;
use Sentinel;
use stdClass;
use URL;
use Validator;
use View;
use Morilog\Jalali;
use Morilog\Jalali\CalendarUtils;

class AuthController extends JoshController
{
    /**
     * Account sign in.
     *
     * @return View
     */
    public function getSignin()
    {
        // Is the user logged in?
        if (Sentinel::check()) {
            return Redirect::route('admin.dashboard');
        }

        // Show the page
        return view('admin.login');
    }

    /**
     * Account sign in form processing.
     * @param Request $request
     * @return Redirect
     */
    public function postSignin(Request $request)
    {
        $currentDate=jdate();
        $currentMonth=jdate()->getMonth();
        $currentYear=jdate()->getYear();
        try {
            if ($user = Sentinel::authenticate($request->only(['email', 'password']), $request->get('remember-me', false))) {

                $emp = Employee::all();
                $IsSalaryPayment = DB::table('salary_payments')->where(DB::raw('MONTH(date)'), '=', $currentMonth)->where(DB::raw('YEAR(date)'), '=', $currentYear)->get();

                if($IsSalaryPayment->count() != 0){
                    $payment = DB::table('employees')
                        ->select('employees.employee_name','employees.position','salary_payments.*')
                        ->join('salary_payments','employees.employee_id','=','salary_payments.employee_id')
                        ->where(DB::raw('MONTH(salary_payments.date)'), '=', $currentMonth)->where(DB::raw('YEAR(salary_payments.date)'), '=', $currentYear)
                        ->get();
                    return Redirect::route("admin.dashboard")->with('success', trans('auth/message.signin.success'));
                }
                else{
                    $payment = DB::table('employees')
                        ->join('salary_payments','employees.employee_id','=','salary_payments.employee_id')
                        ->where(DB::raw('MONTH(salary_payments.date)'), '=', $currentMonth-1)->where(DB::raw('YEAR(salary_payments.date)'), '=', $currentYear)
                        ->get();
                    if($payment->count() != 0){
                        foreach ($payment as $i => $pay){

                            $salaryPayment = new SalaryPayment();
                            $salaryPayment->absence_quantity = 0;
                            $salaryPayment->over_time = 0;
                            $salaryPayment->advance = 0;
                            $totalAfterAbsent = number_format((($pay->salary / 30) * (30 - $pay->absence_quantity)), 0, '.', '');
                            $balance = $totalAfterAbsent + $pay->old_balance + $pay->over_time - $pay->advance - $pay->giving_amount;
                            $salaryPayment->old_balance = $balance;
                            $salaryPayment->giving_amount = 0;
                            $salaryPayment->employee_id = $pay->employee_id;
                            $salaryPayment->date = CalendarUtils::strftime('Y-m-d', strtotime($currentDate));
                            $salaryPayment->save();
                        }


                    }else{
                        foreach ($emp as $i => $e){
                            $salaryPayment = new SalaryPayment();
                            $salaryPayment->absence_quantity = 0;
                            $salaryPayment->over_time = 0;
                            $salaryPayment->advance = 0;
                            $salaryPayment->old_balance = $e->remaining_salary;
                            $salaryPayment->giving_amount = 0;
                            $salaryPayment->employee_id = $e->employee_id;
                            $salaryPayment->date = CalendarUtils::strftime('Y-m-d', strtotime($currentDate));
                            $salaryPayment->save();
                        }
                    }
                    return Redirect::route("admin.dashboard")->with('success', trans('auth/message.signin.success'));
                }

            }

            $this->messageBag->add('email', trans('auth/message.account_not_found'));

        } catch (NotActivatedException $e) {
            $this->messageBag->add('email', trans('auth/message.account_not_activated'));
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            $this->messageBag->add('email', trans('auth/message.account_suspended', compact('delay')));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * Account sign up form processing.
     *
     * @return Redirect
     */
    public function postSignup(UserRequest $request)
    {

        try {
            // Register the user
            $user = Sentinel::registerAndActivate([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'password' => $request->get('password'),
            ]);

            //add user to 'User' group
            $role = Sentinel::findRoleById(1);
            $role->users()->attach($user);


            // Log the user in
            $name = Sentinel::login($user, false);
            //Activity log

            activity($name->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('Registered');
            //activity log ends
            // Redirect to the home page with success menu
            return Redirect::route("admin./")->with('success', trans('auth/message.signup.success'));

        } catch (UserExistsException $e) {
            $this->messageBag->add('email', trans('auth/message.account_already_exists'));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * User account activation page.
     *
     * @param number $userId
     * @param string $activationCode
     * @return
     */
    public function getActivate($userId,$activationCode = null)
    {
        // Is user logged in?
        if (Sentinel::check()) {
            return Redirect::route('admin.dashboard');
        }

        $user = Sentinel::findById($userId);
        $activation = Activation::create($user);

        if (Activation::complete($user, $activation->code)) {
            // Activation was successful
            // Redirect to the login page
            return Redirect::route('signin')->with('success', trans('auth/message.activate.success'));
        } else {
            // Activation not found or not completed.
            $error = trans('auth/message.activate.error');
            return Redirect::route('signin')->with('error', $error);
        }

    }

    /**
     * Forgot password form processing page.
     * @param Request $request
     *
     * @return Redirect
     */
    public function postForgotPassword(ForgotRequest $request)
    {
        $data = new stdClass();

        try {
            // Get the user password recovery code
            $user = Sentinel::findByCredentials(['email' => $request->get('email')]);

            if (!$user) {
                return back()->with('error', trans('auth/message.account_email_not_found'));
            }
            $activation = Activation::completed($user);
            if(!$activation){
                return back()->with('error', trans('auth/message.account_not_activated'));
            }
            $reminder = Reminder::exists($user) ?: Reminder::create($user);
            // Data to be used on the email view

            $data->user_name = $user->first_name .' ' .$user->last_name;
            $data->forgotPasswordUrl = URL::route('forgot-password-confirm', [$user->id, $reminder->code]);

            // Send the activation code through email

            Mail::to($user->email)
                ->send(new ForgotPassword($data));

        } catch (UserNotFoundException $e) {
            // Even though the email was not found, we will pretend
            // we have sent the password reset code through email,
            // this is a security measure against hackers.
        }

        //  Redirect to the forgot password
        return back()->with('success', trans('auth/message.forgot-password.success'));
    }

    /**
     * Forgot Password Confirmation page.
     *
     * @param number $userId
     * @param  string $passwordResetCode
     * @return View
     */
    public function getForgotPasswordConfirm($userId,$passwordResetCode = null)
    {
        // Find the user using the password reset code
        if(!$user = Sentinel::findById($userId)) {
            // Redirect to the forgot password page
            return Redirect::route('forgot-password')->with('error', trans('auth/message.account_not_found'));
        }
        if($reminder = Reminder::exists($user)) {
            if($passwordResetCode == $reminder->code) {
                return view('admin.auth.forgot-password-confirm');
            } else{
                return 'code does not match';
            }
        } else {
            return 'does not exists';
        }

        // Show the page
        // return View('admin.auth.forgot-password-confirm');
    }

    /**
     * Forgot Password Confirmation form processing page.
     *
     * @param Request $request
     * @param number $userId
     * @param  string   $passwordResetCode
     * @return Redirect
     */
    public function postForgotPasswordConfirm(ConfirmPasswordRequest $request, $userId, $passwordResetCode = null)
    {

        // Find the user using the password reset code
        $user = Sentinel::findById($userId);
        if (!$reminder = Reminder::complete($user, $passwordResetCode, $request->get('password'))) {
            // Ooops.. something went wrong
            return Redirect::route('signin')->with('error', trans('auth/message.forgot-password-confirm.error'));
        }

        // Password successfully reseted
        return Redirect::route('signin')->with('success', trans('auth/message.forgot-password-confirm.success'));
    }

    /**
     * Logout page.
     *
     * @return Redirect
     */
    public function getLogout()
    {

        if (Sentinel::check()) {
            //Activity log
            $user = Sentinel::getuser();

            // Log the user out
            Sentinel::logout();
            // Redirect to the users page
            return redirect('/')->with('success', 'You have successfully logged out!');
        } else {

            // Redirect to the users page
            return redirect('admin/signin')->with('error', 'You must be login!');
        }
    }

    /**
     * Account sign up form processing for register2 page
     *
     * @param Request $request
     *
     * @return Redirect
     */
    public function postRegister2(UserRequest $request)
    {

        try {
            // Register the user
            $user = Sentinel::registerAndActivate(array(
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'password' => $request->get('password'),
            ));

            //add user to 'User' group
            $role = Sentinel::findRoleById(2);
            $role->users()->attach($user);

            // Log the user in
            Sentinel::login($user, false);

            // Redirect to the home page with success menu
            return Redirect::route("admin.dashboard")->with('success', trans('auth/message.signup.success'));

        } catch (UserExistsException $e) {
            $this->messageBag->add('email', trans('auth/message.account_already_exists'));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    public function reg(Request $request){
        $r = Reg::select('reg_code','days')->get();
//        echo

//        if($request["code"] == $r[0]->reg_code) {
        if(Hash::check($request["code"], $r[0]->reg_code)) {
            Reg::where('reg_id', '=', '1')->update([
                "days" => $r[0]->days
            ]);
            return Redirect::back()->with(['yesReg'=> 'سیستم موفقانه راجستر گردید، تشکر']);
        }

        else{
            return Redirect::back()->with(['noReg'=> 'کود درج شده اشتباه میباشد، دوباره کوشش نمایید!']);
        }
    }

}
