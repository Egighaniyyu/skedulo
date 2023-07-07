<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo(){
        if( Auth()->user()->role == 'admin'){
            return route('dashboards.index');
        }
        elseif( Auth()->user()->role == 'guru'){
            return route('dashboard.index');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request,[
            'login'=>'required',
            'password'=>'required'
        ]);

        // login with email or username
        $login = request()->input('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nama';
        request()->merge([$field => $login]);
        if (auth()->attempt(array($field => $input['login'], 'password' => $input['password'])))
        {
            if( auth()->user()->role == 'admin' ){
                return redirect()->route('dashboards.index');
            }
            elseif( auth()->user()->role == 'guru' ){
                return redirect()->route('dashboard.index');
            }
        }
        else{
            return redirect()->route('login');
        }
    }
}