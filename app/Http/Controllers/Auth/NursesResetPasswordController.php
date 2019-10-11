<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Password;
use Auth;
class NursesResetPasswordController extends Controller
{
    use ResetsPasswords;
    //the redirect url
    protected $redirectTo = '/dashboard';
}
