<?php

namespace App\Http\Controllers;

use App\Models\tm;
use App\Models\user;
use App\Models\agent;
use App\Models\order;

use App\Models\client;
use App\Models\product;
use Illuminate\Http\Request;
use App\Models\orderedProducts;

use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\CartCollection;
use App\Http\Controllers\CartController;
use RealRashid\SweetAlert\Facades\Alert;

class orderedProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(auth()->user()->userType==='agent') {


        $client = order::join('users','users.id','=','orders.client_id')
            ->join('clients','clients.user_id','=','orders.client_id')
            ->where('orders.createdBy',auth()->user()->id)
            ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.KD_id','orders.*']);

        $kd = order::join('users','users.id','=','orders.KD_id')->
        join('key_distros','key_distros.user_id','=','orders.KD_id')
        ->where('orders.createdBy',auth()->user()->id)->get();

        return view('agent.showOrders',compact('client','kd'));



        }
        elseif (auth()->user()->userType==='client') {
        $client = order::join('users','users.id','=','orders.client_id')
            ->join('clients','clients.user_id','=','orders.client_id')
            ->where('orders.createdBy',auth()->user()->id)
            ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.KD_id','orders.*']);

        $kd = order::join('users','users.id','=','orders.KD_id')->
        join('key_distros','key_distros.user_id','=','orders.KD_id')
        ->where('orders.createdBy',auth()->user()->id)->get();

        return view('client.showOrders',compact('client','kd'));
        }

        // elseif (auth()->user()->userType==='client') {


        // $client = order::join('users','users.id','=','orders.client_id')
        //     ->join('clients','clients.user_id','=','orders.client_id')
        //     ->where('orders.createdBy',auth()->user()->id)
        //     ->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.KD_id','orders.*']);

        // $kd = order::join('users','users.id','=','orders.KD_id')->
        // join('key_distros','key_distros.user_id','=','orders.KD_id')
        // ->where('orders.createdBy',auth()->user()->id)->get();

        // return view('client.showOrders',compact('client','kd'));
        // }

    }
    public function kdView()
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
        $unconfirmed=count($client);
        // echo $client;
        return view('KD.showOrders',compact('client'));
    }

        public function tmView()
    {

         $tm=tm::join('users','users.id','=','tms.user_id')
             ->where('users.id',auth()->user()->id)
             ->get();

     $tmkd_id = $tm[0]->kd_id;


         $client=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')


//  ->whereIn('orders.KD_id', function($query) {
//                     $query->select('kd_id')
//                           ->distinct()
//                           ->from('tms');
//                 })


        ->where('orders.confirmStatus','confirmed')
        ->where('orders.KD_id',$tmkd_id)

        ->where('orders.rom_order_confirmation','confirmed')
        ->where('orders.rom_adjusted_confirmation','confirmed')
         ->where('orders.tm_confirmation','unconfirmed')
        //  ->where('orders.price_update','0')

        ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);


        // echo auth()->user()->tm;
        $clients=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        // ->join('tm','tm.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->kd_id)
        ->where('orders.confirmStatus','confirmed')
        ->where('orders.rom_order_confirmation','confirmed')
        ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);
        $unconfirmed=count($client);
        //  echo $client;
        return view('TM.showOrders',compact('client'));
    }
