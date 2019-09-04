<?php

namespace App\Http\Controllers\Patients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    }
}
