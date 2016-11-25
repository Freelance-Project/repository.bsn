<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (\Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            if(\Auth::user()->type == 'admin'){
                \Session::put('admin', [
                    'user' => \Auth::user(),
                    'role' => \Auth::user()->roles()->first(),
                ]);                
            } else {

                $arrType = ['member'];
                $failAccess = false;
                $is_ = 'member'; 

                $failAccess = false;
                
                if ( $failAccess ) {                   
                    $this->logout();
                    $this->incrementLoginAttempts($request);
                    return $this->sendFailedLoginResponse($request);
                }

            }
            // dd('aa');
            return $this->handleUserWasAuthenticated($request, $throttles);
        }
        // dd('aaaaa');
        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, \Auth::guard($this->getGuard())->user());
            
        }
        
        $getSession = \Session::get('activity_session');
        
        return redirect('/home');
    }   

    public function logout()
    {
        
        \Auth::guard($this->getGuard())->logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/login');
    }
}
