<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\user;
use App\Models\client;
use App\Models\ProductCatagory;
use App\Models\ProductType;
use App\Models\key_distro;


use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ClientCartController extends Controller
{
     public function clientProductCatagoryList(Request $request)
    {
        $id= auth()->user()->id;
        $productsCatagories = ProductCatagory::join('products','products.catagory_id','=','product_catagories.id')
        ->join('key_distros','key_distros.user_id','=','products.KD_ID')
        ->join('clients','clients.distro_id','=','key_distros.user_id')
        ->where('clients.user_id',$id)
        ->distinct()
        ->get(['product_catagories.*']);
        return view('orderCart.clientProductCatagory_list',compact('productsCatagories'));

    }
    public function clientproductList(Request $request,$id)
    {
        $user_id= auth()->user()->id;
        // $products = Product::where('catagory_id',$id)->get();
        $productType = ProductType::where('catagory_id',$id)->get();
        // $client_id=$request->client_id;

        // $kds= key_distro::all();
        $cat_id = $id;
      //  echo $user_id;

        $products = Product::join('key_distros','key_distros.user_id','=','products.KD_ID')
        ->join('productlist','productlist.id','=','products.productlist_id')
        ->join('clients','clients.distro_id','=','key_distros.user_id')
        ->where('clients.user_id',$user_id)
        ->where('products.catagory_id',$id)
        ->get(['products.*','productlist.min_order','productlist.max_order']);

       return view('orderCart.ClientProduct_list', compact('products','productType','cat_id'));
    }
    public function clientproductList_kd(Request $request,$id,$kdid)
    {

       $products = Product::where('catagory_id',$id)
       ->where('KD_ID',$kdid)
       ->get();
        $productType = ProductType::where('catagory_id',$id)->get();
        $client_id=$request->client_id;
        return view('orderCart.ClientProduct_list_kd',compact('products','productType'));
    }

    public function clientCartList()
    {

        $cartItems = \Cart::getContent();

        return view('orderCart.Clientcart', compact('cartItems'));
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
    
       
        if($new_quantity > $request->max)
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
            'kd'=>$request->kd,
         )
        ]);
        Alert::toast('Product Added to Cart', 'success');
        return back();
         Alert::toast('Product Added to Cart', 'success');
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
        return redirect()->route('clientcart.list');
    }
    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);

        Alert::toast('Item removed', 'success');
        return redirect()->route('clientcart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();
        Alert::toast('All Items Removed', 'success');
        return redirect()->route('clientcart.list');
    }


}



