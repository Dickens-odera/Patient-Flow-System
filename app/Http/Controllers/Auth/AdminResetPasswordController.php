<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Password;
use Auth;
class AdminResetPasswordController extends Controller
{
    use ResetsPasswords;
    //the redirect url
    protected $redirectTo = '/dashboard';
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }
    protected function broker()
    {
        return Password::broker('admins');
    }
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.admin.reset')->with(['token'=>$token,'email'=>$request->email]);
    }
    public function reset(Request $request)
    {
        
    }

}
