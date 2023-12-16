<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;



class officerController extends Controller
{



    public function Order_hierarchy()
    {
        $hierarchy= Handover_hierarchy::all();
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

       return view('dashboard.officerDashboard',compact('client','kds','users','agents','roms','rsps','todaysOrders','totalOrders','total_sales','jsonResult','order'));
    }


    public function add_product(Request $request)
    {
        $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')->get();
        $data['catagories'] = ProductCatagory::get(["catagoryName", "id"]);
        $data['products'] = ProductList::get();
        // $catagory = ProductCatagory::all();
        // $productType= ProductType::all();
        // return view('KD.addProducts', $data );
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
        $products->KD_ID = $request->Kd_id;
        $products->productlist_id = $request->id;
         $products->save();
        Alert::toast('Product Added Successfully', 'success');
        return redirect('/admin/add/product');




    }
      public function view_productlist()
    {
        $products= ProductList::all();
        return view('admin.viewProductslist',compact('products'));

    }


        public function add_product_list(Request $request)
    {
        $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')->get();
        $data['catagories'] = ProductCatagory::get(["catagoryName", "id"]);
        // $catagory = ProductCatagory::all();
        // $productType= ProductType::all();
        // return view('KD.addProducts', $data );
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
        Alert::toast('Product Added Successfully', 'success');
        return redirect('/admin/view/productlist');
    }



    public function view_product()
    {
        $products= product::join('users','users.id','=','products.KD_ID')
        ->get(['products.*','users.firstName','users.middleName','users.lastName']);
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
             'Qty'=> 'required|numeric|gt:0'

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
        Alert::toast('Product Updated Successfully', 'success');
        return redirect('/admin/view/product');
    }
    public function delete_productlist($id)
    {
        $products = ProductList::find($id);
        $products->delete();
        Alert::toast('Product Deleted Successfully', 'success');
        return redirect('/admin/view/productlist');
    }
    public function delete_product($id)
    {
        $products = product::find($id);
        $products->delete();
        Alert::toast('Product Deleted Successfully', 'success');
        return redirect('/admin/view/product');
    }
    public function add_catagory()
    {
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
        Alert::toast('Catagory Added Successfully', 'success');
         return redirect('/admin/view/catagory');
    }

    public function view_catagory()
    {
        $product_catagories= ProductCatagory::all();
        return view('admin.viewCatagories',compact('product_catagories'));

    }
    public function edit_productCatagory($id)
    {
        $product_catagories = ProductCatagory::find($id);
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
        Alert::toast('Catagory Updated Successfully', 'success');
        return redirect('/admin/view/catagory');
    }

