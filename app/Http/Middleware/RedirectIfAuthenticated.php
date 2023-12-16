<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
   // public function handle(Request $request, Closure $next, ...$guards)
    //{
      //  $guards = empty($guards) ? [null] : $guards;
///
   ///     foreach ($guards as $guard) {
      ///      if (Auth::guard($guard)->check()) {
         ///       return redirect(RouteServiceProvider::HOME);
            ///}
//        }
//
  //      return $next($request);
    //}


    public function handle($request, Closure $next, $guard = null) {
        if (Auth::guard($guard)->check()) {
          $role = Auth::user()->userType; 
      
          switch ($role) {
            case 'key_distributor':
               return redirect('/key_distroDashboard');
               break;
            case 'ROM':
               return redirect('/romDashboard');
               break; 
            case 'RSP':
                return redirect('/rspDashboard');
                break;
            case 'agent':
                return redirect('/agentDashboard');
                break;
            default:
               return redirect('/home'); 
               break;
          }
        }
        return $next($request);
      }


}
