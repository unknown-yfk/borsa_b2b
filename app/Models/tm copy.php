<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Helpers\LogActivity;


class tm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
     public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->userType=="TM")
           {
        return $next($request);
           }
        else
        {
            LogActivity::addToLog('Logout');

            Session::flush();
            Auth::logout();
            return redirect('login')->with('warning', 'An authorized user tried to perform some action!');

        }
    }
}
