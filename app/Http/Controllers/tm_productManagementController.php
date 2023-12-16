<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\user;
use App\Models\product;
use App\Models\key_distro;
use App\Models\ProductList;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Models\ProductCatagory;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class key_distroProductManagment extends Controller
{
public function add_product(Request $request)
    {
        $products = ProductList::all();
        // $data['catagories'] = ProductCatagory::get(["catagoryName", "id"]);
        // $catagory = ProductCatagory::all();
        // $productType= ProductType::all();
        return view('KD.addProducts',compact('products'));
    }

   public function store_stock(Request $request)
    {

        $request->validate([

            'name'=>'required|max:255',
            'description'=>'required|max:255',
            'packsize'=>'required|max:255',
            'catagory'=>'required',
            'adminproductType'=>'required',
            'price' => 'required|numeric|gt:0',

            'Qty' => 'required|numeric|gt:0'
            ]);
       // $product_catagor = ProductCatagory::find($id);
       $products = new product;
       $products->name = $request->name;
       // echo  $products;
       $products->image = $request->image;
       // $imagename = time(). '.' . $image->getClientOriginalExtension();
       // $request->image->move('assets/product_img',$imagename);
       // $products->image = $reimagename;
       $products->description = $request->description;
       $products->price = $request->price;
       $products->packsize = $request->packsize;
       $products->catagory_id = $request->catagory;
       $products->ProductType_id = $request->adminproductType;
       $products->Qty = $request->Qty;
       $products->KD_ID = Auth::id();
        $products->save();
       Alert::toast('Product Added Successfully', 'success');
       return redirect('/key_distro/view/product');


    //  return view('KD.consent_error');

    //  $kd_stock = kd_stock::
    }



       public function fetchProductType(Request $request)
    {
        $data['productTypes'] = ProductType::where("catagory_id", $request->catagory_id)
                                ->get(["productTypeName", "id"]);

        return response()->json($data);
    }
     public function store_product(Request $request)
    {
       $request->validate([
             'image'=>'required|image|mimes:jpg,png,jpeg|max:5048',
             'name'=>'required|max:255',
             'description'=>'required|max:255',
             'packsize'=>'required|max:255',
             'catagory'=>'required',
             'productType'=>'required',
             'price' => 'required|numeric|gt:0',

             'Qty' => 'required|numeric|gt:0',
             ]);
        // $product_catagor = ProductCatagory::find($id);
        $products = new product;
        $products->name = $request->name;
        $image = $request->image;
        $imagename = time(). '.' . $image->getClientOriginalExtension();
        $request->image->move('assets/product_img',$imagename);
        $products->image = $imagename;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->Qty = $request->Qty;
        $products->packsize = $request->packsize;
        $products->catagory_id = $request->catagory;
        $products->ProductType_id = $request->productType;
        $products->KD_ID = Auth::id();
        $products->save();
        Alert::toast('Product Added Successfully', 'success');
        return redirect('/key_distro/view/product');
    }
    public function view_product()
    {
        $products = product::where('KD_ID', Auth::id())->get();
        return view('KD.viewProducts',compact('products'));

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

        return view('KD.editProducts',compact('data'));

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
        return redirect('/key_distro/view/product');
    }

    public function delete_product($id)
    {
        $products = product::find($id);
        $products->delete();
        Alert::toast('Product Deleted Successfully', 'success');
        return redirect('/key_distro/view/product');
    }
}
