<?php

namespace App\Http\Controllers;

use App\Models\tm;
use App\Models\rom;
use App\Models\rsp;
use App\Models\user;
use App\Models\order;
use App\Models\client;

use App\Models\product;
use App\Models\delivery1;
use App\Models\delivery_4s;

use App\Models\transaction;


use Illuminate\Http\Request;

use App\Models\orderedProducts;
use App\Models\delivery1Products;
use App\Models\undeliveredOrders;
use App\Models\delivery_4products;
use App\Models\Handover_hierarchy;
use App\Models\undelivered1Products;
use RealRashid\SweetAlert\Facades\Alert;

class handoverController extends Controller
{
 public function tmHandoverDetails(Request $request)
    {
       $id = $request->delivery1_id;
       $tms_all=tm::where('user_id',auth()->user()->id)->get();
        $kd_id=$tms_all[0]->kd_id;
        $rom=delivery1::join('users','users.id','=','delivery1s.rom_id')
        ->join('roms','roms.user_id','=','delivery1s.rom_id')
        ->where('delivery1s.kd_id',$kd_id)->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery1s.*']);

        $deliveredProducts= delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.kd_id',$kd_id)->where('delivery1_products.delivery1_id',$id)->get();
        return view('TM.deliveryDetails',compact('deliveredProducts','rom'));
    }
    public function handOver1(Request $request )
    {
        $orderedBy=$request->orderedBy;
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
            'Hierarchy_id'=>'4',

            'deliveryTotalPrice'=>$request->total,

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




    public function kdHandoverNextpage(Request $request )
    {

      if ($request->hierarchy == 1){

                  $order = order::all();
         $auth = auth()->user()->userName;
        $order_id=$request->order_id;

      $orderedBy=order::where('orders.id',$order_id)->get('orderedBy');

 $orders=order::all();

        $hierarchy = Handover_hierarchy::where('status','1')->get();

         $auth = auth()->user()->userName;

        $client = User::join('orders','orders.client_id','=','users.id')
                            ->where('orders.id',$order_id)
                           ->get(['users.firstName','users.middleName','users.lastName','users.id']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)
        ->get();



         $Kd_id=auth()->user()->id;

        return view('KD.Handover_to_client', compact('hierarchy','client','orderedBy','order','order_id','orderedProducts'));

     }

     if ($request->hierarchy == 2){

        $order_id=$request->order_id;


        $rom_unique_id = $request-> rom_unique_id ;
        $rom_name = rom::where('rom_unique_id', $rom_unique_id)->get();

        $products = \Cart::getcontent();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
        $cartItems = \Cart::getContent();
       if($rom_unique_id=="")
        {
            $rom_unique_id="undefined";
        }
        $rom=rom::join('users','users.id','=','user_id')
                 ->where('rom_unique_id', $rom_unique_id)
                 ->get();

         $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)
        ->get();
         
                 if (count($rom) === 0) {


                         return view('KD.Handover_to_rom', compact('cartItems','rom','products','hierarchy','orderedProducts'));



                 }

                 else  {

                return view('KD.fetch-rom_id', compact('cartItems','rom','products','hierarchy'));
                 }


     }

     if ($request->hierarchy == 3){
              return redirect('/key_distro/Handover_to_rsp');


     }

    if ($request->hierarchy == 4){
              return redirect('/key_distro/Handover_to_all');

    }

    }






