<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
    //redirect the user to the correct login page accrording to their autyenitiaction guards
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if($request->expectsJson())
        {
            return response()->json(['error'=>'Anauthenticated'], 401);
        }
        //get all the aunthetication guards
        $guard = array_get($exception->guards(), 0);
        //show the login urls based on the guards
        switch($guard)
        {
            case 'admin':
                $login = 'admin.login';
                break;
            case 'doctor':
                $login = 'doctor.login';
                break;
            case 'patient':
                $login = 'patient.login';
                break;
            case 'nurse':
                $login = 'nurse.login';
                break;
            case 'staff':
                $login = 'staff.login';
                break;
            default:
                $login = 'login';
                break;
        }
        return redirect()->guest(route($login));
    }
}