    public function delete_ProductCatagory($id)
    {
        $products = product::where('catagory_id', $id)->count();
        if ($products > 0) {
            // return redirect('/admin/view/catagory')
            //     ->with('message', 'Something went wrong');
            Alert::toast('Catagory can not be deleted', 'error');
            return redirect('/admin/view/catagory');
        } else {
            $product_catagories = ProductCatagory::find($id);
            $product_catagories->delete();
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
            Alert::toast('product type can not be deleted ', 'error');
            return redirect('/admin/view/ProductType');
        } else {
            // print_r("deleted");
            $product_types = ProductType::find($id);
            $product_types->delete();
            // $product_catagories = ProductCatagory::find($id);
            // $product_catagories->delete();
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

            return response()->json(['success'=>'Status change successfully.']);
    }

         public function changeClientStatus(Request $request)
    {
        $client = user::find($request->client_id);
        $client->status = $request->status;
        $client->save();

        return response()->json(['success'=>'Status change successfully.']);
    }

    public function newUserList()
    {
        $userList=user::paginate(100);
        return view('admin.userList',compact('userList'));
    }


     public function edit_user($id)
    {
        $user = User::find($id);
        // $productType= ProductType::all();
        // $products = product::find($id);
        // $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')->get();
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
          $agent= $user->agent_id;
          $agent_se = agent::join('users','users.id','=','agents.user_id')
          ->where('users.id',$agent)
          ->get();
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
             $client->Training_module = $request->Training_module;
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
            Alert::toast('successfully Registered', 'success');
        return redirect('/admin/view/clients');


    }





    public function delete_user($id)
    {
        $users = User::find($id);
        $users->delete();
        Alert::toast('User Deleted Successfully', 'success');
        // return redirect('/admin/view/users');
        return redirect()->back();

    }





    public function create_client()
    {
        $businessType=businessType::all();

        $idType= idType::all();
        $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')->get();
        $agents = agent::join('users','users.id','=','agents.user_id')->get();

        // $key_distross= key_distro::all();
        // echo  $key_distross;
        return view('admin.registerClient',compact('businessType','key_distro','idType','agents'));
    }

    public function store_client(Request $request)
    {
    //    $err = $request->validate
    //    ([
    //         'firstName' => ['required', 'alpha', 'max:255'],
    //         'middleName' => ['required', 'alpha', 'max:255'],
    //         'lastName' => ['required', 'alpha', 'max:255'],
    //         // 'userName' => ['required', 'alpha', 'max:255','unique:users'],
    //         // 'userType' => ['required', 'alpha', 'max:255'],
    //         'Mother_name' => ['required', 'string', 'max:255'],
    //         'Gender' => ['required', 'string', 'max:255'],
    //         'birthdate' => ['required', 'string', 'max:255'],
    //         'PhoneType' => ['required', 'string', 'max:255'],


    //         'client_mobile_phone' => ['required', 'digits:10'],
    //         'Alternative_Phone_Number' => ['required', 'digits:10'],
    //         'Nationality' => ['required', 'alpha', 'max:255'],
    //         'Photo' => ['image','mimes:jpg,png,jpeg','max:5048'],

    //         'FamilySize' => ['required', 'digits'],
    //         'child_in_school' => ['required', 'alpha', 'max:255'],
    //         'Marital_Status' => ['required', 'alpha', 'max:255'],
    //         'userName' => ['required', 'alpha', 'max:255'],
    //         'Country' => ['required', 'alpha', 'max:255'],
    //         'City' => ['required', 'alpha', 'max:255'],
    //         'Region' => ['required', 'alpha', 'max:255'],
    //         'kebele' => ['required', 'alpha', 'max:255'],
    //         'house_number' => ['required', 'alpha', 'max:255'],
    //         'idType' => ['required', 'alpha', 'max:255'],
    //         'ID_Number' => ['required', 'alpha', 'max:255'],
    //         'ID_issue_date' => ['required', 'alpha', 'max:255'],
    //         'ID_expiry_Date' => ['required', 'alpha', 'max:255'],
    //         'client_businessName' => ['required', 'alpha', 'max:255'],
    //         'client_businessType' => ['required', 'alpha', 'max:255'],
    //         'businessRegistration' => ['required', 'alpha', 'max:255'],
    //         'Tin_number' => ['required', 'alpha', 'max:255'],
    //         'License_number' => ['required', 'alpha', 'max:255'],
    //         'Distance_from_KD' => ['required', 'alpha', 'max:255'],
    //         'distro_id' => ['required', 'alpha', 'max:255'],

    //         // 'zone' => ['required', 'alpha', 'max:255'],






    //           'firstName' => ['required', 'alpha', 'max:255'],
    //         'middleName' => ['required', 'alpha', 'max:255'],
    //         'lastName' => ['required', 'alpha', 'max:255'],
    //         'password' => ['required', 'min:6'],
    //         'PinCode' => ['required', 'min:4'],
    //         'QRPassword' => ['required'],
    //         'address' =>['required', 'string'],
    //         'mobile' => ['digits:10'],

    //         'kd' =>['required'],
    //         'status' => ['required'],
    //         'lat' => ['required'],
    //         'lng' => ['required'],
    //         'Bank_Account_Number' => 'required|numeric|digits:14'
    //     ]);
         $client_unique_id = general::IDGenerator(new client, 'client_unique_id', 5, 'CL');


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


             'ID_expiry_Date' => $request->ID_expiry_Date,
             'businessRegisteration' => $request->businessRegisteration,
             'Training_module' => $request->Training_module,
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
        return view('admin.registerTM',compact('idType','key_distro'));
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

        Alert::toast('successfully Registered', 'success');
        return redirect('/user/list');

    }


    public function create_user()
    {
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
        Alert::toast('successfully Registered', 'success');
        return redirect('/user/list');
    }
    public function view_clients()
    {
        $client = client::join('users','users.id', '=','clients.user_id')

        ->paginate(100);
        $key_distro=key_distro::join('users','users.id','=','key_distros.user_id')
        ->join('clients','clients.distro_id','=','key_distros.user_id')
        ->get();
        return view('admin.showClients',compact('client','key_distro'));

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
        return view('admin.show_client', compact('client','user'));
        }else
        {
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
        ->where('key_distros.id', $id)
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

}