    public function tmHandoverNextpage(Request $request )
    {
//
if ($request->hierarchy == 1){
            //   return redirect('/key_distro/Handover_to_client');


                  $order = order::all();



        // $hierarchy = Handover_hierarchy::where('status','1')->get();

         $auth = auth()->user()->userName;
        $order_id=$request->order_id;
        // $client = order::join('users','users.id','=','orders.client_id')
        // ->join('clients','clients.user_id','=','orders.client_id')
        // ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        // ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        // $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        // ->join('products','products.id','=','ordered_products.product_id')
        // ->where('ordered_products.order_id',$order_id)->get();

      $orderedBy=order::where('orders.id',$order_id)->get('orderedBy');

 $orders=order::all();

        $hierarchy = Handover_hierarchy::where('status','1')->get();

         $auth = auth()->user()->userName;
        // $order_id=$request->order_id;
        $client = User::join('orders','orders.client_id','=','users.id')
                            ->where('orders.id',$order_id)
                           ->get(['users.firstName','users.middleName','users.lastName','users.id']);
        // ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        // ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)
        ->get();


// echo $order_id;
         $Kd_id=auth()->user()->id;

        return view('TM.Handover_to_client', compact('hierarchy','client','orderedBy','order','order_id','orderedProducts'));
        // return view('KD.Handover_to_client');








     }

     if ($request->hierarchy == 2){
            //   return redirect('/key_distro/Handover_to_rom');

        $order_id=$request->order_id;


                  $rom_unique_id = $request-> rom_unique_id ;
        $rom_name = rom::where('rom_unique_id', $rom_unique_id)->get();

        $products = \Cart::getcontent();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
        $cartItems = \Cart::getContent();
         //dd($cartItems);
        $rom=rom::join('users','users.id','=','user_id')
                 ->where('rom_unique_id', $rom_unique_id)
                 ->get();

                       $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)
        ->get();

                //  if (count($rom) === 0) {

                    // success('The success message to display');
                         return view('TM.Handover_to_rom', compact('cartItems','rom','products','hierarchy','orderedProducts'));
                // return A;


                //  }

                //  else  {

                // return view('TM.fetch-rom_id', compact('cartItems','rom','products','hierarchy'));
                //  }


     }

     if ($request->hierarchy == 3){
              return redirect('/tm/Handover_to_rsp');


     }

    if ($request->hierarchy == 4){
              return redirect('/tm/Handover_to_all');

    }   
    }






















      public function filter_deliveries( )


    {

    //       public function filter_deliveries_post( Request $request)


    // {

    // }
      $client_unique_id = $request-> client_unique_id ;
        $clients = client::join('users','users.id','=','clients.user_id')
        ->where('users.userType','client')
        ->where('clients.client_unique_id', $client_unique_id)
        ->get(['users.firstName','users.middleName','users.lastName','clients.user_id','clients.distro_id','clients.pinCode']);


        $client_unique_id = $request-> client_unique_id ;
        $client_name = client::where('client_unique_id', $client_unique_id)->get();
        $kd_name = client::join('users','users.id','=','clients.distro_id')->where('client_unique_id', $client_unique_id)->get(['firstName','middleName','lastName']);
        //   echo count($client_name);


             if (count($client_name) === 0){
        Alert::toast('You entered wrong Client id', 'warning');

                return redirect()->back();
            }


            elseif( $client_name[0]->client_unique_id == $request-> client_unique_id) {


            return view('agent.client_info_display', compact('clients','client_name','kd_name'));

            }



        // return view('KD.Handover_to_rom');

    }

    public function fetch_client(Request $request)


    {

        $cartItems = \Cart::getContent();

               foreach($cartItems as $row) {


	     $order_id = $row->attributes->order_id; // whatever properties your model have
//
     }

      $orderedBy=order::where('orders.id',$order_id)->get('orderedBy');


         $orders = $row->attributes->order_id;
         $Kd_id=auth()->user()->id;

        $client_unique_id = $request-> client_unique_id ;
        $client_name = client::where('client_unique_id', $client_unique_id)->get();

        $products = \Cart::getcontent();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
         //dd($cartItems);
         $c=client::join('users','users.id','=','clients.user_id')->get('clients.client_unique_id');
        $clients=client::join('users','users.id','=','clients.user_id')->where('client_unique_id', $client_unique_id)
                 ->get(['users.firstName','users.middleName'
        ,'users.lastName','clients.user_id']);

        return view('KD.fetch-client_id', compact('cartItems','clients','products','hierarchy','orderedBy','order_id'));





    }




       public function Handover_to_client(Request $request)


       {



    $order = order::all();



        $hierarchy = Handover_hierarchy::where('status','1')->get();

         $auth = auth()->user()->userName;
        $order_id=$request->order_id;
        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)->get();

      $orderedBy=order::where('orders.id',$order_id)->get('orderedBy');

 $orders=order::all();

        $hierarchy = Handover_hierarchy::where('status','1')->get();

         $auth = auth()->user()->userName;
        // $order_id=$request->order_id;
        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)
        ->get();


