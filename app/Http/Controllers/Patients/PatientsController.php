<?php

namespace App\Http\Controllers\Patients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Doctors;
use App\Departments;
use App\Nurse;
use App\Bookings;
use App\Patients;
use Image;
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
    //show a form to enable the patient book a doctor
    public function showDrBookingForm(Request $request)
    {
        $doctors = Doctors::all();
        $departments = Departments::all();
        $nurses = Nurse::all();
        return view('patients.bookings.create', compact(['doctors','departments','nurses']));
    }
    //booking logic
    public function submitDrBookings(Request $request)
    {
        //validation rules
        $rules = array(
            'doctor'=>'required',
            'nurse'=>'required',
            'department'=>'required',
            'comment'=>'nullable',
            'date'=>'required|date',
            'time'=>'required'
        );
        //perform validation
        $validator = Validator::make($request->all(), $rules);
        //if the validation fails
        if($validator->fails())
        {
            $request->session()->flash('error',$validator->errors());
            return redirect()->back()->withInput($request->only('doctor','nurse','department','date','time'));
        }
        else
        {
            //create an instance of the bookigs
            $booking = new Bookings;
            //get the request data from the user input form
            $booking->patient = Auth::user()->name;
            $booking->doctor = $request->doctor;
            $booking->nurse = $request->nurse;
            $booking->department = $request->department;
            $booking->date = $request->date;
            $booking->comment = $request->comment;
            $booking->time = $request->time;
            //save the new booking item
            if($booking->save())
            {
                $doctor = Doctors::where('name',$request->doctor)->first();
                $message = "Dear ".$request->doctor." You have an appointment request from ".Auth::user()->name."Kindly click <a href='https://localhost/8000/doctors/patient/bookings/requests/'>here</a> for more details";
                
                $data = array(
                    'username'=>env('USERNAME'),
                    'api_key'=>env('APIKEY'),
                    'sender'=>env('SENDERID'),
                    'to'=>$doctor->phone,
                    'message'=>$message,
                    'msgtype'=>env('MSGTYPE'),
                    'dlr'=>ENV('DLR')
                );
                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_URL => env('URL'),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $data
                ));
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    $output = curl_exec($ch);
                    if(curl_errno($ch))
                    {
                        $output = curl_errno($ch);
                    }
                    curl_close($ch);
                $request->session()->flash('success','Booking made successfully, wait for doctor`s response');
                return redirect()->to(route('patient.dashboard'));
            }
            else
            {
                //if booking fails
                $request->session()->flash('error','Failed to perform your request, try again');
                return redirect()->back()->withInput($request->only('doctor','nurse','department','date','time'));
            }
        }
    }
    //view bookings history
    public function viewHistory(Request $request)
    {
        $bookings = Bookings::where('patient','=',Auth::user()->name)->latest()->paginate(5);
        if(!$bookings)
        {
            $request->session()->flash('error','No available bookings history');
            return redirect()->back();
        }
        else
        {
            return view('patients.bookings.history', compact('bookings'));
        }
    }
    //let a patient cancel a booking that is still pending
    public function cancelBooking(Request $request, $booking_id = null)
    {
        //get the id of the booking item
        $booking_id = $request->id;
        if(!$booking_id)
        {
            $request->session()->flash('error','Invalid request format');
            return redirect()->back();
        }
        else
        {
            //$this->validate($request, ['id'=>'required']);
            $validator = Validator::make($request->all(), ['id'=>'required']);
            if($validator->fails())
            {
                $request->session()->flash('error',$validator->errors());
                return redirect()->back();
            }
            $booking_item = Bookings::where('id', $booking_id)->first();
            //check the status of the booking is
            if($booking_item->status === 'approved')
            {
                $request->session()->flash('error','You cannot cancel an already approved booking item');
            }
            elseif($booking_item->status === 'pending')
            {
                //something else
                if(Bookings::where('id','=',$booking_id)->where('status','pending')->first()->update(['status'=>'cancelled']))
                {
                    $request->session()->flash('success','Booking cancelled successfuly');
                    return redirect()->back();
                }
                {
                    $request->session()->flash('error','Unable to cancel this booking,please try again');
                    return redirect()->back();
                }
            }
            else
            {
                $request->session()->flash('error','Action cannot be completed at this time');
            }
        }


    }
    //delete a booking item
    public function deleteBookingHistory(Request $request, $booking_id = null)
    {
        $booking_id = $request->id;
        if(!$booking_id)
        {
            $request->session()->flash('error','Invalid request format');
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
                //get the status of the booking
                $booking_value_item = Bookings::where('id', $booking_id)->first();
                $status = $booking_value_item->status;
                if($status === 'approved')
                {
                    $request->session()->flash('error','you cannot delete an alraedy approved booking request');
                    return redirect()->back();
                }
                else
                {
                    if($booking_value_item->delete())
                    {
                        $request->session()->flash('success','Booking item deleted successfully');
                        return redirect()->back();
                    }
                    else
                    {
                        $request->session()->flash('error','Unable to delete the booking item, try again');
                        return redirect()->back();
                    }
                }
            }
        }
    }
    //list all the approved bookings
    public function showAllApprovedBookings()
    {
        $approved_bookings = Bookings::where('patient','=',Auth::user()->name)->where('status','=','approved')->latest()->paginate(10);
        return view('patients.bookings.approved',compact('approved_bookings'));
    }
    //patient profile
    public function profile(Request $request)
    {
        $patient_id = $request->id;
        if(!$patient_id)
        {
            $request->session()->flash('error','Invalid request format');
        }
        else
        {
            $this->validate($request,['id'=>'required']);
            $patient_details = Patients::where('id',$patient_id)->first();
            return view('patients.profile.index',compact('patient_details'));
        }
    }
    //update patient profile
    public function updateProfile(Request $request, $patient_id = null)
    {
        //set validatio rules
        $rules = array(
            'name'=>'required',
            'email'=>'required|email',
            'avartar'=>'nullable|image|mimes:jpeg,jpg,png|max:2048'
        );   
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            $request->session()->flash('error',$validator->errors());
        }
        else
        {
            $patient_id = Auth::user()->id;
            if(!$patient_id)
            {
                $request->session()->flash('Invalid request format');
            }
            else
            {
                $patient = Patients::where('id',$patient_id)->first();
                $patient->name = $request->name;
                $patient->email = $request->email;
                if($request->file('avartar'))
                {
                    $passport_photo = $request->file('avartar');
                    $ext = $passport_photo->getClientOriginalExtension();
                    $passport_photo_name = time().str_random(40).".".$ext;
                    $path = public_path('uploads/images/patients/'.$passport_photo_name);
                    Image::make($passport_photo->getRealPath())->resize(250,200, function($constraint)
                    {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($path);
                    $patient->avartar = $passport_photo_name;
                }
                if($patient->save())
                {   
                    $request->session()->flash('success','Profile updated successfully');
                    return redirect()->back();
                }
                else
                {
                    $request->session()->flash('error','Failed to update profile, try again');
                    return redirect()->back()->withInput($request->only('name','email','avartar'));
                }
            }
        }
    }
    //get all the approved doctor bookings
    public function allApprovedDrPatientBookings(Request $request)
    {
        $approved_bookings = Bookings::where('patient','=',Auth::user()->name)->where('status','=','approved')->get();
        if(!$approved_bookings)
        {
            $request->session()->flash('error','No Approved Bookings yet');
            return redirect()->back();
        }
        else
        {
            $booking_count = count($approved_bookings);
            if($booking_count > 0)
            {
                return view('patients.sidebar',compact('booking_count'));
            }
            else
            {
                return false;
            }
        }
    }
}
