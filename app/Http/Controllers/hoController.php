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

use Auth;
use App;
use App\Rules\MatchOldPassword;



class hoController extends Controller
{


public function change_password()
    {
        return view('ho.changePassword');
    }
    public function update_password(Request $request)
    {
        if (App::environment('demo')) {
            return redirect()->back()->with('error', 'Action not allowed in demo.');
        }
        $user = Auth::user();
       $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required',
            'new_password_confirmation' => 'same:new_password',
        ]);
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        Alert::toast('Password Changed Successfuly!', 'success');
         return redirect('/hoDashboard');
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


}