// echo $order_id;
         $Kd_id=auth()->user()->id;

        // return view('KD.Handover_to_client', compact('hierarchy','client','orderedBy','order','order_id','orderedProducts'));
        // return view('KD.Handover_to_client');



    }

       public function Handover_to_client_store(Request $request )
  {



    $cartItems = \Cart::getContent();

       foreach($cartItems as $row) {


	     $order_id = $row->attributes->order_id; // whatever properties your model have

     }

    //   $orderedBy=order::where('orders.id',$order_id)->get('orderedBy');


    //   if ($request->orderedBy=='client')
    //   {

            // $order_id=$request->order_id;
            // $client_id=order::where('id', $order_id)->get('client_id');



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
        // iterate through the products and store them into the database
        // foreach($products as $product){
        //     delivery_4products::create([

        //         'product_id' => $product->id,
        //         'delivery4_id' => $delivery_4->id,
        //         'delivered_quantity' => $product->quantity,
        //         'subTotal' => $product->attributes->subtotal,

        //     ]);}
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

    //     Alert::toast('Successfully Handovered to client', 'success');
    //      \Cart::clear();

    //     return redirect('/romDashboard');

    //   }



    //   elseif ($request->orderedBy=='agent'){



                // $cartItems = \Cart::getContent();


//        foreach($cartItems as $row) {


// 	     $order_id = $row->attributes->order_id; // whatever properties your model have
// //
//      }
// $order_id = $request->order_id;


//          $client=client::join('orders','orders.client_id','=','clients.user_id')
//         //  ->join('clients','clients.user_id','=','users.id')

//         ->where('orders.id',$order_id)
//         ->get('clients.PinCode');



    //  $pin = $request->pinCode;

    //     if($client[0]->PinCode == $pin)
    //     {





    //                           $hierarchy = Handover_hierarchy::where('status','1')->get();
    // $order = order::all();
    // $cartItems = \Cart::getContent();



//        $hierarchy_id=delivery1::get('hierarchy_id');

//          if($hierarchy_id[count($hierarchy_id)-1]->hierarchy_id == 1) {


//                $order_id = $request->order_id;
//  $id = $request->delivery1_id;

//                $orderedBy=order::where('orders.id',$order_id)->get('orderedBy');
//             //    $Kd_id=auth()->user()->id;
//                $products =\Cart::getContent();
//                $client=User::join('orders','orders.client_id','=','users.id')
//                             ->where('orders.id',$order_id)
//                            ->get(['users.firstName','users.middleName','users.lastName','users.id']);
//             $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
//         ->join('products','products.id','=','delivery1_products.product_id')
//         ->join('orders','orders.id','=','delivery1s.order_id')
//         ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
//         ->join('clients','clients.user_id','=','orders.client_id')
//         // ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();



//         ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();
//  echo  $orderedBy ;


            // return view('ROM.payment_page', compact('products','hierarchy','client','orderedBy','order','order_id','deliveredProducts'));

        // return redirect('/rom/payment/');










            // return redirect()->route('orderProduct',['client_id'=>$request->client_id, 'KD_id'=>$request->KD_id]);
        //       Alert::toast('Successfully Handovered to client', 'success');
        //  \Cart::clear();
        //  }
        // return redirect('/romDashboard');
        // }
        // else
        // {

//                $order_id = $request->order_id;
//  $id = $request->delivery1_id;

//                $orderedBy=order::where('orders.id',$order_id)->get('orderedBy');
//                $Kd_id=auth()->user()->id;
//                $products =\Cart::getContent();
//                $client=User::join('orders','orders.client_id','=','users.id')
//                             ->where('orders.id',$order_id)
//                            ->get(['users.firstName','users.middleName','users.lastName','users.id']);
//             $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
//         ->join('products','products.id','=','delivery1_products.product_id')
//         ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();

//               Alert::toast('wrong pincode', 'warning');
// return redirect('/delivery2CartList');
// return redirect()->back();

    //         return view('ROM.handover_to_client', compact('products','client','orderedBy','order_id','deliveredProducts'));
    //     }




    // }





























        $order_id=$request->order_id;
    //   ;
    // $client_id=order::where('order_id',$order_id)->get('client_id');


      $orderedBy=order::where('orders.id',$order_id)->get('orderedBy');

// echo $request->orderedBy;
      if ($request->orderedBy=='client')
      {

            $order_id=$request->order_id;

            $client_id=order::where('id', $order_id)->get('client_id');


        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)->get();


       $order = order::where('id',$order_id)->update(['handoverStatus'=> 'confirmed']);

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

                'product_id' => $product->id,
                'delivery4_id' => $delivery_4->id,
                'delivered_quantity' => $product->quantity,
                'subTotal' => $product->attributes->subtotal,

            ]);}
            $undeliveredOrders = undeliveredOrders::create([

                'kd_id'=> auth()->user()->id,
                'order_id'=>$request->order_id,
            ]);

            foreach($products as $product){

                undelivered1Products::create([
                    'product_id' => $product->id,
                    'undelivered1_id' => $undeliveredOrders->id,
                    'undelivered_quantity' => $product->attributes->ordered_quantity-$product->quantity,

                ]);}

        Alert::toast('Successfully Handovered to client', 'success');
         \Cart::clear();



        return redirect('/key_distroDashboard');

      }



      elseif ($request->orderedBy=='agent'){


//       $cartItems = \Cart::getContent();


//        foreach($cartItems as $row) {


// 	     $order_id = $row->attributes->order_id; // whatever properties your model have
// //
//      }
//      echo $cartItems;
// $order_id = $request->order_id;


         $client=client::join('orders','orders.client_id','=','clients.user_id')
        //  ->join('clients','clients.user_id','=','users.id')

        ->where('orders.id',$order_id)
        ->get('clients.PinCode');



     $pin = $request->pinCode;

        if($client[0]->PinCode == $pin)
        {


                    // $order_id=$request->order_id;

            // $client_id=order::where('id', $order_id)->get('client_id');

            // $order_id = $request->order_id;

    //   $client=client::join('orders','orders.client_id','=','clients.user_id')
    //     //  ->join('clients','clients.user_id','=','users.id')

    //     ->where('orders.id',$order_id)
    //     ->get('clients.PinCode');



    //  $pin = $request->pinCode;

    //     if($client[0]->PinCode == $pin)
    //     {




        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
               ->join('key_distros','key_distros.user_id','=','orders.KD_id')
            ->join('clients','clients.user_id','=','orders.client_id')
        ->where('ordered_products.order_id',$order_id)
        ->where('orders.KD_id',auth()->user()->id)
        ->get();
        // echo $orderedProducts;
         return view('KD.payment_page', compact('orderedProducts'));








    //    $order = order::where('id',$order_id)->update(['handoverStatus'=> 'confirmed']);

        //  $delivery_1 = delivery1::where('order_id',$order_id)->update(['handoverStatus'=> 'confirmed']);
    //     $order = order::where('id',$order_id);
    //     $products = \Cart::getcontent();
        // echo $orderedProducts;



        // $delivery_4 = delivery_4s::create([


        //     'order_id'=>$request->order_id,
        //     'sender_id'=> auth()->user()->id,
        //     'confirmation_status'=>'unconfirmed',


        //     'order_id'=>$request->order_id,
        //     'client_id'=>$client_id[0]->client_id,

        //     'deliveryTotalPrice'=>$request->total,

        // ]);

        // return redirect('/key_distro/client_pincode_verification');



            }

     }
    }




          public function payment_page(Request $request)
    {

          $hierarchy = Handover_hierarchy::where('status','1')->get();
    $order = order::all();
    // $cartItems = \Cart::getContent();
//  $id = $request->delivery1_id;





       $hierarchy_id=delivery1::get('hierarchy_id');

         if($hierarchy_id[count($hierarchy_id)-1]->hierarchy_id == 1) {


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


            return view('KD.payment_page', compact('products','hierarchy','client','orderedBy','order','order_id','deliveredProducts'));




         }
}






