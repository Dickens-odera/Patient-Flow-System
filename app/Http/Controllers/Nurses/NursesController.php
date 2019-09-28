<?php

namespace App\Http\Controllers\Nurses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Emergencies;
use App\Accidents;
use App\FirstAid;
use App\Maternity;
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
        return view('nurses.dashboard');
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
                $request->session()->flash('error','Unbale to find the requested maternity detail');
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
                $request->session()->flash('error','Fitst Aid request data not found');
                return redirect()->back();
            }
            else
            {
                return view('nurses.emergencies.first-aid.details', compact('first_aid_request'));
            }
        }
    }
    /**********************  End Emergencies ***********************************/
}
