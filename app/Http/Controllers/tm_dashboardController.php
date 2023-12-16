<?php

namespace App\Http\Controllers;

use App\Models\key_distro;
use App\Models\client;
use App\Models\order;
use App\Models\tm;
use Illuminate\Http\Request;
use Auth;

class tm_dashboardController extends Controller
{
public function index()
    {

        $tms_all=tm::where('user_id',auth()->user()->id)->get();
        $kd_id=$tms_all[0]->kd_id;

            $client=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        // ->join('agents', 'orders.rom_id', '=', 'agents.rom_id')

 ->where('orders.KD_id',$kd_id)


        ->where('orders.confirmStatus','confirmed')
        ->where('orders.rom_order_confirmation','confirmed')
        ->where('orders.rom_adjusted_confirmation','confirmed')
         ->where('orders.tm_confirmation','unconfirmed')
        ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);


           $clientconfirmed=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',$kd_id) ->where('orders.confirmStatus','confirmed')
         ->where('orders.rom_order_confirmation','confirmed')

        ->where('orders.rom_adjusted_confirmation','confirmed')
         ->where('orders.tm_confirmation','confirmed')
        ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);



       
        $confirmed=count($clientconfirmed);


        // $client =client::where('distro_id',auth()->user()->id)->count();
        $deliveredOrders = order::where('handoverStatus','confirmed')->where('KD_id', $kd_id)->count();
        $activeOrders = order::where('confirmStatus','unconfirmed')->where('KD_id', $kd_id)->count();

   $returned= order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('ordered_products','ordered_products.order_id','=','orders.id')
        ->where('ordered_products.status','quantity_adjustment')
        ->where('orders.KD_id',$kd_id)->orderBy('created_at', 'DESC')->where('orders.confirmStatus','returned_acceptance')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);
        $returnedcount=count($returned);


         $client=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',$kd_id) ->where('orders.confirmStatus','confirmed')
        ->where('orders.rom_order_confirmation','confirmed')
        ->where('orders.rom_adjusted_confirmation','confirmed')
         ->where('orders.tm_confirmation','unconfirmed')
        ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);


        $unconfirmed=count($client);
        // echo auth()->user()->;
        return view('dashboard.tmDashboard',compact('client','deliveredOrders','activeOrders','unconfirmed','confirmed','returnedcount'));
    }

    public function create()
    {
        //
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
     * @param  \App\Models\key_distro  $key_distro
     * @return \Illuminate\Http\Response
     */
    public function show(key_distro $key_distro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\key_distro  $key_distro
     * @return \Illuminate\Http\Response
     */
    public function edit(key_distro $key_distro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\key_distro  $key_distro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, key_distro $key_distro)
    {
        //
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