public function romViewhistory()
    {
        $romId = auth()->id();
        // $client=order::;
        $client=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        // ->where('orders.KD_id',auth()->user()->id)
        ->where('orders.confirmStatus','!=','unconfirmed')
        ->where('orders.rom_id',$romId)

        // ->where('orders.rom_order_confirmation','confirmed')
        ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*','clients.City','clients.Region']);
        $new=count($client);

        // echo $client;
        return view('ROM.showOrdershistory',compact('client','new'));
    }
        public function romView()
    {
       $romId = auth()->id();
        // $client=order::;
        $client=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        // ->where('orders.KD_id',auth()->user()->id)
        ->where('orders.confirmStatus','unconfirmed')
        ->where('orders.rom_id',$romId)

        // ->where('orders.rom_order_confirmation','confirmed')
        ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*','clients.City','clients.Region']);
        $new=count($client);        
        return view('ROM.showOrders',compact('client','new'));
    }



    public function orderHistory()
    {
        $client= order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->orderBy('created_at', 'DESC')
         ->where('orders.confirmStatus','confirmed')
        ->where('orders.tm_confirmation','confirmed')
        ->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);

        return view('KD.orderHistory',compact('client'));

    }

        public function tm_orderHistory()
    {

          $tm=tm::join('users','users.id','=','tms.user_id')
             ->where('users.id',auth()->user()->id)
             ->get();

     $tmkd_id = $tm[0]->kd_id;



        $client= order::join('users','users.id','=','orders.client_id')
     ->join('clients','clients.user_id','=','orders.client_id')
        // ->join('agents', 'orders.rom_id', '=', 'agents.rom_id')

//  ->whereIn('orders.KD_id', function($query) {
//                     $query->select('kd_id')
//                           ->distinct()
//                           ->from('tms');
//                 })


        ->where('orders.confirmStatus','confirmed')
        ->where('orders.rom_order_confirmation','confirmed')
        ->where('orders.KD_id',$tmkd_id)
        ->where('orders.rom_adjusted_confirmation','confirmed')
         ->where('orders.tm_confirmation','confirmed')
        ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*','clients.Region','clients.City']);

        return view('TM.orderHistory',compact('client'));

    }

      public function returned_order()
    {
        $client= order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('ordered_products','ordered_products.order_id','=','orders.id')
        ->where('ordered_products.status','quantity_adjustment')
        ->where('orders.KD_id',auth()->user()->id)->orderBy('created_at', 'DESC')->where('orders.confirmStatus','returned_acceptance')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);

        return view('KD.Returned_order',compact('client'));

    }

          public function rom_returned_order()
    {
        $client= order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('ordered_products','ordered_products.order_id','=','orders.id')
        // ->where('ordered_products.status','quantity_adjustment')
        ->where('orders.confirmStatus','returned_acceptance')
        // ->where('orders.rom_order_confirmation','confirmed')


        ->where('orders.rom_order_confirmation','confirmed')
        ->where('orders.rom_adjusted_confirmation','unconfirmed')


        ->where('orders.rom_id',auth()->user()->id)->orderBy('created_at', 'DESC')->where('orders.confirmStatus','returned_acceptance')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);

        return view('ROM.Returned_order',compact('client'));

    }

          public function kd_accept(Request $request)
    {
          $orderupdate = order::where('id',$request->order_id)
            ->update(['confirmStatus'=>'confirmed']);
    //  return view('agent.');""
        Alert::toast('Order Accepted', 'success');

            return redirect('/key_distroDashboard');

    }

          public function kd_decline(Request $request)
    {
       $orderupdate = order::where('id',$request->order_id)
            ->update(['confirmStatus'=>'declined']);
    //  return view('agent.');""
        Alert::toast('Order Declined', 'success');

                 return redirect('/key_distroDashboard');


    }

              public function rom_accept(Request $request)
    {
          $orderupdate = order::where('id',$request->order_id)
            ->update([
                'confirmStatus'=>'confirmed',
                'rom_adjusted_confirmation'=>'confirmed',
                // 'confirmStatus'=>'confirmed',

            ]);
              $productss = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            ->where('ordered_products.status','!=','refusal')
            ->where('ordered_products.order_id',$request->order_id)
            ->get();
                foreach($productss as $row) {
            $stock=product::where('id',$row->product_id)
            ->get('Qty');
            if($row->kd_adjusted_quantity == 0)
            {
           $new_qty=$stock[0]->Qty - $row->ordered_quantity;

            $stock_update=product::where('id',$row->product_id)
            ->update(['Qty'=> $new_qty]);
            }
            else
            {
            $new_qty=$stock[0]->Qty - $row->kd_adjusted_quantity;

            $stock_update=product::where('id',$row->product_id)
            ->update(['Qty'=> $new_qty]);
            }
                }

    //  return view('agent.');""
        Alert::toast('Order Accepted', 'success');

            return redirect('/romDashboard');

    }

          public function rom_decline(Request $request)
    {
       $orderupdate = order::where('id',$request->order_id)
            ->update(['confirmStatus'=>'declined']);
    //  return view('agent.');""
        Alert::toast('Order Declined', 'success');

                 return redirect('/romDashboard');


    }



    public function updateStatus(Request $request, OrderedProduct $orderedProduct)
    {
        $orderedProduct = new orderedproducts;
        $orderedProduct->status = $request->input('status');
        $orderedProduct->save();
        return response()->json(['success' => true]);

    }

       public function confirm(Request $request)
    {

        
        $row = [];
        $price_status=0;

        $consent= order::where('id', $request->order_id)->get('consent');


       if($request->total_price != $request->subtotal)
        {
            $price_status=1;
        }
        foreach ($request->all() as $key => $value) {

             if (strpos($key, 'status_') === 0) {
                $stat = explode("_",$key);
                $itemId = $stat[1];
                $itsStatus = $value;
                $row[$itemId] = ["val" => $value];

             } elseif (strpos($key, 'quantity_') === 0) {
                $stat = explode("_",$key);
                $itemId = $stat[1];
                $itsStatus = $value;
                $row[$itemId] = ["val" => $row[$itemId]['val'],"quantity" => $value];
            //  echo $itsStatus;
             }


        }

        foreach($row as $key=>$val)
        {

            $id = $key;
            $status = $val['val'];

            $quantity = 0;
            if($status == 'quantity_Adjustment') {

                $quantity = $val['quantity'];
                if($consent[0]->consent ==0 ){
                 $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$request->order_id)
        ->get();
             Alert::toast('the client will not accept less quantity', 'warning');
        return view('ROM.rom_unconfirmed_details',compact('orderedProducts'));

            }


            }
             $orderedProduct = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            ->where('ordered_products.product_id',$id)
            ->where('ordered_products.order_id',$request->order_id)
            ->update(['status'=> $status ,'kd_adjusted_quantity' => $quantity]);
            // new added for
            $productss = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            ->where('ordered_products.product_id',$id)
            ->where('ordered_products.order_id',$request->order_id)
            ->get();


            if($status=="Acceptance")
            {

              $stock=product::where('id',$id)
            ->get('products.Qty');


           $new_qty=$stock[0]->Qty - $productss[0]->ordered_quantity;

           if($new_qty<0)
           {
             $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$request->order_id)
        ->get();
             Alert::toast('You dont have enough Stock', 'warning');
        return view('ROM.rom_unconfirmed_details',compact('orderedProducts'));
           }
            $stock_update=product::where('id',$id)
            ->update(['Qty'=> $new_qty]);


            }
             if($status=="quantity_Adjustment")
            {

              $stock=product::where('id',$id)
            ->get('products.Qty');

           $new_qty=$stock[0]->Qty - $quantity;

            if($new_qty<0)
           {
             $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$request->order_id)
        ->get();
             Alert::toast('You dont have enough Stock', 'warning');
        return view('ROM.rom_unconfirmed_details',compact('orderedProducts'));
           }

            $stock_update=product::where('id',$id)
            ->update(['Qty'=> $new_qty]);

            }
            //

        }

        if($price_status==1)

        {
                $orderedProductupdate = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
                ->join('products','products.id','=','ordered_products.product_id')
                // ->where('ordered_products.product_id',$id)
                ->where('ordered_products.order_id',$request->order_id)
                 ->update(['confirmStatus'=>'confirmed','price_update'=>$price_status,'rom_order_confirmation'=>'confirmed','rom_adjusted_confirmation'=>'confirmed']);
               // ->update(['confirmStatus'=>'confirmed_with_price_update','price_update'=>$price_status]);
            }

