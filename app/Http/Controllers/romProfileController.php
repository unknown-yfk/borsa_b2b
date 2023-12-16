<?php

namespace App\Http\Controllers;

use App;
use Auth;
use App\Models\rom;
use App\Models\user;
use App\Models\order;
use App\Models\idType;
use App\Models\key_distro;


use App\Helpers\general;
// use App\Models\delivery2;
use App\Models\delivery1;
use App\Models\delivery2;
use App\Models\delivery_4s;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Models\delivery1Products;
use App\Models\delivery_4products;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class romProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){


         $client=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        // ->join('key_distros','key_distros.user_id','=','orders.KD_id')

        ->join('tms','tms.kd_id','=','orders.KD_id')
        ->where('orders.confirmStatus','unconfirmed')
        ->where('orders.rom_order_confirmation','confirmed')



        // ->where('orders.KD_id',auth()->user()->id)
        ->where('orders.confirmStatus','unconfirmed')
        ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);

          $clientconfirmed=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id) ->where('orders.confirmStatus','confirmed')
        ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);

        // echo  $client;



        $unconfirmed=count($client);
        $confirmed=count($clientconfirmed);


        // $client =client::where('distro_id',auth()->user()->id)->count();
        $deliveredOrders = order::where('handoverStatus','confirmed')->where('KD_id', Auth::id())->count();
        $activeOrders = order::where('confirmStatus','unconfirmed')->where('KD_id', Auth::id())->count();

         $returned=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('ordered_products','ordered_products.order_id','=','orders.id')
        ->where('orders.rom_order_confirmation','confirmed')
        ->where('orders.rom_adjusted_confirmation','unconfirmed')
 

        ->where('orders.rom_id',auth()->user()->id)->orderBy('created_at', 'DESC')
        ->where('orders.confirmStatus','returned_acceptance')
        ->get(['users.firstName','users.middleName','users.lastName','orders.*']);
        $returnedcount=count($returned);


        $client=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id) ->where('orders.confirmStatus','unconfirmed')
        ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);

        $recivedDelivery = delivery1::where('rom_id',Auth::id())->count();

         $handoverd = delivery1::join('users','users.id','=','delivery1s.kd_id')
        ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        ->join('orders','orders.id','=','delivery1s.order_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('delivery1s.confirmationStatus','confirmed')
        ->where('delivery1s.rom_id',auth()->user()->id)
        ->where('delivery1s.handoverStatus','unconfirmed')
        ->count();

                $activeDelivery = delivery1::where('rom_id',Auth::id())->where('confirmationStatus','unconfirmed')->count();

                $delivery = delivery1::join('users','users.id','=','delivery1s.kd_id')
        ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        ->join('orders','orders.id','=','delivery1s.order_id')
        ->where('delivery1s.rom_id',auth()->user()->id)
        ->where('delivery1s.confirmationStatus','unconfirmed')
        ->get(['orders.client_id','delivery1s.*','users.firstName','users.middleName','users.lastName']);

        $deliveredProducts=delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get();


         $deliverycount = delivery_4s::join('users', 'users.id', '=', 'delivery_4s.client_id')
    ->join('clients', 'clients.user_id', '=', 'delivery_4s.client_id')
    ->join('roms', 'roms.user_id', '=', 'delivery_4s.sender_id')
    ->where('delivery_4s.sender_id', auth()->user()->id)
    ->count();

     $romId = auth()->id();

       $clientss=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        // ->where('orders.KD_id',auth()->user()->id)
        ->where('orders.confirmStatus','unconfirmed')
        ->where('orders.rom_id',$romId)

        // ->where('orders.rom_order_confirmation','confirmed')
        ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);
        $new=count($clientss);
        return view('dashboard.romDashboard',compact('recivedDelivery','activeDelivery','handoverd','delivery','client','deliveredOrders','activeOrders','unconfirmed','confirmed','returnedcount','new'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idType = idType::all();
        $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')->get();
        return view('ROM.create', compact('idType','key_distro'));
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
            'profilePicture' => 'required|image|mimes:jpg,png,jpeg|max:5048'
        ]);

        $id_path = $request->id_path;
        $woredaPic = time() . '.' . $id_path->getClientOriginalExtension();
        $request->id_path->move('assets/gov_img',$woredaPic);
        $user = user::find(auth()->user()->id);
        $user_pro  = $request->profilePicture;
        $user_proName = time() . '.' . $user_pro->getClientOriginalExtension();
        $request->profilePicture->move('assets/users_img',$user_proName);
        $user->userPhoto = $user_proName;
        $rom_unique_id = general::IDGenerator(new rom, 'rom_unique_id', 5, 'ROM');

        // $user->save();
        $rom = rom::create([
            'user_id'=>auth()->user()->id,
            'address'=> $request->address,
            'mobile'=>$request->mobile,
            'rom_unique_id'=>$rom_unique_id,


            'id_filepath'=> $woredaPic,
            'ID_type'=>$request->idType,
            'kd_id'=>$request->kd,

            'ID_number'=> $request->ID_number,
            'ID_issue_date'=> $request->ID_issue_date,
            'ID_expiry_date'=> $request->ID_expiry_date,
            'latitude' => $request->lat,
            'longtude' => $request->lng,

        ]);

         Alert::toast('Successfully Completed!', 'success');
        return redirect('/romDashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rom  $rom
     * @return \Illuminate\Http\Response
     */
    public function show(rom $romProfile)
    {
        $romProfile=rom::join('users','users.id','=','roms.user_id')
        ->where('roms.user_id',auth()->user()->id)->get();
        return view('ROM.showProfile',compact('romProfile'));;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rom  $rom
     * @return \Illuminate\Http\Response
     */
    public function edit(rom $rom)
    {
        $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')->get();

        $romProfile=rom::join('users','users.id','=','roms.user_id')
        ->where('roms.user_id',auth()->user()->id)->get();
         $idType = idType::all();
         return view('ROM.profileUpdate',compact('romProfile', 'idType','key_distro'));;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rom  $rom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rom $rom)
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
            // 'id_path'=>'required|image|mimes:jpg,png,jpeg|max:5048',
            'idType' =>'required',
            'ID_number' =>'required',
            'ID_issue_date' =>'required|date|before:today',
            'ID_expiry_date' =>'required|date|after:today',
            // 'profilePicture' => 'required|image|mimes:jpg,png,jpeg|max:5048'
        ]);

         if($request->id_path)
        {
            $image_id  = $request->id_path;
            $imagename = time() . '.' . $image_id->getClientOriginalExtension();
            $request->id_path->move('assets/gov_img',$imagename);
             $kdProfile = rom::join('users','users.id','=','roms.user_id')
        ->where('roms.user_id',auth()->user()->id)->update([
            'id_filepath' => $imagename,
        ]);

        }
        else{
            $kdProfile = rom::join('users','users.id','=','roms.user_id')
        ->where('roms.user_id',auth()->user()->id)->update([
            'id_filepath' => $request->id_path_recover,
        ]);
        }
        if($request->userPhoto)
        {
            $user_pro  = $request->userPhoto;
            $user_proName = time() . '.' . $user_pro->getClientOriginalExtension();
            $request->userPhoto->move('assets/user_img',$user_proName);
            $kdProfile = rom::join('users','users.id','=','roms.user_id')
        ->where('roms.user_id',auth()->user()->id)->update([
             'userPhoto'=> $user_proName,
        ]);
        }
        else{
            $kdProfile = rom::join('users','users.id','=','roms.user_id')
        ->where('roms.user_id',auth()->user()->id)->update([
             'userPhoto'=> $request->userPhoto_recover,
        ]);
        }
        $ROMProfile = rom::join('users','users.id','=','roms.user_id')
        ->where('roms.user_id',auth()->user()->id)->update([
            'firstName'=> $request->firstName,
            'middleName'=>$request->middleName,
            'lastName'=> $request->lastName,
            'userName'=>$request->userName,
            'email'=> $request->email,
            'address'=> $request->address,
            'mobile'=>$request->mobile,
            // 'id_filepath'=> $distro_id_image_name,
            'kd_id'=> $request->kd,
            'ID_type'=>$request->idType,
            'ID_number'=> $request->ID_number,
            'ID_issue_date'=> $request->ID_issue_date,
            'ID_expiry_date'=> $request->ID_expiry_date,
        ]);
          Alert::toast('Successfully updated!', 'success');
         return redirect('/romDashboard');
    }
    public function change_password()
    {
        return view('ROM.changePassword');
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
        //     return redirect()->route('rom_change_password');
        // }
        // $credentials = [
        //     'password' => Hash::make($request->password),
        // ];
        // $user->update($credentials);

        Alert::toast('Password Changed Successfuly!', 'success');
         return redirect('/romDashboard');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rom  $rom
     * @return \Illuminate\Http\Response
     */
    public function destroy(rom $rom)
    {
        //
    }
}
