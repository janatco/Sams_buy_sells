<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginCUstom(Request $request){
        //return view('auth.login',compact('items'));


        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = [ 'email' => $request->email , 'password' => $request->password];

        if($this->validUser($credentials)){

            /// check the user type and status first
           // dd(Auth::user()->status);
            if(Auth::user()->status)
            switch (Auth::user()->status){
                 case 'PENDING':
                    return view('auth.verify');
                     //return redirect(route('email/verify'));
                 case 'BLOCK':
                     session()->flush();
                     Auth::logout();
                     return view('auth.blocked');
             }
 
         

       

        dd("Custom Login");
        }

        dd("Invalid Login");


    }

    public function validUserCustom($credential){
        $user = User::where('email',$credential['email'])
        ->first();
        if($user && Hash::check($credential['password'],$user->password)){
            Auth::login($user);
            return true;
        }
        return false;

    }
}