$statusrecords=OrderedProducts::where('order_id',$request->order_id)->count();
$acceptancerecords=OrderedProducts::where('status','acceptance')->where('order_id',$request->order_id)->count();
$refusalrecords=OrderedProducts::where('status','refusal')->where('order_id',$request->order_id)->count();


      $orderedProduct_ac = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            // ->where('ordered_products.product_id',$id)
            ->where('ordered_products.order_id',$request->order_id)
            ->where('ordered_products.status', 'acceptance')
            // ->where('ordered_products.status', 'refusal')

            ->exists();


         $orderedProduct = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            // ->where('ordered_products.product_id',$id)
            ->where('ordered_products.order_id',$request->order_id)
            ->where('ordered_products.status', 'quantity_adjustment')
            // ->where('ordered_products.status', 'acceptance')

            ->exists();

            // ->get();


            if($orderedProduct){

                 if ($consent[0]->consent ==1 ) {
                if($price_status==1)
                {

                    $orderedProductupdate = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
                    ->join('products','products.id','=','ordered_products.product_id')
                    // ->where('ordered_products.product_id',$id)
                    ->where('ordered_products.order_id',$request->order_id)
                    ->update(['confirmStatus'=>'confirmed','price_update'=>$price_status,'rom_order_confirmation'=>'confirmed','rom_adjusted_confirmation'=>'confirmed']);
                    //->update(['confirmStatus'=>'confirmed_with_price_update','price_update'=>$price_status]);
                }
              else {
         $orderedProductupdate = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            // ->where('ordered_products.product_id',$id)
            ->where('ordered_products.order_id',$request->order_id)
            ->update(['confirmStatus'=>'confirmed','price_update'=>$price_status,'rom_order_confirmation'=>'confirmed','rom_adjusted_confirmation'=>'confirmed']);
            //->update(['confirmStatus'=>'confirmed_with_deviation','price_update'=>$price_status]);
              }
            }

             elseif($consent[0]->consent ==0 ){
                  $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$request->order_id)
        ->get();



             Alert::toast('the client will not accept less quantity', 'warning');


        return view('ROM.rom_unconfirmed_details',compact('orderedProducts'));


                    }

            }

            elseif($statusrecords === $acceptancerecords ){

                if($price_status==1)
                {

                    $orderedProductupdate = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
                    ->join('products','products.id','=','ordered_products.product_id')
                    // ->where('ordered_products.product_id',$id)
                    ->where('ordered_products.order_id',$request->order_id)
                    ->update(['confirmStatus'=>'confirmed','price_update'=>$price_status,'rom_order_confirmation'=>'confirmed','rom_adjusted_confirmation'=>'confirmed']);
                    //->update(['confirmStatus'=>'confirmed_with_deviation','price_update'=>$price_status]);
                }
                else
                {

                    // if ($consent[0]->consent ==1 ) {

            $orderedProductupdate_a = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            // ->where('ordered_products.product_id',$id)
            ->where('ordered_products.order_id',$request->order_id)
            ->update(['confirmStatus'=>'confirmed','rom_order_confirmation'=>'confirmed','rom_adjusted_confirmation'=>'confirmed','price_update'=>$price_status]);
//commented for temporary
//   foreach($row as $key=>$val)
//         {

//              $id = $key;
//             $productss = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
//             ->join('products','products.id','=','ordered_products.product_id')
//             ->where('ordered_products.product_id',$id)
//             ->where('ordered_products.order_id',$request->order_id)
//             ->get();

//             $stock=product::where('id',$request->ordered_product_id)
//             ->get('products.Qty');

//            $new_qty=$stock[0]->Qty - $productss[0]->ordered_quantity;

//             $stock_update=product::where('id',$request->ordered_product_id)
//             ->update(['Qty'=> $new_qty]);





//     }
//untill here


                    // }
                    // elseif($consent[0]->consent ==0 ){
                    //     Alert::toast('the client will not accept less quantity', 'warning');
                    //      return redirect()->back();
                    // }

                }
                // echo "a";
            }
                elseif($statusrecords === $refusalrecords ){

       $orderedProductupdate_b = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            // ->where('ordered_products.product_id',$id)
            ->where('ordered_products.order_id',$request->order_id)
            ->update(['confirmStatus'=>'declined','price_update'=>$price_status]);

                }


          elseif($orderedProduct_ac){
            if($price_status==1)
                    {

                        $orderedProductupdate = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
                        ->join('products','products.id','=','ordered_products.product_id')
                        // ->where('ordered_products.product_id',$id)
                        ->where('ordered_products.order_id',$request->order_id)
                        ->update(['confirmStatus'=>'confirmed','price_update'=>$price_status,'rom_order_confirmation'=>'confirmed','rom_adjusted_confirmation'=>'confirmed']);
                        //->update(['confirmStatus'=>'confirmed_with_deviation','price_update'=>$price_status]);
                    }
                    else {




       $orderedProductupdate_c = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            // ->where('ordered_products.product_id',$id)
            ->where('ordered_products.order_id',$request->order_id)
            ->update(['confirmStatus'=>'confirmed','price_update'=>$price_status,'rom_order_confirmation'=>'confirmed','rom_adjusted_confirmation'=>'confirmed']);
           // ->update(['confirmStatus'=>'confirmed_with_deviation','price_update'=>$price_status]);
                    }

                }



               Alert::toast('Order Confirmed', 'success');
      return redirect('/romDashboard');



        }




        public function set_order_status(Request $request)
    {

$status = $request->input('status');
        OrderedProducts::query()->update(['status' => $status]);

    //     $id = $request->ordered_product_id;

    //       $orderupdate = order::where('id',$request->order_id)
    //         ->update(['confirmStatus'=>'confirmed']);

    //    $orderedPs=orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
    //     ->join('products','products.id','=','ordered_products.product_id')
    //     ->where('ordered_products.order_id',$request->order_id)

    //     ->get();

    //     foreach ($orderedPs as $item) {
    // $status = $_POST['status_'.$item->id];

    // Save the status to the database for this ordered product
    // ...
        // echo  $item;


//  $orderId = $request->input('order_id');
//     $orderedProductId = $request->input('ordered_product_id');
//     $status = $request->input('status_'.$orderedProductId);

    // Update the order status in the database for the given ordered product
    // $orderedProduct = OrderedProducts::where('id', $orderedProductId)->first();
    // $orderedProduct->status = $status;
    //    $orderedProduct = OrderedProducts::findOrFail($orderedProductId);
    // echo  $orderedProductId;
    // $orderedProduct->save();

    // Redirect back to the page
    // return redirect()->back();
}

