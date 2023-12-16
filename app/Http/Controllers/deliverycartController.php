<?php

namespace App\Http\Controllers;

use auth;
use App\Models\rom;
use App\Models\user;
use App\Models\order;
use App\Models\client;

use App\Models\product;
use Illuminate\Support\arr;

use Illuminate\Http\Request;

use App\Models\orderedProducts;
use App\Models\Handover_hierarchy;

use RealRashid\SweetAlert\Facades\Alert;

class deliverycartController extends Controller
{
    public function productList()
    {
        $products = Product::all();
        return view('orderCart.productList', compact('products'));
    }
    public function cartList(Request $request)
    {
        $orders=order::all();

        $hierarchy = Handover_hierarchy::where('status','1')->get();

         $auth = auth()->user()->userName;
        $order_id=$request->order_id;
        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)->get();



      return view('KD.deliveryCartList', compact('orderedProducts','hierarchy','orders','client'));
       }


        public function tm_cartList(Request $request)
    {
        $orders=order::all();

        $hierarchy = Handover_hierarchy::where('status','1')->get();

         $auth = auth()->user()->userName;
        $order_id=$request->order_id;
        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)->get();



      return view('TM.deliveryCartList', compact('orderedProducts','hierarchy','orders','client'));
       }




    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'subtotal'=>$request->subTotal,
            'attributes' => array(
                'image' => $request->image,
                'description'=>$request->description,
        'ordered_quantity'=>$request->ordered_quantity,
        'order_id' => $request->order_id,
        'subtotal' => $request->price*$request->quantity,
            )
        ]);
        $left_quantity= $request->ordered_quantity - $request->quantity;



        $Avaliable_product = product::find($request->id);
            $Avaliable_product->Qty += $left_quantity;
            $Avaliable_product->save();

        return redirect()->route('deliveryCart.list');

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
        return redirect()->route('deliverycart.list');
    }
    public function removeCart(Request $request)
    {



        \Cart::remove($request->id);
        Alert::toast('Item removed', 'success');
        return redirect()->route('deliveryCart.list');
    }
    public function clearAllCart()

    {


        \Cart::clear();

        Alert::toast('All Items Removed', 'success');

        return redirect()->back();
        // return redirect()->action([deliverycartController::class, 'clearAllCart']);

        // return redirect()->route('deliveryCart.list');
    }




}
