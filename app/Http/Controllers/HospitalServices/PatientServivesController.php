<?php

namespace App\Http\Controllers\HospitalServices;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Patients;
use App\Nurse;
use App\Doctors;
use App\Emergencies;
use App\Accidents;
use App\Maternity;
use Image;
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
                //check if the patient alraedy has an account
                if(Auth::guard('patient')->check())
                {
                    $request->session()->flash('error','Yor already have an account, kindly login');
                    return redirect()->to(route('patient.login'));
                }
                else
                {
                    return redirect()->to(route('patient.register'));
                }
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
        $nurse = Nurse::latest()->get();
        return view('emergencies.create', compact('nurse'));
    }
    //submit the emrenecy request from the user
    public function submitPatientEmergencyRequest(Request $request)
    {
        $validator = Validator::make($request->all(),array(
            'patient_name'=>'required',
            'type'=>'required',
            'location'=>'required',
            'street'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'comments'=>'required'
        ));
        if($validator->fails())
        {
            $request->session()->flash('error',$validator->errors());
            return redirect()->back()->withInput($request->only('patient_name','type','location','street','address','phone','gender','coments'));
        }
        else
        {
            $emergency  = new Emergencies;
            $emergency->patient_name = $request->patient_name;
            $emergency->type = $request->type;
            $emergency->location = $request->location;
            $emergency->street = $request->street;
            $emergency->address = $request->address;
            $emergency->phone = $request->phone;
            $emergency->gender = $request->gender;
            $emergency->comments = $request->comments;
            if($emergency->save())
            {
                $request->session()->flash('success','Emergency request submitted, you shall get a response from the nurse shortly');
                return view('welcome');
                if($request->type === 'accident')
                {
                    //submit the accident request
                    $accident = New Accidents;
                    $accident->patient = $request->patient_name;
                    $accident->location = $request->location;
                    $accident->street = $request->street;
                    $accident->description = $request->comments;
                    $accident->save(); //send sms to nurse in the near future

                }
                elseif($request->type === 'maternity')
                {
                    $maternity_request = new Maternity;
                    $maternity_request->patient = $request->patient_name;
                    $maternity_request->location = $request->location;
                    $maternity_request->street = $request->street;
                    $maternity_request->description = $request->comments;
                    $maternity_request->save(); //send sms to nurse in the near future
                }
                else
                {
                    //first aid
                }
            }   
            else
            {
                $request->session()->flash('error','Server error, try again');
                return redirect()->back()->withInput($request->only('patient_name','type','location','street','address','phone','gender','coments'));
            }
        }
    }

    //show the form for the patient to register into the system
    public function showPatientRegistrationForm()
    {
        return view('auth.patient-registration-form');
    } 
    //register a new patient
    public function registerPatient(Request $request)
    {
        //perform data validation on the incoming request
        $this->validate($request,array(
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|phone|max:12|unique:patients',
            'avartar'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password'=>'required',
            'password_conf'=>'required'
        ));
        $new_patient = new Patients;
        $new_patient->name = $request->name;
        $new_patient->email = $request->email;
        $new_patient->phone = $request->phone;
        $pwd = $request->password;
        $conf_password = $request->password_conf;
        if($pwd !== $conf_password)
        {
            $request->session()->flash('error','Password mismatch');
            return redirect()->back()->withInput($request->only('name','email','phone','avartar'));
        }
        else
        {
            $new_patient->password = bcrypt($pwd);
        }
        //if there is an image uploaded
        if($request->file('avartar'))
        {
            $avartar = $request->file('avartar');
            $avartar_extension = $avartar->getClientOriginalExtension();
            $avartar_name = $request->name.".".$avartar_extension;
            $path = public_path('uploads/images/patients/'.$avartar_name);
            Image::make($avartar->getRealPath())->resize(250, 200, function($constraint)
            {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($path);
            $new_patient->avartar = $avartar_name;
        }
        if($new_patient->save())
        {
            $request->session()->flash('success','You have successfully been registered, use your email and password to login below');
            return redirect()->to(route('patient.login'));
        }
        else
        {
            $request->session()->flash('error','Failed to register, try again');
            return redirect()->back()->withInput($request->only('name','email','phone','avartar'));
        }
    }
    //enable the user(patient) to reuest for a nurse
    public function showPatientNurseRequestForm()
    {

    }  
}
