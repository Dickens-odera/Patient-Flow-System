<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //redirect the user based on their authentication guards
        switch($guard)
        {
            case 'admin':
                if(Auth::guard($guard)->check())
                {
                    return redirect()->route('admin.dashboard');
                }
                break;
            case 'doctor':
                if(Auth::guard($guard)->check())
                {
                    return redirect()->route('doctor.dashboard');
                }
                break;
            case 'patient':
                if(Auth::guard($guard)->check())
                {
                    return redirect()->route('patient.dashboard');
                }
                break;
            case 'nurse':
                if(Auth::guard($guard)->check())
                {
                    return redirect()->route('nurse.dashboard');
                }
                break;
            case 'staff':
                if(Auth::guard($guard)->check())
                {
                    return redirect()->route('staff.dashboard');
                }
                break;
            default:
                if(Auth::guard($guard)->check())
                {
                    return redirect()->route('home');
                }
                break;
        }
        return $next($request);
    }
}
