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
    public function login(Request $request)
    {
        //some logic should go here
        //perform data validation on the incoming request
        $this->validate($request, array(
            'email'=>'required|email',
            'password'=>'required'
        ));
        //login the staff and show them their dashboard upon successful login
        if(Auth::guard('staff')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember))
        {
            return redirect()->intended(route('staff.dashboard'));
        }
        else
        {
            //if the login attempt failed
            $request->session()->flash('error','Invalid email or password');
            return redirect()->back()->withInput($request->only('email','remember'));
        }
    }
    //logout the staff and return them back to their login page
    public function logout()
    {
        Auth::guard('staff')->logout();
        return redirect()->route('staff.login');
    }
}
