<?php

namespace App\Http\Controllers;

use App\Models\orderedProducts;
use App\Models\product;
use App\Models\order;
use App\Models\agent;
use App\Models\client;
use App\Models\user;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\CartController;

use Darryldecode\Cart\CartCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\cities;
use App\Models\order_statuses;
use App\Models\order_details;

use App\Helpers\LogActivity;
use Carbon\Carbon;
class ClientOrderedProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {




        // $client = order::join('users','users.id','=','orders.client_id')
        //     ->join('clients','clients.user_id','=','orders.client_id')
        //     ->where('orders.createdBy',auth()->user()->id)
        //     ->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.KD_id','orders.*']);

        // $kd = order::join('users','users.id','=','orders.KD_id')->
        // join('key_distros','key_distros.user_id','=','orders.KD_id')
        // ->where('orders.createdBy',auth()->user()->id)->get();

        // return view('agent.showOrders',compact('client','kd'));

        // }

        // elseif (auth()->user()->userType==='client') {


        $client = order::join('users','users.id','=','orders.client_id')
            ->join('clients','clients.user_id','=','orders.client_id')
            ->where('orders.createdBy',auth()->user()->id)
            ->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.KD_id','orders.*']);

        $kd = order::join('users','users.id','=','orders.KD_id')->
        join('key_distros','key_distros.user_id','=','orders.KD_id')
        ->where('orders.createdBy',auth()->user()->id)->get();

