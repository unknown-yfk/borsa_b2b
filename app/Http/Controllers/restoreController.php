<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class restoreController extends Controller
{

        public function restore()
    {
        if(auth::user()->status=='1'){
        $userType = Auth::user()->userType;
        switch ($userType) {
            case 'client':
                return '/client_dash';
                break;
            case 'key distributor':
                return '/key_distroDashboard';
                break;
            case 'RSP':
                return '/rspDashboard';
                break;
            case 'ROM':
                return '/romDashboard';
                break;
                case 'agent':
                    return '/agentDashboard';
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
}

