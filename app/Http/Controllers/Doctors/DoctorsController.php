<?php

namespace App\Http\Controllers\Doctors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patients;
use App\Bookings;
use Auth;
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
    //list the patient bookings
    public function viewAllBookings()
    {
        $patient_bookings = Bookings::where('doctor',Auth::user()->name)->latest()->paginate(10);
        return view('doctor.patients.bookings.index', compact('patient_bookings'));
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
                        //alert the patient in future implementations of this project
                        $request->session()->flash('success','Patient appointment approved successfully');
                        return redirect()->to(route('doctor.patient.bookings.request'));
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
}