        return view('client.showOrders',compact('client','kd'));
        }


    public function kdView()
    {
        $client=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id) ->where('orders.confirmStatus','unconfirmed')
        ->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);
        return view('KD.showOrders',compact('client'));
    }
    public function orderHistory()
    {
        $client= order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*'])->sortDesc();

        return view('KD.orderHistory',compact('client'));

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
        // echo $orderedProducts;
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
        $client_ids = explode('|', $request->client);
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


       $client_id = auth()->user()->id;
        $ord = Auth::id();
        $city = client::where('user_id',$client_id)
        ->get('clients.City');


       $KD_id = client::where('user_id',$client_id)
        ->get(['distro_id','agent_id']);
        $rom_id=agent::where('user_id',$KD_id[0]->agent_id)
        ->get(['rom_id']);
        $order_status=cities::where('name',$city[0]->City)
        ->get();

        $order_statuses=order_statuses::where('City','=',$city[0]->City)
        ->where('status','=',1)
        ->whereNull('enddate')
        ->get();

        $a=agent::all();
        // echo $KD_id;



        if($order_status[0]->order_status==1)
        {
        $products = \Cart::getcontent();

        $size_of_product=0;
        $size_of_found=0;
        $start_date=$order_statuses[0]->startdate;
         $start_date = Carbon::parse($start_date);

        $start_date = $start_date->format('Y-m-d');
         $prduct_found=OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->where('orders.client_id','=',$client_id)
            ->where('orders.confirmStatus','!=','confirmed')
            ->where('orders.createdDate','>=',$start_date);

        $orders_byclient=$prduct_found
        ->get(['ordered_products.id','ordered_products.ordered_quantity','ordered_products.subTotal','orders.id as order_id','orders.totalPrice']);

         if($orders_byclient->count() > 0)
         {

            foreach($products as $product)
            {

            $size_of_product=$size_of_product+1;
            $amount = $product->quantity;
            $Avaliable_product = product::find($product->id);
            $reserved=$Avaliable_product->reserverd_qty+$amount;
            if ($Avaliable_product->Qty >= $amount && $Avaliable_product->Qty > 0 )
            {
            $prduct_found=OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->where('orders.client_id','=',$client_id)
            ->where('orders.createdDate','>=',$start_date);

             $update_reserved=product::where('id',$product->id)
            ->update(['reserverd_qty'=> $reserved]);


             $update_reserved=product::where('id',$product->id)
            ->update(['reserverd_qty'=> $reserved]);
            $orders_byclient=$prduct_found->get(['ordered_products.id','ordered_products.ordered_quantity','ordered_products.subTotal',
            'orders.id as order_id','orders.totalPrice']);

            $prduct_found=$prduct_found->where('ordered_products.product_id','=',$product->id)
            ->get(['ordered_products.id','ordered_products.ordered_quantity','ordered_products.subTotal','orders.id as order_id','orders.totalPrice']);

            if($prduct_found->count() > 0)
            {

               $size_of_found=$size_of_found+1;
               $new_quantity_update=$prduct_found[0]->ordered_quantity+$product->quantity;
               $new_subtotal_update=$prduct_found[0]->subTotal+$product->attributes->subtotal;
               $new_total_update=$prduct_found[0]->totalPrice+$product->attributes->subtotal;



               OrderedProducts::where('id',$prduct_found[0]->id)
               ->update(['ordered_quantity'=>$new_quantity_update,'subTotal'=>$new_subtotal_update]);
                order::where('id',$prduct_found[0]->order_id)
               ->update(['totalPrice'=>$new_total_update]);
               order_details::create([
                  'ordered_id'=>$prduct_found[0]->id,
                  'quantity'=>$product->quantity,
                  'created_date'=>today(),
               ]);


            }
            else
            {
               $new_total_update=$orders_byclient[0]->totalPrice+$product->attributes->subtotal;

              $ordered_product=OrderedProducts::create([
                'product_id' => $product->id,
                'order_id' => $orders_byclient[0]->order_id,
                'ordered_quantity' => $product->quantity,
                'subTotal'=>$product->attributes->subtotal,
            ]);
             order::where('id',$orders_byclient[0]->order_id)
               ->update(['totalPrice'=>$new_total_update]);

                order_details::create([
                  'ordered_id'=>$ordered_product->id,
                  'quantity'=>$product->quantity,
                  'created_date'=>today(),
               ]);
            }
        }
            else {
        Alert::toast('You can not order more than available quantity', 'warning');
              return back();
            }

         }
          LogActivity::addToLog('Order');
        Alert::toast('Successfully Ordered', 'success');
        \Cart::clear();

        return redirect('/clientShowOrders');

            }
         else
         {
             $order = order::create([
            'client_id'=>$client_id,
            'KD_id'=>$KD_id[0]->distro_id,
            'Hierarchy_id'=>2,
            'createdDate'=> today(),
            'createdBy'=> auth()->user()->id,
            'orderedBy'=> auth()->user()->userType,
            'consent'=>$request->consent,
            'rom_id'=> $rom_id[0]->rom_id,
            'totalPrice'=>$request->total,
            'price_update'=>'0'


        ]);
         foreach($products as $product)
        {
            $amount = $product->quantity;
            $Avaliable_product = product::find($product->id);
            $reserved=$Avaliable_product->reserverd_qty+$amount;
            if ($Avaliable_product->Qty >= $amount && $Avaliable_product->Qty > 0 )
             {
            $update_reserved=product::where('id',$product->id)
            ->update(['reserverd_qty'=> $reserved]);
            $ordered_product=OrderedProducts::create([
                'product_id' => $product->id,
                'order_id' => $order->id,
                'ordered_quantity' => $product->quantity,
                'subTotal'=>$product->attributes->subtotal,
            ]);
            order_details::create([
                  'ordered_id'=>$ordered_product->id,
                  'created_date'=>today(),
                  'quantity'=>$product->quantity,
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
        LogActivity::addToLog('Order');
        Alert::toast('Successfully Ordered', 'success');
        \Cart::clear();

        return redirect('/clientShowOrders');
         }


            }
            else
               {
                Alert::toast('You cannot order now', 'failed');
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
    public function update(Request $request, orderedProducts $orderedProducts)
    {
        $orderupdate = order::where('id',$request->order_id)
            ->update(['confirmStatus'=>$request->confirm]);
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
