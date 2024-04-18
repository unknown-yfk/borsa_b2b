<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\LogActivity;


class admin
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

        if(Auth::user()->userType=="admin")
           {
            return $next($request);

           }
        else
        {
            //Alert::warning('Unauthorized', 'User Not Authorized To Perform This Action');
            LogActivity::addToLog('Logout');

            Session::flush();
            Auth::logout();
            return redirect('login')->with('warning', 'An authorized user tried to perform some action!');


            // return redirect()->back()->with('success', 'your message,here');
        }
    }
}
