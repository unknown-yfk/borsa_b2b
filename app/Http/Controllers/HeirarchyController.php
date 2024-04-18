<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeirarchyController extends Controller
{
     public function handOver1(Request $request )
    {
        $order_id=$request->order_id;
        $rom = rom::join('users','users.id','=','roms.user_id')
        ->get(['users.firstName','users.middleName','users.lastName','roms.user_id']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)->get();
        return view('KD.deliveryList',compact('orderedProducts','rom'));

    }
    public function store(Request $request)
    {
        $order_id=$request->order_id;
        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)->get();
       $order = order::where('id',$order_id)->update(['handoverStatus'=> 'confirmed']);
        $products = \Cart::getcontent();
        $delivery1 = delivery1::create([
            'rom_id'=>$request->rom,
            'kd_id'=> auth()->user()->id,
            'order_id'=>$request->order_id,
            'deliveryTotalPrice'=>$request->total,
            'cico_confirmation'=> 'unconfirmed',



        ]);
        // iterate through the products and store them into the database
        foreach($products as $product){
            delivery1Products::create([
                'product_id' => $product->id,
                'delivery1_id' => $delivery1->id,
                'delivered_quantity' => $product->quantity,
                'subTotal' => $product->attributes->subtotal,

            ]);}
            $undeliveredOrders = undeliveredOrders::create([
                'rom_id'=>$request->rom,
                'kd_id'=> auth()->user()->id,
                'order_id'=>$request->order_id,
            ]);

            foreach($products as $product){

                undelivered1Products::create([
                    'product_id' => $product->id,
                    'undelivered1_id' => $undeliveredOrders->id,
                    'undelivered_quantity' => $product->attributes->ordered_quantity-$product->quantity,

                ]);}

        Alert::toast('Successfully Handovered', 'success');
         \Cart::clear();
        return redirect('/key_distroDashboard');
    }
    public function kdHandoverIndex( )
    {
        $rom=delivery1::join('users','users.id','=','delivery1s.rom_id')
        ->join('roms','roms.user_id','=','delivery1s.rom_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery1s.*'])->sortDesc();
        $deliveredProducts=delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get();
        return view('KD.handoverHistory',compact('deliveredProducts','rom'));

    }
    public function kdHandoverDetails(Request $request)
    {
        $id = $request->delivery1_id;
        $rom=delivery1::join('users','users.id','=','delivery1s.rom_id')
        ->join('roms','roms.user_id','=','delivery1s.rom_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery1s.*']);

        $deliveredProducts= delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();
        return view('KD.deliveryDetails',compact('deliveredProducts','rom'));

    }
}
