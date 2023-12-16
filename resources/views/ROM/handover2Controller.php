<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderedProducts;
use App\Models\order;
use App\Models\client;
use App\Models\user;
use App\Models\rsp;
use App\Models\rom;
use App\Models\delivery1;
use App\Models\delivery1Products;
use App\Models\delivery2;
use App\Models\delivery2Products;
use App\Models\undelivered2Orders;
use App\Models\undelivered2Products;

use RealRashid\SweetAlert\Facades\Alert;

class handover2Controller extends Controller
{
    public function handOver2(Request $request )
    {
        $order_id=$request->delivery1_id;
        $deliveredProducts=delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$order_id)->get();
        return view('ROM.deliveryList',compact('deliveredProducts'));

    }
    public function store(Request $request )
    {
        $order_id=$request->order_id;
        $delivery1 = delivery1::find($order_id);
        $delivery1->update(['handoverStatus' => 'confirmed']);
        $products = \Cart::getcontent();
        $deliver2 = delivery2::create([
            'rom_id'=>auth()->user()->id,
            'rsp_id'=>$request->rsp,
            'order_id'=>$request->order_id,
            'deliveryTotalPrice'=>$request->total
        ]);



        // iterate through the products and store them into the database

        foreach($products as $product){
            delivery2Products::create([
                'product_id' => $product->id,
                'delivery2_id' => $deliver2->id,
                'delivered_quantity' => $product->quantity,
                'subTotal' => $product->attributes->subtotal,

            ]);
        }
        $undeliveredOrders2 = undelivered2Orders::create([
            'rom_id'=>auth()->user()->id,
            'rsp_id'=>$request->rsp,
            'order_id'=>$request->order_id,

        ]);

        foreach($products as $product){
            undelivered2Products::create([
                'product_id' => $product->id,
                'undelivered2_id' => $undeliveredOrders2->id,
                'undelivered_quantity' => $product->attributes->recieved_quantity-$product->quantity,

            ]);}
        Alert::toast('Successfully Handovered', 'success');
        return redirect('/romDashboard');
    }
    public function romHandoverIndex( )
    {
        $rsp=delivery2::join('users','users.id','=','delivery2s.rsp_id')
        ->join('rsps','rsps.user_id','=','delivery2s.rsp_id')
        ->where('delivery2s.rom_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery2s.*']);

        $deliveredProducts=delivery2Products::join('delivery2s','delivery2s.id','=','delivery2_products.delivery2_id')
        ->join('products','products.id','=','delivery2_products.product_id')
        ->where('delivery2s.rom_id',auth()->user()->id)->get();
        return view('ROM.handoverHistory',compact('deliveredProducts','rsp'));

    }
    public function romHandoverDetails(Request $request )
    {
        $delivery2_id=$request->delivery2_id;

        $rsp=delivery2::join('users','users.id','=','delivery2s.rsp_id')
        ->join('rsps','rsps.user_id','=','delivery2s.rsp_id')
        ->where('delivery2s.rom_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery2s.*']);

        $deliveredProducts=delivery2Products::join('delivery2s','delivery2s.id','=','delivery2_products.delivery2_id')
        ->join('products','products.id','=','delivery2_products.product_id')
        ->where('delivery2s.rom_id',auth()->user()->id)->where('delivery2_products.delivery2_id',$delivery2_id)->get();



        return view('ROM.deliveryDetails',compact('deliveredProducts','rsp'));

    }
    public function romUndeliveredIndex( )
    {


        $rsp=undelivered2Orders::join('users','users.id','=','undelivered2_orders.rsp_id')
        ->join('rsps','rsps.user_id','=','undelivered2_orders.rsp_id')
        ->where('undelivered2_orders.rom_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','undelivered2_orders.*'])->sortDesc();



        return view('ROM.undeliveredOrders',compact('rsp'));

    }
    public function kdUndeliveredDetails(Request $request )
    {
        $rom_id=$request->delivery1_id;

        $rom=delivery1::join('users','users.id','=','delivery1s.rom_id')
        ->join('roms','roms.user_id','=','delivery1s.rom_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery1s.*']);

        $deliveredProducts=undelivered1Products::join('undelivered_orders','undelivered_orders.id','=','undelivered1_products.undelivered1_id')
        ->join('products','products.id','=','undelivered1_products.product_id')
        ->where('undelivered_orders.kd_id',auth()->user()->id)->where('undelivered1_products.undelivered1_id',$rom_id)->get();



        return view('KD.undeliveredDetails',compact('deliveredProducts','rom'));

    }




    public function rspDeliveryIndex( )
    {

        $rom = delivery2::join('users','users.id','=','delivery2s.rom_id')
        ->join('roms','roms.user_id','=','delivery2s.rom_id')
        ->where('delivery2s.rsp_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery2s.*']);

        $deliveredProducts = delivery2Products::join('delivery2s','delivery2s.id','=','delivery2_products.delivery2_id')
        ->join('products','products.id','=','delivery2_products.product_id')
        ->where('delivery2s.rsp_id',auth()->user()->id)->get();


        return view('RSP.newDeliveries',compact('deliveredProducts','rom'));

    }



    public function rspDeliveryDetails(Request $request )
    {
        $delivery2_id=$request->delivery2_id;

        $rom=delivery2::join('users','users.id','=','delivery2s.rom_id')
        ->join('roms','roms.user_id','=','delivery2s.rom_id')
        ->where('delivery2s.rsp_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery2s.*']);

        $deliveredProducts=delivery2Products::join('delivery2s','delivery2s.id','=','delivery2_products.delivery2_id')
        ->join('products','products.id','=','delivery2_products.product_id')
        ->where('delivery2s.rsp_id',auth()->user()->id)->where('delivery2_products.delivery2_id',$delivery2_id)->get();



        return view('RSP.deliveryDetails',compact('deliveredProducts','rom'));

    }
    public function update(Request $request)
    {

        $delivery2update = delivery2::where('id',$request->delivery2s_id)->update([
            'confirmationStatus'=>$request->confirm]);

            Alert::toast('delivery Confirmed', 'success');

        return redirect('/rspDashboard');
    }
}
