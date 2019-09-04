<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class StaffLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:staff',['except'=>['logout']]);
    }
    //show the login form to the staff
    public function showLoginForm()
    {
        return view('auth.staff-login');
    }
    //perform the login function
    public function login()
    {
        //some logic should go here
    }
    //logout the staff and return them back to their login page
    public function logout()
    {
        Auth::guard('staff')->logout();
        return redirect()->route('staf.login');
    }
}