// }



//   $status = $request->input('status');
//   $data = array('status' => $status);
//   $jsonData = json_encode($data);

//   return response()->json($jsonData);


    // }


        public function kd_unconfirmed_details(Request $request)
    {
             $auth = Auth::user()->userName;
        $order_id=$request->order_id;

        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)
        ->get();

// echo $orderedProducts;
// Alert::toast('ye','success');
// echo $orderedProducts;
if (count($orderedProducts) === 0 ){
    return back();
    alert::toast('order doesn not exist','warning');
}

else{
        return view('KD.kd_unconfirmed_details',compact('orderedProducts','auth'));

}





    }

            public function tm_unconfirmed_details(Request $request)
    {
             $auth = Auth::user()->userName;
        $order_id=$request->order_id;

        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->kd_id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)
        ->get();

// echo $orderedProducts;
// Alert::toast('ye','success');
// echo $orderedProducts;
if (count($orderedProducts) === 0 ){
    return back();
    alert::toast('order doesn not exist','warning');
}

else{
        return view('TM.tm_unconfirmed_details',compact('orderedProducts','auth'));

}






    }
public function rom_order_history_details(Request $request)
    {
             $auth = Auth::user()->userName;
        $order_id=$request->order_id;

        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.rom_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)
        ->get();

// echo $orderedProducts;
// Alert::toast('ye','success');
// echo $orderedProducts;
if (count($orderedProducts) === 0 ){
    return back();
    alert::toast('order doesn not exist','warning');
}

