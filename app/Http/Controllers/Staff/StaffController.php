<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Staff;
use App\Patients;
use App\PharmacistCharge;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\DoctorAccidentResponse as DrAccResponse;
class StaffController extends Controller
{
    //authentication guard
    public function __construct()
    {
        $this->middleware('auth:staff');
    }
    public function index()
    {
        //show the dashboard
        return view('staff.dashboard');
    }
    //transactions section
    public function listAllPatientTransactions(Request $request)
    {
        $pharmacist = Staff::where('name','=',Auth::user()->name)->first()->pluck('name');
        //dd($pharmacist);
        $doctor_accident_res = DrAccResponse::where('pharmacist','=',$pharmacist)->latest()->paginate(10);
        //dd($doctor_accident_res);
        if(!$doctor_accident_res)
        {
            $request->session()->flash('error','Data Not Found');
            return redirect()->back();
        }
        else
        {
            return view('staff.doctor.response.accidents.index', compact('doctor_accident_res'));
        }
    }
    //view as ingle detail of the patient records
    public function ViewPatientTransactionDetail(Request $request, $res_id = null)
    {
        $res_id = $request->id;
        if(!$res_id)
        {
            $request->session()->flash('error','Invalid request format');
            return redirect()->back();
        }
        else
        {
            $this->validate($request,['id'=>'required']);
            $res = DrAccResponse::where('id','=',$res_id)->first();
            if(!$res)
            {
                $request->session()->flash('error','Response data not found');
                return redirect()->back();
            }
            else
            {
                return view('staff.doctor.response.accidents.detail', compact('res'));
            }
        }
    }
    //charge the patient
    public function chargePatient(Request $request, $res_id = null)
    {
        $res_id = $request->id;
        if(!$res_id)
        {
            $request->session()->flash('error','Invalid request format');
            return redirect()->back();
        }
        else
        {
            $validator = Validator::make($request->all(),array(
                'id'=>'required',
                'date'=>'required',
                'amount'=>'required',
                'comments'=>'nullable'
            ));
            if($validator->fails())
            {
                $request->session()->flash('error',$validator->errors());
                return redirect()->back();
            }
            else
            {
                $patient = DrAccResponse::where('id','=',$res_id)->first()->pluck('patient');
                //dd($patient[0]);
                if(!$patient)
                {
                    $request->session()->flash('error','Patient not found');
                    return redirect()->back();
                }
                $charge = new PharmacistCharge;
                $charge->date = $request->date;
                $amount = $request->amount;
                if($amount < 0)
                {
                    $request->session()->flash('error','The amount cannot be negative');
                    return redirect()->back();
                }
                $charge->amount = $amount;
                $charge->patient = $patient[0];
                $charge->comments = $request->comments;
                if($charge->save())
                {
                    //send sms to patient with the details of the payments
                    $paybill = 846830;
                    $message = "Dear ".$patient." You are required to pay an amount of ".$request->amount. "for the prescripion using the PAYBILL: ".$paybill;
                    $phone = Patients::where('name','=',$patient)->first()->pluck('phone');
                    if(!$phone)
                    {
                        $phone = 254797720327;
                    }
                    $postData = array(
                        'username'=>env('USERNAME'),
                        'api_key'=>env('APIKEY'),
                        'sender'=>env('SENDERID'),
                        'to'=>$phone,
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
                    $request->session()->flash('success','Success, the patient shall be notofied of the charges');
                    return redirect()->to(route('pharmacists.patient.transactions.all'));
                }
                else
                {
                    $request->session()->flash('error','Failed to perform action, try again');
                    return redirect()->back()->withInput($request->only('date','amount','comments'));
                }
            }
        }
    }
}
