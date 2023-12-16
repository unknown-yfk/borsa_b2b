<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use App\Models\client;


use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
// use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App;
use App\Rules\MatchOldPassword;

class clientProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $client=client::join('users','users.id','=','clients.user_id')->get();


        // return view('agent.clientList',compact('client'));
        return view('dashboard.clientDashboard');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        $clientProfile=client::join('users','users.id','=','clients.user_id')
        ->where('clients.user_id',auth()->user()->id)->
get(['users.firstName','users.middleName','users.lastName','clients.client_businessName',
'clients.client_address']);

// return $clientProfile;
        return view('client.showProfile',compact('clientProfile'));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $userProfile)
    {

        $clientProfile=client::join('users','users.id','=','clients.user_id')
        ->where('clients.user_id',auth()->user()->id);
        return view('client.profileUpdate',compact('clientProfile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $clientProfile=client::join('users','users.id','=','clients.user_id')
        ->where('clients.user_id',auth()->user()->id)->update([

            'userName'=> $request->userName,
            'client_address'=> $request->address,
            'client_businessType'=> $request->businessType,
            'client_BusinessRegisteration'=> $request->businessRegisteration,
            'client_mobile'=>$request->mobile,

        ]);
        return redirect('/client_dash') ->with('message', 'filled successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }
}