else{

        return view('ROM.rom_orderhistory_details',compact('orderedProducts','auth'));

}






    }
        public function rom_unconfirmed_details(Request $request)
    {
             $auth = Auth::user()->userName;
        $order_id=$request->order_id;

        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.rom_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)
        ->get();

// echo $orderedProducts;
// Alert::toast('ye','success');
// echo $orderedProducts;
if (count($orderedProducts) === 0 ){
    return back();
    alert::toast('order doesn not exist','warning');
}

else{
        return view('ROM.rom_unconfirmed_details',compact('orderedProducts','auth'));

}






    }



        public function kd_confirmed_details(Request $request)
    {
             $auth = Auth::user()->userName;
        $order_id=$request->order_id;
        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)->get();
        // echo $orderedProducts[0]->order_id;
    //    echo $orderedProducts[0]->confirmStatus;
    //    echo $orderedProducts[0]->handoverStatus;
        // return view('orderCart.orderDetails',compact('orderedProducts','auth'));


        return view('KD.kd_confirmed_details',compact('orderedProducts','auth'));

        // return view('orderCart.orderDetails');



    }


           public function tm_confirmed_details(Request $request)
    {
             $auth = Auth::user()->userName;
        $order_id=$request->order_id;
        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)->get();
        // echo $orderedProducts[0]->order_id;
    //    echo $orderedProducts[0]->confirmStatus;
    //    echo $orderedProducts[0]->handoverStatus;
        // return view('orderCart.orderDetails',compact('orderedProducts','auth'));


        return view('TM.tm_confirmed_details',compact('orderedProducts','auth'));

        // return view('orderCart.orderDetails');



    }

          public function kd_returned_details(Request $request)
    {
             $auth = Auth::user()->userName;
        $order_id=$request->order_id;
        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)->get();
        // echo $orderedProducts[0]->order_id;
    //    echo $orderedProducts[0]->confirmStatus;
    //    echo $orderedProducts[0]->handoverStatus;
        // return view('orderCart.orderDetails',compact('orderedProducts','auth'));


        return view('KD.returned_order_details',compact('orderedProducts','auth'));

        // return view('orderCart.orderDetails');



    }

            public function rom_returned_details(Request $request)
    {
             $auth = Auth::user()->userName;
        $order_id=$request->order_id;
        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.rom_id',auth()->user()->id)
        ->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)
        ->get();


        return view('ROM.returned_order_details',compact('orderedProducts','auth'));




    }
  public function orderDetailsofficer(Request $request)
    {


               $auth = Auth::user()->userName;
        $order_id=$request->order_id;

        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)
        ->distinct()
        ->get(['products.image','products.description','products.price','ordered_products.ordered_quantity',
        'ordered_products.kd_adjusted_quantity','ordered_products.subTotal','orders.totalPrice','ordered_products.status']);


         return view('orderCart.orderDetailsofficer',compact('orderedProducts','auth'));


    }
 public function orderDetailshoreport(Request $request)
    {
        $auth = Auth::user()->userName;
        $order_id=$request->order_id;

        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)
        ->distinct()
        ->get(['products.image','products.description','products.price','products.name','ordered_products.ordered_quantity',
        'ordered_products.kd_adjusted_quantity','ordered_products.subTotal','orders.totalPrice','ordered_products.status']);


         return view('orderCart.orderDetailshoreport',compact('orderedProducts','auth'));


    }
  public function orderDetailsho(Request $request)
    {


               $auth = Auth::user()->userName;
        $order_id=$request->order_id;
        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

            $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
    ->join('products','products.id','=','ordered_products.product_id')
    ->join('delivery1s','delivery1s.order_id','=','ordered_products.order_id')
    ->join('delivery1_products', function ($join) {
        $join->on('delivery1_products.delivery1_id', '=', 'delivery1s.id')
             ->on('products.id', '=', 'delivery1_products.product_id');
    })
    ->where('orders.id', $order_id)
    ->distinct()
    ->get(['products.image','products.description','products.id', 'orders.id', 'products.name','products.price','ordered_products.ordered_quantity','ordered_products.kd_adjusted_quantity','delivery1_products.partial_quantity','delivery1_products.delivered_quantity','ordered_products.subTotal','orders.totalPrice','delivery1_products.amount_status','ordered_products.status']);
   



         return view('orderCart.orderDetailsho',compact('orderedProducts','auth'));


    }


    public function orderDetails(Request $request)
    {


               $auth = Auth::user()->userName;
        $order_id=$request->order_id;
        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)->get();
        // echo $orderedProducts[0]->order_id;
    //    echo $orderedProducts[0]->confirmStatus;
    //    echo $orderedProducts[0]->handoverStatus;
        // return view('orderCart.orderDetails',compact('orderedProducts','auth'));


        return view('orderCart.orderDetails',compact('orderedProducts','auth'));


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\\Cart::clear();Response
     */
    public function create()
    {
        //
    }

    public function clientCheck(Request $request){
        // $client_ids = explode('|', $request->client);
        $client_id = $client_ids[0];
        $KD_id = $client_ids[1];
        $total = $request->total;
        return view('orderCart.checkClient',compact('client_id','KD_id','total'));
    }
    public function clientCheckSubmit(Request $request)
    {
        $client = client::join('users','users.id','=','clients.user_id')
        ->where('clients.user_id',$client_id)
        ->get('clients.PinCode');
        return $client->PinCode;
        $pin = $request->pinCode;
        if($client->PinCode == $pin)
        {
            return redirect()->route('orderProduct',['client_id'=>$request->client_id, 'KD_id'=>$request->KD_id]);
        }
        else
        {
            return redirect()->back()->withErrors("Wrong Pin Code");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
   {
 $client_id = $request->clients_user_id;
        // $KD_id = $client_ids[1];
        $ord = Auth::id();



         $KD_id = client::where('user_id',$client_id)
        ->get('clients.distro_id');
        $agent= agent::where('user_id',Auth::id())->get();
        $rom_id=$agent[0]->rom_id;

        $a=agent::all();
        // echo $KD_id;
        $Hierarchy_id = order::join('handover_hierarchy','handover_hierarchy.id','=','orders.hierarchy_id')
                                ->get();


        $client = client::join('users','users.id','=','clients.user_id')
            ->where('clients.user_id',$client_id)
            ->value('clients.PinCode');
        if($client == $request->pinCode)
        {
            // echo $agent[0]->rom_id;

        $products = \Cart::getcontent();

         $order = order::create([
            // $client_ids = explode('|', $request->client),
            'client_id'=>$client_id,
            'KD_id'=>$KD_id[0]->distro_id,
            'Hierarchy_id'=>$request->hierarchy_id,
            'createdDate'=> today(),
            'createdBy'=> auth()->user()->id,
            'orderedBy'=> auth()->user()->userType,
            'consent'=>$request->consent,
            'rom_id'=> $rom_id,



            'totalPrice'=>$request->total
        ]);
        foreach($products as $product){
            $amount = $product->quantity;
            $Avaliable_product = product::find($product->id);
            $reserved=$Avaliable_product->reserverd_qty+$amount;
            if ($Avaliable_product->Qty >= $amount && $Avaliable_product->Qty > 0 ) {

            //      $Avaliable_product->Qty -= $amount;
            // $Avaliable_product->save();

            $update_reserved=product::where('id',$product->id)
            ->update(['reserverd_qty'=> $reserved]);
            OrderedProducts::create([
                'product_id' => $product->id,
                'order_id' => $order->id,
                'ordered_quantity' => $product->quantity,
                'subTotal'=>$product->attributes->subtotal,
            ]);
            }
            else {
        Alert::toast('You can not order more than available quantity', 'warning');
               $order = order::find($order->id);

             if ($order) {
                $order->delete();
             }
             else
             {

             }
              return back();
     

            }

        }
        Alert::toast('Successfully Ordered', 'success');
        \Cart::clear();

        return redirect('/showOrders');
    }
    else {
        # code...
         Alert::toast('Pin Code Incorrect', 'failed');
         return back();
    }
               }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\orderedProducts  $orderedProducts
     * @return \Illuminate\Http\Response
     */
    public function show(orderedProducts $orderedProducts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orderedProducts  $orderedProducts
     * @return \Illuminate\Http\Response
     */
    public function edit(orderedProducts $orderedProducts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orderedProducts  $orderedProducts
     * @return \Illuminate\Http\Response
     */
    public function tm_update(Request $request, orderedProducts $orderedProducts)
    {

        $orderupdate = order::where('id',$request->order_id)
            ->update(['tm_confirmation'=>'confirmed']);
            Alert::toast('Order Confirmed', 'success');
        return redirect('/tmDashboard');
    }

       public function update(Request $request, orderedProducts $orderedProducts)
    {

        $orderupdate = order::where('id',$request->order_id)
            ->update(['tm_confirmation'=>'confirmed']);
            Alert::toast('Order Confirmed', 'success');
        return redirect('/key_distroDashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orderedProducts  $orderedProducts
     * @return \Illuminate\Http\Response
     */
    public function destroy(orderedProducts $orderedProducts)
    {
        //
    }
}
