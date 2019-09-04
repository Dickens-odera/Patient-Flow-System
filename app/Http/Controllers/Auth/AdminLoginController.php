<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin',['except'=>['logout']]);
    }
    //show the login form to the admin
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }
    //perform the login function
    public function login(Request $request)
    {
        //perform validation on the incoming requests
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        //use the Auth facade to login the admin using the credentials
        //the attempt function automatically Hashes the password, so there is no need of hashing it gain
        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password]))
        { 
            //if successfully logged in, redirect to their intended page
            return redirect()->intended(route('admin.dashboard'));
        }
        else
        {
            //if login failed, redirect the user to their previous page, currently login page
            return redirect()->back()->withInput($request->only('email','remember'));
        }
    }
    //the logout function
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
