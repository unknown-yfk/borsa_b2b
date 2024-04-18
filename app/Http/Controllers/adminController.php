<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\tm;
use App\Models\user;
use App\Models\order;
use App\Models\client;
use App\Models\idType;
use App\Models\product;
use App\Helpers\general;
use App\Models\key_distro;
use App\Models\agent;
use App\Models\ProductList;


use App\Models\ProductType;
use App\Models\businessType;
use Illuminate\Http\Request;
use App\Models\orderedProducts;
use App\Models\ProductCatagory;
use App\Models\delivery1Products;
use App\Models\undeliveredOrders;
use App\Models\Handover_hierarchy;
use Illuminate\Support\Facades\DB;
use App\Models\undelivered1Products;
use App\Models\order_statuses;
use App\Models\cities;
use App\Models\regions;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use App\Helpers\LogActivity;



class adminController extends Controller
{



    public function orderstatus()
    {

        $order_status=cities::join('regions','regions.id','=','cities.region_id')
        ->get(['regions.name as Region','cities.name','cities.order_status','cities.id']);

        return view('admin.order_status',compact('order_status'));
    }
     public function order_status_report()
    {
        $order_status=order_statuses::all();
        return view('admin.order_status_report',compact('order_status'));
    }

     public function Order_hierarchy()
    {
        $hierarchy= Handover_hierarchy::all();
        LogActivity::addToLog('View Order hierarchy');
        return view('admin.Order_hierarchy',compact('hierarchy'));
    }
    public function store_Order_hierarchy(Request $request)

    {


        $hierarchy = new Handover_hierarchy;
        $hierarchy->name = implode(',',$request->hierarchy_name);
        $hierarchy->save();



        // return redirect('/admin/view/product');
        return redirect()->back();
    }


      public function changeHierarchyStatus(Request $request)
    {
        $hierarchy = Handover_hierarchy::find($request->hierarchy_id);
        $hierarchy->status = $request->status;
        $hierarchy->save();
        LogActivity::addToLog('Change order hierarchy status');

        return response()->json(['success'=>'Status change successfully.']);
    }



    public function index()
    {


        $client = client::join('users','users.id', '=','clients.user_id')->count();
        $client = client::join('users','users.id', '=','clients.user_id')->count();


        // $client =user::where('userType','client')->count();
        $users =user::count() - 1;
        $kds =user::where('userType','key distributor')->count();
        $agents =user::where('userType','agent')->count();

        $roms =user::where('userType','ROM')->count();
        $rsps =user::where('userType','RSP')->count();
        $total_sales=order::where('paymentStatus','confirm')->sum('totalPrice');

        $userList=user::get();
        $todaysOrders=order::where('createdDate',today())->count();
        $totalOrders =order::count();
$jsonResult = json_encode([$todaysOrders, $agents,$kds]);

 $order = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.createdDate',today())
        ->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.deliveryStatus', 'clients.distro_id','KD_id']);

        return view('dashboard.adminDashboard',compact('client','kds','users','agents','roms','rsps','todaysOrders','totalOrders','total_sales','jsonResult','order'));
    }


    public function add_product(Request $request)
    {
        $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')->get();
        $data['catagories'] = ProductCatagory::get(["catagoryName", "id"]);
        $data['products'] = ProductList::get();
        // $catagory = ProductCatagory::all();
        // $productType= ProductType::all();
        // return view('KD.addProducts', $data );
        LogActivity::addToLog('Register Product view');


        return view('admin.addProducts',compact('key_distro'),$data);
    }




     public function fetchProductTypes(Request $request)
    {
        $data['productTypes'] = ProductType::where("catagory_id", $request->catagory_id)
                                ->get(["productTypeName", "id"]);

        return response()->json($data);
    }


