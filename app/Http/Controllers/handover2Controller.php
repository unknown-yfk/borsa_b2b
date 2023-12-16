<?php

namespace App\Http\Controllers;

use App\Models\rom;
use App\Models\rsp;
use App\Models\user;
use App\Models\order;
use App\Models\client;
use App\Models\delivery1;
use App\Models\delivery2;
use App\Models\delivery_4s;
use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\orderedProducts;
use App\Models\delivery1Products;
use App\Models\delivery2Products;
use App\Models\delivery_4products;
use App\Models\Handover_hierarchy;
use App\Models\undelivered2Orders;




use App\Models\undelivered2Products;
use RealRashid\SweetAlert\Facades\Alert;

class handover2Controller extends Controller
{
    public function handOver2(Request $request)
    {
        $id = $request->delivery1_id;
        $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();
        return view('ROM.deliveryList',compact('deliveredProducts'));

    }
    public function storerom(Request $request )
    {
        $order_id=$request->order_id;
        $products = \Cart::getcontent();
       $order = order::where('id',$order_id)->update(['handoverStatus'=> 'confirmed']);

        $delivery1 = delivery1::where('order_id',$order_id)->update(['handoverStatus'=> 'confirmed']);
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

            ]);
        }
        Alert::toast('successfully handovered', 'success');
        \Cart::clear();
        return redirect('/romDashboard');
    }


        public function storekd(Request $request )
    {
        $order_id=$request->order_id;
        $products = \Cart::getcontent();
        $order = order::where('id',$order_id)->update(['handoverStatus'=> 'confirmed']);

        $delivery1 = delivery1::where('order_id',$order_id)->update(['handoverStatus'=> 'confirmed']);
        $deliver2 = delivery2::create([
            // 'rom_id'=>auth()->user()->id,
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
            // 'rom_id'=>auth()->user()->id,
            'rsp_id'=>$request->rsp,
            'order_id'=>$request->order_id,

        ]);
        foreach($products as $product){
            undelivered2Products::create([
                'product_id' => $product->id,
                'undelivered2_id' => $undeliveredOrders2->id,
                'undelivered_quantity' => $product->attributes->recieved_quantity-$product->quantity,

            ]);
        }
        Alert::toast('successfully handovered', 'success');
        \Cart::clear();

        return redirect('/key_distroDashboard');

    }

public function fetchkd_account_number(){
$account=key_distro::where('id', $order_id)->get('client_id')
       ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        // ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();



        ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();

}

public function fetchclient_account_number(){
$account=client::join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        // ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();



        ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();

}


   public function last_page(Request $request)
    {
        $id = $request->delivery1_id;
        $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();
       Alert::toast('Successfully Handovered to client', 'success');
         \Cart::clear();

        return redirect('/romDashboard');

    }






