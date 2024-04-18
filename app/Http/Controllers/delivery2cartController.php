<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderedProducts;
use App\Models\user;
use App\Models\client;
use App\Models\delivery1;
use App\Models\delivery1Products;
use App\Models\Handover_hierarchy;
use App\Models\order;
use App\Helpers\LogActivity;





use App\Models\rsp;
use RealRashid\SweetAlert\Facades\Alert;

class delivery2cartController extends Controller
{
    public function productList()
    {
        $products = Product::all();

        return view('orderCart.productList', compact('products'));
    }


    public function updateStatus(Request $request, delivery1Product $deliveredProduct)
    {
        $deliveredProduct = new delivery1Products;
        $deliveredProduct->status = $request->input('status');
        $deliveredProduct->save();
        return response()->json(['success' => true]);
    }


public function cartList(Request $request)
    {


        $row = [];

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



        foreach($row as $key=>$val) {

            $id = $key;
            $status = $val['val'];
            $quantity = 0;
            if($status == 'partial') {

                $quantity = $val['quantity'];
            }




               $deliveredProductsaa=delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')

        ->join('users','users.id','=','delivery1s.kd_id')
        ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        ->join('products','products.id','=','delivery1_products.product_id')

        ->where('delivery1_products.product_id',$id)

        ->where('delivery1s.order_id',$request->order_id)

         ->update(['amount_status'=> $status ,'partial_quantity' => $quantity]);


         $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('ordered_products','ordered_products.product_id','=','delivery1_products.product_id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->join('users','users.id','=','delivery1s.kd_id')
        ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        ->where('delivery1s.confirmationStatus','confirmed')

        ->where('delivery1s.order_id',$request->order_id)
        ->where('ordered_products.order_id',$request->order_id)
        ->where('delivery1s.rom_id',auth()->user()->id)
        ->get(['orders.price_update','delivery1_products.*','products.price','products.name','delivery1s.*','products.image']);


        }

               $orderedBy=order::where('orders.id',$request->order_id)->get('orderedBy');
               $Kd_id=auth()->user()->id;
               $products =\Cart::getContent();
               $client=User::join('orders','orders.client_id','=','users.id')
                            ->where('orders.id',$request->order_id)
                           ->get(['users.firstName','users.middleName','users.lastName','users.id']);


return view('ROM.handover_to_client', compact('products','client','orderedBy','deliveredProducts'));

    }

    public function addToCart(Request $request)
    {
     $cartItems = \Cart::getContent();
       foreach($cartItems as $row) {


	     $order_id = $row->attributes->order_id; // whatever properties your model have
//
     }



        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'subtotal'=>$request->subTotal,

            'attributes' => array(
                'image' => $request->image,
                'description'=>$request->description,
        'recieved_quantity'=>$request->delivered_quantity,
        'order_id'=>$request->order_id,
        'delivery1_id'=>$request->delivery1_id,
        'subtotal'=>$request->price*$request->quantity,
            )
        ]);
        Alert::toast('product added to delivery cart', 'success');


        return redirect()->route('delivery2Cart.list');
    }

    public function updateCart(Request $request)
    {

            $cartItems = \Cart::getContent();


       foreach($cartItems as $row) {


	     $order_id = $row->attributes->order_id; // whatever properties your model have
//
     }


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

        return redirect()->route('delivery2cart.list');
    }

    public function removeCart(Request $request)
    {

          $cartItems = \Cart::getContent();


       foreach($cartItems as $row) {


	     $order_id = $row->attributes->order_id; // whatever properties your model have
//
     }



        \Cart::remove($request->id);
        Alert::toast('Item removed', 'success');
        // echo 'ssf';
        return redirect()->route('delivery2Cart.list');
    }

    public function clearAllCart()
    {
           $cartItems = \Cart::getContent();


       foreach($cartItems as $row) {


	     $order_id = $row->attributes->order_id; // whatever properties your model have
//
     }




        \Cart::clear();

        Alert::toast('All Items Removed', 'success');


        return redirect()->route('delivery2Cart.list');
    }
    public function cartListagent(Request $request)
    {
        $row = [];
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

             }


        }
        foreach($row as $key=>$val) {

            $id = $key;
            $status = $val['val'];
            $quantity = 0;
            if($status == 'partial') {

                $quantity = $val['quantity'];
            }
        $deliveredProductsaa=delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('users','users.id','=','delivery1s.kd_id')
        ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        ->join('products','products.id','=','delivery1_products.product_id')

        ->where('delivery1_products.product_id',$id)
        ->where('delivery1s.order_id',$request->order_id)
        ->update(['amount_status'=> $status ,'partial_quantity' => $quantity]);


         $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('ordered_products','ordered_products.product_id','=','delivery1_products.product_id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->join('users','users.id','=','delivery1s.kd_id')
        ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        ->where('delivery1s.confirmationStatus','confirmed')

        ->where('delivery1s.order_id',$request->order_id)
        ->where('ordered_products.order_id',$request->order_id)
        ->where('delivery1s.cico_id',auth()->user()->id)
        ->get(['orders.price_update','delivery1_products.*','products.price','products.name','delivery1s.*','products.image']);

        }
               $orderedBy=order::where('orders.id',$request->order_id)->get('orderedBy');
               $Kd_id=auth()->user()->id;
               $products =\Cart::getContent();
               $client=User::join('orders','orders.client_id','=','users.id')
                            ->where('orders.id',$request->order_id)
                           ->get(['users.firstName','users.middleName','users.lastName','users.id']);
                 return view('agent.handover_to_client', compact('products','client','orderedBy','deliveredProducts'));



    }


}
