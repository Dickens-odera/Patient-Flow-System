<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    }

}
