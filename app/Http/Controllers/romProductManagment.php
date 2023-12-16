<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\user;
use App\Models\product;
use App\Models\key_distro;
use App\Models\ProductList;
use App\Models\rom;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Models\ProductCatagory;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class romProductManagment extends Controller
{
    public function add_product(Request $request)
    {
        $products = ProductList::all();
        $id=Auth::id();
        $kd_id=rom::where('user_id',$id)->get(['kd_id']);
        // $data['catagories'] = ProductCatagory::get(["catagoryName", "id"]);
        // $catagory = ProductCatagory::all();
        // $productType= ProductType::all();

        return view('ROM.addProducts',compact('products','kd_id'));
    }
    public function store_product(Request $request)
    {
       $request->validate([


             'Qty' => 'required|numeric|gt:0',
             ]);

        $products = new product;
        $products->name = $request->name;
        $image = $request->image;
        $products->image = $image;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->Qty = $request->Qty;
        $products->packsize = $request->packsize;
        $products->catagory_id = $request->catagory;
        $products->productlist_id = $request->id;
        $products->ProductType_id = $request->adminproductType;
        $products->KD_ID = $request->kd_id;

        $products->save();
        Alert::toast('Product Added Successfully', 'success');
        return redirect('/rom/view/product');
    }
    public function view_product()
    {
        $id=Auth::id();
        $kd_id=rom::where('user_id',$id)->get(['kd_id']);
        $products = product::where('KD_ID',$kd_id[0]->kd_id)->get();

        return view('ROM.viewProducts',compact('products'));

    }
    public function edit_product($id)
    {
        // $catagory = ProductCatagory::all();
        // join('users','users.id','=','orders.client_id')
        // ->join('clients','clients.user_id','=','orders.client_id')
        // ->join('transaction','transaction.order_id','=','orders.id')

        $data= product::join('product_types','product_types.id','=','products.productType_id')
        ->join('product_catagories','product_catagories.id','=','products.catagory_id')
        ->where('products.id', $id)
        ->get(['products.*','product_types.productTypeName','product_catagories.catagoryName']);

        return view('ROM.editProducts',compact('data'));

    }
    public function edited_product_store(Request $request,$id)
     {
        $request->validate([

            //  'catagory'=>'required',
            //  'productType'=>'required',

             'Qty'=> 'required|numeric|gt:0'

             ]);

        $products = product::where('id',$id)->update(['Qty'=> $request->Qty]);
        Alert::toast('Product Updated Successfully', 'success');
        return redirect('/rom/view/product');
    }
    public function delete_product($id)
    {
        //$products = product::find($id);
        //$products->delete();

        //Alert::toast('Product Deleted Successfully', 'success');
        return redirect('/rom/view/product');
    }
}