    public function store_product(Request $request)
    {
       $request->validate([

             'name'=>'required|max:255',
             'description'=>'required|max:255',
             'packsize'=>'required|max:255',
             'catagory'=>'required',
             'adminproductType'=>'required',
             'price' => 'required|numeric|gt:0',
             'Kd_id' => 'required',

             'Qty' => 'required|numeric|gte:0'
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
        $products->KD_ID = $request->Kd_id;
        $products->productlist_id = $request->id;
         $products->save();
        LogActivity::addToLog('Register Product Store');

        Alert::toast('Product Added Successfully', 'success');
        return redirect('/admin/add/product');




    }
    public function getCities($regionId)
    {
        $cities = cities::where('region_id', $regionId)->get();
        return response()->json($cities);
    }
      public function view_productlist(Request $request)
    {
        $products= ProductList::all();
        LogActivity::addToLog('View Product List');
      
        return view('admin.viewProductslist',compact('products'));

    }


        public function add_product_list(Request $request)
    {
        $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')->get();
        $data['catagories'] = ProductCatagory::get(["catagoryName", "id"]);
        // $catagory = ProductCatagory::all();
        // $productType= ProductType::all();
        // return view('KD.addProducts', $data );
        LogActivity::addToLog('Register Product List View');

        return view('admin.addProductslist',compact('key_distro'),$data);
    }


    public function fetchProductlist(Request $request)
    {
        $data['productTypes'] = ProductList::where("id", $request->product_id)
                                ->get();
        return response()->json($data);
    }

       public function store_productlist(Request $request)
    {
       $request->validate([
             'image'=>'required|image|mimes:jpg,png,jpeg|max:5048',
             'name'=>'required|max:255',
             'description'=>'required|max:255',
             'packsize'=>'required|max:255',
             'catagory'=>'required',
             'adminproductType'=>'required',
             'min_order'=>'required',
             'max_order'=>'required',
            //  'adminproductType'=>'required',
             'price' => 'required|numeric|gt:0',
             'Qty' => 'required|numeric|gt:0'
             ]);
        // $product_catagor = ProductCatagory::find($id);
        $products = new ProductList;
        $products->name = $request->name;
        $image = $request->image;
        $imagename = time(). '.' . $image->getClientOriginalExtension();
        $request->image->move('assets/product_img',$imagename);
        $products->image = $imagename;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->packsize = $request->packsize;
        $products->catagory_id = $request->catagory;
        $products->productType_id = $request->adminproductType;
        $products->Qty = $request->Qty;
        $products->min_order = $request->min_order;
        $products->max_order = $request->max_order;
        $products->save();
        LogActivity::addToLog('Register Product List Store');

        Alert::toast('Product Added Successfully', 'success');
        return redirect('/admin/view/productlist');
    }



    public function view_product()
    {
 $products= product::join('users','users.id','=','products.KD_ID')
        ->get(['products.*','users.firstName','users.middleName','users.lastName']);
        LogActivity::addToLog('View products');

        return view('admin.viewProducts',compact('products'));

          }
    public function edit_productlist($id)
    {
      $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')->get();
        $data['catagories'] = ProductCatagory::get(["catagoryName", "id"]);
        $productType= ProductType::all();
        $products = ProductList::find($id);
        // $catagory = ProductCatagory::all();
        // $productType= ProductType::all();
        // return view('KD.addProducts', $data );
        // return view('admin.addProducts',compact('key_distro'),$data);
        LogActivity::addToLog('View productslist Edit');

        return view('admin.editProductslist',compact('products', 'productType','key_distro'),$data);

    }
    public function edit_product($id)
    {
      $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')->get();
        $data['catagories'] = ProductCatagory::get(["catagoryName", "id"]);
        $productType= ProductType::all();
        $products = product::find($id);
        // $catagory = ProductCatagory::all();
        // $productType= ProductType::all();
        // return view('KD.addProducts', $data );
        // return view('admin.addProducts',compact('key_distro'),$data);
        LogActivity::addToLog('Edit products view');

        return view('admin.editProducts',compact('products', 'productType','key_distro'),$data);

    }

    public function edited_productlist_store(Request $request,$id)
    {
        $request->validate([
             'image'=>'image|mimes:jpg,png,jpeg|max:5048',
             'name'=>'required|max:255',
             'description'=>'required|max:255',
             'packsize'=>'required|max:255',
             'catagory'=>'required',
             'min_order'=>'required',
             'max_order'=>'required',
             'adminproductType'=>'required',
              'price' => 'required|numeric|gt:0',
             'Qty'=> 'required|numeric|gt:0'

             //'KD_ID' => 'required',
             ]);
        $products = ProductList::find($id);
        $productImage = $request->image;
        if($productImage != null)
        {
        $image = $request->image;
        $imagename = time(). '.' . $image->getClientOriginalExtension();
        $request->image->move('assets/product_img',$imagename);
        $products->image = $imagename;
        }
        else
        {
            $products->image = $request->old_image;
        }
        $products->name = $request->name;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->packsize = $request->packsize;
        $products->Qty = $request->Qty;
        $products->min_order = $request->min_order;
        $products->max_order = $request->max_order;
        $products->catagory_id = $request->catagory;
        $products->productType_id = $request->adminproductType;
        $products->save();
        LogActivity::addToLog('Product List update store');

        Alert::toast('Product Updated Successfully', 'success');
        return redirect('/admin/view/productlist');
    }
    public function edited_product_store(Request $request,$id)
    {
        $request->validate([
             'image'=>'image|mimes:jpg,png,jpeg|max:5048',
             'name'=>'required|max:255',
             'description'=>'required|max:255',
             'packsize'=>'required|max:255',
             'catagory'=>'required',
             'adminproductType'=>'required',
              'price' => 'required|numeric|gt:0',
             'Qty'=> 'required|numeric|gte:0'

             //'KD_ID' => 'required',
             ]);
        $products = product::find($id);
        $productImage = $request->image;
        if($productImage != null)
        {
        $image = $request->image;
        $imagename = time(). '.' . $image->getClientOriginalExtension();
        $request->image->move('assets/product_img',$imagename);
        $products->image = $imagename;
        }
        else
        {
            $products->image = $request->old_image;
        }
        $products->name = $request->name;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->packsize = $request->packsize;
        $products->Qty = $request->Qty;

        $products->catagory_id = $request->catagory;
        $products->productType_id = $request->adminproductType;
        $products->save();
        LogActivity::addToLog('Product Edit Store');
        Alert::toast('Product Updated Successfully', 'success');
        return redirect('/admin/view/product');
    }
    public function delete_productlist($id)
    {
        $products = ProductList::find($id);
        //$products->delete();
          $products->Qty = 0;
          $products->save();
        LogActivity::addToLog('Delete Product List');

        Alert::toast('Product Deleted Successfully', 'success');
        return redirect('/admin/view/productlist');
    }
    public function delete_product($id)
    {
        $products = product::find($id);
       // $products->delete();
         $products->Qty = 0;
          $products->save();
        LogActivity::addToLog('Delete Product');

        Alert::toast('Product Deleted Successfully', 'success');
        return redirect('/admin/view/product');
    }
    public function add_catagory()
    {
        LogActivity::addToLog('View add category');

        return view('admin.addCatagories');
    }
     public function store_catagory(Request $request)
    {
        $request->validate([
            'catagoryName' => 'required|max:255',
            'description'=>'required|max:255',
            'image'=>'required|image|mimes:jpg,png,jpeg|max:5048',
        ]);
        $product_catagories = new ProductCatagory;
        $product_catagories->catagoryName = $request->catagoryName;
        $image = $request->image;
        $imagename = time(). '.' . $image->getClientOriginalExtension();
        $request->image->move('assets/catagory_img',$imagename);
        $product_catagories->image = $imagename;
        $product_catagories->description = $request->description;
        $product_catagories->save();
        LogActivity::addToLog('Store category');

        Alert::toast('Catagory Added Successfully', 'success');
         return redirect('/admin/view/catagory');
    }

    public function view_catagory()
    {
        $product_catagories= ProductCatagory::all();
        LogActivity::addToLog('View category');

        return view('admin.viewCatagories',compact('product_catagories'));

    }
    public function edit_productCatagory($id)
    {
        $product_catagories = ProductCatagory::find($id);
        LogActivity::addToLog('Edit Product View');

        return view('admin.editCatagory',compact('product_catagories'));

    }

    public function edited_product_catagories(Request $request,$id)
    {
        $request->validate([
            'catagoryName' => 'required|max:255',
            'description'=>'required|max:255',
            'image'=>'image|mimes:jpg,png,jpeg|max:5048',
        ]);

        $product_catagories = ProductCatagory::find($id);
        $catagoryImage = $request->image;
        if($catagoryImage != null)
        {
        $image = $request->image;
        $imagename = time(). '.' . $image->getClientOriginalExtension();
        $request->image->move('assets/catagory_img',$imagename);
        $product_catagories->image = $imagename;
        }
        else
        {
            $product_catagories->image = $request->old_image;
        }
        $product_catagories->catagoryName = $request->catagoryName;
        $product_catagories->description = $request->description;


        $product_catagories->save();
        LogActivity::addToLog('edit category store');

        Alert::toast('Catagory Updated Successfully', 'success');
        return redirect('/admin/view/catagory');
    }

    public function delete_ProductCatagory($id)
    {
        $products = product::where('catagory_id', $id)->count();
        if ($products > 0) {
            // return redirect('/admin/view/catagory')
            //     ->with('message', 'Something went wrong');
           LogActivity::addToLog('Delete Cataegory failed');

            Alert::toast('Catagory can not be deleted', 'error');
            return redirect('/admin/view/catagory');
        } else {
            $product_catagories = ProductCatagory::find($id);
            $product_catagories->delete();
        LogActivity::addToLog('Delete Catagory ');

            Alert::toast('Catagory Deleted ', 'success');
            return redirect('/admin/view/catagory');
        }
    }


    //     $product_catagories = ProductCatagory::find($id);
    //     $product_catagories->delete();
    //     Alert::toast('Catagory Deleted Successfully', 'success');
    //     return redirect('/admin/view/catagory');
    // }
      public function add_productType(Request $request)
    {
        // $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')->get();
        $catagory = ProductCatagory::all();
        LogActivity::addToLog('Add product type view');
        return view('admin.addProductTypes',compact('catagory'));
    }

     public function store_productType(Request $request)
    {
        $request->validate([
            'productTypeName' => 'required|max:255',
            'description'=>'required|max:255',
            'catagory' => 'required',

        ]);
        // $product_catagor = ProductCatagory::find($id);
        $product_types = new ProductType;
        $product_types->productTypeName = $request->productTypeName;
        $product_types->description = $request->description;
        $product_types->catagory_id = $request->catagory;
        $product_types->save();
        LogActivity::addToLog('Add product type store');
        Alert::toast('Product Type Added Successfully', 'success');
        return redirect('/admin/view/ProductType');
    }

    public function view_ProductType()
    {
        $product_types = ProductType::all();
        return view('admin.viewProductTypes',compact('product_types'));

    }

    public function edit_productType($id)
    {
        $product_types = ProductType::find($id);
        $catagory = ProductCatagory::all();
        LogActivity::addToLog('Edit product type view');

        return view('admin.editProductType',compact('catagory','product_types'));

    }
    public function edited_productType_store(Request $request,$id)
    {
        $request->validate([
            'productTypeName' => 'required',
            'description' => 'required',
            'catagory' => 'required',
        ]);
        $product_types = ProductType::find($id);
        $product_types->productTypeName = $request->productTypeName;
        $product_types->description = $request->description;
        $product_types->catagory_id = $request->catagory;
        $product_types->save();
        LogActivity::addToLog('Edit product type store');

        Alert::toast('Product Type Updated Successfully', 'success');
        return redirect('/admin/view/ProductType');
    }

    public function delete_productType($id)
    {
        // $product_types = ProductType::find($id);
        // $product_types->delete();
        // Alert::toast('Product Type Deleted Successfully', 'success');
        // return redirect('/admin/view/productType');
        $product = product::where('productType_id', $id)->count();
        if ($product > 0) {
            // return redirect('/admin/view/catagory')
            //     ->with('message', 'Something went wrong');
        LogActivity::addToLog('Delete product type failed');

            Alert::toast('product type can not be deleted ', 'error');
            return redirect('/admin/view/ProductType');
        } else {
            // print_r("deleted");
            $product_types = ProductType::find($id);
            $product_types->delete();
            // $product_catagories = ProductCatagory::find($id);
            // $product_catagories->delete();
        LogActivity::addToLog('Delete product type');

            Alert::toast('Product Deleted ', 'success');
            return redirect('/admin/view/ProductType');
        }
    }
    // public function activate_user($id)
    // {
    //     $user = user::find($id);
    //     $user->status = 'active';
    //     $user->save();
    //     Alert::toast('Successfully Activated', 'success');
    //     return redirect()->back();
    // }
    //  public function deactivate_user($id,Request $request)
    // {
    //     $user = user::find($id);
    //     $user->status = $request->deactivate;
    //     $user->save();
    //     Alert::toast('Successfully Deactivated', 'success');
    //     return redirect()->back();
    // }
     public function changeStatus(Request $request)
    {

        $user = user::find($request->user_id);
            $user->status = $request->status;
            $user->save();
        LogActivity::addToLog('Change Status of user');

            return response()->json(['success'=>'Status change successfully.']);
    }

     public function changeorderStatus(Request $request)
    {

        
        $city = cities::find($request->user_id);
        
        if($city->order_status==1)
        {
         
             return response()->json(['success'=>'Already Started.']);
        }
        else
        {
           $city->order_status = $request->status;
        $city->save();
        $region= regions::find($city->region_id);
         $user = order_statuses::create([
            'Region' => $region->name,
            'City'=> $city->name,
            'startdate'=> now()->toDateTimeString(),
            'status'=> $request->status

        ]);
      

        LogActivity::addToLog('Change Status of order');
            //return response()->json(['success'=>'Status change successfully.']);
           
        }

    }

         public function changeClientStatus(Request $request)
    {
        $client = user::find($request->client_id);
        $client->status = $request->status;
        $client->save();
        LogActivity::addToLog('Edit client status');

        return response()->json(['success'=>'Status change successfully.']);
    }

    public function newUserList()
    {
        $userList=user::paginate(100);
        LogActivity::addToLog('view Users List');

        return view('admin.userList',compact('userList'));
    }


     public function edit_user($id)
    {
        $user = User::find($id);
        // $productType= ProductType::all();
        // $products = product::find($id);
        // $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')->get();
        LogActivity::addToLog('Edit user view');

        return view('admin.edituser',compact('user'));

    }
    public function edited_user_store(Request $request,$id)
    {

        $request->validate([
            'firstName' => ['required', 'alpha', 'max:255'],
            'middleName' => ['required', 'alpha', 'max:255'],
            'lastName' => ['required', 'alpha', 'max:255'],
            'userName' => ['required', 'string', 'max:255'],
            'email' => [ 'string', 'email', 'max:255'],


        ]);


            // 'firstName'=>$request->firstName,
            // 'middleName'=>$request->middleName,
            // 'lastName'=> $request->lastName,
            // 'userName'=> $request->userName,
            // 'email' => $request->email,
            //  ]);

        $user = User::find($id);
        $user->firstName = $request->firstName;
        $user->middleName = $request->middleName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->userName = $request->userName;
        //    'password'=>Hash::make($request['password']),
        //     'userType'=>$request->userType,
        //     'status'=>$request->status,


             $user->save();
        LogActivity::addToLog('Edit User Data');

            Alert::toast('successfully Registered', 'success');
        return redirect('/user/list');


    }
   public function edit_client($id)
    {
          $businessType=businessType::all();

        $idType= idType::all();
        $user = User::join('clients','clients.user_id','=','users.id')
        ->where('users.id',$id)
        ->first();
        $kd= $user->distro_id;
         $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')
         ->where('users.id',$kd)
         ->get();
          $key_all = key_distro::join('users','users.id','=','key_distros.user_id')
         ->get();
          $agents = agent::join('users','users.id','=','agents.user_id')->get();
          $agent=$user->agent_id;
          $agent_se = agent::join('users','users.id','=','agents.user_id')
          ->where('users.id',$agent)
          ->get();
        LogActivity::addToLog('Edit client view');

        return view('admin.editclient',compact('user','key_distro','key_all','businessType','idType','agents','agent_se'));
    }
    public function edited_client_store(Request $request,$id)
    {

           $client = client::find($id);

             $client->Mother_name = $request->Mother_name;
             $client->ID_type = $request->ID_type;
             $client->Gender = $request->Gender;
             $client->birthdate = $request->birthdate;
             $client->PhoneType = $request->PhoneType;
             $client->client_business_Name = $request->client_business_Name;
             $client->client_mobile_phone = $request->client_mobile_phone;
             $client->Alternative_Phone_Number = $request->Alternative_Phone_Number;
             $client->Nationality = $request->Nationality;
             $client->ID_expiry_Date = $request->ID_expiry_Date;
             $client->Photo = $request->Photo;
             $client->businessRegisteration = $request->businessRegisteration;
             $client->userName = $request->userName;
             $client->FamilySize = $request->FamilySize;
             $client->child_in_school = $request->child_in_school;
             $client->Marital_Status = $request->Marital_Status;
             $client->Country = $request->Country;
             $client->City = $request->City;
             $client->Region = $request->Region;
             $client->zone = $request->zone;
             $client->kebele = $request->kebele;
             $client->house_number = $request->house_number;

             $client->ID_Number = $request->ID_Number;
             $client->agent_id = $request->agent_id ;
             $client->client_business_Type = $request->client_business_Type;
             $client->Tin_number = $request->Tin_number;
             $client->License_number = $request->License_number;
             $client->Distance_from_KD = $request->Distance_from_KD;
             $client->distro_id = $request->kd;

             $client->ID_expiry_Date = $request->ID_expiry_Date;
             $client->businessRegisteration = $request->businessRegisteration;
             $client->status = $request->status;
             $client->Bank_Account = $request->Bank_Account;
             $client->Bank_name = $request->Bank_name;
             $client->Bank_Account_Number = $request->Bank_Account_Number;
             $client->Community_Saving = $request->Community_Saving;
             $client->Community_loan = $request->Community_loan;
             $client->Receival_of_training = $request->Receival_of_training;
             $client->Training_provided_by = $request->Training_provided_by;
             $client->ID_issue_date = $request->ID_issue_date;
             $client->Long_term_personal_goals = $request->Long_term_personal_goals;
             $client->Long_term_business_goals = $request->Long_term_business_goals;
             $client->Desired_place_of_residence = $request->Desired_place_of_residence;

             $client->age = $request->age;
             $client->nochild = $request->nochild;
             $client->child_in_school_under2 = $request->child_in_school_under2;
             $client->camp = $request->camp;
             $client->unhcr_id = $request->unhcr_id;
             $client->businesscamp = $request->businesscamp;
             $client->businesszone = $request->businesszone;
             $client->establishment_date = $request->establishment_date;
             $client->workpermit = $request->workpermit;
             $client->financialproduct_saving = $request->financialproduct_saving;
             $client->financialproduct_loan = $request->financialproduct_loan;
             $client->financialproduct_payment = $request->financialproduct_payment;
             $client->otheraccount = $request->otheraccount;
             $client->productused_saving = $request->productused_saving;
             $client->productused_loan = $request->productused_loan;
             $client->productused_remittance = $request->productused_remittance;
             $client->productused_payment = $request->productused_payment;
             $client->Training_taking = $request->Training_taking;
             $client->Training_given_org = $request->Training_given_org;
             $client->Training_module1 = $request->Training_module1;
             $client->Training_module2 = $request->Training_module2;
             $client->Training_module3 = $request->Training_module3;
             $client->areas_intrested_finance = $request->areas_intrested_finance;
             $client->areas_intrested_scale = $request->areas_intrested_scale;
             $client->areas_intrested_digitize = $request->areas_intrested_digitize;
             $client->short_term_personal_goals = $request->short_term_personal_goals;
             $client->short_term_business_goals = $request->short_term_business_goals;
             $client->leaveethiopia = $request->leaveethiopia;
             $client->when_leave = $request->when_leave;

             $client->save();


        $id_user=client::where('id',$id)->first();
        $id=$id_user->user_id;
        $user = User::find($id);
        $user->firstName = $request->firstName;
        $user->middleName = $request->middleName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->userName = $request->userName;

             $user->save();
        LogActivity::addToLog('Client Edit store');

            Alert::toast('successfully Registered', 'success');
        return redirect('/admin/view/clients');

    }





    public function delete_user($id)
    {
        $users = User::find($id);

        //$users->delete();
        Alert::toast('User Deleted Successfully', 'success');
        // return redirect('/admin/view/users');
        LogActivity::addToLog('User Deleted');
        return redirect()->back();

    }





    public function create_client()
    {
        $businessType=businessType::all();

        $idType= idType::all();
        $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')->get();
        $agents = agent::join('users','users.id','=','agents.user_id')->get();
        $regions = regions::all(); // Fetch all regions
        $cities = cities::all();
      

        // $key_distross= key_distro::all();
        // echo  $key_distross;
        LogActivity::addToLog('Register Client View');


        return view('admin.registerClient',compact('businessType','key_distro','idType','agents','regions','cities'));
    }

    public function store_client(Request $request)
    {
         $data = client::orderBy('id','asc')->first();
        // dd($data);
        $client_unique_id = 'CL'.rand(10000, 99999);
 //$client_unique_id = general::IDGenerator_client(new client, 'client_unique_id', 5, 'CL',$data);

  $found=client::where('client_unique_id',$client_unique_id)->count();
  while($found>0)
  {
    //$client_unique_id = general::IDGenerator_client(new client, 'client_unique_id', 5, 'CL');
    // echo  $client_unique_id;
    $client_unique_id = 'CL'.rand(10000, 99999);
     $found=client::where('client_unique_id',$client_unique_id)->count();
  }


//     $client_unique_id = general::IDGenerator_client(new client, 'client_unique_id', 5, 'CL');
//   $found=client::where('client_unique_id',$client_unique_id)->count();

         $imageName = time().'.'.$request->Photo->extension();

        $request->Photo->move(public_path('images'), $imageName);

        //    $imagename = time() . '.' . $request->id_path->getClientOriginalExtension();
        //    $request->id_path->move('assets/gov_img',$imagename);
        $check=user::where('userName',$request->userName)->count();
        if($check > 0)
        {
            Alert::toast('User Name Already Exist', 'error');
             return redirect()->back();
        }
        else
        {
  $user = user::create([
            'firstName' => $request->firstName,
            'middleName'=> $request->middleName,
            'lastName'=> $request->lastName,
            'password'=> Hash::make($request->password),
            'userType'=> $request->userType,
            'status' => $request->status,
            'userName' => $request->userName,

        ]);

           $client= client::create([
             'Mother_name' => $request->Mother_name,
             'ID_type' => $request->ID_type,
             'Gender' => $request->Gender,
             'birthdate' => $request->birthdate,
             'PhoneType' => $request->PhoneType,
             'client_business_Name' => $request->client_business_Name,
             'client_mobile_phone' => $request->client_mobile_phone,
             'Alternative_Phone_Number' => $request->Alternative_Phone_Number,
             'Nationality' => $request->Nationality,
             'ID_expiry_Date' => $request->ID_expiry_Date,
             'Photo' => $request->Photo,
             'businessRegisteration' => $request->businessRegisteration,
             'userName' => $request->userName,
             'FamilySize' => $request->FamilySize,
             'child_in_school' => $request->child_in_school,
             'Marital_Status' => $request->Marital_Status,
             'Country' => $request->Country,
             'City' => $request->City,
             'Region' => $request->Region,
             'zone' => $request->zone,
             'kebele' => $request->kebele,
             'house_number' => $request->house_number,
             'idType' => $request->idType,
             'ID_Number' => $request->ID_Number,
             'client_business_Type' => $request->client_business_Type,
             'Tin_number' => $request->Tin_number,
             'License_number' => $request->License_number,
             'Distance_from_KD' => $request->Distance_from_KD,
             'distro_id' => $request->kd,
             'agent_id' => $request->agent_id,


             'age' => $request->age,
             'nochild' => $request->nochild,
             'child_in_school_under2' => $request->child_in_school_under2,
             'camp' => $request->camp,
             'unhcr_id' => $request->unhcr_id,
             'businesscamp' => $request->businesscamp,
             'businesszone' => $request->businesszone,
             'establishment_date' => $request->establishment_date,
             'workpermit' => $request->workpermit,
             'financialproduct_saving' => $request->financialproduct_saving,
             'financialproduct_loan' => $request->financialproduct_loan,
             'financialproduct_payment' => $request->financialproduct_payment,
             'otheraccount' => $request->otheraccount,
             'productused_saving' => $request->productused_saving,
             'productused_loan' => $request->productused_loan,
             'productused_remittance' => $request->productused_remittance,
             'productused_payment' => $request->productused_payment,
             'Training_taking' => $request->Training_taking,
             'Training_given_org' => $request->Training_given_org,
             'Training_module1' => $request->Training_module1,
             'Training_module2' => $request->Training_module2,
             'Training_module3' => $request->Training_module3,
             'areas_intrested_finance' => $request->areas_intrested_finance,
             'areas_intrested_scale' => $request->areas_intrested_scale,
             'areas_intrested_digitize' => $request->areas_intrested_digitize,
             'short_term_personal_goals' => $request->short_term_personal_goals,
             'short_term_business_goals' => $request->short_term_business_goals,
             'leaveethiopia' => $request->leaveethiopia,
             'when_leave' => $request->when_leave,


             'ID_expiry_Date' => $request->ID_expiry_Date,
             'businessRegisteration' => $request->businessRegisteration,
             'status' => $request->status,
             'Bank_Account' => $request->Bank_Account,
             'Bank_name' => $request->Bank_name,
             'Bank_Account_Number' => $request->Bank_Account_Number,
             'Community_Saving' => $request->Community_Saving,
             'Community_loan' => $request->Community_loan,
             'Receival_of_training' => $request->Receival_of_training,
             'Training_provided_by' => $request->Training_provided_by,
             'ID_issue_date' => $request->ID_issue_date,
             'Long_term_personal_goals' => $request->Long_term_personal_goals,
             'Long_term_business_goals' => $request->Long_term_business_goals,
             'Desired_place_of_residence' => $request->Desired_place_of_residence,
             'user_id' => $user->id,
             'PinCode' => $this->generateUniqueCode(),

             'client_mobile_phone'=>$request->client_mobile_phone,
             'client_unique_id'=>$client_unique_id,
            ]);

        Alert::toast('Successfully Registered', 'success');
        LogActivity::addToLog('Register Client Store');
        return redirect('/admin/view/clients');

        }
        }

    public function generateUniqueCode()
    {
        do {
            $PinCode = random_int(1000, 9999);
        } while (client::where("PinCode", "=", $PinCode)->first());

        return $PinCode;
    }
 public function create_tm()
    {
        $idType= idType::all();
        $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')->get();
         LogActivity::addToLog('Register TM view');
        return view('admin.registerTM',compact('idType','key_distro'));
    }

    public function create_facilator()
    {
        $idType= idType::all();
        $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')->get();
        LogActivity::addToLog('Register Facilitator View');
        return view('admin.registerfacilator',compact('idType','key_distro'));
    }



 public function store_facilator(Request $request){
        $request->validate([
            'firstName' => ['required', 'alpha', 'max:255'],
            'middleName' => ['required', 'alpha', 'max:255'],
            'lastName' => ['required', 'alpha', 'max:255'],
            'userName' => ['required', 'string', 'max:255','unique:users'],
            // 'password' => ['required', 'string', 'min:6', 'confirmed'],
            'address' =>'required',
            'mobile' =>'required|digits:10',
            'id_path'=>'required|image|mimes:jpg,png,jpeg|max:5048',
            'idType' =>'required',
            'ID_number' =>'required',
            'ID_issue_date' =>'required|date|before:today',
            'ID_expiry_date' =>'required|date|after:today',
            'profilePicture' => 'required|image|mimes:jpg,png,jpeg|max:5048'
        ]);
        $user_type="facilitator";

          $user_pro  = $request->profilePicture;

       $user_proName = time() . '.' . $user_pro->getClientOriginalExtension();
        $user_pro->move('assets/users_img',$user_proName);
        $user = user::create([
            'firstName'=>$request->firstName,
            'middleName'=>$request->middleName,
            'lastName'=> $request->lastName,
            'userName'=> $request->userName,
            'userType' => $user_type,
            'userPhoto' => $user_proName,

            'password'=>Hash::make($request['password']),
            'userType'=>$user_type,
            'status'=>$request->status,
        ]);
 $tm_id = time().'.'.$request->id_path->extension();

$request->id_path->move('assets/gov_img', $tm_id);

// $path = 'assets/gov_img'.$tm_id;

         LogActivity::addToLog('Register Facilitator Store');
        Alert::toast('successfully Registered', 'success');

        return redirect('/user/list');

    }


    public function store_tm(Request $request){
        $request->validate([
            'firstName' => ['required', 'alpha', 'max:255'],
            'middleName' => ['required', 'alpha', 'max:255'],
            'lastName' => ['required', 'alpha', 'max:255'],
            'userName' => ['required', 'string', 'max:255','unique:users'],
            // 'password' => ['required', 'string', 'min:6', 'confirmed'],
            'address' =>'required',
            'mobile' =>'required|digits:10',
            'id_path'=>'required|image|mimes:jpg,png,jpeg|max:5048',
            'idType' =>'required',
            'ID_number' =>'required',
            'ID_issue_date' =>'required|date|before:today',
            'ID_expiry_date' =>'required|date|after:today',
            'profilePicture' => 'required|image|mimes:jpg,png,jpeg|max:5048'
        ]);
        $user_type="TM";

          $user_pro  = $request->profilePicture;

       $user_proName = time() . '.' . $user_pro->getClientOriginalExtension();
        $user_pro->move('assets/users_img',$user_proName);
        $user = user::create([
            'firstName'=>$request->firstName,
            'middleName'=>$request->middleName,
            'lastName'=> $request->lastName,
            'userName'=> $request->userName,
            'userType' => $user_type,
            'userPhoto' => $user_proName,

            'password'=>Hash::make($request['password']),
            'userType'=>$user_type,
            'status'=>$request->status,
        ]);
 $tm_id = time().'.'.$request->id_path->extension();

$request->id_path->move('assets/gov_img', $tm_id);

// $path = 'assets/gov_img'.$tm_id;
        $tm = tm::create([
            'user_id'=>$user->id,
            'address'=> $request->address,
            'mobile'=>$request->mobile,
            'kd_id'=>$request->kd_id,
            'id_filepath'=> $tm_id,
            'ID_type'=>$request->idType,
            'ID_number'=> $request->ID_number,
            'ID_issue_date'=> $request->ID_issue_date,
            'ID_expiry_date'=> $request->ID_expiry_date,
            'latitude' => $request->lat,
            'longtude' => $request->lng,

        ]);
        $kdupdate = key_distro::where('user_id',$request->kd_id)
        ->update(['has_tm'=>'1']);

         LogActivity::addToLog('Register tm Store');

        Alert::toast('successfully Registered', 'success');
        return redirect('/user/list');

    }


    public function create_user()
    {
         LogActivity::addToLog('Register user view');
        return view('admin.registerUser');
    }
    public function store_user(Request $request){
        $request->validate([
            'firstName' => ['required', 'alpha', 'max:255'],
            'middleName' => ['required', 'alpha', 'max:255'],
            'lastName' => ['required', 'alpha', 'max:255'],
            'userName' => ['required', 'string', 'max:255','unique:users'],
            'email' => [ 'string', 'email', 'max:255', 'unique:users'],
            'userType' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);



         $user = user::create([
            'firstName'=>$request->firstName,
            'middleName'=>$request->middleName,
            'lastName'=> $request->lastName,
            'userName'=> $request->userName,
            'email' => $request->email,
            'password'=>Hash::make($request['password']),
            'userType'=>$request->userType,
            'status'=>$request->status,
        ]);
         LogActivity::addToLog('Register User Store');
        Alert::toast('successfully Registered', 'success');
        return redirect('/user/list');
//
    }
    // public function view_clients()
    // {
    //     $client = client::join('users','users.id', '=','clients.user_id')

    //     ->paginate(100);
    //     $key_distro=key_distro::join('users','users.id','=','key_distros.user_id')
    //     ->join('clients','clients.distro_id','=','key_distros.user_id')
    //     ->get();
    //     LogActivity::addToLog('view clients');
    //     return view('admin.showClients',compact('client','key_distro'));

    // }
    public function view_clients(Request $request)
{
    $search = $request->input('search');
    $client = client::join('users', 'users.id', '=', 'clients.user_id');

    if (!empty($search)) {
        $client = $client->where(function ($query) use ($search) {
            $query->where('users.firstName', 'like', "%$search%")
                ->orWhere('users.middleName', 'like', "%$search%")
                ->orWhere('users.lastName', 'like', "%$search%")
                ->orWhere('users.userName', 'like', "%$search%")
                ->orWhere('users.status', 'like', "%$search%")
                ->orWhere('clients.distro_id', 'like', "%$search%")
                ->orWhere('clients.Region', 'like', "%$search%")
                ->orWhere('clients.client_unique_id', 'like', "%$search%")
                ->orWhere('clients.City', 'like', "%$search%");
        });
    }

    $client = $client->paginate(10);
    if ($request->ajax()) {
        LogActivity::addToLog('view clients');
    return response()->json($client);
} else {
    LogActivity::addToLog('view clients');
    return view('admin.showClients', compact('client'));
}


}
     public function Qrgenerator($id)
    {
		    $result=0;
			$client = client::where('user_id',$id)->first();
            $user=client::join('users','users.id','=','clients.user_id')
            ->where('clients.user_id',$id)
            ->get();

			if ($client) {

			   if($client->QRPassword == NULL)
                	     {
      			        $qrLogin = MD5($client->id);
		                $client->QRPassword= $qrLogin;
		                $client->update();
		                $result=1;
		      	     }
        LogActivity::addToLog('Generate Qrcode');

        return view('admin.show_client', compact('client','user'));
        }else
        {
            LogActivity::addToLog('Qr generator error');

            return redirect()->back()->with('error', 'QR Generator Error.');
       }
    }
    public function orderIndex()
    {
        $order = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.createdDate',today())
        ->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.deliveryStatus', 'clients.distro_id','KD_id']);
        return view('admin.showOrders',compact('order'));

    }
    public static function getname($id)
    {
  $kd = DB::table('key_distros')
        ->join('users','users.id','=','key_distros.user_id')
        ->where('key_distros.user_id', $id)
        ->get(['users.firstName','users.middleName','users.lastName']);
        return $kd;
       }
    public function orderHistory()
    {
         $order = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','users.id')
        ->join('key_distros', 'key_distros.user_id','=','clients.distro_id')
        ->get(['users.firstName','users.middleName','users.lastName','orders.id',
        'orders.createdDate','orders.deliveryStatus', 'clients.distro_id']);

        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $kd = order::join('users','users.id','=','orders.KD_id')->
        join('key_distros','key_distros.user_id','=','orders.KD_id')
        ->where('orders.createdBy',auth()->user()->id)->get();



        return view('admin.orderHistory',compact('client','kd','order'));

    }
    public function undeliveredIndex( )
    {
        $rom = undeliveredOrders::join('users','users.id','=','undelivered_orders.rom_id')
        ->join('roms','roms.user_id','=','undelivered_orders.rom_id')->get(['users.firstName','users.middleName'
        ,'users.lastName','undelivered_orders.*'])->sortDesc();

        $deliveredProducts = delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get();
        $count = $deliveredProducts->count();
        return view('admin.undeliveredOrders',compact('deliveredProducts','rom'));

    }
    public function undeliveredDetails(Request $request )
    {
        $rom_id=$request->delivery1_id;
        $deliveredProducts=undelivered1Products::join('undelivered_orders','undelivered_orders.id','=','undelivered1_products.undelivered1_id')
        ->join('products','products.id','=','undelivered1_products.product_id')
        ->where('undelivered1_products.undelivered1_id',$rom_id)->get();
        return view('admin.undeliveredDetails',compact('deliveredProducts'));

    }
    public function add_region(Request $request)
    {
        $regions = regions::all();
        LogActivity::addToLog('Add Regions');
        return view('admin.addRegions',compact('regions'));
    }
     public function store_region(Request $request)
    {
       $request->validate([
            'name' => 'required|max:255',
        ]);
        $region = new regions;
        $region->name = $request->name;
        $region->save();
        LogActivity::addToLog('Store region');

        Alert::toast('Regions Added Successfully', 'success');
         return redirect('/admin/view/Region');
    }
    public function view_region()
    {
        $client = regions::all();
        LogActivity::addToLog('view regions');
        return view('admin.showRegion',compact('client'));
    }
   public function edit_region($id)
   {
     $region = regions::find($id);
        LogActivity::addToLog('Edit Regions');

        return view('admin.editRegion',compact('region'));
   }
  public function edited_region_store(Request $request,$id)
  {
        $request->validate([
            'name' => 'required|max:255',
        ]);
         $regions = regions::find($id);

        $regions->name = $request->name;
        $regions->save();
        LogActivity::addToLog('Store Region edit');
        Alert::toast('Region Edited Successfully', 'success');
         return redirect('/admin/view/Region');
  }

  public function add_city(Request $request)
    {
        $city = cities::all();
        $region =regions::all();
        LogActivity::addToLog('Add cities');
        return view('admin.addCity',compact('city','region'));
    }
    public function store_city(Request $request)
    {
       $request->validate([
            'name' => 'required|max:255',
             'region_id' => 'required|max:255',
        ]);
        $city = new cities;
        $city->name = $request->name;
        $city->region_id = $request->region_id;
        $city->save();
        LogActivity::addToLog('Store city');

        Alert::toast('City Added Successfully', 'success');
         return redirect('/admin/view/City');
    }
    public function view_city()
    {
        $city = cities::join('regions','regions.id','=','cities.region_id')
        ->get(['regions.name as region','cities.*']);
        LogActivity::addToLog('view city');

        return view('admin.showCity',compact('city'));
    }
   public function edit_city($id)
   {
     $city = cities::join('regions','regions.id','=','cities.region_id')
        ->where('cities.id','=',$id)
        ->get(['regions.name as region','cities.*','regions.id as region_id']);
         $region =regions::all();
        LogActivity::addToLog('Edit city');

        return view('admin.editcity',compact('city','region'));
   }
  public function edited_city_store(Request $request,$id)
  {

        $request->validate([
            'name' => 'required|max:255',
            'region_id' => 'required|max:255',
        ]);


         $city = cities::find($id);
        $city->name = $request->name;
        $city->region_id = $request->region_id;
        $city->save();
        LogActivity::addToLog('Store city edit');
        Alert::toast('city Edited Successfully', 'success');
         return redirect('/admin/view/City');
  }



}