public function handover_to_clientrom(Request $request )
      {
        $cartItems = \Cart::getContent();
           foreach($cartItems as $row) {
           $order_id = $row->attributes->order_id; // whatever properties your model have
    //
         }

        //   $orderedBy=order::where('orders.id',$order_id)->get('orderedBy');

          if ($request->orderedBy=='client')
          {

                $order_id=$request->order_id;
                $client_id=order::where('id', $order_id)->get('client_id');



            $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            ->where('ordered_products.order_id',$order_id)->get();
            $delivery1 = delivery1::where('order_id',$order_id)->update(['handoverStatus'=> 'confirmed']);

             $delivery_4 = delivery_4s::where('order_id',$order_id)->update(['confirmation_status'=> 'confirmed']);
            $order = order::where('id',$order_id);
            $products = \Cart::getcontent();

            $delivery_4 = delivery_4s::create([


                'order_id'=>$request->order_id,
                'sender_id'=> auth()->user()->id,
                'confirmation_status'=>'unconfirmed',


           'order_id'=>$request->order_id,
             'client_id'=>$client_id[0]->client_id,

                'deliveryTotalPrice'=>$request->total,

            ]);
            // iterate through the products and store them into the database
            foreach($products as $product){
                delivery_4products::create([

                    'product_id' => $product->product_id,
                    'delivery4_id' => $delivery_4->id,
                    'delivered_quantity' => $product->quantity,
                    'subTotal' => $product->attributes->subtotal,

                ]);}
            //     $undeliveredOrders = undeliveredOrders::create([

            //         'kd_id'=> auth()->user()->id,
            //         'order_id'=>$request->order_id,
            //     ]);

            //     foreach($products as $product){

            //         undelivered1Products::create([
            //             'product_id' => $product->id,
            //             'undelivered1_id' => $undeliveredOrders->id,
            //             'undelivered_quantity' => $product->attributes->ordered_quantity-$product->quantity,

            //         ]);}

            Alert::toast('Successfully Handovered to client', 'success');
             \Cart::clear();

            return redirect('/romDashboard');

          }



          elseif ($request->orderedBy=='agent'){



                    // $cartItems = \Cart::getContent();


    //        foreach($cartItems as $row) {


    //        $order_id = $row->attributes->order_id; // whatever properties your model have
    // //
    //      }
    $order_id = $request->order_id;


             $client=client::join('orders','orders.client_id','=','clients.user_id')
            //  ->join('clients','clients.user_id','=','users.id')

            ->where('orders.id',$order_id)
            ->get('clients.PinCode');



         $pin = $request->pinCode;

            if($client[0]->PinCode == $pin)
            {





                                  $hierarchy = Handover_hierarchy::where('status','1')->get();
        $order = order::all();
        // $cartItems = \Cart::getContent();



           $hierarchy_id=delivery1::get('hierarchy_id');

             if($hierarchy_id[count($hierarchy_id)-1]->hierarchy_id == 2) {


                   $order_id = $request->order_id;
     $id = $request->delivery1_id;


    $orderedBy=order::where('orders.id',$order_id)->get('orderedBy');
                //    $Kd_id=auth()->user()->id;
                   $products =\Cart::getContent();


$client=User::join('orders','orders.client_id','=','users.id')
                               ->where('orders.id',$order_id)
                               ->get(['users.firstName','users.middleName','users.lastName','users.id']);
                $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
            ->join('products','products.id','=','delivery1_products.product_id')
            ->join('orders','orders.id','=','delivery1s.order_id')
            ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
            ->join('clients','clients.user_id','=','orders.client_id')
            // ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();



            ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();
    //  echo  $id ;


            return view('ROM.payment_page', compact('products','hierarchy','client','orderedBy','order','order_id','deliveredProducts'));

            // return redirect('/rom/payment/');










                // return redirect()->route('orderProduct',['client_id'=>$request->client_id, 'KD_id'=>$request->KD_id]);
                  Alert::toast('Successfully Handovered to client', 'success');
             \Cart::clear();
             }
            // return redirect('/romDashboard');
            }
            else
            {

                   $order_id = $request->order_id;
     $id = $request->delivery1_id;

                   $orderedBy=order::where('orders.id',$order_id)->get('orderedBy');
                   $Kd_id=auth()->user()->id;
                   $products =\Cart::getContent();
                   $client=User::join('orders','orders.client_id','=','users.id')
                                ->where('orders.id',$order_id)
                               ->get(['users.firstName','users.middleName','users.lastName','users.id']);
                $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
            ->join('products','products.id','=','delivery1_products.product_id')
            ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();

                  Alert::toast('wrong pincode', 'warning');
    // return redirect('/delivery2CartList');
    // return redirect()->back();

                return view('ROM.handover_to_client', compact('products','client','orderedBy','order_id','deliveredProducts'));
            }




        }
    }
         public function rom_processPayment(Request $request)
{


$pay =  $request->input('payment');
     $selectedOption = $request->input('romflexRadioDefaultrom');
    $mainselectedOption = $request->input('flexRadioDefault');
    $provider = $request->input('provider');
    $tila = $request->input('tila');


     $id = $request->delivery1_id;


         $order_id=$request->order_id;
            $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)->get();

           $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
            ->join('products','products.id','=','delivery1_products.product_id')
            ->join('orders','orders.id','=','delivery1s.order_id')
            ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
            ->join('clients','clients.user_id','=','orders.client_id')
            ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();



        $updatehandover= order::where('id',$order_id)->update([
            'handoverStatus' => 'confirmed',
            'paymentStatus' => 'confirm',
            'deliveryStatus' => 'Delivered',

        ]);

 $transaction = transaction::create([
    'order_id' => $order_id,
    'total_price' => $request->total_price,
    'bank_name' => $request->input('provider') ? $request->input('provider') : $request->input('tila'),
    'from_client' => $request->from_bank_account,
    'to_kd' => $request->to_bank_account,
    'date' => $request->createdDate,
]);



        //   $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        // ->join('products','products.id','=','ordered_products.product_id')
        //        ->join('key_distros','key_distros.user_id','=','orders.KD_id')
        //     ->join('clients','clients.user_id','=','orders.client_id')
        // ->where('ordered_products.order_id',$order_id)
        // ->where('orders.KD_id',auth()->user()->id)
        // ->update([ ]);
