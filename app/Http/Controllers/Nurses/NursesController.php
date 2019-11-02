<?php

namespace App\Http\Controllers\Nurses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Emergencies;
use App\Accidents;
use App\FirstAid;
use App\Maternity;
use App\Doctors;
use App\Nurse;
use App\Departments;
use App\Patients;
use App\NurseMatrenityResponse as MatResponse;
use App\NurseAccidentResponse as ResponseState;
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
        $accidents = DB::select(DB::raw("SELECT * FROM accidents ORDER BY id DESC LIMIT 10"));
        $maternity = DB::select(DB::raw("SELECT * FROM maternity_request ORDER BY id +0 DESC LIMIT 10"));
        $first_aid_requests = DB::select(DB::raw("SELECT * FROM first_aid_requests ORDER BY id +0 DESC LIMIT 10"));
        return view('nurses.dashboard', compact(['accidents','maternity','first_aid_requests']));
    }
    /********************** Emergencies ************************************/
    //view all accidents 
    public function viewAllReportedAccidents(Request $request)
    {
        //get all the emergency requests that are reported as accidents
        $accidents = Emergencies::where('type','=','accident')->latest()->paginate(10);
        if(!$accidents)
        {
            $request->session()->flash('error','No acciden data reported yet');
            return redirect()->back();
        }
        else
        {
            return view('nurses.emergencies.accidents.index', compact('accidents'));
        }
    }
    //view the details of a single accident item
    public function emergencyAccidentDetails(Request $request, $accident_id = null)
    {
        $accident_id = $request->id;
        if(!$accident_id)
        {
            $request->session()->flash('error','Invalid request format');
            return redirect()->back();
        }
        else
        {
            $this->validate($request, ['id'=>'required']);
            $accident = Emergencies::where('id','=',$accident_id)->first();
            if(!$accident)
            {
                $request->session()->flash('error','Unable to find the requested accident detail');
                return redirect()->back();
            }
            else
            {
                return view('nurses.emergencies.accidents.details', compact('accident'));
            }
        }
    }
    //view all the maternity requests
    public function viewAllReportedMaternity(Request $request)
    {
        $maternity = Emergencies::where('type','=','maternity')->latest()->paginate(10);
        if(!$maternity)
        {
            $request->session()->flash('error','Maternity data not found');
            return redirect()->back();
        }
        else
        {
            return view('nurses.emergencies.maternity.index', compact('maternity'));
        }
    }
    //displays all the details on a single maternity item
    public function emergencyMaternityDetail(Request $request, $maternity_id = null)
    {
        $maternity_id =$request->id;
        if(!$maternity_id)
        {
            $request->session()->flash('error','Invalid request format');
            return redirect()->back();
        }
        else
        {
            $this->validate($request, ['id'=>'required']);
            $maternity_detail = Emergencies::where('id','=',$maternity_id)->first();
            if(!$maternity_detail)
            {
                $request->session()->flash('error','Unable to find the requested maternity detail');
                return redirect()->back();
            }
            else
            {
                return view('nurses.emergencies.maternity.details', compact('maternity_detail'));
            }
        }
    }
    //view all the first aid requests
    public function viewAllReportedfirstAid(Request $request)
    {
        $first_aid_requets = Emergencies::where('type','=','first_aid')->latest()->paginate(10);
        if(!$first_aid_requets)
        {
            $request->session()->flash('error','First Aid Data not found');
            return redirect()->back();
        }
        else
        {
            return view('nurses.emergencies.first-aid.index', compact('first_aid_requets'));
        }
    }
    //show the details of a single first aid emergency request
    public function emergencyFirstAidDetail(Request $request, $first_aid_request_id = null)
    {
        $first_aid_request_id = $request->id;
        if(!$first_aid_request_id)
        {
            $request->session()->flash('error','Invalid request format');
            return redirect()->back();
        }
        else
        {
            $this->validate($request,['id'=>'required']);
            $first_aid_request = Emergencies::where('id','=',$first_aid_request_id)->first();
            if(!$first_aid_request)
            {
                $request->session()->flash('error','First Aid request data not found');
                return redirect()->back();
            }
            else
            {
                return view('nurses.emergencies.first-aid.details', compact('first_aid_request'));
            }
        }
    }
    /********************************* Emergency Responses ***********************/
    //accident responses
    public function emergencyAccidentResponse(Request $request,$accident_id = null)
    {
        $accident_id = $request->id;
        if(!$accident_id)
        {
            $request->session()->flash('error','Invalid Request Format');
            return redirect()->back();
        }
        else
        {
            $validator = Validator::make($request->all(),['id'=>'required']);
            if($validator->fails())
            {
                $request->session()->flash('error',$validator->errors());
                return redirect()->back();
            }
            else
            {
                $accident = Emergencies::where('id','=',$accident_id)->where('type','=','accident')->where('status','=','pending')->first();
                //$accident = Emergencies::where('id','=',$accident_id)->where('type','=','accident')->first();
                if(!$accident)
                {
                    $request->session()->flash('error','No Accident information found');
                    return redirect()->back();
                }
                else
                {
                    $patient = $accident->patient_name;
                    $patient_id = $accident->id;
                    if(!$patient)
                    {
                        $request->session()->flash('error','The patient could not be found');
                        return redirect()->back();
                    }
                    //dd($pat_id);
                    $doctors = Doctors::latest()->get();
                    return view('nurses.emergencies.accidents.response', compact(['patient','accident','doctors','patient_id']));
                }
            }
        }
    }
    //send the above response to the doctor
    public function sendAccidentResponse(Request $request, $accident_id = null)
    {
        $accident_id = $request->id;
        if(!$accident_id)
        {
            $request->session()->flash('error','No accident information found');
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),array(
            'id'=>'required',
            'patient'=>'required',
            'doctor'=>'required',
            'comments'=>'required',
            'accident_type'=>'required',
            'damage_type'=>'required'
        ));
        if($validator->fails())
        {
            $request->session()->flash('error',$validator->errors());
            return redirect()->back()->withInput($request->only('patient','doctor','comments','accident_type','damage_type'));
        }
        else
        {
            $response = new ResponseState;
            $response->patient = $request->patient;
            $nurse = Nurse::where('name','=',Auth::user()->name)->first();
            $response->nurse = $nurse->name;
            $doctor = $request->doctor;
            $response->doctor = $request->doctor;
            $response->comments = $request->comments;
            $response->accident_type = $request->accident_type;
            $response->damage_type = $request->damage_type;
            if($response->save())
            {
                Emergencies::where('id','=',$accident_id)->first()->update(['status'=>'complete']);
                //send sms to the doctor alerting them of the nurse response data
                
                $url = "http://localhost:8000/doctors/emergencies/accidents";
                $recipient_phone = Doctors::where('name','=',$doctor)->pluck('phone');
                //dd($recipient_phone);
                $message = "Dear ".$doctor." You have received a request from nurse".$nurse->name." to attend to the patient ".$request->patient." Kindly click ".$url." to check the emmergency state";
                $postData = array(
                    'username'=>env('USERNAME'),
                    'api_key'=>env('APIKEY'),
                    'sender'=>env('SENDERID'),
                    'to'=>$recipient_phone,
                    'message'=>$message,
                    'msgtype'=>env('MSGTYPE'),
                    'dlr'=>env('DLR')
                );
                    $ch = curl_init();
                    curl_setopt_array($ch, array(
                            CURLOPT_URL => env('URL'),
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_POST => true,
                            CURLOPT_POSTFIELDS => $postData
                        ));
                    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
                    $output = curl_exec($ch);
                    if(curl_errno($ch))
                        {
                            $output = curl_error($ch);
                        }
                        curl_close($ch);
                $request->session()->flash('success','Accident successfully reported to Doctor '.$request->doctor);
                return redirect()->to(route('nurse.emergencies.accidents.all'));
            }
        }
    }
    //maternity responses
    public function emergencyMaternityResponse(Request $request, $maternity_res_id = null)
    {
        $maternity_res_id = $request->id;
        if(!$maternity_res_id)
        {
            $request->session()->flash('error','Invalid request format');
            return redirect()->back();
        }
        else
        {
            $this->validate($request,['id'=>'required']);
            $maternity_res = Emergencies::where('id','=',$maternity_res_id)->where('type','=','maternity')->first();
            $status = $maternity_res->status;
            if($status === "complete")
            {
                $request->session()->flash('error','This recoed has already been responded to');
                return redirect()->back();
            }
            if(!$maternity_res)
            {
                $request->session()->flash('error','Matching maternity informtion not found');
                return redirect()->back();
            }
            else
            {
                $patient = $maternity_res->patient_name;
                $patient_id = $maternity_res->id;
                //dd($patient);
                if(!$patient)
                {
                    $request->session()->flash('error','Patient Not Found');
                    return redirect()->back();
                }
                else
                {
                    $doctors = Doctors::latest()->get();
                    //dd($doctors);
                    if(!$doctors)
                    {
                        $request->session()->flash('error','No doctors found');
                        return redirect()->back();
                    }
                    else
                    {
                        return view('nurses.emergencies.maternity.response',compact('doctors','patient','patient_id'));
                    }
                }
            }
        }
    }
    //send the maternity response data to the Dr.
    public function sendMaternityResponseToDr(Request $request, $maternity_res_id = null)
    {
        $maternity_res_id = $request->id;
        if(!$maternity_res_id)
        {
            $request->session()->flash('error','Invalid request format');
            return redirect()->back();
        }
        else
        {
            $validator = Validator::make($request->all(),array(
                'id'=>'required',
                'patient'=>'required',
                'doctor'=>'required',
                'comments'=>'nullable'
            ));
            if($validator->fails())
            {
                $request->session()->flash('error',$validator->errors());
                return redirect()->back();
            }
            else
            {
                $maternity_data_status = Emergencies::where('id','=',$maternity_res_id)->where('type','=','maternity')->first();
                $status = $maternity_data_status->status;
                //dd($status);
                if($status == 'complete')
                {
                    $request->session()->flash('error','This particular record has already been reported');
                    return redirect()->back();
                }
                $mat_res =  new MatResponse;
                $mat_res->patient = $request->patient;
                $nurse = Nurse::where('name','=',Auth::user()->name)->first();
                $doctor = $request->doctor;
                $mat_res->nurse = $nurse->name;
                $mat_res->doctor = $request->doctor;
                $mat_res->status = 'initiated';
                $mat_res->comments = $request->comments;
                if($mat_res->save())
                {
                    Emergencies::where('id','=',$maternity_res_id)->first()->update(['status'=>'complete']);
                    //send sms to the Doctor
                    $url = "http://localhost:8000/doctors/emergencies/maternity";
                    $recipient_phone = Doctors::where('name','=',$doctor)->pluck('phone');
                    //dd($recipient_phone);
                    $message = "Dear ".$doctor." You have received a request from nurse ".$nurse->name." to attend to the patient ".$request->patient." Kindly click ".$url." to check the emmergency state";
                    $postData = array(
                        'username'=>env('USERNAME'),
                        'api_key'=>env('APIKEY'),
                        'sender'=>env('SENDERID'),
                        'to'=>$recipient_phone,
                        'message'=>$message,
                        'msgtype'=>env('MSGTYPE'),
                        'dlr'=>env('DLR')
                    );
                        $ch = curl_init();
                        curl_setopt_array($ch, array(
                                CURLOPT_URL => env('URL'),
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_POST => true,
                                CURLOPT_POSTFIELDS => $postData
                            ));
                        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
                        $output = curl_exec($ch);
                        if(curl_errno($ch))
                            {
                                $output = curl_error($ch);
                            }
                            curl_close($ch);
                    $request->session()->flash('success','Maternity response successfully sent to Dr '.$request->doctor);
                    return redirect()->to(route('nurse.emergencies.maternity.response'));
                }
                else
                {
                    $request->session()->flash('error','Failed to send the maternity response to Dr '.$request->doctor.", try again");
                    return redirect()->back();
                }
            }
        }
    }
    /********************************* End of Emergency Responses Logic ********************/
    /**********************  End Emergencies ***********************************/
}
