<?php

namespace App\Http\Controllers\Patients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
class PatientsController extends Controller
{
    //authentication guard
    public function __construct()
    {
        $this->middleware('auth:patient');
    }
    public function index()
    {
        //show the dashboard
        return view('patients.dashboard');
    }
}