// echo $selectedOption;
 Alert::toast('Successfully Paid', 'success');

//  echo $pay;

       return view('ROM.receipt_page', compact('deliveredProducts'));




    // }
    //    else {
    //     echo "A";
    //    }

}


    public function pincode_verify(Request $request)
    {




         $hierarchy = Handover_hierarchy::where('status','1')->get();
    $cartItems = \Cart::getContent();


    $order = order::all();

     $order_id=$request->order_id;




       foreach($cartItems as $row) {

     $order_id=$request->order_id;

	     $order_id = $row->attributes->order_id; // whatever properties your model have
//
     }

      $orderedBy=order::where('orders.id',$order_id)->get('orderedBy');


        //  $orders = $row->attributes->order_id;
        //  $Kd_id = auth()->user()->id;
         $products =\Cart::getContent();

         $client=User::join('orders','orders.client_id','=','users.id')

        ->where('orders.id',$order_id)
        ->get(['users.firstName','users.middleName'
        ,'users.lastName','users.id']);

        return view('ROM.clientpincode', compact('cartItems','products','hierarchy','client','orderedBy','order','order_id'));
        // return view('KD.Handover_to_client');



        // return view('KD.clientpincode');

    }


      public function pinCode_verify_post( Request $request)
    {
        $cartItems = \Cart::getContent();


       foreach($cartItems as $row) {


	     $order_id = $row->attributes->order_id; // whatever properties your model have
//
     }



         $client=client::join('orders','orders.client_id','=','clients.user_id')
        //  ->join('clients','clients.user_id','=','users.id')

        ->where('orders.id',$order_id)
        ->get('clients.PinCode');



     $pin = $request->pinCode;

        if($client[0]->PinCode == $pin)
        {



    //         $order_id=$request->order_id;
    //         $client_id=order::where('id', $order_id)->get('client_id');



    //     $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
    //     ->join('products','products.id','=','ordered_products.product_id')
    //     ->where('ordered_products.order_id',$order_id)->get();
    //     $delivery1 = delivery1::where('order_id',$order_id)->update(['handoverStatus'=> 'confirmed']);

    //      $delivery_4 = delivery_4s::where('order_id',$order_id)->update(['confirmation_status'=> 'confirmed']);
    //     $order = order::where('id',$order_id);
    //     $products = \Cart::getcontent();

    //     $delivery_4 = delivery_4s::create([


    //         'order_id'=>$request->order_id,
    //         'sender_id'=> auth()->user()->id,
    //         'confirmation_status'=>'unconfirmed',


    //    'order_id'=>$request->order_id,
    //      'client_id'=>$client_id[0]->client_id,

    //         'deliveryTotalPrice'=>$request->total,

    //     ]);

        // foreach($products as $product){
        //     delivery_4products::create([

        //         'product_id' => $product->id,
        //         'delivery4_id' => $delivery_4->id,
        //         'delivered_quantity' => $product->quantity,
        //         'subTotal' => $product->attributes->subtotal,

        //     ]);}











            //   Alert::toast('Successfully Handovered to client', 'success');
        //  \Cart::clear();

                  $hierarchy = Handover_hierarchy::where('status','1')->get();
    $order = order::all();
    // $cartItems = \Cart::getContent();



       $hierarchy_id=delivery1::get('hierarchy_id');

         if($hierarchy_id[count($hierarchy_id)-1]->hierarchy_id == 2) {


               $order_id = $request->order_id;
//  $id = $request->delivery1_id;
//  echo  $order_id ;

               $orderedBy=order::where('orders.id',$order_id)->get('orderedBy');
               $Kd_id=auth()->user()->id;
               $products =\Cart::getContent();
               $client=User::join('orders','orders.client_id','=','users.id')
                            ->where('orders.id',$order_id)
                           ->get(['users.firstName','users.middleName','users.lastName','users.id']);
        //     $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        // ->join('products','products.id','=','delivery1_products.product_id')
        // ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();
             $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('ordered_products','ordered_products.product_id','=','delivery1_products.product_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->join('users','users.id','=','delivery1s.kd_id')
        ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        ->where('delivery1s.confirmationStatus','confirmed')

        ->where('delivery1s.order_id',$request->order_id)
        ->where('ordered_products.order_id',$request->order_id)
        ->where('delivery1s.rom_id',auth()->user()->id)
        ->get();


            return view('ROM.payment_page', compact('products','hierarchy','client','orderedBy','order','order_id','deliveredProducts'));

        // return redirect('/rom/payment/');
        }
        }
        else
        {
             return redirect()->back()->withErrors("Wrong Pin Code");
        }




    }



          public function payment_page(Request $request)
    {

          $hierarchy = Handover_hierarchy::where('status','1')->get();
    $order = order::all();
    // $cartItems = \Cart::getContent();
//  $id = $request->delivery1_id;





       $hierarchy_id=delivery1::get('hierarchy_id');

         if($hierarchy_id[count($hierarchy_id)-1]->hierarchy_id == 2) {


               $order_id = $request->order_id;
//  $id = $request->delivery1_id;
//  echo  $order_id ;

               $orderedBy=order::where('orders.id',$order_id)->get('orderedBy');
            //    $Kd_id=auth()->user()->id;
               $products =\Cart::getContent();
               $client=User::join('orders','orders.client_id','=','users.id')
                            ->where('orders.id',$order_id)
                           ->get(['users.firstName','users.middleName','users.lastName','users.id']);
                        //    ->get();
        //     $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        // ->join('products','products.id','=','delivery1_products.product_id')
        // ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();


            return view('ROM.payment_page', compact('products','hierarchy','client','orderedBy','order','order_id','deliveredProducts'));




         }
}















        // return view('ROM.payment_page');
    // }







      public function deliveryToClient(Request $request)
    {
        $id = $request->delivery2_id;
        $deliverdOrder = delivery2::find($id);
        $user_id = Auth::id();
        $order_id = $deliverdOrder->order_id;
        $order = order::find($order_id);
        $client_id = $order->client_id;
        return view('ROM.qr_scanner',compact('client_id'));
    }









    public function romHandoverIndex( )
    {
    // {
    //     $delivery = delivery_4s::join('users','users.id','=','delivery_4s.client_id')
    //     ->join('clients','clients.user_id','=','delivery_4s.client_id')
    //     ->join('roms','roms.user_id','=','delivery1s.rom_id')

    //     ->where('delivery1s.rom_id',auth()->user()->id)->get(['users.firstName','users.middleName'
    //     ,'users.lastName','delivery_4s.*']);

        $delivery = delivery_4s::join('users', 'users.id', '=', 'delivery_4s.client_id')
    ->join('clients', 'clients.user_id', '=', 'delivery_4s.client_id')
    ->join('roms', 'roms.user_id', '=', 'delivery_4s.sender_id')
    ->where('delivery_4s.sender_id', auth()->user()->id)
    ->get(['users.firstName', 'users.middleName', 'users.lastName', 'delivery_4s.*']);

        $deliveredProducts = delivery_4Products::join('delivery_4s','delivery_4s.id','=','delivery_4products.delivery4_id')
        ->join('products','products.id','=','delivery_4products.product_id')
        ->where('delivery_4s.sender_id',auth()->user()->id)->get();
        return view('ROM.handoverHistory',compact('deliveredProducts','delivery'));

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
        return view('ROM.handoverDetials',compact('deliveredProducts','rsp'));

    }
    public function romUndeliveredIndex( )
    {
        $undelivered = undelivered2Orders::join('users','users.id','=','undelivered2_orders.rsp_id')
        ->join('rsps','rsps.user_id','=','undelivered2_orders.rsp_id')
        ->where('undelivered2_orders.rom_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','undelivered2_orders.*'])->sortDesc();
        return view('ROM.undeliveredOrders',compact('undelivered'));

    }
    public function romUndeliveredDetails(Request $request )
    {
        $id = $request->delivery1_id;
        $undeliveredProducts = undelivered2Products::join('undelivered2_orders','undelivered2_orders.id','=','undelivered2_products.undelivered2_id')
        ->join('products','products.id','=','undelivered2_products.product_id')
        ->where('undelivered2_orders.rom_id',auth()->user()->id)->where('undelivered2_products.undelivered2_id',$id)->get();
        return view('ROM.undeliveredDetails',compact('undeliveredProducts'));

    }
    public function rspDeliveryIndex( )
    {
        $rom=delivery2::join('users','users.id','=','delivery2s.rom_id')
        ->join('roms','roms.user_id','=','delivery2s.rom_id')
        ->where('delivery2s.rsp_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery2s.*']);

        $deliveredProducts=delivery2Products::join('delivery2s','delivery2s.id','=','delivery2_products.delivery2_id')
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

           public function delivery_search()
    {
     return view('ROM.delivery_search');
    }



      public function delivery_search_post(Request $request)
    {


        $client_unique_id =$request->client_unique_id ;
        $client_name = client::where('client_unique_id', $client_unique_id)->get();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
        // echo $client_unique_id;
        $clients = client::join('users','users.id','=','clients.user_id')
        ->where('users.userType','client')
        ->where('client_unique_id', $client_unique_id)
        ->get(['firstName','middleName','lastName','clients.user_id','distro_id','clients.pinCode']);
        $cartItems = \Cart::getContent();


if (count($clients) === 0)
 {

     $cartItems = \Cart::getContent();

        $client_unique_id =$request->client_unique_id ;
        $client_name = client::where('client_unique_id', $client_unique_id)->get();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
        // echo $client_unique_id;
        $client = order::join('users','users.id','=','orders.client_id')
            ->join('clients','clients.user_id','=','orders.client_id')
            ->where('orders.createdBy',auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.KD_id','orders.*']);

        $clients = client::join('users','users.id','=','clients.user_id')
        ->where('users.userType','client')
        ->where('client_unique_id', $client_unique_id)
        ->get(['firstName','middleName','lastName','clients.user_id','distro_id','clients.pinCode']);
        $cartItems = \Cart::getContent();

        Alert::toast('You entered wrong Client id', 'warning');


        // return view('orderCart.cart', compact('cartItems','clients','client','hierarchy','client_name'));
        return redirect()->back();




 }
            else {

                     $client_unique_id =$request->client_unique_id ;
        $client_name = client::where('client_unique_id', $client_unique_id)->get();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
        // echo $client_unique_id;
         $client = order::join('users','users.id','=','orders.client_id')
            ->join('clients','clients.user_id','=','orders.client_id')
            ->where('orders.createdBy',auth()->user()->id)
            ->where('client_unique_id', $client_unique_id)
            ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.KD_id','orders.*']);

        $clients = client::join('users','users.id','=','clients.user_id')
        ->where('users.userType','client')
        ->where('client_unique_id', $client_unique_id)
        ->get(['firstName','middleName','lastName','clients.user_id','distro_id','clients.pinCode']);
        $cartItems = \Cart::getContent();

        $delivery = delivery1::join('users','users.id','=','delivery1s.kd_id')
        ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        ->join('orders','orders.id','=','delivery1s.order_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('delivery1s.confirmationStatus','confirmed')
        ->where('clients.client_unique_id', $client_unique_id)
        ->where('delivery1s.rom_id',auth()->user()->id)
        ->where('delivery1s.handoverStatus','unconfirmed')
        ->where('orders.deliveryStatus','!=','Delivered')

        // ->get(['delivery1s.handoverStatus']);
  // ->distinct('order_id')
        ->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery1s.*']);

// echo $delivery;

       return view('ROM.oldDeliveries', compact('cartItems','clients','client','hierarchy','client_name','delivery'));

            }
        }





}