public function processPayment(Request $request)
{

    // echo "a";
    //   $order_id=$request->order_id;
    // Get the value of the flexRadioDefault radio input
    $selectedOption = $request->input('flexRadioDefault');
    $mainselectedOption = $request->input('flexRadioDefault');
    $provider = $request->input('provider');
    $tila = $request->input('tila');

    // tila
    //  if ($provider === 'cbe_birr') {
    //     // echo "a";
    // Alert::toast('Not allowed for unilever client', 'warning');


    //     return redirect()->back();
    // }



// echo $selectedOption;
    // Do something with the selected option
    if ($selectedOption) {
        // echo "a";
    // Alert::toast('Not allowed for unilever client', 'warning');


    //     return redirect()->back();
    // } else {


         $order_id=$request->order_id;
           $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
               ->join('key_distros','key_distros.user_id','=','orders.KD_id')
            ->join('clients','clients.user_id','=','orders.client_id')
        ->where('ordered_products.order_id',$order_id)
        ->where('orders.KD_id',auth()->user()->id)
        ->get();
        // echo $provider;

        $updatehandover= order::where('id',$order_id)->update([
            'handoverStatus' => 'confirmed',
            'paymentStatus' => 'confirm',
            'deliveryStatus' => 'Delivered',

        ]);
        // $updatepayment= order::where('id',$order_id)->update(['handoverStatus' => 'confirmed']);


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
// echo $orderedProducts;
 Alert::toast('Successfully Paid', 'success');


       return view('KD.receipt_page', compact('orderedProducts'));


        // Handle Other option

}
}









    public function pincode_verify()
    {






         $hierarchy = Handover_hierarchy::where('status','1')->get();
    $cartItems = \Cart::getContent();


    $order = order::all();



       foreach($cartItems as $row) {


	     $order_id = $row->attributes->order_id; // whatever properties your model have
//
     }

      $orderedBy=order::where('orders.id',$order_id)->get('orderedBy');


         $orders = $row->attributes->order_id;
         $Kd_id = auth()->user()->id;
         $products =\Cart::getContent();

         $client=User::join('orders','orders.client_id','=','users.id')

        ->where('orders.id',$order_id)
        ->get(['users.firstName','users.middleName'
        ,'users.lastName','users.id']);

        return view('KD.clientpincode', compact('cartItems','products','hierarchy','client','orderedBy','order','order_id'));
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







       $order = order::where('id',$order_id)->update(['handoverStatus'=> 'confirmed']);


            // return redirect()->route('orderProduct',['client_id'=>$request->client_id, 'KD_id'=>$request->KD_id]);
              Alert::toast('Successfully Handovered to client', 'success');
         \Cart::clear();

        return redirect('/key_distroDashboard');
        }
        else
        {
             return redirect()->back();
              Alert::toast('Wrong PinCode', 'warning');

        }




    }


       public function Handover_to_all()
    {

      $products = \Cart::getcontent();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
       $cartItems = \Cart::getContent();
         //dd($cartItems);
        $rom=rom::join('users','users.id','=','roms.user_id')

        ->get(['users.firstName','users.middleName'
        ,'users.lastName','roms.user_id']);
        return view('KD.deliveryCartlist1', compact('cartItems','rom','products','hierarchy'));



        // return view('KD.Handover_to_rom');



    }



      public function Handover_to_rom(Request $request)


    {
        $order_id = $request ->order_id;
          $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)->get();
