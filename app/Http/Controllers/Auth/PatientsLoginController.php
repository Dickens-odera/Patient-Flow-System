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
    public function login()
    {
        //some logic should go here
    }
    //logout the patient and return them back to their login page
    public function logout()
    {
        Auth::guard('patient')->logout();
        return redirect()->route('patient.login');
    }
}
