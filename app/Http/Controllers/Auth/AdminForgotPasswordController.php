<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;
class AdminForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    protected function broker()
    {
        return Password::broker('admins');
    }
    public function showLinkRequestForm()
    {
        return view('auth.passwords.admin.email');
    }
    public function sendResetLinkEmail(Request $request)
    {
        
    }
}
