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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;




class hoController extends Controller
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

// get orders by region
$ordersByRegion = order::join('clients', 'orders.client_id', '=', 'clients.id')
->select('clients.region', DB::raw('COUNT(orders.id) as order_count'))
->groupBy('clients.region')
->get();

$mostOrderedProducts = orderedProducts::select( 'productlist.name', DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered'))
->join('products', 'products.id', '=', 'ordered_products.product_id')
->join('productlist', 'productlist.id', '=', 'products.productlist_id')
->groupBy('productlist.name')
->orderByDesc('total_ordered')
->take(10)
->get();

    // get total orders depend on rejected,accepted and adjusted
// three scinarios in here
// first find a rejected one
$rejectedOrder=order::where('confirmstatus', '=', 'declined')
->count();

$pendingOrders = order::where('confirmstatus', '=', 'unconfirmed')

    ->count();

// second scinaroio a fully accepted one with confirmed status
    $acceptedOrder = order::where('confirmstatus', '=', 'confirmed')
    ->count();
//third scinario the djusted one which is confirmed with price change and confirmed with deviation
    $adjustedORder = order::whereIn('confirmstatus', ['confirmed_with_price_update', 'confirmed_with_deviation'])
    ->get()->count();

    $RomApproved=order::where('rom_order_confirmation','=','confirmed')->count();
    $TMApproved=order::where('tm_confirmation','=','confirmed')->count();
    $delivered=order::where('deliveryStatus','=','delivered')->count();
     $pending=order::where('rom_order_confirmation','!=','confirmed')
    ->orWhere('rom_order_confirmation','!=','unconfirmed')
    ->count();

    $totalConfirmedProducts = orderedProducts::join('orders', 'ordered_products.order_id', '=', 'orders.id')
    ->where('orders.confirmstatus', '=', 'confirmed')
    ->sum('ordered_products.ordered_quantity');


// Get the total amount of money for confirmed products
    $totalConfirmedAmount = orderedProducts::join('orders', 'ordered_products.order_id', '=', 'orders.id')
    ->where('orders.confirmstatus', '=', 'confirmed')
    ->sum('ordered_products.subtotal');
      $totalConfirmedAmount=round($totalConfirmedAmount,2);




         $order = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.createdDate',today())
        ->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.deliveryStatus', 'clients.distro_id','KD_id']);


       return view('dashboard.hoDashboard',compact('client','pendingOrders','ordersByRegion','mostOrderedProducts','totalConfirmedAmount','totalConfirmedProducts','kds','users','RomApproved','TMApproved','delivered','ordersByRegion','rejectedOrder','acceptedOrder','adjustedORder','agents','roms','rsps','todaysOrders','totalOrders','total_sales','jsonResult','order','pending'));
    }





public function userdetail(Request $request)
    {
        $user_id=$request->user_id;
        $user = user::join('clients','clients.user_id','=','users.id')
        ->where('users.id',$user_id)
        ->get();


         return view('ho.clientDetailsho',compact('user'));
            // echo $user[0]->firstName;

    }


    public function export(Request $request)
    {
        $clients = client::select(
        'clients.client_unique_id',
        \DB::raw("CONCAT(users.firstname,' ', users.middleName,' ',users.lastname) AS client_name"),
        \DB::raw("CONCAT(users_kd.firstname,' ', users_kd.middleName,' ', users_kd.lastname) AS kd_name"),
        \DB::raw("CONCAT(users_agent.firstname,' ', users_agent.middleName,' ', users_agent.lastname) AS agent_name"),
        \DB::raw("CONCAT(users_facilitator.firstname,' ', users_facilitator.middleName,' ', users_facilitator.lastname) AS facilitator_name"),
        'clients.Mother_name',
        'clients.Gender',
        'clients.birthdate',
        'clients.age',
        'clients.nochild',
        'clients.child_in_school_under2',
        'clients.camp',
        'clients.unhcr_id',
        'clients.businesscamp',
        'clients.businesszone',
        'clients.establishment_date',
        'clients.workpermit',
        'clients.financialproduct_saving',
        'clients.financialproduct_loan',
        'clients.financialproduct_payment',
        'clients.otheraccount',
        'clients.productused_saving',
        'clients.productused_loan',
        'clients.productused_remittance',
        'clients.productused_payment',
        'clients.Training_taking',
        'clients.Training_given_org',
        'clients.Training_module1',
        'clients.Training_module2',
        'clients.Training_module3',
        'clients.areas_intrested_finance',
        'clients.areas_intrested_scale',
        'clients.areas_intrested_digitize',
        'clients.short_term_personal_goals',
        'clients.short_term_business_goals',
        'clients.leaveethiopia',
        'clients.when_leave',
        'clients.PhoneType',
        'clients.client_mobile_phone',
        'clients.Alternative_Phone_Number',
        'clients.Nationality',
        'clients.Photo',
        'clients.FamilySize',
        'clients.child_in_school',
        'clients.Marital_Status',
        'clients.userName',
        'clients.Country',
        'clients.City',
        'clients.Region',
        'clients.zone',
        'clients.kebele',
        'clients.house_number',
        'clients.ID_Number',
        'clients.ID_issue_date',
        'clients.ID_expiry_Date',
        'clients.client_business_Name',
        'clients.client_business_Type',
        'clients.businessRegisteration',
        'clients.Tin_number',
        'clients.License_number',
        'clients.Distance_from_KD',
        'clients.status',
        'clients.Bank_Account',
        'clients.Bank_name',
        'clients.Bank_Account_Number',
        'clients.Community_Saving',
        'clients.Community_loan',
        'clients.Receival_of_training',
        'clients.Training_provided_by',
        'clients.Long_term_personal_goals',
        'clients.Long_term_business_goals',
        'clients.Desired_place_of_residence',
        'clients.Training_module',
        'clients.client_address',
        'clients.client_mobile',
        'clients.id_filepath',
        'clients.ID_type',
        'clients.client_businessName',
        'clients.client_businessType',
        'clients.client_BusinessRegisteration',
        'clients.client_yearsInBusiness',
        'clients.PinCode',
         'clients.user_id',

    )
    ->leftJoin('users', 'clients.user_id', '=', 'users.id')
    ->leftJoin('users AS users_kd', 'clients.distro_id', '=', 'users_kd.id')
    ->leftJoin('users AS users_agent', 'clients.agent_id', '=', 'users_agent.id')
    ->leftJoin('users AS users_facilitator', 'clients.registered_id', '=', 'users_facilitator.id')
    ->get();

    $csvData = $this->generateCsvContent($clients);
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename=clients.csv',
    ];


    $filename = 'exports/' . 'clients' . '.csv';
    Storage::disk('local')->put($filename, $csvData);

    return response()->download(storage_path("app/{$filename}"))->deleteFileAfterSend(true);



    }
    private function generateCsvContent($data)
{
      $handle = fopen('php://temp', 'w');


    fputcsv($handle, array_keys($data->first()->toArray()));


    foreach ($data as $row) {
        fputcsv($handle, $row->toArray());
    }

    rewind($handle);
    $csvContent = stream_get_contents($handle);
    fclose($handle);

    return $csvContent;
}

}
