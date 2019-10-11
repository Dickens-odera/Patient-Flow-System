<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Password;
use Auth;
class DoctorsResetPasswordController extends Controller
{
    use ResetsPasswords;
    //the direct url once logged in
    protected $redirectTo = '/dashboard';

}
