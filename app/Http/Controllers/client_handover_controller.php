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
use App\Models\undeliveredOrders;
use App\Models\undelivered1Products;
use App\Models\delivery_4s;
use App\Models\delivery_4products;
use RealRashid\SweetAlert\Facades\Alert;

class client_handover_controller extends Controller
{
    public function clientDeliveryIndex( )
    {
        $deliveredProducts=delivery_4products::join('delivery_4s','delivery_4products.delivery4_id','=','delivery_4s.id')
        ->join('products','products.id','=','delivery_4products.product_id')
        ->get();

        $delivery=delivery_4s::join('users','delivery_4s.sender_id','=','users.id')
        ->where('delivery_4s.client_id',auth()->user()->id)
        ->where('delivery_4s.confirmation_status','unconfirmed')
        ->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery_4s.*']);
       return view('client.new_deliveries',compact('deliveredProducts','delivery'));


    }


    public function clientDeliveryDetails(Request $request )
    {

        $id = $request->delivery4_id;
        $deliveredProducts = delivery_4products::join('delivery_4s','delivery_4s.id','=','delivery_4products.delivery4_id')
        ->join('products','products.id','=','delivery_4products.product_id')
        ->where('delivery_4s.client_id',auth()->user()->id)->where('delivery_4products.delivery4_id',$id)
        ->get();
       return view('client.deliveryDetails',compact('deliveredProducts'));

    }
    public function clientDeliveryDetailsindex(Request $request )
    {
        $id = $request->delivery_4s_id;
        $deliveredProducts = delivery_4products::join('delivery_4s','delivery_4s.id','=','delivery_4products.delivery4_id')
        ->join('products','products.id','=','delivery_4products.product_id')
        ->where('delivery_4s.client_id',auth()->user()->id)->where('delivery_4products.delivery4_id',$id)
        ->get();
        return view('client.deliverydetailview',compact('deliveredProducts'));

    }

    public function update(Request $request)
    {

        $delivery4update = delivery_4s::where('id',$request->delivery_4_id)->update([
            'confirmation_status'=>$request->confirm]);
            Alert::toast('delivery Confirmed', 'success');
        $orderupdate = order::where('id',$request->order_id)->update([
                'deliveryStatus'=>'Delivered','paymentStatus'=>'Confirm']);
        return redirect('/client_dash');
    }
    public function handOver(Request $request)
    {
        $id = $request->delivery_4_id;
        $deliveredProducts = delivery_4products::join('delivery_4s','delivery_4s.id','=','delivery_4products.delivery4_id')
        ->join('products','products.id','=','delivery_4products.product_id')
        ->where('delivery_4s.client_id ',auth()->user()->id)->where('delivery_4products.delivery4_id',$id)->get();
        return view('client.deliveryList',compact('deliveredProducts'));

    }
    public function clientDeliveryHistoryIndex()
    {
        $delivery = delivery_4s::join('users','users.id','=','delivery_4s.sender_id')
        ->where('delivery_4s.client_id',auth()->user()->id)->where('delivery_4s.confirmation_status','confirmed')
        ->get(['users.firstName','users.middleName'
        ,'users.lastName','users.userType','delivery_4s.*']);

        return view('client.oldOrders',compact('delivery'));

    }
}
