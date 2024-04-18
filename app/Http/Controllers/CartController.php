<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\user;
use Auth;

use App\Models\orderedProducts;
// use App\Models\product;
use App\Models\order;
use App\Models\Loans;
// use App\Models\client;
// use App\Models\user;
// use RealRashid\SweetAlert\Facades\Alert;
// use App\Http\Controllers\CartController;

use Darryldecode\Cart\CartCollection;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

use App\Models\client;
use App\Models\ProductCatagory;
use App\Models\ProductType;
use App\Models\Handover_hierarchy;
use App\Models\cities;
use Carbon\Carbon;

use App\Models\order_statuses;

// use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{







        public function filter_client_id()
    {

  return view('agent.filter_client_id');
    }


      public function fetch_client_info()
    {

  return view('agent.filter_client_id');
    }

     public function fetch_client_info_post( Request $request)
    {
         $id=Auth::id();
        $client_unique_id = $request->client_unique_id ;
        $clients = client::join('users','users.id','=','clients.user_id')
        ->where('users.userType','client')
        ->where('clients.client_unique_id', $client_unique_id)
        ->where('clients.agent_id',$id)
        ->get(['users.firstName','users.middleName','users.lastName','clients.user_id','clients.distro_id','clients.pinCode']);


        $client_unique_id = $request->client_unique_id ;
        $client_name = client::where('client_unique_id', $client_unique_id)
        ->where('agent_id',$id)
        ->get();
        $kd_name = client::join('users','users.id','=','clients.distro_id')
         ->where('client_unique_id', $client_unique_id)
          ->where('clients.agent_id',$id)
         ->get(['firstName','middleName','lastName']);
        //   echo count($client_name);


             if (count($client_name) === 0){
        Alert::toast('You entered wrong Client id', 'warning');

                return redirect()->back();
            }
            elseif( $client_name[0]->client_unique_id == $request-> client_unique_id)
             {
             $loan = Loans::join('users','users.id','=','loans.client_id')
                   ->join('clients','clients.user_id','=','loans.client_id')
                   ->where('loans.client_id',$client_name[0]->user_id)
                   ->where('loans.status','pending')
                   ->where('loans.remaining_amount','>',0)
                   ->get();
              if (count($loan) === 0)
              {
                 return view('agent.client_info_display', compact('clients','client_name','kd_name'));
              }
              else
              {
                 Alert::toast('You Have Unpaid Loan', 'warning');

                return redirect()->back();
              }


            }
    }




     public function ProductCatagoryList(Request $request)
    {

        $cli_id = $request->clients_user_id;
$city = Client::where('user_id', $cli_id)->first();

if ($city && isset($city->City)) {
    $status = cities::where('name', $city->City)->first();

    if ($status && $status->order_status == 1) {
        $productsCatagories = ProductCatagory::join('products', 'products.catagory_id', '=', 'product_catagories.id')
            ->join('key_distros', 'key_distros.user_id', '=', 'products.KD_ID')
            ->join('clients', 'clients.distro_id', '=', 'key_distros.user_id')
            ->where('clients.user_id', $cli_id)
            ->distinct()
            ->get(['product_catagories.*']);
        return view('orderCart.product_catagory_list', compact('productsCatagories', 'cli_id'));
    } else {
        Alert::toast('You Cannot Order Now', 'error');
        return redirect('/filter_client_id');
    }
}

    }
    public function productList(Request $request,$id,$cli_id)
    {
   $products = Product::join('key_distros','key_distros.user_id','=','products.KD_ID')
        ->join('clients','clients.distro_id','=','key_distros.user_id')
        ->join('productlist','productlist.id','=','products.productlist_id')
        ->where('clients.user_id',$cli_id)
        ->where('products.catagory_id',$id)
        ->get(['products.*','productlist.min_order','productlist.max_order']);
        $productType = ProductType::where('catagory_id',$id)->get();



      return view('orderCart.productList', compact('products','productType','cli_id'));
    }


       public function fetch_client(Request $request)
    {

        $client_unique_id = 'client_unique_id'   ;
        $client_name = client::where('client_unique_id', $client_unique_id)->get();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
        $clients = client::join('users','users.id','=','clients.user_id')
        ->where('users.userType','client')
        ->where('client_unique_id', $client_unique_id)
        ->get(['firstName','middleName','lastName','clients.user_id','distro_id']);
        $cartItems = \Cart::getContent();
        // dd($cartItems);

        // if($client_name){

        //     return redirect('/agent/fetch_client')

        // }
        // return view('agent.fetch-client_id', compact('cartItems','clients','hierarchy'));
    }



    public function fetch_client_post(Request $request)
    {
        $id=Auth::id();
        $client_unique_id =$request->client_unique_id ;
        $client_name = client::where('client_unique_id', $client_unique_id)
        ->where('agent_id', $id)
        ->get();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
        // echo $client_unique_id;
        $clients = client::join('users','users.id','=','clients.user_id')
        ->where('users.userType','client')
        ->where('client_unique_id', $client_unique_id)
        ->where('agent_id', $id)
        ->get(['firstName','middleName','lastName','clients.user_id','distro_id','clients.pinCode']);
        $cartItems = \Cart::getContent();


if (count($clients) === 0) {

     $cartItems = \Cart::getContent();

                      $client_unique_id =$request->client_unique_id ;
        $client_name = client::where('client_unique_id', $client_unique_id)->get();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
        // echo $client_unique_id;
        $clients = client::join('users','users.id','=','clients.user_id')
        ->where('users.userType','client')
        ->where('client_unique_id', $client_unique_id)
        ->where('agent_id', $id)
        ->get(['firstName','middleName','lastName','clients.user_id','distro_id','clients.pinCode']);
        $cartItems = \Cart::getContent();

        Alert::toast('You entered wrong Client id', 'warning');


        return view('orderCart.cart', compact('cartItems','clients','hierarchy','client_name'));




            }
            else {

        $client_unique_id =$request->client_unique_id ;
        $client_name = client::where('client_unique_id', $client_unique_id)->get();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
        // echo $client_unique_id;
        $clients = client::join('users','users.id','=','clients.user_id')
        ->where('users.userType','client')
        ->where('client_unique_id', $client_unique_id)
        ->where('agent_id', $id)
        ->get(['firstName','middleName','lastName','clients.user_id','distro_id','clients.pinCode']);
        $cartItems = \Cart::getContent();




       return view('agent.fetch-client_id', compact('cartItems','clients','hierarchy','client_name'));

            }



    }
