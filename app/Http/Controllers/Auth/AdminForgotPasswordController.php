<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;
class AdminForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    protected function broker()
    {
        return Password::broker('admins');
    }
    public function showLinkRequestForm()
    {
        return view('auth.passwords.admin.email');
    }
    // public function sendResetLinkEmail(Request $request)
    // {
    //     // //perform validatio for the email
    //     // $validator = Validator::make($request->all(),['email'=>'required|email']);
    //     // if($validator->fails())
    //     // {
    //     //     $request->session()->flash('error',$validator->errors());
    //     // }
    //     // else
    //     // {
    //     //     if($this->broker()->sendResetLink($request->only('email')))
    //     //     {
    //     //         $request->session()->flash('success','reset Link Email Sent, kindly check your email');
    //     //     }
    //     //     else
    //     //     {
    //     //         $request->session()->flash('error','Failed to send the reset link, try again');
    //     //         return redirect()->back()->withInput($request->only('email'));
    //     //     }
    //     // }
    // }
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }
    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }
    protected function credentials(Request $request)
    {
        return $request->only('email');
    }
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return back()->with('status', trans($response));
    }
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => trans($response)]);
    }

}
