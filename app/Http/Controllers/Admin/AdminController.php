<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //declare the authnetication guard
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //the admin homepage
    public function index()
    {
        return view('admin.partials.index');
    }
}
