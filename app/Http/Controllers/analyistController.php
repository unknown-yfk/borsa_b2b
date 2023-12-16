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
use App\Exports\Exportorders;
use Maatwebsite\Excel\Facades\Excel;



class analyistController extends Controller
{

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

        return view('dashboard.analyistDashboard',compact('client','kds','users','agents','roms','rsps','todaysOrders','totalOrders','total_sales','jsonResult','order'));



    }
 public function view_clients()
    {
        $client = client::join('users','users.id', '=','clients.user_id')
        ->paginate(1000000);
        $key_distro=key_distro::join('users','users.id','=','key_distros.user_id')
        ->join('clients','clients.distro_id','=','key_distros.user_id')
        ->get();

        return view('analyist.showClients',compact('client','key_distro'));

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
        return view('analyist.editclient',compact('user','key_distro','key_all','businessType','idType','agents','agent_se'));

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
            Alert::toast('successfully Registered', 'success');
        return redirect('/analyist/view/clients');


    }

      public function newUserList()
    {
        $userList=user::paginate(1000000);
        return view('analyist.userList',compact('userList'));
    }
    public function userdetail(Request $request)
    {
        $user_id=$request->user_id;
        $user = user::join('clients','clients.user_id','=','users.id')
        ->where('users.id',$user_id)
        ->get();


         return view('analyist.clientDetailsho',compact('user'));
            

    }
}
