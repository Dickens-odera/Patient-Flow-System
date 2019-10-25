<?php

namespace App\Http\Controllers\Doctors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patients;
use App\Bookings;
use App\Doctors;
use Image;
use Auth;
use App\Emergencies;
use App\Accidents;
use App\Maternity;
use App\FirstAid;
use App\NurseAccidentResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
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
    //show the doctor their profile
    public function profile(Request $request, $doctor_id = null)
    {
        $doctor_id = $request->id;
        if(!$doctor_id)
        {
            $request->session()->flash('error','Invalid request format');
            return redirect()->intended(route('doctor.dashboard'));
        }
        else
        {
            $this->validate($request,['id'=>'required']);
            $doctor = Doctors::where('name','=',Auth::user()->name)->where('id','=',$doctor_id)->first();
            if(!$doctor)
            {
                $request->session()->flash('error','No doctor with that particular id found');
                return  redirect()->intended(route('doctor.dashboard'));
            }
            else
            {
                return view('doctor.profile.index', compact('doctor'));
            }
        }
    }
    //update the doctor's profile
    public function updateProfile(Request $request, $doctor_id = null)
    {
        $doctor_id = $request->id;
        if(!$doctor_id)
        {
            $request->session()->flash('error','Invalid request format');
            return redirect()->back();
        }
        else
        {
            $this->validate($request,['id','required']);
            $doctor = Doctors::where('id','=',Auth::user()->id)->where('name','=',Auth::user()->name)->first();
            if(!$doctor)
            {
                $request->session()->flash('error','The requested doctor not found');
                return redirect()->back();
            }
            else
            {
                $validator = Validator::make($request->all(),
                [
                    'name'=>'required',
                    'email'=>'required|email',
                    'phone'=>'required|phone',
                    'avartar'=>'image|mimes:jpg,png|max:2048|nullable'
                ]);
                if($validator->fails())
                {
                    $request->session()->flash('error',$validator->errors());
                    return redirect()->back();
                }
                else
                {
                    if($request->file('avartar'))
                    {
                        $doctor_photo = $request->file('avartar');
                        $file_ext = $doctor_photo->getClientOriginalExtension();
                        $file_name_to_save = "Dr ".$request->name.".".$file_ext;
                        $path_to_file = public_path('uploads/images/doctors/'.$file_name_to_save);
                        Image::make($doctor_photo->getRealPath())->resize(200, null, function($constraint)
                        {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->save($path_to_file);
                    }
                    if($doctor->update(['name'=>$request->name, 'email'=>$request->email,'phone'=>$request->phone,'avartar'=>$file_name_to_save]))
                    {
                        $request->session()->flash('success','Profile updated successfully');
                        return redirect()->back();
                    }
                    else
                    {
                        $request->session()->flash('error','Failed to update your profile, try again');
                        return redirect()->back();
                    }
                }
            }
        }
    }
    //list the patient bookings
    public function viewAllBookings(Request $request)
    {
        $patient_bookings = Bookings::where('doctor',Auth::user()->name)->latest()->paginate(10);
        if(!$patient_bookings)
        {
            $request->session()->flash('error','No patient bookings yet');
            return redirect()->back();
        }
        else
        {
            return view('doctor.patients.bookings.index', compact('patient_bookings'));
        }
    }
    //view the details of a single patient booking
    public function viewPatientBookingDetail(Request $request,  $booking_id=null)
    {
        $booking_id = $request->id;
        if(!$booking_id)
        {
            $request->session()->flash('error','Inavlid request format');
            return redirect()->back();
        }
        else
        {
            $validator = Validator::make($request->all(),['id'=>'required']);
            if($validator->fails())
            {
                $request->session()->flash('error',$validator->errors());
            }
            else
            {
                $booking = Bookings::where('id',$booking_id)->first();
                return view('doctor.patients.bookings.detail', compact('booking'));
            }
        }
    }
    //approve booking
    public function approveAppointmentBooking(Request $request, $booking_id=null)
    {
        $booking_id = $request->id;
        if(!$booking_id)
        {
            $request->session()->flash('error','Invalid request');
            return redirect()->back();
        }
        else
        {
            //$this->validate($request,['id'=>'required']);
            $validator = Validator::make($request->all(),['id'=>'required']);
            if($validator->fails())
            {
                $request->session()->flash('error',$validator->errors());
                return redirect()->back();
            }
            else
            {
                $booking = Bookings::where('id',$booking_id)->first();
                //check the status of the booking item
                $status = $booking->status;
                if($status === 'approved')
                {
                    $request->session()->flash('error','You had already approved this booking item');
                    return redirect()->to(route('doctor.patient.bookings.request'));
                }
                elseif($status === 'cancelled')
                {
                    $request->session()->flash('error','The patient had cancelled this request');
                    return redirect()->to(route('doctor.patient.bookings.request'));
                }
                else
                {
                    if($booking->update(['status'=>'approved']))
                    {
                        //alert the patient with an sms message
                        $patient = Bookings::where('id','=',$booking_id)->first()->pluck('patient');
                        $doctor = Bookings::where('id','=',$booking_id)->first()->pluck('doctor');
                        $url = "http://localhost:8000/patients/doctor/bookings/approved";
                        $recipient_phone = Patients::where('name','=',$patient)->first()->pluck('phone');
                        $message = "Dear ".$patient.","."your appointment request to see Dr".$doctor." has been successfully approved, kindly check your portal at".$url."for more information";
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
                        $request->session()->flash('success','Patient appointment approved successfully');
                        return redirect()->to(route('doctor.patient.bookings.request'));
                    }
                    else
                    {
                        $request->session()->flash('error','Failed to approve the appointment status, try again');
                        return redirect()->back()->withInput($request->only('patient','doctor','nurse','department','comment','date','time','status'));
                    }
                }
            }
        }
    }
    //show all the approved appointments
    public function showAllApprovedBookings()
    {
        $approved_bookings = Bookings::where('status','approved')->where('doctor',Auth::user()->name)->latest()->paginate(10);
        return view('doctor.patients.bookings.approved',compact('approved_bookings'));
    }
    /************************** EMERGENCIES ******************/
    //ACCIDENTS
    public function listAllAccidentsFromNurse(request $request)
    {
        $reported_accidents = NurseAccidentResponse::where('doctor','=',Auth::user()->name)->get();
        if(!$reported_accidents)
        {
            $request->session()->flash('error','No accident data found');
            return redirect()->back();
        }
        else
        {
            return view('doctor.emergencies.accidents.index',compact('reported_accidents'));
        }
    }
    //single accident detail
    public function viewAccidentDetail(Request $request, $accident_rep_id = null)
    {
        $accident_rep_id = $request->id;
        if(!$accident_rep_id)
        {
            $request->session()->flash('error','Inavalid request format');
            return redirect()->back();
        }
        else
        {
            $this->validate($request, ['id'=>'required']);
            $accident = NurseAccidentResponse::where('id','=',$accident_rep_id)->where('doctor','=',Auth::user()->name)->get();
            if(!$accident)
            {
                $request->session()->flash('error','No accident information found, try again');
                return redirect()->back();
            }
            else
            {
                return view('doctor.emergencies.accidents.detail',compact('accident'));
            }
        }   
    }
    //delete a single accident record
    public function removeAccidentDetail(Request $request, $accident_id = null)
    {
        $accident_id = $request->id;
        if(!$accident_id)
        {
            $request->session()->flash('error','Invalid request format');
            return redirect()->back();
        }
        else
        {
            $this->validate($request,['id'=>'required']);
            $accident = NurseAccidentResponse::where('id','=',$accident_id)->first();
            if(!$accident)
            {
                $request->session()->flash('error','Accident information not found');
                return redirect()->back();
            }
            else
            {
                if($accident->delete())
                {
                    $request->session()->flash('success','The accident information has been successfully deleted');
                    return redirect()->to(route('doctor.emergencies.accidents'));
                }
            }
        }   
    }
    /************************** END EMERGENCIES *******************/
}