public function client_order_details(Request $request)
    {
             $auth = Auth::user()->userName;
        $order_id=$request->order_id;

        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.client_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)

        ->get();

         return view('client.client_order_details',compact('orderedProducts','auth'));

    }
     public function agent_order_details(Request $request)



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

        ->get();

         return view('agent.agent_order_details',compact('orderedProducts','auth'));

    }



        public function cartList()
    {


        $hierarchy = Handover_hierarchy::where('status','1')->get();
        $clients = client::join('users','users.id','=','clients.user_id')
        ->where('users.userType','client')
        ->get(['firstName','middleName','lastName','clients.user_id','distro_id']);
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        // echo $cartItems;
        return view('orderCart.cart', compact('cartItems','clients','hierarchy'));

    }

public function addToCart(Request $request)
    {

         $validator = $request->validate([
            'quantity' => 'required'

        ]);


      $quantity=\Cart::get($request->id);

     if(!$quantity)
     {
        $quantity=0;
        $new_quantity=$quantity+$request->quantity;
     }
     else
     {
        $new_quantity=$quantity->quantity+$request->quantity;
     }
        $city = client::where('user_id',$request->client_id)
        ->get('clients.City');
        $order_status=cities::where('name','=',$city[0]->City)
        ->get();

        $order_statuses=order_statuses::where('City','=',$city[0]->City)
        ->where('status','=',1)
        ->whereNull('enddate')
        ->get();


        if($order_status[0]->order_status==1)
        {

             $start_date=$order_statuses[0]->startdate;
              $start_date = Carbon::parse($start_date);

        $start_date = $start_date->format('Y-m-d');

            $prduct_found=OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->where('orders.client_id','=',$request->client_id)
            ->where('ordered_products.product_id','=',$request->id)
            ->where('orders.createdDate','>=',$start_date)
            ->get(['ordered_products.id','ordered_products.ordered_quantity','ordered_products.subTotal','orders.id as order_id','orders.totalPrice' ]);
             if($prduct_found->count() > 0)
            {
               $new_quanity_formax=$prduct_found[0]->ordered_quantity+$request->quantity;
                Alert::toast('You Have ordered This quantity Before', 'success');

                if($new_quanity_formax > $request->max)
        {
            Alert::toast('You Have Reached Maximum Order Try Again', 'error');
            return back();
        }

            }

            if($new_quantity > $request->max )
        {
            Alert::toast('You Have Reached Maximum Order Try Again', 'error');
            return back();
        }
        else if($request->quantity > $request->Qty)
        {
            Alert::toast('Product Quantity Is Greater Than Available Quantity Try Again', 'error');
            return back();
        }
        else
        {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
            'image' => $request->image,
            'subtotal'=>$request->price*$request->quantity,
            'description'=>$request->description,
         )
        ]);
        Alert::toast('Product Added to Cart', 'success');
        return back();
    }

        }
        else
        {
            Alert::toast('You Cannot Order Now', 'error');
        return back();
        }




    }
    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );
        session()->flash('success', 'Item Cart is Updated Successfully !');
        return redirect()->route('cart.list');
    }
    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        Alert::toast('Item removed', 'success');
        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();
        Alert::toast('All Items Removed', 'success');
        return redirect()->route('cart.list');
    }

