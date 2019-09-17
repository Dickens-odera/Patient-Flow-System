<?php

namespace App\Http\Controllers\HospitalServices;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Patients;
class PatientServivesController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    //get the services requested for by the patient on the welcome page
    public function postPatientServiceRequest(Request $request, $service = null)
    {   
        $service = $request->service;
        if(!$service)
        {
            $request->session()->flash('error','Please select an action from the dropdown to continue');
        }
        $this->validate($request,['service'=>'required']);
        switch($service)
        {
            case 'dashboard':
                //check if the patient is logged in
                if(Auth::guard('patient')->check())
                {
                    return redirect()->to(route('patient.dashboard'));
                }
                else
                {
                    $request->session()->flash('error','Kindly login to proceeed to your dashboard');
                    return redirect()->to(route('patient.login'));
                }
            break;
            case 'login':
                return redirect()->to(route('patient.login'));
            break;
            case 'emergency':
                return redirect()->to(route('patient.emergency.request.form'));
            break;
            case 'register':
                return redirect()->to(route('patient.register'));
            break;
            case 'booking':
                //check if the patient is logged in or not
                if(!Auth::guard('patient')->check())
                {
                    $request->session()->flash('error','Kindly login in order to book an appointment with a doctor');
                    return redirect()->to(route('patient.login'));
                }
                else
                {
                    return redirect()->to(route('patient.doctor.booking'));
                }
            break;
            case 'nurse_request':
                return redirect()->to(route('patient.nurse.request.form'));
            break;
            default:
                return redirect()->back();
            break;
        }
    }
    //show the emergency form
    public function showPatientEmergecyForm()
    {
        //
    }
    //show the form for the patient to register into the system
    public function showPatientRegistrationForm()
    {
        //
    } 
    //enable the user(patient) to reuest for a nurse
    public function showPatientNurseRequestForm()
    {

    }  
}