// echo $order_id;
      $products = \Cart::getcontent();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
       $cartItems = \Cart::getContent();
         //dd($cartItems);
        $rom=rom::join('users','users.id','=','roms.user_id')
        ->get(['users.firstName','users.middleName','users.lastName','roms.user_id']);

         return view('KD.Handover_to_rom', compact('cartItems','rom','products','hierarchy','orderedProducts'));



        // return view('KD.Handover_to_rom');

    }



      public function fetch_rom(Request $request)


    {

         $order_id = $request ->order_id;
          $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)->get();

        $rom_unique_id = $request-> rom_unique_id ;
        $rom_name = rom::where('rom_unique_id', $rom_unique_id)->get();

        $products = \Cart::getcontent();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
        $cartItems = \Cart::getContent();
         //dd($cartItems);
        $rom=rom::join('users','users.id','=','user_id')
                 ->where('rom_unique_id', $rom_unique_id)
                 ->get();

                //  if($rom_name)

                 if (count($rom) === 0) {

                    // return back();
                 if (count($rom_name) === 0) {
                     Alert::toast('Incorrect ROM ID', 'warning');
                         return view('KD.Handover_to_rom', compact('cartItems','rom','products','hierarchy','orderedProducts'))->with('warning','Dont Open this link');


                 }


                    // success('The success message to display');
                // return A;


                 }

                 else  {


                return view('KD.fetch-rom_id', compact('cartItems','rom','products','hierarchy','orderedProducts'));
                 }

    }



     public function tm_fetch_rom(Request $request)


    {

            $order_id = $request ->order_id;
          $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')

        ->where('ordered_products.order_id',$order_id)->get();

        $rom_unique_id = $request-> rom_unique_id ;
        $rom_name = rom::where('rom_unique_id', $rom_unique_id)->get();

        $products = \Cart::getcontent();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
        $cartItems = \Cart::getContent();
         //dd($cartItems);
        $rom=rom::join('users','users.id','=','user_id')
                 ->where('rom_unique_id', $rom_unique_id)
                 ->get();

                 if (count($rom) === 0) {

                    // success('The success message to display');
                         return view('TM.Handover_to_rom', compact('cartItems','rom','products','hierarchy'))->with('warning','Dont Open this link');
                // return A;


                 }

                 else  {

                return view('TM.fetch-rom_id', compact('cartItems','rom','products','hierarchy','orderedProducts'));
                 }


    }



