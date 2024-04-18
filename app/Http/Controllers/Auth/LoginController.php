<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Helpers\LogActivity;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function redirectTo()
    {
        if(auth::user()->status=='1'){
        $userType = Auth::user()->userType;


        switch ($userType) {
            case 'client':
                LogActivity::addToLog('Client Login');
                return '/client_dash';
                break;
            case 'key distributor':
                     LogActivity::addToLog(' Login');
                return '/key_distroDashboard';
                break;
            case 'TM':
                     LogActivity::addToLog('TM Login');
                return '/tmDashboard';
                break;
            case 'RSP':
                     LogActivity::addToLog('Rsp Login');

                return '/rspDashboard';
                break;
            case 'ROM':
                     LogActivity::addToLog('Rom Login');
                return '/romDashboard';
                break;
            case 'agent':
                     LogActivity::addToLog('Agent Login');
                    return '/agentDashboard';
                    break;
            case 'admin':
                     LogActivity::addToLog('Admin Login');
                    return '/adminDashboard';
                    break;
            case 'HO':
                     LogActivity::addToLog('ho Login');
                    return '/hoDashboard';
                    break;
            case 'officer':
                    LogActivity::addToLog('Officer Login');
                return '/officerDashboard';
                break;
            case 'accion':
                    LogActivity::addToLog('Accion Login');
                return '/accionDashboard';
                break;
            case 'analyist':
                    LogActivity::addToLog('Analyist Login');
                return '/analyistDashboard';
                break;
            default:
                return '/home';
                break;
        }
    }
    else{
        return '/home';
    }
    }
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }
}
