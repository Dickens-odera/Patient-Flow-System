<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class StaffController extends Controller
{
    //authentication guard
    public function __construct()
    {
        $this->middleware('auth:staff');
    }
    public function index()
    {
        //show the dashboard
        return view('staff.dashboard');
    }

}
