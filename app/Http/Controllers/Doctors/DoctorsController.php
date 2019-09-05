<?php

namespace App\Http\Controllers\Doctors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorsController extends Controller
{
    //the authentiaction guard
    public function __construct()
    {
        $this->middleware('auth:doctor');
    }
    public function index()
    {
        //show the dashboard
        return view('doctor.dashboard');
    }
}
