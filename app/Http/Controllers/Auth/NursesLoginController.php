<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class NursesLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:nurse');
    }
    //show the login form to the nurse
    public function showLoginForm()
    {
        return view('auth.nurses-login');
    }
    //perform the login function
    public function login()
    {
        //some logic should go here
    }
    //logout the nurse and redirect them back to the nurses login page
    public function logout()
    {
        Auth::guard('nurse')->logout();
        return redirect()->route('nurse.login');
    }
}
