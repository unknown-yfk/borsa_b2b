<?php

namespace App\Http\Controllers;

use App;
use Auth;
use App\Models\rom;
use App\Models\User;
use App\Models\agent;
use App\Models\order;
use App\Models\idType;
use App\Helpers\general;
use App\Models\businessType;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;

// use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;


class agentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $confirm = order::where('confirmStatus','confirmed')->where('createdBy', Auth::id())->count();
        $unconfirm = order::where('confirmStatus','unconfirmed')->where('createdBy', Auth::id())->count();
        $delieverd = order::where('deliveryStatus','Delivered')->where('createdBy', Auth::id())->count();



        $client = order::join('users','users.id','=','orders.client_id')
            ->join('clients','clients.user_id','=','orders.client_id')
            ->where('orders.createdBy',auth()->user()->id)
            ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.KD_id','orders.*']);
        return view('dashboard.agentDashboard',compact('confirm','unconfirm','delieverd','client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $businessType = businessType::all();
        $idType= idType::all();
        $roms=rom::join('users','users.id','=','roms.user_id')
        ->where('users.status','1')->get();

        return view('agent.create',compact('businessType','idType','roms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'address' =>'required',
            'mobile' =>'required|digits:10',
            'id_path'=>'required|image|mimes:jpg,png,jpeg|max:5048',
            'idType' =>'required',
            'ID_number' =>'required',
            'ID_issue_date' =>'required|date|before:today',
            'ID_expiry_date' =>'required|date|after:today',
            'businessName' =>'required',
            'businessType' =>'required',
            'businessAddress' =>'required',
            'licenceFilePath'=>'required|image|mimes:jpg,png,jpeg|max:5048',
            'licenceNumber' =>'required',
            'issueDate' =>'required|date|before:today',
            'expiryDate' =>'required|date|after:today',
            'tinNumber' =>'required',
            'rom_id' =>'required',
            'businessEstablishmentYear' =>'required|digits:4|integer|min:1900|max:2023',
            // 'profilePicture' => 'required|image|mimes:jpg,png,jpeg|max:5048'

        ]);

       $image_id  = $request->id_path;
       $imagename = time() . '.' . $image_id->getClientOriginalExtension();
       $request->id_path->move('assets/gov_img',$imagename);
       $image_licence = $request->licenceFilePath;
       $imagenameL = time() . '.' . $image_licence->getClientOriginalExtension();
       $request->licenceFilePath->move('assets/licences_img',$imagenameL);
       $user = user::find(auth()->user()->id);
       $agent_unique_id = general::IDGenerator(new agent, 'agent_unique_id', 5, 'AGENT');
       $user_pro  = $request->profilePicture;

       $user_proName = time() . '.' . $user_pro->getClientOriginalExtension();
       $request->profilePicture->move('assets/users_img',$user_proName);
       $user->userPhoto = $user_proName;
       $user->save();
        $agent = agent::create([
            'user_id'=>auth()->user()->id,
            'address'=> $request->address,
            'mobile'=>$request->mobile,
            'agent_unique_id'=> $agent_unique_id,
            'id_file_path'=> $imagename,
            'ID_type' => $request->idType,
            'ID_number'=> $request->ID_number,
            'ID_issue_date'=> $request->ID_issue_date,
            'ID_expiry_date'=> $request->ID_expiry_date,
            'businessName'=>$request->businessName,
            'businessType'=> $request->businessType,
            'businessAddress'=>$request->businessAddress,
            'licenceFilePath'=> $imagenameL,
            'licenceNumber'=>$request->licenceNumber,
            'issueDate'=> $request->issueDate,
            'expiryDate'=> $request->expiryDate,
            'tinNumber'=> $request->tinNumber,
            'rom_id' => $request->rom_id,
            'businessEstablishmentYear'=> $request->businessEstablishmentYear,

        ]);

        // echo $request->rom_id;
        Alert::toast('Successfully Added!', 'success');
        return redirect('/agentDashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(agent $agentProfile)
    {
        $agentProfile = agent::join('users','users.id','=','agents.user_id')
        ->where('agents.user_id',auth()->user()->id)->get();
        return view('agent.showProfile',compact('agentProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(agent $agent)
    {
        $agentProfile = agent::join('users','users.id','=','agents.user_id')
        ->where('agents.user_id',auth()->user()->id)->get();
        $businessType = businessType::all();
        $idType= idType::all();
        return view('agent.profileUpdate',compact('agentProfile','businessType','idType'));;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, agent $agent)
    {
        $request->validate([
            'firstName' => ['required', 'alpha', 'max:255'],
            'middleName' => ['required', 'alpha', 'max:255'],
            'lastName' => ['required', 'alpha', 'max:255'],
            'userName' => ['required', 'string', 'max:255'],
            'email' => [ 'string', 'email', 'max:255'],
            'address' =>'required',
            'mobile' =>'required|digits:10',
            'idType' =>'required',
            'ID_number' =>'required',
            'ID_issue_date' =>'required|date|before:today',
            'ID_expiry_date' =>'required|date|after:today',
            'businessName' =>'required',
            'businessType' =>'required',
            'businessAddress' =>'required',
            'licenceNumber' =>'required',
            'issueDate' =>'required|date|before:today',
            'expiryDate' =>'required|date|after:today',
            'tinNumber' =>'required',
            'businessEstablishmentYear' =>'required|digits:4|integer|min:1900|max:2023',
        ]);

        if($request->id_path)
        {
            $image_id  = $request->id_path;
            $imagename = time() . '.' . $image_id->getClientOriginalExtension();
            $request->id_path->move('assets/gov_img',$imagename);
             $kdProfile = agent::join('users','users.id','=','agents.user_id')
        ->where('agents.user_id',auth()->user()->id)->update([
            'id_file_path' => $imagename,
        ]);

        }
        else{
            $kdProfile = agent::join('users','users.id','=','agents.user_id')
        ->where('agents.user_id',auth()->user()->id)->update([
            'id_file_path' => $request->id_path_recover,
        ]);
        }

        if($request->licenceFilePath)
        {
            $image_licence = $request->licenceFilePath;
            $imagenameL = time() . '.' . $image_licence->getClientOriginalExtension();
            $request->licenceFilePath->move('assets/licences_img',$imagenameL);
             $kdProfile = agent::join('users','users.id','=','agents.user_id')
        ->where('agents.user_id',auth()->user()->id)->update([
              'licenceFilePath'=>$imagenameL,
        ]);
        }
        else{
            $kdProfile = agent::join('users','users.id','=','agents.user_id')
        ->where('agents.user_id',auth()->user()->id)->update([
            'licenceFilePath' => $request->licenceFilePath_recover,
        ]);
        }

        if($request->userPhoto)
        {
            $user_pro  = $request->userPhoto;
            $user_proName = time() . '.' . $user_pro->getClientOriginalExtension();
            $request->userPhoto->move('assets/user_img',$user_proName);
            $kdProfile = agent::join('users','users.id','=','agents.user_id')
        ->where('agents.user_id',auth()->user()->id)->update([
             'userPhoto'=> $user_proName,
        ]);
        }
        else{
            $kdProfile = agent::join('users','users.id','=','agents.user_id')
        ->where('agents.user_id',auth()->user()->id)->update([
             'userPhoto'=> $request->userPhoto_recover,
        ]);
        }
        $agentProfile = agent::join('users','users.id','=','agents.user_id')
        ->where('agents.user_id',auth()->user()->id)->update([
            'firstName'=> $request->firstName,
            'middleName'=>$request->middleName,
            'lastName'=> $request->lastName,
            'userName'=>$request->userName,
            'email'=> $request->email,
            'address'=> $request->address,
            'mobile'=>$request->mobile,
            'ID_type'=>$request->idType,
            'ID_number'=> $request->ID_number,
            'ID_issue_date'=> $request->ID_issue_date,
            'ID_expiry_date'=> $request->ID_expiry_date,
            'businessName'=>$request->businessName,
            'businessType'=> $request->businessType,
            'businessAddress'=>$request->businessAddress,
            'licenceNumber'=>$request->licenceNumber,
            'issueDate'=> $request->issueDate,
            'expiryDate'=> $request->expiryDate,
            'tinNumber'=> $request->tinNumber,
            'businessEstablishmentYear'=> $request->businessEstablishmentYear,
        ]);
        Alert::toast('Successfully Updated!', 'success');
        return redirect()->route('agent.dashboard');

    }
    public function change_password()
    {
        return view('agent.changePassword');
    }
    public function update_password(Request $request)
    {
        if (App::environment('demo')) {
            return redirect()->back()->with('error', 'Action not allowed in demo.');
        }
        $user = Auth::user();
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required',
            'new_password_confirmation' => 'same:new_password',
        ]);
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        // if (!Hash::check($request->current_password, $user->password)) {
        //      Alert::toast('Invalid Password!', 'warning');
        //     return redirect()->route('agent_change_password');
        // }
        // $credentials = [
        //     'password' => Hash::make($request->password),
        // ];
        // $user->update($credentials);

        Alert::toast('Password Changed Successfuly!', 'success');
         return redirect()->route('agent.dashboard');
    }
    public function destroy(agent $agent)
    {
        //
    }
}