public function Handover_to_rom_post(Request $request )

    {

  $order_id=$request->order_id;
        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)->get();

       $order = order::where('id',$order_id)->update(['handoverStatus'=> 'confirmed']);
    //    $delivery1 = delivery1::where('id',$order_id)->update(['Hierarchy_id'=> '1']);

        $products = \Cart::getcontent();
        $rom_unique_id = $request-> rom_user_id ;

         $rom=rom::join('users','users.id','=','roms.user_id')
                 ->where('rom_unique_id', $rom_unique_id)
                 ->get('roms.user_id');

        $delivery1 = delivery1::create([
            'rom_id'=>$request-> rom_user_id,
            'kd_id'=> auth()->user()->id,
            'order_id'=>$request->order_id,
            'Hierarchy_id'=>'2',
            'handoverStatus'=>'unconfirmed',
            'confirmationStatus'=> 'unconfirmed',
            'deliveryTotalPrice'=>$request->total,

        ]);
        // iterate through the products and store them into the database

        foreach($orderedProducts as $product){
            if ($product->kd_adjusted_quantity === 0) {
               $subTotal = $product->price * $product->ordered_quantity;
                $delivered_quantity = $product->ordered_quantity;
            } else {
                 $subTotal = $product->price * $product->ordered_quantity - $product->price * $product->kd_adjusted_quantity;
                $delivered_quantity = $product->kd_adjusted_quantity;

            }


            // $new_stock=$stock[0]->Qty - $delivered_quantity;
            // $products_update = product::where('id',$product->id)->update(['Qty'=> $new_stock]);
            // Create the delivery1Products record using the calculated subTotal
            delivery1Products::create([
                'product_id' => $product->id,
                'delivery1_id' => $delivery1->id,
                'delivered_quantity' => $delivered_quantity,
                'subTotal' => $subTotal,
            ]);}
            $undeliveredOrders = undeliveredOrders::create([
                'rom_id'=>$request-> rom_user_id,
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


    public function tm_Handover_to_rom_post(Request $request )

    {
$order_id=$request->order_id;
        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)->get();

       $order = order::where('id',$order_id)->update(['handoverStatus'=> 'confirmed']);
    //    $delivery1 = delivery1::where('id',$order_id)->update(['Hierarchy_id'=> '1']);

        $products = \Cart::getcontent();
        $rom_unique_id = $request-> rom_user_id ;

         $rom=rom::join('users','users.id','=','roms.user_id')
                 ->where('rom_unique_id', $rom_unique_id)
                 ->get('roms.user_id');

      $tm=tm::join('users','users.id','=','tms.user_id')
             ->where('users.id',auth()->user()->id)
             ->get();

     $tmkd_id = $tm[0]->kd_id;
    //  echo $orderedProducts;

        $delivery1 = delivery1::create([
            'rom_id'=>$request-> rom_user_id,
            'kd_id'=> $tmkd_id,
            'order_id'=>$request->order_id,
            'Hierarchy_id'=>'2',
            'handoverStatus'=>'unconfirmed',
            'confirmationStatus'=> 'unconfirmed',
            'deliveryTotalPrice'=>$request->total,

        ]);
        // echo $orderedProducts;
        // iterate through the products and store them into the database

        foreach($orderedProducts as $product){
            // echo $product;
             if ($product->kd_adjusted_quantity === 0) {
                $subTotal = $product->subTotal/$product->ordered_quantity * $product->ordered_quantity;
                $delivered_quantity = $product->ordered_quantity;


            } else {
                $subTotal = $product->subTotal/$product->kd_adjusted_quantity *  $product->kd_adjusted_quantity;
                $delivered_quantity = $product->kd_adjusted_quantity;

            }
            // echo $product;




            delivery1Products::create([
                'product_id' => $product->id,
                'delivery1_id' => $delivery1->id,
                'delivered_quantity' => $delivered_quantity,
                'subTotal' => $subTotal,
            ]);}
            $undeliveredOrders = undeliveredOrders::create([
                'rom_id'=>$request-> rom_user_id,
                'kd_id'=> $tmkd_id,
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


        return redirect('/tmDashboard');
                   }
    // }




       public function fetch_rsp(Request $request)


    {

        $rsp_unique_id = $request-> rsp_unique_id ;
        $rsp_name = rsp::where('rsp_unique_id', $rsp_unique_id)->get();

        $products = \Cart::getcontent();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
        $cartItems = \Cart::getContent();
         //dd($cartItems);
        $rsp=rsp::join('users','users.id','=','rsps.user_id')
                 ->where('rsp_unique_id', $rsp_unique_id)
                 ->get(['users.firstName','users.middleName'
        ,'users.lastName','rsps.user_id']);
        return view('KD.fetch-rsp_id', compact('cartItems','rsp','products','hierarchy'));





    }


       public function Handover_to_rsp( )
    {
     $products = \Cart::getcontent();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
       $cartItems = \Cart::getContent();
         //dd($cartItems);
        $rom=rom::join('users','users.id','=','roms.user_id')
        ->get(['users.firstName','users.middleName'
        ,'users.lastName','roms.user_id']);

       $rsp=rsp::join('users','users.id','=','rsps.user_id')
        ->get(['users.firstName','users.middleName'
        ,'users.lastName','rsps.user_id']);
        return view('KD.Handover_to_rsp', compact('cartItems','rom','products','hierarchy','rsp'));
        // return view('KD.Handover_to_rsp');



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


        public function tmHandoverIndex( )
    {
        $tms_all=tm::where('user_id',auth()->user()->id)->get();
        $kd_id=$tms_all[0]->kd_id;

        $rom=delivery1::join('users','users.id','=','delivery1s.rom_id')
        ->join('roms','roms.user_id','=','delivery1s.rom_id')
        ->where('delivery1s.KD_id',$kd_id)


        ->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery1s.*'])->sortDesc();
        $deliveredProducts=delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
           ->where('delivery1s.KD_id', $kd_id)
        ->get();
        return view('TM.handoverHistory',compact('deliveredProducts','rom'));



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
    public function kdUndeliveredIndex( )
    {
        $UndeliverdOrders = undeliveredOrders::join('users','users.id','=','undelivered_orders.rom_id')
        ->join('roms','roms.user_id','=','undelivered_orders.rom_id')
        ->where('undelivered_orders.kd_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','undelivered_orders.*'])->sortDesc();

        $deliveredProducts=delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get();
        return view('KD.undeliveredOrders',compact('deliveredProducts','UndeliverdOrders'));

    }
    public function kdUndeliveredDetails(Request $request )
    {
        $id=$request->delivery1_id;
        $rom=delivery1::join('users','users.id','=','delivery1s.rom_id')
        ->join('roms','roms.user_id','=','delivery1s.rom_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery1s.*']);
        $deliveredProducts=undelivered1Products::join('undelivered_orders','undelivered_orders.id','=','undelivered1_products.undelivered1_id')
        ->join('products','products.id','=','undelivered1_products.product_id')
        ->where('undelivered_orders.kd_id',auth()->user()->id)->where('undelivered1_products.undelivered1_id',$id)->get();
        return view('KD.undeliveredDetails',compact('deliveredProducts','rom'));

    }
    public function romDeliveryIndex(Request $request )
    {

         $order_id=$request->order_id;
        $delivery = delivery1::join('users','users.id','=','delivery1s.kd_id')
        ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')->where('delivery1s.confirmationStatus','unconfirmed')
        ->where('delivery1s.rom_id',auth()->user()->id)->get();

        $deliveredProducts=delivery1::join('users','users.id','=','delivery1s.kd_id')
        ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        // ->join('clients','clients.user_id','=','orders.client_id')
        // ->where('client_unique_id', $client_unique_id)
        ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1s.confirmationStatus','unconfirmed')
        ->where('delivery1s.handoverStatus','unconfirmed')->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery1s.*']);
        // echo $deliveredProducts;

        return view('ROM.newDeliveries',compact('deliveredProducts','delivery'));

    }
    public function romDeliveryHistoryIndex( Request $request)

    {

  $delivery = delivery1::join('users','users.id','=','delivery1s.kd_id')
        ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        // ->join('clients','clients.user_id','=','orders.client_id')
        ->where('client_unique_id', $client_unique_id)
        ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1s.confirmationStatus','confirmed')
        ->where('delivery1s.handoverStatus','unconfirmed')->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery1s.*']);
  $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get();

// $orderIds = delivery1::where('rom_id', auth()->user()->id)
//     ->where('confirmationStatus', 'confirmed')
//     ->where('handoverStatus', 'unconfirmed')
//     ->distinct('order_id')
//     ->pluck('order_id');

// $deliveries = delivery1::join('users', 'users.id', '=', 'delivery1s.kd_id')
//     ->join('key_distros', 'key_distros.user_id', '=', 'delivery1s.kd_id')
//     ->whereIn('delivery1s.order_id', $orderIds)
//     ->groupBy('delivery1s.order_id')
//     ->get();

// retrieve the unique order IDs of the deliveries
// $orderIds = $deliveries->unique('order_id')->pluck('order_id');
        // echo $delivery;


        return view('ROM.oldDeliveries',compact('deliveredProducts','delivery'));

    }




    public function romDeliveryDetails(Request $request )

    {
         $order_id=$request->order_id;

        $id = $request->delivery1_id;
        $user_id=auth()->user()->id;
        $delivery = delivery1::join('users','users.id','=','delivery1s.rom_id')
        ->where('delivery1s.rom_id',$user_id)
        ->first(['users.firstName','users.middleName','users.lastName','delivery1s.*']);

        $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('ordered_products','ordered_products.product_id','=','delivery1_products.product_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->join('users','users.id','=','delivery1s.kd_id')
        ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        // ->where('delivery1s.confirmationStatus','confirmed')
        // ->where('delivery1s.handoverStatus','unconfirmed')


        ->where('delivery1s.order_id',$order_id)
        ->where('ordered_products.order_id',$order_id)
        ->where('delivery1s.rom_id',auth()->user()->id)
        // ->distinct('delivery1_products.id')
        // ->get(['delivery1_products.id AS unique_id','ordered_products.*','products.*','users.*','key_distros.*','delivery1s.*']);

        ->get();



        // ->get();

      return view('ROM.deliveryDetails',compact('deliveredProducts','delivery'));
        // echo $deliveredProducts;



    }

        public function rom_newDeliveryDetails(Request $request )
    {
         $order_id=$request->order_id;

        $id = $request->delivery1_id;
        $delivery = delivery1::join('users','users.id','=','delivery1s.rom_id')

        ->where('delivery1s.rom_id',auth()->user()->id)
        ->get(['users.firstName','users.middleName','users.lastName','delivery1s.*']);
        $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
            ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.confirmationStatus','unconfirmed')
        ->join('users','users.id','=','delivery1s.kd_id')
        ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        ->where('delivery1s.order_id',$order_id)
        ->where('delivery1s.rom_id',auth()->user()->id)->get();
        return view('ROM.newdeliverydetails',compact('deliveredProducts','delivery'));
    }




    public function update(Request $request,)
    {
        $delivery1update = delivery1::where('id',$request->delivery1s_id)->update([
            'confirmationStatus'=>$request->confirm]);
            Alert::toast('delivery Confirmed', 'success');
        return redirect('/romDashboard');
    }

}


