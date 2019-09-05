<?php

namespace App\Http\Controllers\Nurses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
class NursesController extends Controller
{
    //authentication guard
    public function __construct()
    {
        $this->middleware('auth:nurse');
    }
    public function index()
    {
        //show the dashboard
        return view('nurses.dashboard');
    }
}
