<?php

namespace App\Http\Controllers;

use App\Models\key_distro;
use App\Models\tm;

use App\Models\user;
use Illuminate\Http\Request;
use App\Models\businessType;
use Illuminate\Support\Facades\Hash;
use App\Models\idType;
use Auth;
use App;
use App\Rules\MatchOldPassword;
use App\Helpers\general;
use App\Helpers\LogActivity;



use RealRashid\SweetAlert\Facades\Alert;

class tm_profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $businessType=businessType::all();
        $idType= idType::all();
        $today = date('Y-m-d H:i:s');
        return view('TM.create',compact('businessType','idType','today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
    {

       $key_distro = $request->validate([
            // 'address' =>'required',
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

            'CBEBank_Account_Number' =>'numeric',
            'AmharaBank_Account_Number' =>'numeric',
            'HibretBank_Account_Number' =>'numeric',

            'businessEstablishmentYear' =>'required|digits:4|integer|min:1900|max:2023',
            'profilePicture' =>'image|mimes:jpg,png,jpeg|max:5048',
        ]);

       // $users = user::where('id', auth()->user()->id)->get('users.firstName','users.lastName');
       // return $user;
       $image_id  = $request->id_path;
       $imagename = time() . '.' . $image_id->getClientOriginalExtension();
       $request->id_path->move('assets/gov_img',$imagename);

       $image_licence = $request->licenceFilePath;
       $imagenameL = time() . '.' . $image_licence->getClientOriginalExtension();
       $request->licenceFilePath->move('assets/licences_img',$imagenameL);

       $user = user::find(auth()->user()->id);
       $user_pro  = $request->profilePicture;
       $user_proName = time() . '.' . $user_pro->getClientOriginalExtension();
       $request->profilePicture->move('assets/users_img',$user_proName);
       $user->userPhoto = $user_proName;
       $key_distro_unique_id = general::IDGenerator(new key_distro, 'key_distro_unique_id', 5, 'KD');

       $user->save();
        $request = key_distro::create([
            'user_id'=>auth()->user()->id,
            'address'=> $request->address,
            'mobile'=>$request->mobile,
            'key_distro_unique_id'=>$key_distro_unique_id,



            'id_file_path'=> $imagename,
            'ID_type'=>$request->idType,
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
            'businessEstablishmentYear'=> $request->businessEstablishmentYear,
            'latitude'=> $request->lat,
            'longtude'=> $request->lng,
            'CBEBank_Account_Number' => $request->CBEBank_Account_Number,
            'AmharaBank_Account_Number' =>$request->AmharaBank_Account_Number,
            'HibretBank_Account_Number' =>$request->HibretBank_Account_Number,

        ]);

     Alert::toast('Successfully Completed!', 'success');
        return redirect('/key_distroDashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\key_distro  $key_distro
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $tmProfile=tm::join('users','users.id','=','tms.user_id')
        ->where('tms.user_id',auth()->user()->id)->get();
        return view('TM.showProfile',compact('tmProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\key_distro  $key_distro
     * @return \Illuminate\Http\Response
     */
    public function edit(key_distro $key_distro)
    {
        $tmProfile = tm::join('users','users.id','=','tms.user_id')
        ->where('tms.user_id',auth()->user()->id)->get();
        $businessType = businessType::all();
        $idType= idType::all();

        return view('TM.profileUpdate',compact('tmProfile', 'businessType','idType'));


    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\key_distro  $key_distro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tm $tm)
    {
        $request->validate([
            'firstName' => ['required', 'alpha', 'max:255'],
            'middleName' => ['required', 'alpha', 'max:255'],
            'lastName' => ['required', 'alpha', 'max:255'],
            'userName' => ['required', 'string', 'max:255'],
            // 'email' => [ 'string', 'email', 'max:255'],
            'address' =>'required',
            'address' =>'required',
            'mobile' =>'required|digits:10',
            // 'id_path'=>'image|mimes:jpg,png,jpeg|max:5048',
            // 'idType' =>'required',
            // 'ID_number' =>'required',
            // 'ID_issue_date' =>'required|date|before:today',
            // 'ID_expiry_date' =>'required|date|after:today',
            // 'businessName' =>'required',
            // 'businessType' =>'required',
            // 'businessAddress' =>'required',
            // 'licenceFilePath'=>'image|mimes:jpg,png,jpeg|max:5048',
            // 'licenceNumber' =>'required',
            // 'issueDate' =>'required|date|before:today',
            // 'expiryDate' =>'required|date|after:today',
            // 'tinNumber' =>'required',
            // 'businessEstablishmentYear' =>'required|digits:4|integer|min:1900|max:2023',
            // 'userPhoto' =>'image|mimes:jpg,png,jpeg|max:5048',

        ]);
        // if($request->id_path)
        // {
        //     $image_id  = $request->id_path;
        //     $imagename = time() . '.' . $image_id->getClientOriginalExtension();
        //     $request->id_path->move('assets/gov_img',$imagename);
        //      $kdProfile = key_distro::join('users','users.id','=','tms.user_id')
        // ->where('tms.user_id',auth()->user()->id)->update([
        //     'id_file_path' => $imagename,
        // ]);

        // }
        // else{
        //     $kdProfile = key_distro::join('users','users.id','=','tms.user_id')
        // ->where('tms.user_id',auth()->user()->id)->update([
        //     'id_file_path' => $request->id_path_recover,
        // ]);
        // }

        // if($request->licenceFilePath)
        // {
        //     $image_licence = $request->licenceFilePath;
        //     $imagenameL = time() . '.' . $image_licence->getClientOriginalExtension();
        //     $request->licenceFilePath->move('assets/licences_img',$imagenameL);
        //      $kdProfile = key_distro::join('users','users.id','=','tms.user_id')
        // ->where('tms.user_id',auth()->user()->id)->update([
        //       'licenceFilePath'=>$imagenameL,
        // ]);
        // }
        // else{
        //     $kdProfile = key_distro::join('users','users.id','=','tms.user_id')
        // ->where('tms.user_id',auth()->user()->id)->update([
        //     'licenceFilePath' => $request->licenceFilePath_recover,
        // ]);
        // }

        // if($request->userPhoto)
        // {
        //     $user_pro  = $request->userPhoto;
        //     $user_proName = time() . '.' . $user_pro->getClientOriginalExtension();
        //     $request->userPhoto->move('assets/users_img',$user_proName);
        //     $kdProfile = key_distro::join('users','users.id','=','tms.user_id')
        // ->where('tms.user_id',auth()->user()->id)->update([
        //      'userPhoto'=> $user_proName,
        // ]);
        // }
        // else{
        //     $kdProfile = key_distro::join('users','users.id','=','tms.user_id')
        // ->where('tms.user_id',auth()->user()->id)->update([
        //      'userPhoto'=> $request->userPhoto_recover,
        // ]);
        // }

        $tmProfile = tm::join('users','users.id','=','tms.user_id')
        ->where('tms.user_id',auth()->user()->id)->update([
            'firstName'=> $request->firstName,
            'middleName'=>$request->middleName,
            'lastName'=> $request->lastName,
            'userName'=>$request->userName,
            'email'=> $request->email,
            'address'=> $request->address,
            'mobile'=>$request->mobile,
            // 'id_file_path' => $imagename,
            'ID_type'=>$request->idType,
            'ID_number'=> $request->ID_number,
            'ID_issue_date'=> $request->ID_issue_date,
            'ID_expiry_date'=> $request->ID_expiry_date,
            // 'businessName'=>$request->businessName,
            // 'businessType'=> $request->businessType,
            // 'businessAddress'=>$request->businessAddress,
            // 'licenceNumber'=>$request->licenceNumber,
            // 'licenceFilePath'=>$imagenameL,
            // 'issueDate'=> $request->issueDate,
            // 'expiryDate'=> $request->expiryDate,
            // 'tinNumber'=> $request->tinNumber,
            // 'businessEstablishmentYear'=> $request->businessEstablishmentYear,
            'latitude'=> $request->lat,
            'longtude'=> $request->lng,
            // 'userPhoto'=> $user_proName,
        ]);
        LogActivity::addToLog('Update Profile');


        Alert::toast('Successfully Updated!', 'success');
        return redirect('/tmDashboard');

    }
     public function change_password()
    {
        return view('TM.changePassword');
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
        //     return redirect()->route('kd_change_password');
        // }
        // $credentials = [
        //     'password' => Hash::make($request->password),
        // ];
        // $user->update($credentials);
        LogActivity::addToLog('change password');

        Alert::toast('Password Changed Successfuly!', 'success');
         return redirect('/tmDashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\key_distro  $key_distro
     * @return \Illuminate\Http\Response
     */
    public function destroy(key_distro $key_distro)
    {
        //
    }
}
