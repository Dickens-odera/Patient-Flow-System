<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Doctors;
use App\Nurse;
use App\Departments;
use App\Patients;
use App\Admin;
use Image;
use Auth;
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
    public function profile(Request $request, $admin_id = null)
    {
        //show the administrator their profile
        $admin_id = Auth::user()->id;
        if(!$admin_id)
        {
            $request->session()->flash('error','Invalid request format');
        }
        else
        {
            $this->validate($request, ['id'=>'required']);
            $admin = Admin::where('id', $admin_id)->first();
            return view('admin.profile.index', compact('admin'));
        }
    }
    //update the admin profile
    public function updateProfile(Request $request, $adm_id = null)
    {
        $adm_id = Auth::user()->id;
        if(!$adm_id)
        {
            $request->session()->flash('error','Invalid request format');
        }
        else
        {
            $this->validate($request,array(
                'name'=>'required',
                'email'=>'required|email',
                'avartar'=>'nullable|image|mimes:jpeg,jpg,png|max:2048'
            ));
            $admin = Admin::where('id',$adm_id)->first();
            $admin->name = $request->name;
            $admin->email = $request->email;
            if($request->file('avartar'))
            {
                $admin_photo = $request->file('avartar');
                $ext = $admin_photo->getClientOriginalExtension();
                $saved_admin_photo_name = time().str_random(40).".".$ext;
                $path = public_path('uploads/images/admins/'.$saved_admin_photo_name);
                Image::make($admin_photo->getRealPath())->resize(250, 200, function($constraint)
                {   
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($path);
                $admin->avartar = $saved_admin_photo_name;
            }
            if($admin->save())
            {
                $request->session()->flash('success','Profile updated successfully');
                return redirect()->back();
            }   
            else
            {
                $request->session()->flash('error','Unable to update your profile at this time,try again');
                return redirect()->back();
            }

        }
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
            'email'=>'required|email|unique:doctors',
            'password'=>'required',
            'confirm_password'=>'required',
            'phone'=>'required|phone|max:12|unique:doctors',
            'avartar'=>'nullable|image|mimes:jpeg,jpg,png|max:2048'
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
                $request->session()->flash('error','Password mismatch, try again');
                return redirect()->back()->withInput($request->only('name','email','phone'));
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
                $message = "Dear ".$request->name." Kindly use these credentials to <a href='https://localhost:8000/doctor/doctorlogin'>login here</a>"." Username:".$request->email.". Password:".$request->password;
                $postData = array(
                    'username'=>env('USERNAME'),
                    'api_key'=>env('APIKEY'),
                    'sender'=>env('SENDERID'),
                    'to'=>$request->phone,
                    'message'=>$message,
                    'msgtype'=>env('MSGTYPE'),
                    'dlr'=>env('DLR')
                );
                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_URL => env('URL'),
                    CURLOPT_RETURNTRANSFER =>true,
                    CURLOPT_POST =>  true,
                    CURLOPT_POSTFIELDS => $postData
                ));
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $output = curl_exec($ch);
                if(curl_errno($ch))
                {
                    curl_errno($ch);
                }
                curl_close($ch);
                //return response()->json(['state'=>'success']);
                $request->session()->flash('success','The doctor has been added successfully');
                return redirect()->back();
            }
            else
            {
                //if the process of adding the new doctor failed
                $request->session()->flash('error','Failed to add the new doctor, try again');
                return redirect()->back();
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
            $request->session()->flash('error','Invalid request');
            return redirect()->back();
        }
        else
        {
            $validator = Validator::make($request->all(), ['id'=>'required']);
            if($validator->fails())
            {
                $request->session()->flash('error',$validator->errors());
                return redirect()->back();
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
            'avartar'=>'nullable|image|mimes:jpeg,jpg,png|max:2048'
        );
        //perfor validation on the above rules to ensure that they are met before perfoming any action
        $validator = Validator::make($request->all(),$rules);
        //if the validation failed
        if($validator->fails())
        {
            $request->session()->flash('error',$validator->errors());
            return redirect()->back();
        }
        else
        {
            //if the validation rules have been met, proceed to get the request data and perform the upation
            $id = $request->id;
            if(!$id)
            {
                //if the doctor's id is not provided
                $request->session()->flash('error','Invalid request');
                return redirect()->back();
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
                    $ext = $avartar->getClientOriginalExtension();
                    $avartar_name = "Dr.".$request->name.".".$ext;
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
                    $request->session()->flash('success','Doctor`s profile updated succesffuly');
                    return redirect()->back();
                }
                else
                {
                    //if the profile was not updated
                    $request->session()->flash('error','Failed to update doctor profile, try again');
                    return redirect()->back()->withInput($request->only('name','email','avartar'));
                }
            }
        }
    }
    //delete information pertaining to a particular dr
    public function deleteDrInformation(Request $request)
    {
        //get the id of the Dr
        $id = $request->id;
        if(!$id)
        {
            //if the id is not attached to the request
            $request->session()->flash('error','Invalid request');
            return redirect()->back();
        }
        else
        {
            //if the id is attached to the request
            $this->validate($request, ['id'=>'required']);
            //perform the delete request
            if(Doctors::where('id', $id)->first()->delete())
            {
                //if the delete request was successfull, give feedback with a success message
                $request->session()->flash('success','Dr information deleted successfully');
                return redirect()->back();
            }
            else
            {
                //if the request failed
                $request->session()->flash('error','Failed to delete the Dr information, try again');
                return redirect()->back();
            }
        }
    }
    /*************************************** END OF DOCTORS SECTION ***********************************************/
    /************************ ADMIN-NURSES FUNTIONALITY********************************/
    //show a form to add a new nurse
    public function showNursesForm()
    {
        return view('admin.nurses.create');
    }
    //logic to add a new nurse
    public function addNewNurse(Request $request)
    {
        //create validation rules for the incoming request data
        $rules = array(
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|phone',
            'password'=>'required',
            'confirm_password'=>'required',
            'avartar'=>'nullable|image|mimes:jpeg,jpg,png|max:2048'
        );
        //perform validation on the above set validation rules
        $validator = Validator::make($request->all(), $rules);
        //determine if the validation rules are not met
        if($validator->fails())
        {
            //redirect the user to the same page with an errror message
            $request->session()->flash('error',$validator->errors());
            return redirect()->back();
        }
        //if the validation rules have been met, proceed to get the request data from the form
        $nurse = new Nurse;
        $nurse->name = $request->name;
        $nurse->email = $request->email;
        $nurse->phone = $request->phone;
        $pwd = $request->password;
        $confirm_pwd = $request->confirm_password;
        //determine if the two password actually match
        if($pwd !== $confirm_pwd)
        {
            //throw an error
            $request->session()->flash('error','Password mismatch');
            return redirect()->back();
        }
        else
        {
            //encrypt the password by Hashing it to 60 bit characters
            $nurse->password = bcrypt($pwd);
        }
        //check if an image is uploaded
        if($request->file('avartar'))
        {
            //get the file uploaded
            $nurse_avartar = $request->file('avartar');
            $ext = $nurse_avartar->getClientOriginalExtension();
            $avartar_name = "Nurse ".$request->name.".".$ext;
            $path = public_path('uploads/images/nurses/'.$avartar_name);
            //upload the image by resizing it to a width of 250 and a height of 200 pixels respectively
            Image::make($nurse_avartar->getRealPath())->resize(250,200, function($constraint)
            {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($path);
            $nurse->avartar = $avartar_name;
        }
        //save the new nurse into the database
        if($nurse->save())
        {
            //if the nurse was successfully added into the database, show a success message
            $message = "Dear ".$request->name."Kindly use these credentials to log into your portal <a href='http://localhost:8000/nurses/nurseslogin/'>here</a>"."Username:".$request->email." Password".$request->password;
        
                $data = array(
                    'username'=>env('USERNAME'),
                    'api_key'=>env('APIKEY'),
                    'sender'=>env('SENDERID'),
                    'to'=>$request->phone,
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
            $request->session()->flash('success','Nurse '.$request->name.' '.'added successfully');
            return redirect()->back();
        }
        else
        {
            //if the request to add a new nurse fails, throw an error and return the admin to the same form
            $request->session()->flash('error','Failed to add the nurse, try again');
            return redirect()->back()->withInput($request->only('name','email','phone','avartar'));
        }
    }
    //list all the nurses
    public function viewAllNurses()
    {
        $nurses = Nurse::latest()->paginate(10);
        return view('admin.nurses.index', compact('nurses'));
    }
    //show the edit form with the nurse's information
    public function showNurseEditForm(Request $request)
    {
        //determine whether the id of the nurse is attached to the request
        $id = $request->id;
        if(!$id)
        {
            //if not so,
            $request->session()->flash('error','Invalid request format');
            return redirect()->back();
        }
        else
        {
            //set the validation
            $this->validate($request,['id'=>'required']);
            $nurse = Nurse::where('id',$id)->first();
            return view('admin.nurses.edit', compact('nurse'));
        }
    }
    //update the details pertaining to a particular nurse
    public function updateNurseInformation(Request $request)
    {
        //get the id of the nurse
        $id = $request->id;
        if(!$id)
        {
            $request->session()->flash('error','Invalid request format');
            return redirect()->back();
        }
        //validation rules
        $nurse_validation_rules = array(
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|phone',
            'avartar'=>'nullable|image|mimes:jpeg,jpg,png|max:2048'
        );
    //check to see whether the above set validation rules are met
        $validator = Validator::make($request->all(), $nurse_validation_rules);
        //if not, throw an error message with the missing rules
        if($validator->fails())
        {
            $request->session()->flash('error',$validator->errors());
            return redirect()->back()->withInput($request->only('name','email','phone','avartar'));
        }
        else
        {
            //if the validation rules have been met, get the input data from the form
            $nurse = Nurse::where('id',$id)->first();
            $nurse->name = $request->name;
            $nurse->email = $request->email;
            $nurse->phone = $request->phone;
            //if there is a file upload(Image)
            if($request->file('avartar'))
            {
                $nurse_avartar = $request->file('avartar');
                $avartar_name = "Nurse ".$request->name.".".$nurse_avartar->getClientOriginalExtension();
                $path = public_path('uploads/images/nurses/'.$avartar_name);
                Image::make($nurse_avartar->getRealPath())->resize(250, 200, function($constraint)
                {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($path);
                $nurse->avartar = $avartar_name;
            }
            else
            {
                $nurse->avartar = $nurse->avartar;
            }
            if($nurse->save())
            {
                //if the updation process was successfull
                $request->session()->flash('success','Nurse information updated successfully');
                return redirect()->to(route('admin.nurses.view.all'));
            }
            else
            {
                //if the updatio process failed
                $request->session()->flash('error','Failed to update nurse information, try again');
                return redirect()->back()->withInput($request->only('name','email','phone','avartar'));
            }
        }
    }
    //delete nurse information
    public function deleteNurseInformation(Request $request, $nurse_id = null)
    {
        //attach an id to the request
        $nurse_id= $request->id;
        if(!$nurse_id)
        {
            //if the id is not attached to the request
            $request->session()->flash('error','Invalid request');
            return redirect()->back();
        }
        else
        {
            //validate the request
            $this->validate($request, ['id'=>'required']);
            //delete the nurse
            if(Nurse::where('id',$nurse_id)->first()->delete())
            {
                //if the delete request was succssfull
                //perform future backup
                $request->session()->flash('success','Nurse deleted successfuly');
                return redirect()->to(route('admin.nurses.view.all'));
            }
        }
    }
    /*********************** END OF ADMIN NURSES FUNCTIONALITY *******************************/
    /*********************** ADMIN DEOARTMENTS FUNTIONALITY *********************************/
    //list all the available departments
    public function viewAllDepartments()
    {
       $departments = Departments::latest()->paginate(10);
       return view('admin.departments.index', compact('departments'));
    }
    //show te form to add a new department
    public function showDepartmentsForm()
    {
        return view('admin.departments.create');
    }
    //logic that add a new department to the database
    public function addNewDepartment(Request $request)
    {
        //set validation rules
        $dep_rules = array(
            'name'=>'required|unique:departments',
            'description'=>'nullable'
        );
        //perform validation
        $validator = Validator::make($request->all(), $dep_rules);
        //if the validation fails
        if($validator->fails())
        {
            $request->session()->flash('error',$validator->errors());
            return redirect()->back()->withInput($request->only('name','description'));
        }
        else
        {
              //get the input data from the form
              $department = new Departments;
              $department->name = $request->name;
              $department->description = $request->description;
              //save the department to the database
              if($department->save())
              {
                  //upon success
                  $request->session()->flash('success','The '.$request->name." "."department has been added sucessfully");
                  return redirect()->back();
              } 
              else
              {
                  //upon failure
                  $request->session()->flash('error','Failed to add the new department, try again');
                  return redirect()->back()->withInput($request->only('name','description'));
              }
        }
    }
    //show the details of a single department
    public function showDepartmentDetails(Request $request, $department_id = null)
    {
        //find the departement by id
        $department_id = $request->id;
        //check if the id is not provided
        if(!$department_id)
        {
            //if not
            $request->session()->flash('error','Invalid request format');
            return redirect()->back();
        }
        else
        {
            //peform data validation
            $validator = Validator::make($request->all(), ['id'=>'required']);
            if($validator->fails())
            {
                //if the validation has failed
                $request->session()->flash('error',$validator->errors());
                return redirect()->back();
            }
            else
            {
                $department = Departments::where('id',$department_id)->first();
                return view('admin.departments.show', compact('department'));
            }
        }
    }
    //delete a partiicular department
    public function deleteDepartmentInforrmation(Request $request, $dep_id = null)
    {
        //ewquire id for the action
        $dep_id = $request->id;
        //if there is no id attached to the request
        if(!$dep_id)
        {
            $request->session()->flash('error','Invalid request format');
            return redirect()->back();
        }
        else
        {
            //perform data validation
            $this->validate($request, ['id'=>'required']);
            //perform the delete action
            if(Departments::where('id',$dep_id)->first()->delete())
            {
                //if the department has been deleted successfully
                $request->session()->flash('success','the department has been successfully deleted');
                return redirect()->back();
            }
            else
            {
                //if the delete action failed
                $request->session()->flash('error','Failed to complete yoir request, try again');
                return redirect()->back()->withInput($request->only('name','description'));
            }
        }
    }
    //update the information pertaining to a particular department
    public function updateDepartmentInformation(Request $request, $dep_id = null)
    {
        //get the id of the department
        $dep_id = $request->id;
        //if the id is not provided in the request
        if(!$dep_id)
        {
            //throw an error
            $request->session()->flash('error','Invalid request format');
            return redirect()->back();
        }
        else
        {
            //if the id is provided
            $this->validate($request,['name'=>'required','description'=>'required']);
            //perform the updation process
            if(Departments::where('id',$dep_id)->first()->update(['name'=>$request->name,'description'=>$request->description]))
            {
                //if the updation process was a success
                $request->session()->flash('success','Department data updated successfully');
                return redirect()->to(route('admin.departments.view.all'));
            }
            else
            {
                //if the updation process failed
                $request->session()->flash('error','Failed to update department information, try again');
                return redirect()->back()->withInput($request->only('name','description'));
            }
        }
    }

    /*********************** END OF ADMIN DEPARTMENTS FUNCTIONALITY */

    /*********************** ADMIN-PATIENTS FUNCTIONALITIES ***********************/
    //view all the patients in the system
    public function viewAllPatients()
    {
        $patients = Patients::latest()->paginate(10);
        return view('admin.patients.index', compact('patients'));
    }
    /*********************** END ADMIN-PATIENTS FUNCTIONALITIES *********************/
}
