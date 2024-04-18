<?php

namespace App\Http\Controllers;

use App\Models\rom;
use App\Models\rsp;
use App\Models\user;
use App\Models\order;
use App\Models\client;
use App\Models\agent;
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
use App\Models\Loan_products;
use App\Models\Loans;
use App\Models\cash_paid;
use App\Models\Loan_repayments;
use Illuminate\Support\Facades\DB;




use App\Models\undelivered2Products;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\LogActivity;

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
           $order_id = $row->attributes->order_id;
         }



            $order_id = $request->order_id;


             $client=client::join('orders','orders.client_id','=','clients.user_id')

            ->where('orders.id',$order_id)
            ->get('clients.PinCode');
            $pin = $request->pinCode;
            if($client[0]->PinCode == $pin)
            {

                    $hierarchy = Handover_hierarchy::where('status','1')->get();
                    $order = order::all();

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

       LogActivity::addToLog('handover to client');
       $loan=Loan_products::get(['max_amount']);

            return view('ROM.payment_page', compact('products','hierarchy','client','orderedBy','order','order_id','deliveredProducts','loan'));


                  Alert::toast('Successfully Handovered to client', 'success');
             \Cart::clear();
            //  }

            }
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
             LogActivity::addToLog('wrong pincode');


                  Alert::toast('wrong pincode', 'warning');

                return view('ROM.handover_to_client', compact('products','client','orderedBy','order_id','deliveredProducts'));
            }





    }
         public function rom_processPayment(Request $request)
{
     $loan=$request->input('loan');
     $cash=$request->input('cash');


     $pay =  $request->input('payment');
     $selectedOption = $request->input('romflexRadioDefaultrom');
    $mainselectedOption = $request->input('flexRadioDefault');
    $provider = $request->input('provider');
    $tila = $request->input('tila');


     $id = $request->delivery1_id;


         $order_id=$request->order_id;
         $client_id = order::where('id', $order_id)->first();

            $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)->get();

           $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
            ->join('products','products.id','=','delivery1_products.product_id')
            ->join('orders','orders.id','=','delivery1s.order_id')
            ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
            ->join('clients','clients.user_id','=','orders.client_id')
            ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();


            if ($client_id->orderedBy=='client')
                    {

                            $client_id_1=order::where('id', $order_id)->get('client_id');
                        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
                        ->join('products','products.id','=','ordered_products.product_id')
                        ->where('ordered_products.order_id',$order_id)->get();
                        $delivery1 = delivery1::where('order_id',$order_id)->update(['handoverStatus'=> 'confirmed']);

                        // $delivery_4 = delivery_4s::where('order_id',$order_id)->update(['confirmation_status'=> 'confirmed']);
                        $order = order::where('id',$order_id);

                        $products =  delivery1::join('delivery1_products','delivery1_products.delivery1_id','=','delivery1s.id')
                        ->where('order_id',$order_id)
                        ->get(['delivery1_products.*','delivery1s.*']);

                        $delivery_4 = delivery_4s::create([
                            'order_id'=>$request->order_id,
                            'sender_id'=> auth()->user()->id,
                            'confirmation_status'=>'unconfirmed',
                            'order_id'=>$request->order_id,
                            'client_id'=>$client_id_1[0]->client_id,
                            'deliveryTotalPrice'=>$request->total_price,

                        ]);

                        foreach($products as $product){

                            if($product->partial_quantity==0)
                            {
                                $delivered_quantity=$product->delivered_quantity;
                                $subtotal=$product->subTotal;

                            }
                            else if($product->partial_quantity !=0)
                            {
                                $delivered_quantity=$product->partial_quantity;
                                $subtotal=$product->partial_quantity*$product->subTotal/$product->delivered_quantity;

                            }


                            delivery_4products::create([

                                'product_id' => $product->product_id,
                                'delivery4_id' => $delivery_4->id,
                                'delivered_quantity' => $delivered_quantity,
                                'subTotal' => $subtotal,

                            ]);}


                    }
                elseif ($request->orderedBy=='agent')
                {
                      $updatehandover= order::where('id',$order_id)->update([
                                      'handoverStatus' => 'confirmed',
                                      'paymentStatus' => 'confirm',
                                     'deliveryStatus' => 'Delivered',

                                      ]);
                }


 $transaction = transaction::create([
    'order_id' => $order_id,
    'total_price' => $request->total_price,
    'bank_name' => $request->input('provider') ? $request->input('provider') : $request->input('tila'),
    'from_client' => $request->from_bank_account,
    'to_kd' => $request->to_bank_account,
    'date' => $request->createdDate,
]);

