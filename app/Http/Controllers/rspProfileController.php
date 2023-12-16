<?php

namespace App\Http\Controllers;

use App\Models\rsp;
use App\Models\idType;
use App\Models\user;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\general;


class rspProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.rspDashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idType = idType::all();
        return view('RSP.create', compact('idType'));
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
            // 'firstName' => ['required', 'alpha', 'max:255'],
            // 'middleName' => ['required', 'alpha', 'max:255'],
            // 'lastName' => ['required', 'alpha', 'max:255'],
            // 'userName' => ['required', 'string', 'max:255'],
            // 'email' => [ 'string', 'email', 'max:255'],
            'address' =>'required',
            'mobile' =>'required|digits:10',
            'id_path'=>'required|image|mimes:jpg,png,jpeg|max:5048',
            'idType' =>'required',
            'ID_number' =>'required',
            'ID_issue_date' =>'required|date|before:today',
            'ID_expiry_date' =>'required|date|after:today',
            'profilePicture' =>'image|mimes:jpg,png,jpeg|max:5048',
        ]);

       // $users = user::where('id', auth()->user()->id)->get('users.firstName','users.lastName');
       // return $user;
       $image_id  = $request->id_path;
       $imagename = time() . '.' . $image_id->getClientOriginalExtension();
       $request->id_path->move('assets/gov_img',$imagename);
       //userSave
       $user = user::find(auth()->user()->id);
       $user_pro  = $request->profilePicture;
       $user_proName = time() . '.' . $user_pro->getClientOriginalExtension();
       $request->profilePicture->move('assets/users_img',$user_proName);
       $user->userPhoto = $user_proName;
       $rsp_unique_id = general::IDGenerator(new rsp, 'rsp_unique_id', 5, 'RSP');

       $user->save();
        $rsp = rsp::create([
            'user_id'=>auth()->user()->id,
            'address'=> $request->address,
            'mobile'=>$request->mobile,
            'rsp_unique_id'=>$rsp_unique_id,

            'id_filepath'=> $imagename,
            'ID_type'=>$request->idType,
            'ID_number'=> $request->ID_number,
            'ID_issue_date'=> $request->ID_issue_date,
            'ID_expiry_date'=> $request->ID_expiry_date,
            'latitude'=> $request->lat,
            'longtude'=> $request->lng,
        ]);
        Alert::toast('Successfully Completed!', 'success');
        return redirect('/rspDashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rsp  $rsp
     * @return \Illuminate\Http\Response
     */
    public function show(rsp $rspProfile)
    {
        $rspProfile = rsp::join('users','users.id','=','rsps.user_id')
        ->where('rsps.user_id',auth()->user()->id)->get();
        return view('RSP.showProfile',compact('rspProfile'));;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rsp  $rsp
     * @return \Illuminate\Http\Response
     */
    public function edit(rsp $rsp)
    {
        $rspProfile=rsp::join('users','users.id','=','rsps.user_id')
        ->where('rsps.user_id',auth()->user()->id)->get();
        $idType = idType::all();
        return view('RSP.ProfileUpdate',compact('rspProfile','idType'));;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rsp  $rsp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rsp $rsp)
    {

        $request->validate([
            'firstName' => ['required', 'alpha', 'max:255'],
            'middleName' => ['required', 'alpha', 'max:255'],
            'lastName' => ['required', 'alpha', 'max:255'],
            'userName' => ['required', 'string', 'max:255'],
            'email' => [ 'string', 'email', 'max:255'],
            'address' =>'required',
            'address' =>'required',
            'mobile' =>'required|digits:10',
            'idType' =>'required',
            'ID_number' =>'required',
            'ID_issue_date' =>'required|date|before:today',
            'ID_expiry_date' =>'required|date|after:today',

               ]);
        if($request->id_path)
        {
            $image_id  = $request->id_path;
            $imagename = time() . '.' . $image_id->getClientOriginalExtension();
            $request->id_path->move('assets/gov_img',$imagename);
             $kdProfile = rsp::join('users','users.id','=','rsps.user_id')
             ->where('rsps.user_id',auth()->user()->id)->update([
            'id_filepath' => $imagename,
        ]);

        }
        else{
            $kdProfile = rsp::join('users','users.id','=','rsps.user_id')
        ->where('rsps.user_id',auth()->user()->id)->update([
            'id_filepath' => $request->id_path_recover,
        ]);
        }
        if($request->userPhoto)
        {
            $user_pro  = $request->userPhoto;
            $user_proName = time() . '.' . $user_pro->getClientOriginalExtension();
            $request->userPhoto->move('assets/users_img',$user_proName);
            $RSPProfile = rsp::join('users','users.id','=','rsps.user_id')
        ->where('rsps.user_id',auth()->user()->id)->update([
             'userPhoto'=> $user_proName,
        ]);
        }
        else{
            $RSPProfile = rsp::join('users','users.id','=','rsps.user_id')
        ->where('rsps.user_id',auth()->user()->id)->update([
             'userPhoto'=> $request->userPhoto_recover,
        ]);
        }
        $rspProfile = rsp::join('users','users.id','=','rsps.user_id')
            ->where('rsps.user_id',auth()->user()->id)
            ->update([
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
            'latitude' => $request->lng,
            'longtude' => $request->lat,
        ]);
          Alert::toast('Successfully Updated!', 'success');
         return redirect('/rspDashboard');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rsp  $rsp
     * @return \Illuminate\Http\Response
     */
    public function destroy(rsp $rsp)
    {
        //
    }
}
