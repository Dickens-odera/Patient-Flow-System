<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Doctors;
use Image;
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
    //admin profile
    public function profile()
    {
        //show the administrator their profile
    }
    /**************************** DOCTORS SECTION OF THE ADMIN *************************/
    //show a list of all doctors
    public function viewAllDoctors()
    {
        $doctors = Doctors::latest()->paginate(10);
        return view('admin.doctor.index', compact('doctors'));
    }
    //show a form to enable the admin to add a new doctor
    public function showDoctorsForm()
    {
        return view('admin.doctor.create');
    }
    //add a new doctor
    public function addNewDoctor(Request $request)
    {
        //set the validation rules
        $rules = array(
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'confirm_password'=>'required',
            'phone'=>'required|phone|max:12|unique:doctors',
            'avartar'=>'nullable|mimes:jpeg,jpg,png|max:2048'
        );
        //perform data validation on the incoming requests
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            //if the validation rules are not met
            return redirect()->back()->with('error',$validator->errors());
        }
        else
        {
            //if the validation rules are met, proceed to add the new doctor
            $doctor = new Doctors;
            $doctor->name = $request->name;
            $doctor->email = $request->email;
            $pwd = $request->password;
            $confirm_pwd = $request->confirm_password;
            if($pwd !== $confirm_pwd)
            {
                //if the password and the confirmation pasword do not match
                return redirect()->back()->withInput($request->only('name','email','phone'))->with('error','Password mismatch, try again');
            }
            else
            {
                $doctor->password = bcrypt($request->password);
            }
            $doctor->phone = $request->phone;
            if($request->file('avartar'))
            {
                $avartar = $request->file('avartar');
                $ext = $avartar->getClientOriginalExtension();
                $avartar_name = "Dr.".$request->name.".".$ext;
                $path = public_path('uploads/images/doctors/'.$avartar_name);
                Image::make($avartar->getRealPath())->resize(250, null, function($constraint)
                {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($path);
                $doctor->avartar = $avartar_name;
            }
            if($doctor->save())
            {
                //if the new doctor was added successfully, send them their credentials via sms(in future) or email
                return redirect()->back()->with('success','The doctor has been added successfully');
            }
            else
            {
                //if the process of adding the new doctor failed
                return redirect()->back()->with('error','Failed to add the new doctor, try again');
            }
        }
    }
    //show the admin a form to edit a particular Dr's information
    public function showDrEditForm(Request $request, $id = null)
    {
        //get all the of the dr
        $id = $request->id;
        if(!$id)
        {
            //if the id is not provided
            return redirect()->back()->with('error','Invalid request');
        }
        else
        {
            $validator = Validator::make($request->all(), ['id'=>'required']);
            if($validator->fails())
            {
                return redirect()->back()->with('error',$validator->errors());
            }
            else
            {
                $doctor = Doctors::where('id', $id)->first();
                return view('admin.doctor.edit', compact('doctor'));
            }
        }
    }
    //update the Dr's Information
    public function updateDrInformation(Request $request)
    {
        //set the validation rules for the incoming requests
        $rules = array(
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required|phone|max:12',
            'avartar'=>'nullable|mimes:jpeg,jpg,png|max:2048'
        );
        //perfor validation on the above rules to ensure that they are met before perfoming any action
        $validator = Validator::make($request->all(),$rules);
        //if the validation failed
        if($validator->fails())
        {
            return redirect()->back()->with('error', $validator->errors());
        }
        else
        {
            //if the validation rules have been met, proceed to get the request data and perform the upation
            $id = $request->id;
            if(!$id)
            {
                //if the doctor's id is not provided
                return redirect()->back()->with('error','Invalid data');
            }
            else
            {
                //get input data
                $doctor = Doctors::where('id',$id)->first();
                $doctor->name = $request->name;
                $doctor->email = $request->email;
                $doctor->phone = $request->phone;
                //check if a new image has been uploaded
                if($request->file('avartar'))
                {
                    $avartar = $request->file('avartar');
                    $avartar_name = "Dr.".$request->name.".".$avartar->getClientOriginalExtension();
                    $path = public_path('uploads/images/doctors/'.$avartar_name);
                    //save the image
                    Image::make($avartar->getRealPath())->resize(250, null, function($constraint)
                    {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($path);
                    $doctor->avartar = $avartar_name;
                }
                else
                {
                    //maintain the Dr's image
                    $doctor->avartar = $doctor->avartar;
                }
                if($doctor->save())
                {
                    //if the doctor's information are sccessfully updated
                    return redirect()->back()->with('success','Doctor`s profile updated succesffuly');
                }
                else
                {
                    //if the profile was not updated
                    return redirect()->back()->withInput($request->only('name','email','avartar'))->with('error','Failed to update dotor profile, try again');
                }
            }
        }
    }
    /*************************************** END OF DOCTORS SECTION ***********************************************/
}
