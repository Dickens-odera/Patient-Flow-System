<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Validator;
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
    public function login(Request $request)
    {
        //some logic should go here
        //perform validation on the incoming requests
        $this->validate($request, array(
            'email'=>'required|email',
            'password'=>'required'
        ));
        
        if(Auth::guard('doctor')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember))
        {
            return redirect()->intended(route('doctor.dashboard'));
        }
        else
        {
            return redirect()->back()->withInput($request->only('email','remember'));
        }
    }
    //a  function to logout the doctor and return them to the doctor's login page
    public function logout()
    {
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login');
    }
}
