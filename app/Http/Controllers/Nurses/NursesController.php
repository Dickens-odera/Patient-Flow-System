<?php

namespace App\Http\Controllers\Nurses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    }
}
