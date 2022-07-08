<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Mail\DetectDevice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
    protected $redirectTo = '/home';

    protected function authenticated(Request $request, $password){
        Auth::logoutOtherDevices(request('password'));
//        $biodata = DB::table('masterbiodata')->where('nip', Auth::user()->nip)->first();
//        if($biodata !== null){
//            $mail = $biodata->emailpribadi;
//            if($mail !== null){
//                Mail::to($mail)->send(new DetectDevice($request));
//            }
//        }

//       Mail::to('admin@rurusteve.com')->send(new DetectDevice($request));
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

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
}
