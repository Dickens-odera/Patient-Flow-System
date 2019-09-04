<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class DoctorsLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:doctor',['except'=>['logout']]);
    }
    //show the login form to the doctor
    public function showLoginForm()
    {
        return view('auth.doctors-login');
    }
    //perform the login function
    public function login()
    {
        //some logic should go here
    }
    //a  function to logout the doctor and return them to the doctor's login page
    public function logout()
    {
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login');
    }
}
