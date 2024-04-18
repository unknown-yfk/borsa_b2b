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



class accionController extends Controller
{

     public function index()
    {

        $client = client::join('users','users.id', '=','clients.user_id')
        ->where('clients.Region','=','Gambella')
        ->get()
        ->count();

        $users =user::count() - 1;
        $kds =user::join('key_distros','key_distros.user_id','=','users.id')
        ->where('users.userType','key distributor')
        ->where('key_distros.address','Gambella')
        ->count();
        $agents =user::join('agents','agents.user_id','=','users.id')
        ->where('users.userType','agent')
        ->where('agents.address','Gambella')
        ->count();
        $roms =user::join('roms','roms.user_id','=','users.id')
        ->where('users.userType','ROM')
        ->where('roms.address','Gambella')
        ->count();
        $rsps =user::join('rsps','rsps.user_id','=','users.id')
        ->where('users.userType','RSP')
        ->where('rsps.address','Gambella')
        ->count();
        $total_sales=order::where('paymentStatus','confirm')->sum('totalPrice');

        $userList=user::get();
        $todaysOrders=order::where('createdDate',today())->count();
        $totalOrders =order::count();
        $jsonResult = json_encode([$todaysOrders, $agents,$kds]);

        $order = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.createdDate',today())
        ->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.deliveryStatus', 'clients.distro_id','KD_id']);
          //echo $order;

        $mostOrderedProducts = orderedProducts::select( 'productlist.name', DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered'))
        ->join('products', 'products.id', '=', 'ordered_products.product_id')
        ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
        ->join('orders', 'orders.id', '=', 'ordered_products.order_id')
        ->join('clients', 'clients.user_id', '=', 'orders.client_id')
        ->where('clients.Region','Gambella')
        ->groupBy('productlist.name')
        ->orderByDesc('total_ordered')
        ->take(10)
        ->get();
        $mostDeliveredProducts = delivery1Products::select('productlist.name', DB::raw('SUM(delivery1_products.delivered_quantity) as total_ordered'))
        ->join('products', 'products.id', '=', 'delivery1_products.product_id')
        ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
        ->join('delivery1s', 'delivery1s.id', '=', 'delivery1_products.delivery1_id')
        ->join('orders', 'orders.id', '=', 'delivery1s.order_id')
        ->join('clients', 'clients.user_id', '=', 'orders.client_id')
        ->where('clients.Region','Gambella')
        ->groupBy('productlist.name')
        ->orderByDesc('total_ordered')
        ->take(10)
        ->get();
        $RomApproved=order::join('clients', 'clients.user_id', '=', 'orders.client_id')
        ->where('clients.Region','Gambella')
        ->where('rom_order_confirmation','=','confirmed')->count();
        $TMApproved=order::join('clients', 'clients.user_id', '=', 'orders.client_id')
        ->where('clients.Region','Gambella')
        ->where('tm_confirmation','=','confirmed')->count();
        $delivered=order::join('clients', 'clients.user_id', '=', 'orders.client_id')
        ->where('clients.Region','Gambella')
        ->where('handOverStatus','=','confirmed')->count();

        $rejectedOrder=order::join('clients', 'clients.user_id', '=', 'orders.client_id')
        ->where('clients.Region','Gambella')
        ->where('confirmstatus', '=', 'declined')
        ->count();

        $pendingOrders = order::join('clients', 'clients.user_id', '=', 'orders.client_id')
        ->where('clients.Region','Gambella')
        ->where('confirmstatus', '=', 'unconfirmed')
        ->count();

        $acceptedOrder = order::join('clients', 'clients.user_id', '=', 'orders.client_id')
        ->where('clients.Region','Gambella')
        ->where('confirmstatus', '=', 'confirmed')
        ->count();

        $adjustedORder = order::join('clients', 'clients.user_id', '=', 'orders.client_id')
        ->where('clients.Region','Gambella')
        ->whereIn('confirmstatus', ['confirmed_with_price_update', 'confirmed_with_deviation'])
        ->get()->count();

         $totalConfirmedProducts = orderedProducts::join('orders', 'ordered_products.order_id', '=', 'orders.id')
         ->join('clients', 'clients.user_id', '=', 'orders.client_id')
         ->where('clients.Region','Gambella')
         ->where('orders.confirmstatus', '=', 'confirmed')
         ->sum('ordered_products.ordered_quantity');


        $totalConfirmedAmount = orderedProducts::join('orders', 'ordered_products.order_id', '=', 'orders.id')
        ->join('clients', 'clients.user_id', '=', 'orders.client_id')
        ->where('clients.Region','Gambella')
        ->where('orders.confirmstatus', '=', 'confirmed')
        ->sum('ordered_products.subtotal');

        $totalDeliveredAmount = delivery1Products::join('delivery1s', 'delivery1s.id', '=', 'delivery1_products.delivery1_id')
        ->join('orders', 'delivery1s.order_id', '=', 'orders.id')
        ->join('clients', 'clients.user_id', '=', 'orders.client_id')
        ->where('clients.Region','Gambella')
        ->where('orders.confirmstatus', '=', 'confirmed')
        ->sum('delivery1_products.subTotal');

       return view('dashboard.accionDashboard',compact('mostDeliveredProducts','client','kds','users','agents','roms','mostOrderedProducts','RomApproved','TMApproved','delivered','rejectedOrder'
       ,'pendingOrders','acceptedOrder','adjustedORder','totalConfirmedProducts','totalConfirmedAmount','totalDeliveredAmount'));
    }


}