public function clientaccept(Request $request)
    {

    $orderupdate = order::where('id', $request->order_id)
    ->update([
        'confirmStatus' => 'returned_acceptance',
        'rom_order_confirmation' => 'confirmed',
        'rom_adjusted_confirmation' => 'unconfirmed'
    ]);

// $orderedProducts = orderedProducts::join('orders', 'orders.id', '=', 'ordered_products.order_id')
//     ->join('products', 'products.id', '=', 'ordered_products.product_id')
//     ->where('ordered_products.order_id', $request->order_id)
//     ->get();
// foreach ($orderedProducts as $p) {
//   $update= orderedProducts::update(['subTotal'=>$p->kd_quantity_adjustment * $p->price]);

// // foreach ($orderedProducts as $p) {
// //     if ($p->kd_quantity_adjustment === 0) {
// //         $p->subTotal = $p->quantity * $p->price;
// //     } elseif ($p->kd_quantity_adjustment !== 0) {
// //         $p->subTotal = $p->kd_quantity_adjustment * $p->price;
// //     }
// }

Alert::toast('Order Accepted', 'success');
    //  return view('dashboard.agentDashboard');

    //  return back();
     return redirect ('/client_dash');

    }
public function clientdecline(Request $request)
    {

          $orderupdate = order::where('id',$request->order_id)
            ->update(['confirmStatus'=>'declined']);
    //  return view('agent.');""
        Alert::toast('Order Declined', 'success');

     return redirect ('/client_dash');
    //  return view('dashboard.agentDashboard');
    }
    public function accept(Request $request)
    {

$orderupdate = order::where('id', $request->order_id)
    ->update([
        'confirmStatus' => 'returned_acceptance',
        'rom_order_confirmation' => 'confirmed',
        'rom_adjusted_confirmation' => 'unconfirmed'
    ]);

// $orderedProducts = orderedProducts::join('orders', 'orders.id', '=', 'ordered_products.order_id')
//     ->join('products', 'products.id', '=', 'ordered_products.product_id')
//     ->where('ordered_products.order_id', $request->order_id)
//     ->get();
// foreach ($orderedProducts as $p) {
//   $update= orderedProducts::update(['subTotal'=>$p->kd_quantity_adjustment * $p->price]);

// // foreach ($orderedProducts as $p) {
// //     if ($p->kd_quantity_adjustment === 0) {
// //         $p->subTotal = $p->quantity * $p->price;
// //     } elseif ($p->kd_quantity_adjustment !== 0) {
// //         $p->subTotal = $p->kd_quantity_adjustment * $p->price;
// //     }
// }
        LogActivity::addToLog('order accept');

Alert::toast('Order Accepted', 'success');
    //  return view('dashboard.agentDashboard');

    //  return back();
     return redirect ('/agentDashboard');

    }

        public function decline(Request $request)
    {

          $orderupdate = order::where('id',$request->order_id)
            ->update(['confirmStatus'=>'declined']);
    //  return view('agent.');""
        LogActivity::addToLog('decline');

        Alert::toast('Order Declined', 'success');

     return redirect ('/agentDashboard');
    //  return view('dashboard.agentDashboard');
    }
public function clientorder_tracking()
    {


        $hierarchy = Handover_hierarchy::where('status','1')->get();
        // echo $client_unique_id;
         $client = order::join('users','users.id','=','orders.client_id')
            ->join('clients','clients.user_id','=','orders.client_id')
            ->where('users.id', auth()->user()->id)
            ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.KD_id','orders.*']);

        $clients = client::join('users','users.id','=','clients.user_id')
        ->where('users.userType','client')
        ->where('users.id', auth()->user()->id)
        ->get(['firstName','middleName','lastName','clients.user_id','distro_id','clients.pinCode']);
        $cartItems = \Cart::getContent();




       return view('client.client_order_list', compact('cartItems','clients','client','hierarchy'));

    }
        public function order_tracking()
    {
     return view('agent.order_tracking');
    }




  public function order_tracking_post(Request $request)
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


if (count($clients) === 0) {

     $cartItems = \Cart::getContent();

                      $client_unique_id =$request->client_unique_id ;
        $client_name = client::where('client_unique_id', $client_unique_id)->get();
        $hierarchy = Handover_hierarchy::where('status','1')->get();
        // echo $client_unique_id;
         $client = order::join('users','users.id','=','orders.client_id')
            ->join('clients','clients.user_id','=','orders.client_id')
            ->where('orders.createdBy',auth()->user()->id)
            ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.KD_id','orders.*']);

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




       return view('agent.client_order_list', compact('cartItems','clients','client','hierarchy','client_name'));

            }
        }


}