if($loan==0)
{
  $cash_create = cash_paid::create([
    'created_by' => auth()->user()->id,
    'client_id' => $client_id->client_id,
    'order_id' => $order_id,
    'amount' => $cash,

]);
}
else if($cash==0)
{
  $loan_period = Loan_products::first();

  $currentDate = new \DateTime();
  $currentDate->modify('+'.$loan_period->loan_period);

  $newDate = $currentDate->format('Y-m-d');

  $loan_create = Loans::create([
    'created_by' => auth()->user()->id,
    'client_id' => $client_id->client_id,
    'amount' => $loan,
    'expected_first_repayment' => $newDate,
    'order_id' => $order_id,
    'status' => 'pending',
    'remaining_amount' => $loan,
    'loan_product_id' => $client_id->id,
]);
}
else
{
    $loan_period = Loan_products::first();

  $currentDate = new \DateTime();
  $currentDate->modify('+'.$loan_period->loan_period);

  $newDate = $currentDate->format('Y-m-d');
 $loan_create = Loans::create([
    'created_by' => auth()->user()->id,
    'client_id' => $client_id->client_id,
    'amount' => $loan,
    'expected_first_repayment' => $newDate,
    'order_id' => $order_id,
    'status' => 'pending',
    'remaining_amount' => $loan,
    'loan_product_id' => $client_id->id,
  ]);
  $cash_create = cash_paid::create([
    'created_by' => auth()->user()->id,
    'client_id' => $client_id->client_id,
    'order_id' => $order_id,
    'amount' => $cash,

]);
}
      LogActivity::addToLog('order derliver paied');

      Alert::toast('Successfully Paid', 'success');



       return view('ROM.receipt_page', compact('deliveredProducts'));

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
         $loan=Loan_products::get(['max_amount']);


            return view('ROM.payment_page', compact('products','hierarchy','client','orderedBy','order','order_id','deliveredProducts','loan'));

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

             $loan=Loan_products::get(['max_amount']);
            return view('ROM.payment_page', compact('products','hierarchy','client','orderedBy','order','order_id','deliveredProducts','loan'));




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
    public function hierarchy_search()
    {
      $user_id=auth()->user()->id;
        $agents=agent::join('users','users.id','=','agents.user_id')
        ->where('agents.rom_id',$user_id)->get(['users.firstName','users.middleName','users.lastName','users.id']);

      // dd($agents);

     return view('ROM.hierarchy_search',compact('agents'));
    }

    public function delivery_search()
    {
      $user_id=auth()->user()->id;
        $agents=agent::join('users','users.id','=','agents.user_id')
        ->where('agents.rom_id',$user_id)->get(['users.firstName','users.middleName','users.lastName','users.id']);

      // dd($agents);

     return view('ROM.delivery_search',compact('agents'));
    }
     public function delivery_hierarchy_post(Request $request)
     {
        $hierarchy =$request->hierarchy;
        if($hierarchy=="client")
        {

        return view('ROM.delivery_search');
        }
        else if($hierarchy=="cico")
        {
         $user_id=auth()->user()->id;
        $agents=agent::join('users','users.id','=','agents.user_id')
        ->where('agents.rom_id',$user_id)->get(['users.firstName','users.middleName','users.lastName','users.id']);
        return view('ROM.delivery_search_cico',compact('agents'));

        }
     }
    public function delivery_search_cico_post(Request  $request)
   {
        $cico_id=$request->cico_id;
        $user_id=auth()->user()->id;


        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $regionFilters = $request->input('region_filter');
        $cityFilters = $request->input('city_filter');


        $uniqueRegions = client::distinct()->pluck('Region')->toArray();
        $uniqueCities = [];

          $client = delivery1::select(
                    'users.firstName',
                    'users.middleName',
                    'users.lastName',
                    'delivery1s.deliveryTotalPrice',
                    'orders.created_at',
                    'delivery1s.id',
                    'clients.City',
                    'clients.Region',
                    DB::raw('GROUP_CONCAT(products.productlist_id) AS product_ids'),
                    DB::raw('GROUP_CONCAT(products.id) AS productt_ids'),
                    DB::raw('GROUP_CONCAT(products.price) AS product_price'),
                    DB::raw('GROUP_CONCAT( delivery1_products.subTotal) AS price'),
                    DB::raw('GROUP_CONCAT(delivery1_products.delivered_quantity) AS ordered_quantities'),
                    DB::raw('GROUP_CONCAT(orders.price_update) AS price_updates'),

                )
                ->join('orders', 'orders.id', '=', 'delivery1s.order_id')
                ->join('users', 'users.id', '=', 'orders.client_id')
                ->join('clients', 'clients.user_id', '=', 'orders.client_id')
                ->leftjoin('agents','agents.user_id','=','clients.agent_id')
                ->leftJoin('delivery1_products', 'delivery1_products.delivery1_id', '=', 'delivery1s.id')
                ->leftJoin('products', 'products.id', '=', 'delivery1_products.product_id')

                ->where('delivery1s.rom_id','=',$user_id)

                ->where('delivery1s.confirmationStatus','=','confirmed')
                ->where('delivery1s.handoverStatus','=','unconfirmed')
                ->where('orders.deliveryStatus','!=','Delivered')
                ->where('delivery1s.handover_to_cico','=','unconfirmed')

                ->where('agents.rom_id','=',$user_id)
                ->where('agents.user_id',$cico_id)
                ->where('delivery1s.Hierarchy_id','=','5')
                ->groupBy('orders.id','users.firstName',
                'users.middleName',
                'users.lastName',
                'delivery1s.deliveryTotalPrice',
                'orders.created_at',
                'delivery1s.id',
                'clients.City',
                'clients.Region')
                ->orderBy('orders.created_at', 'DESC');

                 if ($fromDate && $toDate) {
                $client->whereBetween('orders.created_at', [$fromDate, $toDate]);
            }


            if (!$regionFilters) {
                $uniqueCities = client::distinct()->pluck('City')->toArray();
            }

            if ($regionFilters) {
                $client->whereIn('clients.Region', $regionFilters);


                $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


                if ($cityFilters) {
                    $client->whereIn('clients.City', $cityFilters);
                }
            } elseif ($cityFilters) {
                $client->whereIn('clients.City', $cityFilters);
            }

             $client=$client->get();
             $new=count($client);

            $product = delivery1::join('delivery1_products', 'delivery1_products.delivery1_id', '=', 'delivery1s.id')
                ->join('products', 'products.id', '=', 'delivery1_products.product_id')
                ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
                ->groupBy('productlist.id', 'productlist.name')
                ->get(['productlist.name', 'productlist.id']);


        return view('ROM.handover_to_cico',compact('product', 'uniqueRegions', 'uniqueCities','client','new','cico_id'));


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
         ->where('delivery1s.Hierarchy_id','=','2')
        ->where('orders.Hierarchy_id','=','2')

        ->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery1s.*']);

       return view('ROM.oldDeliveries', compact('cartItems','clients','client','hierarchy','client_name','delivery'));

            }
        }
       public function handover_cico(Request  $request)
       {

        $orders=$request->input('orders');
        foreach ($orders as $detail)
        {
        $order_id = $detail['orderId'];

        $order = delivery1::where('id',$order_id)->update(['handover_to_cico'=> 'confirmed','cico_id'=>$request->cico_id] );
        }
         LogActivity::addToLog('handover to CICO');

        Alert::toast('Successfully Handovered', 'success');


          return redirect('/romDashboard');
       }
      public function hierarchy_search_cico(Request  $request)
       {
        return view('agent.delivery_search');
       }
       public function delivery_search_post_cico(Request $request)
       {
        $client_unique_id =$request->client_unique_id ;
        $client_name = client::where('client_unique_id', $client_unique_id)->get();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
        $clients = client::join('users','users.id','=','clients.user_id')
        ->where('users.userType','client')
        ->where('client_unique_id', $client_unique_id)
        ->where('agent_id', auth()->user()->id)
        ->get(['firstName','middleName','lastName','clients.user_id','distro_id','clients.pinCode']);
        $cartItems = \Cart::getContent();


        if (count($clients) === 0)
        {
                Alert::toast('You entered wrong Client id', 'warning');
                return redirect()->back();
        }
        else
        {
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
                    ->where('agent_id', auth()->user()->id)
                    ->get(['firstName','middleName','lastName','clients.user_id','distro_id','clients.pinCode']);
                    $cartItems = \Cart::getContent();

                    $delivery = delivery1::join('users','users.id','=','delivery1s.kd_id')
                    ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
                    ->join('orders','orders.id','=','delivery1s.order_id')
                    ->join('clients','clients.user_id','=','orders.client_id')
                    ->where('delivery1s.confirmationStatus','confirmed')
                    ->where('clients.client_unique_id', $client_unique_id)
                    ->where('clients.agent_id', auth()->user()->id)
                    ->where('delivery1s.cico_id',auth()->user()->id)
                    ->where('delivery1s.handoverStatus','unconfirmed')
                    ->where('orders.deliveryStatus','!=','Delivered')
                    ->where('delivery1s.cico_confirmation','confirmed')

                    // ->get(['delivery1s.handoverStatus']);
            // ->distinct('order_id')
                    ->get(['users.firstName','users.middleName'
                    ,'users.lastName','delivery1s.*']);

            // echo $delivery;

                return view('agent.oldDeliveries', compact('cartItems','clients','client','hierarchy','client_name','delivery'));

        }


       }
    public function handover_to_clientagent(Request $request)
    {
      $cartItems = \Cart::getContent();
        foreach($cartItems as $row)
        {
           $order_id = $row->attributes->order_id;
         }

            $order_id = $request->order_id;

             $client=client::join('orders','orders.client_id','=','clients.user_id')
            ->where('orders.id',$order_id)
            ->get();
         $pin = $request->pinCode;
        if($client[0]->PinCode == $pin)
        {

                $hierarchy = Handover_hierarchy::where('status','1')->get();
                $order = order::all();
                $hierarchy_id=delivery1::get('hierarchy_id');

             if($hierarchy_id[count($hierarchy_id)-1]->hierarchy_id == 2 || $hierarchy_id[count($hierarchy_id)-1]->hierarchy_id == 5 )
             {
                    $order_id = $request->order_id;
                    $id = $request->delivery1_id;


                 $orderedBy=order::where('orders.id',$order_id)->get('orderedBy');

                 $products =\Cart::getContent();


                    $client=User::join('orders','orders.client_id','=','users.id')
                                    ->where('orders.id',$order_id)
                                    ->get(['users.firstName','users.middleName','users.lastName','users.id']);
                    $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
                    ->join('products','products.id','=','delivery1_products.product_id')
                    ->join('orders','orders.id','=','delivery1s.order_id')
                    ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
                    ->join('clients','clients.user_id','=','orders.client_id')
                    ->where('delivery1s.cico_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();

                    $loan=Loan_products::get(['max_amount']);

                    LogActivity::addToLog('handover to client');

                    return view('agent.loan_process', compact('products','hierarchy','client','orderedBy','order','order_id','deliveredProducts','loan'));
                    Alert::toast('Successfully Handovered to client', 'success');

             }


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
            ->where('delivery1s.cico_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();
            LogActivity::addToLog('wrong pincode');
            Alert::toast('wrong pincode', 'warning');
            return view('agent.handover_to_client', compact('products','client','orderedBy','order_id','deliveredProducts'));
            }




        }



     public function agent_processPayment(Request $request)
{

     $loan=$request->input('loan');
     $cash=$request->input('cash');

     $pay =  $request->input('payment');
     $selectedOption = $request->input('romflexRadioDefaultrom');
    $mainselectedOption = $request->input('flexRadioDefault');
    $provider = $request->input('provider');
    $tila = $request->input('tila');


     $id = $request->delivery1_id;


         $order_id=$request->order_id;
         $client_id = order::where('id', $order_id)->first();

            $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)->get();

           $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
            ->join('products','products.id','=','delivery1_products.product_id')
            ->join('orders','orders.id','=','delivery1s.order_id')
            ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
            ->join('clients','clients.user_id','=','orders.client_id')
            ->where('delivery1s.cico_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$id)->get();

        if($deliveredProducts[0]->orderedBy=='client')
        {
            $order_id=$request->order_id;
            $client_id1=order::where('id', $order_id)->get('client_id');
            $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            ->where('ordered_products.order_id',$order_id)->get();
            $delivery1 = delivery1::where('order_id',$order_id)->update(['handoverStatus'=> 'confirmed']);

            $delivery_4 = delivery_4s::where('order_id',$order_id)->update(['confirmation_status'=> 'confirmed']);
            $order = order::where('id',$order_id);
            $products =  delivery1::join('delivery1_products','delivery1_products.delivery1_id','=','delivery1s.id')
            ->where('order_id',$order_id)
            ->get(['delivery1_products.*','delivery1s.*']);

            $delivery_4 = delivery_4s::create([


                'order_id'=>$request->order_id,
                'sender_id'=> auth()->user()->id,
                'confirmation_status'=>'unconfirmed',
            'order_id'=>$request->order_id,
            'client_id'=>$client_id1[0]->client_id,
                'deliveryTotalPrice'=>$request->total_price,

            ]);

            foreach($products as $product){

                if($product->partial_quantity==0)
                {
                    $delivered_quantity=$product->delivered_quantity;
                    $subtotal=$product->subTotal;

                }
                else if($product->partial_quantity !=0)
                {
                    $delivered_quantity=$product->partial_quantity;
                    $subtotal=$product->partial_quantity*$product->subTotal/$product->delivered_quantity;

                }


                delivery_4products::create([

                    'product_id' => $product->product_id,
                    'delivery4_id' => $delivery_4->id,
                    'delivered_quantity' => $delivered_quantity,
                    'subTotal' => $subtotal,

                ]);}
        }
        else
        {
          $updatehandover= order::where('id',$order_id)->update([
            'handoverStatus' => 'confirmed',
            'paymentStatus' => 'confirm',
            'deliveryStatus' => 'Delivered',

        ]);
        }



 $transaction = transaction::create([
    'order_id' => $order_id,
    'total_price' => $request->total_price,
    'bank_name' => $request->input('provider') ? $request->input('provider') : $request->input('tila'),
    'from_client' => $request->from_bank_account,
    'to_kd' => $request->to_bank_account,
    'date' => $request->createdDate,
]);
if($loan==0)
{
  $cash_create = cash_paid::create([
    'created_by' => auth()->user()->id,
    'client_id' => $client_id->client_id,
    'order_id' => $order_id,
    'amount' => $cash,

]);
}
else if($cash==0)
{
  $loan_period = Loan_products::first();

  $currentDate = new \DateTime();
  $currentDate->modify('+'.$loan_period->loan_period);

  $newDate = $currentDate->format('Y-m-d');

  $loan_create = Loans::create([
    'created_by' => auth()->user()->id,
    'client_id' => $client_id->client_id,
    'amount' => $loan,
    'expected_first_repayment' => $newDate,
    'order_id' => $order_id,
    'status' => 'pending',
    'remaining_amount' => $loan,
    'loan_product_id' => $client_id->id,
]);
}
else
{
    $loan_period = Loan_products::first();

  $currentDate = new \DateTime();
  $currentDate->modify('+'.$loan_period->loan_period);

  $newDate = $currentDate->format('Y-m-d');
 $loan_create = Loans::create([
    'created_by' => auth()->user()->id,
    'client_id' => $client_id->client_id,
    'amount' => $loan,
    'expected_first_repayment' => $newDate,
    'order_id' => $order_id,
    'status' => 'pending',
    'remaining_amount' => $loan,
    'loan_product_id' => $client_id->id,
  ]);
  $cash_create = cash_paid::create([
    'created_by' => auth()->user()->id,
    'client_id' => $client_id->client_id,
    'order_id' => $order_id,
    'amount' => $cash,

]);
}
       LogActivity::addToLog('order derliver paied');

 Alert::toast('Successfully Paid', 'success');

       return view('ROM.receipt_page', compact('deliveredProducts'));


}
 public function repayment()
 {
      return view('agent.repayment');

 }
 public function repayment_search(Request $request)
 {
      $client_unique_id=$request->client_unique_id;

      $clients = client::join('users','users.id','=','clients.user_id')
                    ->where('users.userType','client')
                    ->where('clients.client_unique_id', $client_unique_id)
                    ->where('clients.agent_id', auth()->user()->id)
                    ->get(['users.firstName','users.middleName','users.lastName','clients.user_id','clients.distro_id','clients.pinCode']);

      if($clients)
      {

        $loans=Loans::where('client_id',$clients[0]->user_id)
        ->where('status',"pending")->get();

        if($loans[0]->remaining_amount==0)
        {
           Alert::toast('You have no unpaid loan', 'warning');
           return redirect()->back();

        }
        else
        {
          return view('agent.repayment_view',compact('loans'));

        }

      }
      else
      {
         Alert::toast('Client not found', 'warning');
        return redirect()->back();

      }

 }
 public function repayment_pay(Request  $request)
{

    $currentDate = new \DateTime();
    $new_remaining=$request->remaining_amount - $request->repayment_amount;
    $pay=Loans::where('id',$request->id)->update(['remaining_amount' => $new_remaining,'status' => 'done']);
    Loan_repayments::create([
     'loan_id' => $request->id,
     'paid_amount' => $request->repayment_amount,
     'date' => $currentDate
    ]);
     Alert::toast('Successfully Paid', 'success');
     return view('agent.remaining',compact('new_remaining'));

}

}
