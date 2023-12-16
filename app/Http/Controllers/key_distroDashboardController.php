<?php

namespace App\Http\Controllers;

use App\Models\key_distro;
use App\Models\client;
use App\Models\order;
use Illuminate\Http\Request;
use Auth;

class key_distroDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $client=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)
        ->where('orders.confirmStatus','confirmed')
        ->where('orders.rom_order_confirmation','confirmed')
        ->where('orders.rom_adjusted_confirmation','confirmed')
         ->where('orders.tm_confirmation','unconfirmed')
        ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);

        //  $client=order::join('users','users.id','=','orders.client_id')
        // ->join('clients','clients.user_id','=','orders.client_id')
        // ->where('orders.KD_id',auth()->user()->id) ->where('orders.confirmStatus','unconfirmed')
        // ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        // ,'users.lastName','orders.*']);

          $clientconfirmed=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id) ->where('orders.confirmStatus','confirmed')
         ->where('orders.tm_confirmation','confirmed')
        ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);


        $unconfirmed=count($client);
        $confirmed=count($clientconfirmed);


        // $client =client::where('distro_id',auth()->user()->id)->count();
        $deliveredOrders = order::where('handoverStatus','confirmed')->where('KD_id', Auth::id())->count();
        $activeOrders = order::where('confirmStatus','unconfirmed')->where('KD_id', Auth::id())->count();

   $returned= order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('ordered_products','ordered_products.order_id','=','orders.id')
        ->where('ordered_products.status','quantity_adjustment')
        ->where('orders.KD_id',auth()->user()->id)->orderBy('created_at', 'DESC')->where('orders.confirmStatus','returned_acceptance')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);
        $returnedcount=count($returned);



        return view('dashboard.kdDashboard',compact('client','deliveredOrders','activeOrders','unconfirmed','confirmed','returnedcount'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
