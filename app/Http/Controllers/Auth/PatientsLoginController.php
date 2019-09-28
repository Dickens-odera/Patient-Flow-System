<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class PatientsLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:patient',['except'=>['logout']]);
    }
    //show the login form to the patient
    public function showLoginForm()
    {
        return view('auth.patients-login');
    }
    //perform the login function
    public function login(Request $request)
    {
        //some logic should go here
        //validate the incoming requests
        $this->validate($request, array(
            'email'=>'required|email',
            'password'=>'required'
        ));
        //login the user
        if(Auth::guard('patient')->attempt(['email'=>$request->email,'password'=>$request->password], $request->remember))
        {
            //redirect the patient to their dashboard
            return redirect()->intended(route('patient.dashboard'));
        }   
        else
        {
            //if the login was not successful
            $request->session()->flash('error','Invalid email or password');
            return redirect()->back()->withInput($request->only('email','remember'));
        }
    }
    //logout the patient and return them back to their login page
    public function logout()
    {
        Auth::guard('patient')->logout();
        return redirect()->route('patient.login');
    }
}
