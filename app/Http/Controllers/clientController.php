<?php

namespace App\Http\Controllers;

use App\Models\client;
use Illuminate\Http\Request;

class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         /* $request->validate([
            
            'firstName'=> 'required|max:255',
            'middleName'=>'required|max:255',
            'lastName'=>'required|max:255',
            'address'=>'required',
            'businessType'=>'required',
            'businessRegisteration'=>'required',
            'mobile'=>'required',
            'latitude'=>'required',
            'longtude'=>'required',
            'yearsInBusiness'=>'required',
            'verificationData'=>'required',
        ]);
*/
$client = client::create([
    'user_id'=>auth()->user()->id,  
'client_address'=> $request->address,
'client_mobile'=>$request->mobile,
'client_businessName'=> $request->businessName,
'client_businessType'=> $request->businessType,
'client_BusinessRegisteration'=> $request->businessRegisteration,
'client_mobile'=>$request->mobile,
'client_latitude'=> $request->latitude,
'client_longtude'=> $request->longtude,

'client_yearsInBusiness'=>$request->yearsInBusiness,
'client_verificationData'=> $request->verifictionData,


]);
return redirect('/client_dash') ->with('message', 'filled successfully');

    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(client $id)
    {
        $client = client::where('user_id', auth()->user()->id)->get();
       
         return $client   ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(client $client)
    {
        //
    }
}
