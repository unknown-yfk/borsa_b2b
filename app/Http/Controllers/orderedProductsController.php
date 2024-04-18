<?php

namespace App\Http\Controllers;

use App\Models\tm;
use App\Models\Handover_hierarchy;
use App\Models\rom;
use App\Models\user;
use App\Models\agent;
use App\Models\order;

use App\Models\client;
use App\Models\product;
use Illuminate\Http\Request;
use App\Models\orderedProducts;
use App\Models\delivery1;

use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\CartCollection;
use App\Http\Controllers\CartController;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\LogActivity;
use Illuminate\Support\Facades\DB;
use App\Models\cities;
use App\Models\order_statuses;
use App\Models\order_details;
use Carbon\Carbon;


class orderedProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(auth()->user()->userType==='agent') {


        $client = order::join('users','users.id','=','orders.client_id')
            ->join('clients','clients.user_id','=','orders.client_id')
            ->where('orders.createdBy',auth()->user()->id)
            ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.KD_id','orders.*']);

        $kd = order::join('users','users.id','=','orders.KD_id')->
        join('key_distros','key_distros.user_id','=','orders.KD_id')
        ->where('orders.createdBy',auth()->user()->id)->get();

        return view('agent.showOrders',compact('client','kd'));



        }
        elseif (auth()->user()->userType==='client') {
        $client = order::join('users','users.id','=','orders.client_id')
            ->join('clients','clients.user_id','=','orders.client_id')
            ->where('orders.client_id',auth()->user()->id)
            ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.KD_id','orders.*']);

        $kd = order::join('users','users.id','=','orders.KD_id')->
        join('key_distros','key_distros.user_id','=','orders.KD_id')
        ->where('orders.client_id',auth()->user()->id)->get();

        return view('client.showOrders',compact('client','kd'));
        }

        // elseif (auth()->user()->userType==='client') {


        // $client = order::join('users','users.id','=','orders.client_id')
        //     ->join('clients','clients.user_id','=','orders.client_id')
        //     ->where('orders.createdBy',auth()->user()->id)
        //     ->get(['users.firstName','users.middleName','users.lastName','orders.id','orders.createdDate','orders.KD_id','orders.*']);

        // $kd = order::join('users','users.id','=','orders.KD_id')->
        // join('key_distros','key_distros.user_id','=','orders.KD_id')
        // ->where('orders.createdBy',auth()->user()->id)->get();

        // return view('client.showOrders',compact('client','kd'));
        // }

    }
    public function kdView(Request $request)
    {
            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');
            $regionFilters = $request->input('region_filter');
            $cityFilters = $request->input('city_filter');

            $uniqueRegions = client::distinct()->pluck('Region')->toArray();
            $uniqueCities = [];

            $client = Order::select(
                    'users.firstName',
                    'users.middleName',
                    'users.lastName',
                    'orders.totalPrice',
                    'orders.created_at',
                    'orders.id',
                    'orders.rom_id',
                    'clients.City',
                    'clients.Region',
                    DB::raw('GROUP_CONCAT(products.productlist_id) AS product_ids'),
                    DB::raw('GROUP_CONCAT(products.id) AS productt_ids'),
                    DB::raw('GROUP_CONCAT(products.price) AS product_price'),
                    DB::raw('GROUP_CONCAT( ordered_products.status) AS status'),
                    DB::raw('GROUP_CONCAT( ordered_products.subTotal) AS price'),
                    DB::raw('GROUP_CONCAT(ordered_products.kd_adjusted_quantity) AS kd_adjusted_quantities'),
                    DB::raw('GROUP_CONCAT(ordered_products.ordered_quantity) AS ordered_quantities'),
                    DB::raw('GROUP_CONCAT(orders.price_update) AS price_updates'),

                )
                ->join('users', 'users.id', '=', 'orders.client_id')
                ->join('clients', 'clients.user_id', '=', 'orders.client_id')
                ->leftJoin('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
                ->leftJoin('products', 'products.id', '=', 'ordered_products.product_id')
                ->where('orders.confirmStatus','confirmed')
                ->where('orders.KD_id',auth()->user()->id)

                ->where('orders.rom_order_confirmation','confirmed')
                ->where('orders.rom_adjusted_confirmation','confirmed')
                ->where('orders.tm_confirmation','unconfirmed')
                ->groupBy('orders.id','users.firstName',
                'users.middleName',
                'users.lastName',
                'orders.totalPrice',
                'orders.created_at',
                'orders.id',
                'orders.rom_id',
                'clients.City',
                'clients.Region',)
                ->orderBy('orders.created_at', 'DESC');

        if ($fromDate && $toDate) {
                $client->whereBetween('orders.created_at', [$fromDate, $toDate]);
            }


            if (!$regionFilters) {
                $uniqueCities = client::distinct()->pluck('City')->toArray();
            }

            if ($regionFilters) {
                $client->whereIn('clients.Region', $regionFilters);


                $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


                if ($cityFilters) {
                    $client->whereIn('clients.City', $cityFilters);
                }
            } elseif ($cityFilters) {
                $client->whereIn('clients.City', $cityFilters);
            }

             $client=$client->get();
             $new=count($client);

            $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
                ->join('products', 'products.id', '=', 'ordered_products.product_id')
                ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
                ->groupBy('productlist.id', 'productlist.name')
                ->get(['productlist.name', 'productlist.id']);

        return view('KD.showOrders',compact('product', 'uniqueRegions', 'uniqueCities','client','new'));
    }

        public function tmView(Request $request)
    {
        $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');
            $regionFilters = $request->input('region_filter');
            $cityFilters = $request->input('city_filter');

         $tm=tm::join('users','users.id','=','tms.user_id')
             ->where('users.id',auth()->user()->id)
             ->get();

         $tmkd_id = $tm[0]->kd_id;
         $uniqueRegions = client::distinct()->pluck('Region')->toArray();
            $uniqueCities = [];


        $client = Order::select(
                    'users.firstName',
                    'users.middleName',
                    'users.lastName',
                    'orders.totalPrice',
                    'orders.created_at',
                    'orders.id',
                    'orders.rom_id',
                    'clients.City',
                    'clients.Region',
                    DB::raw('GROUP_CONCAT(products.productlist_id) AS product_ids'),
                    DB::raw('GROUP_CONCAT(products.id) AS productt_ids'),
                    DB::raw('GROUP_CONCAT(products.price) AS product_price'),
                    DB::raw('GROUP_CONCAT( ordered_products.status) AS status'),
                    DB::raw('GROUP_CONCAT( ordered_products.subTotal) AS price'),
                    DB::raw('GROUP_CONCAT(ordered_products.kd_adjusted_quantity) AS kd_adjusted_quantities'),
                    DB::raw('GROUP_CONCAT(ordered_products.ordered_quantity) AS ordered_quantities'),
                    DB::raw('GROUP_CONCAT(orders.price_update) AS price_updates'),

                )
                ->join('users', 'users.id', '=', 'orders.client_id')
                ->join('clients', 'clients.user_id', '=', 'orders.client_id')
                ->leftJoin('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
                ->leftJoin('products', 'products.id', '=', 'ordered_products.product_id')
                ->where('orders.confirmStatus','confirmed')
                ->where('orders.KD_id',$tmkd_id)
                ->where('ordered_products.status','!=','refusal')

                ->where('orders.rom_order_confirmation','confirmed')
                ->where('orders.rom_adjusted_confirmation','confirmed')
                ->where('orders.tm_confirmation','unconfirmed')
                ->groupBy('orders.id','users.firstName',
                'users.middleName',
                'users.lastName',
                'orders.totalPrice',
                'orders.created_at',
                'orders.id',
                'orders.rom_id',
                'clients.City',
                'clients.Region',)
                ->orderBy('orders.created_at', 'DESC');

        if ($fromDate && $toDate) {
                $client->whereBetween('orders.created_at', [$fromDate, $toDate]);
            }


            if (!$regionFilters) {
                $uniqueCities = client::distinct()->pluck('City')->toArray();
            }

            if ($regionFilters) {
                $client->whereIn('clients.Region', $regionFilters);


                $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


                if ($cityFilters) {
                    $client->whereIn('clients.City', $cityFilters);
                }
            } elseif ($cityFilters) {
                $client->whereIn('clients.City', $cityFilters);
            }
            $client=$client->get();
          $new=count($client);

            $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
                ->join('products', 'products.id', '=', 'ordered_products.product_id')
                ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
                ->groupBy('productlist.id', 'productlist.name')
                ->get(['productlist.name', 'productlist.id']);
                return view('TM.showOrders',compact( 'product', 'uniqueRegions', 'uniqueCities','client','new'));


    }
public function romViewhistory()
    {
        $romId = auth()->id();
        // $client=order::;
        $client=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        // ->where('orders.KD_id',auth()->user()->id)
        ->where('orders.confirmStatus','!=','unconfirmed')
        ->where('orders.rom_id',$romId)

        // ->where('orders.rom_order_confirmation','confirmed')
        ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*','clients.City','clients.Region']);
        $new=count($client);

        // echo $client;
        return view('ROM.showOrdershistory',compact('client','new'));
    }
        public function romView(Request $request)
    {
        $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');
            $regionFilters = $request->input('region_filter');
            $cityFilters = $request->input('city_filter');

            $uniqueRegions = client::distinct()->pluck('Region')->toArray();
            $uniqueCities = [];

            $query = delivery1::join('delivery1_products', 'delivery1_products.delivery1_id', '=', 'delivery1s.id')
                ->join('products', 'products.id', '=', 'delivery1_products.product_id')
                ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
                ->join('orders', 'orders.id', '=', 'delivery1s.order_id')
                ->join('users', 'users.id', '=', 'orders.client_id')
                ->join('clients', 'users.id', '=', 'clients.user_id')
                ->where('users.id', '!=', '5393');



            $romId = auth()->id();

           $client = Order::select(
                    'users.firstName',
                    'users.middleName',
                    'users.lastName',
                    'orders.totalPrice',
                    'orders.created_at',
                    'orders.id',
                    'orders.rom_id',
                    'clients.City',
                    'clients.Region',
                    DB::raw('GROUP_CONCAT(products.productlist_id) AS product_ids'),
                    DB::raw('GROUP_CONCAT(products.id) AS productt_ids'),
                    DB::raw('GROUP_CONCAT(products.price) AS product_price'),
                    DB::raw('GROUP_CONCAT( ordered_products.status) AS status'),
                    DB::raw('GROUP_CONCAT( ordered_products.subTotal) AS price'),
                    DB::raw('GROUP_CONCAT(ordered_products.ordered_quantity) AS ordered_quantities')
                )
                ->join('users', 'users.id', '=', 'orders.client_id')
                ->join('clients', 'clients.user_id', '=', 'orders.client_id')
                ->leftJoin('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
                ->leftJoin('products', 'products.id', '=', 'ordered_products.product_id')
                ->where('orders.confirmStatus', 'unconfirmed')
                ->where('orders.rom_id', $romId)
                ->groupBy('orders.id','users.firstName',
                'users.middleName',
                'users.lastName',
                'orders.totalPrice',
                'orders.created_at',
                'orders.id',
                'orders.rom_id',
                'clients.City',
                'clients.Region',)
                ->orderBy('orders.created_at', 'DESC');
                   if ($fromDate && $toDate) {
                $client->whereBetween('orders.created_at', [$fromDate, $toDate]);
            }


            if (!$regionFilters) {
                $uniqueCities = client::distinct()->pluck('City')->toArray();
            }

            if ($regionFilters) {
                $query->whereIn('clients.Region', $regionFilters);


                $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


                if ($cityFilters) {
                    $query->whereIn('clients.City', $cityFilters);
                }
            } elseif ($cityFilters) {
                $query->whereIn('clients.City', $cityFilters);
            }
            $client=$client->get();
          $new=count($client);

            $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
                ->join('products', 'products.id', '=', 'ordered_products.product_id')
                ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
                ->groupBy('productlist.id', 'productlist.name')
                ->get(['productlist.name', 'productlist.id']);

               // echo $product." ".$client;


                return view('ROM.showOrders',compact( 'product', 'uniqueRegions', 'uniqueCities','client','new'));

    }
    public function BulkEdit(Request $request)
    {

        $products = $request->input('products');

        foreach ($products as $product) {
            foreach ($product as $detail) {
                // Access the inner array details
                $orderId = $detail['orderId'];
                $productId = $detail['productId'];
                $adjusted_quantity = (int)$detail['quantity'];
                $isSelected = $detail['isSelected'] === 'true' ? true : false;
                $productAmount= $detail['productAmount'];

                $request->validate([
                    $adjusted_quantity => 'numeric|min:0|max:' . $productAmount,
                ]);
                if($adjusted_quantity == 0 && $adjusted_quantity == null)
                {

                }
                // Perform MySQL query using Eloquent
                $order = Order::find($orderId);
                if ($order) {
                    // Update attributes in the orders table
                    $order->confirmStatus = 'confirmed';
                    $order->rom_order_confirmation = 'confirmed';
                    $order->rom_adjusted_confirmation = 'confirmed';
                    $order->save();
                }

                $orderedProducts = orderedProducts::where('order_id', $orderId)
                    ->where('product_id', $productId)
                    ->get();



                foreach ($orderedProducts as $orderedProduct) {
                    // Update attributes in the ordered_products table
                    if (!$isSelected) {
                        if ($adjusted_quantity !== null && $adjusted_quantity !== 0)
                        {
                            $product = product::where('id', $productId)->first();
                            if ($product)
                            {
                                $product->Qty -= $adjusted_quantity;
                                $product->save();
                            }
                            $orderedProduct->update([
                                'status' => 'quantity_adjustment', // Replace with the actual value
                                'kd_adjusted_quantity' => $adjusted_quantity,
                            ]);
                        }
                        elseif ($adjusted_quantity == null &&  $adjusted_quantity == 0)
                        {

                            $product = product::where('id', $productId)->first();
                            if ($product)
                            {
                                $product->Qty -= $productAmount;
                                $product->save();
                            }
                            $orderedProduct->update([
                                'status' => 'acceptance',
                                'kd_adjusted_quantity' => 0,
                            ]);
                        }
                    } else {
                        $orderedProduct->update([
                            'status' => 'refusal',
                            'kd_adjusted_quantity' => 0,
                        ]);
                    }
                }
            }
        }
        return redirect()->route('romShow');
    }
    public function orderHistory(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $regionFilters = $request->input('region_filter');
        $cityFilters = $request->input('city_filter');
        $rom_id=$request->input('rom_id');

         $uniqueRegions = client::distinct()->pluck('Region')->toArray();
        $uniqueCities = [];

     $client = Order::select(
                    'users.firstName',
                    'users.middleName',
                    'users.lastName',
                    'orders.totalPrice',
                    'orders.created_at',
                    'orders.id',
                    'orders.rom_id',
                    'clients.City',
                    'clients.Region',
                    DB::raw('GROUP_CONCAT(products.productlist_id) AS product_ids'),
                    DB::raw('GROUP_CONCAT(products.id) AS productt_ids'),
                    DB::raw('GROUP_CONCAT(products.price) AS product_price'),
                    DB::raw('GROUP_CONCAT( ordered_products.status) AS status'),
                    DB::raw('GROUP_CONCAT( ordered_products.subTotal) AS price'),
                    DB::raw('GROUP_CONCAT(ordered_products.kd_adjusted_quantity) AS kd_adjusted_quantities'),
                    DB::raw('GROUP_CONCAT(ordered_products.ordered_quantity) AS ordered_quantities'),
                    DB::raw('GROUP_CONCAT(orders.price_update) AS price_updates'),
                )
                ->join('users', 'users.id', '=', 'orders.client_id')
                ->join('clients', 'clients.user_id', '=', 'orders.client_id')
                ->leftJoin('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
                ->leftJoin('products', 'products.id', '=', 'ordered_products.product_id')
                ->where('orders.confirmStatus','confirmed')
                ->where('orders.rom_order_confirmation','confirmed')
                ->where('orders.KD_id',auth()->user()->id)
                ->where('orders.rom_id', $rom_id)
                ->where('orders.handoverStatus','unconfirmed')
                ->where('orders.rom_adjusted_confirmation','confirmed')
                ->where('orders.tm_confirmation','confirmed')
                ->groupBy('orders.id','users.firstName',
                'users.middleName',
                'users.lastName',
                'orders.totalPrice',
                'orders.created_at',
                'orders.id',
                'orders.rom_id',
                'clients.City',
                'clients.Region',)
                ->orderBy('orders.created_at', 'DESC');

        if ($fromDate && $toDate) {
                $client->whereBetween('orders.created_at', [$fromDate, $toDate]);
            }


            if (!$regionFilters) {
                $uniqueCities = client::distinct()->pluck('City')->toArray();
            }

            if ($regionFilters) {
                $client->whereIn('clients.Region', $regionFilters);


                $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


                if ($cityFilters) {
                    $client->whereIn('clients.City', $cityFilters);
                }
            } elseif ($cityFilters) {
                $client->whereIn('clients.City', $cityFilters);
            }
            $client=$client->get();

            $new=count($client);

            $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
                ->join('products', 'products.id', '=', 'ordered_products.product_id')
                ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
                ->groupBy('productlist.id', 'productlist.name')
                ->get(['productlist.name', 'productlist.id']);
                $hierarchy = Handover_hierarchy::where('status','1')->get();


        return view('KD.orderHistory',compact('product', 'uniqueRegions', 'uniqueCities','client','new', 'hierarchy','rom_id'));


    }
    public function searchrom()
    {

        $user_type=auth()->user()->userType;
        if($user_type=="key distributor")
        {
        $roms=rom::join('users','users.id','=','roms.user_id')
        ->where('roms.kd_id',auth()->user()->id)->get(['users.firstName','users.middleName','users.lastName','users.id']);

      // dd($agents);

     return view('KD.delivery_search',compact('roms'));
        }
        else if($user_type=="TM")
        {
            $tm=tm::join('users','users.id','=','tms.user_id')
             ->where('users.id',auth()->user()->id)
             ->get();

         $tmkd_id = $tm[0]->kd_id;
        $roms=rom::join('users','users.id','=','roms.user_id')
        ->where('roms.kd_id',$tmkd_id)->get(['users.firstName','users.middleName','users.lastName','users.id']);

     return view('TM.delivery_search',compact('roms'));
        }

    }

        public function tm_orderHistory(Request $request)
    {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');
            $regionFilters = $request->input('region_filter');
            $cityFilters = $request->input('city_filter');
            $rom_id=$request->input('rom_id');

         $tm=tm::join('users','users.id','=','tms.user_id')
             ->where('users.id',auth()->user()->id)
             ->get();

         $tmkd_id = $tm[0]->kd_id;
         $uniqueRegions = client::distinct()->pluck('Region')->toArray();
        $uniqueCities = [];

          $tm=tm::join('users','users.id','=','tms.user_id')
             ->where('users.id',auth()->user()->id)
             ->get();

     $tmkd_id = $tm[0]->kd_id;

     $client = Order::select(
                    'users.firstName',
                    'users.middleName',
                    'users.lastName',
                    'orders.totalPrice',
                    'orders.created_at',
                    'orders.id',
                    'orders.rom_id',
                    'clients.City',
                    'clients.Region',
                    DB::raw('GROUP_CONCAT(products.productlist_id) AS product_ids'),
                    DB::raw('GROUP_CONCAT(products.id) AS productt_ids'),
                    DB::raw('GROUP_CONCAT(products.price) AS product_price'),
                    DB::raw('GROUP_CONCAT( ordered_products.status) AS status'),
                    DB::raw('GROUP_CONCAT( ordered_products.subTotal) AS price'),
                    DB::raw('GROUP_CONCAT(ordered_products.kd_adjusted_quantity) AS kd_adjusted_quantities'),
                    DB::raw('GROUP_CONCAT(ordered_products.ordered_quantity) AS ordered_quantities'),
                    DB::raw('GROUP_CONCAT(orders.price_update) AS price_updates'),
                )
                ->join('users', 'users.id', '=', 'orders.client_id')
                ->join('clients', 'clients.user_id', '=', 'orders.client_id')
                ->leftJoin('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
                ->leftJoin('products', 'products.id', '=', 'ordered_products.product_id')
                ->where('orders.confirmStatus','confirmed')
                ->where('orders.rom_order_confirmation','confirmed')
                ->where('orders.KD_id',$tmkd_id)
                ->where('orders.rom_id', $rom_id)
                ->where('orders.handoverStatus','unconfirmed')
                ->where('orders.rom_adjusted_confirmation','confirmed')
                ->where('orders.tm_confirmation','confirmed')
                ->groupBy('orders.id','users.firstName',
                'users.middleName',
                'users.lastName',
                'orders.totalPrice',
                'orders.created_at',
                'orders.id',
                'orders.rom_id',
                'clients.City',
                'clients.Region',)
                ->orderBy('orders.created_at', 'DESC');

        if ($fromDate && $toDate) {
                $client->whereBetween('orders.created_at', [$fromDate, $toDate]);
            }


            if (!$regionFilters) {
                $uniqueCities = client::distinct()->pluck('City')->toArray();
            }

            if ($regionFilters) {
                $client->whereIn('clients.Region', $regionFilters);


                $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


                if ($cityFilters) {
                    $client->whereIn('clients.City', $cityFilters);
                }
            } elseif ($cityFilters) {
                $client->whereIn('clients.City', $cityFilters);
            }
            $client=$client->get();


            $new=count($client);

            $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
                ->join('products', 'products.id', '=', 'ordered_products.product_id')
                ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
                ->groupBy('productlist.id', 'productlist.name')
                ->get(['productlist.name', 'productlist.id']);
                $hierarchy = Handover_hierarchy::where('status','1')->get();


        return view('TM.orderHistory',compact('product', 'uniqueRegions', 'uniqueCities','client','new', 'hierarchy','rom_id'));

    }

      public function returned_order()
    {
        $client= order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('ordered_products','ordered_products.order_id','=','orders.id')
        ->where('ordered_products.status','quantity_adjustment')
        ->where('orders.KD_id',auth()->user()->id)->orderBy('created_at', 'DESC')->where('orders.confirmStatus','returned_acceptance')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);

        return view('KD.Returned_order',compact('client'));

    }

          public function rom_returned_order()
    {
        $client= order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('ordered_products','ordered_products.order_id','=','orders.id')
        // ->where('ordered_products.status','quantity_adjustment')
        ->where('orders.confirmStatus','returned_acceptance')
        // ->where('orders.rom_order_confirmation','confirmed')


        ->where('orders.rom_order_confirmation','confirmed')
        ->where('orders.rom_adjusted_confirmation','unconfirmed')


        ->where('orders.rom_id',auth()->user()->id)->orderBy('created_at', 'DESC')
        ->where('orders.rom_id',auth()->user()->id)->orderBy('created_at', 'DESC')
        ->where('orders.confirmStatus','returned_acceptance')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);

        return view('ROM.Returned_order',compact('client'));

    }

          public function kd_accept(Request $request)
    {
          $orderupdate = order::where('id',$request->order_id)
            ->update(['confirmStatus'=>'confirmed']);
    //  return view('agent.');""
        Alert::toast('Order Accepted', 'success');

            return redirect('/key_distroDashboard');

    }

          public function kd_decline(Request $request)
    {
       $orderupdate = order::where('id',$request->order_id)
            ->update(['confirmStatus'=>'declined']);
    //  return view('agent.');""
        Alert::toast('Order Declined', 'success');

                 return redirect('/key_distroDashboard');


    }

              public function rom_accept(Request $request)
    {
          $orderupdate = order::where('id',$request->order_id)
            ->update([
                'confirmStatus'=>'confirmed',
                'rom_adjusted_confirmation'=>'confirmed',
                // 'confirmStatus'=>'confirmed',

            ]);
              $productss = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            ->where('ordered_products.status','!=','refusal')
            ->where('ordered_products.order_id',$request->order_id)
            ->get();
                foreach($productss as $row) {
            $stock=product::where('id',$row->product_id)
            ->get('Qty');
            if($row->kd_adjusted_quantity == 0)
            {
           $new_qty=$stock[0]->Qty - $row->ordered_quantity;

            $stock_update=product::where('id',$row->product_id)
            ->update(['Qty'=> $new_qty]);
            }
            else
            {
            $new_qty=$stock[0]->Qty - $row->kd_adjusted_quantity;

            $stock_update=product::where('id',$row->product_id)
            ->update(['Qty'=> $new_qty]);
            }
                }

    //  return view('agent.');""
        Alert::toast('Order Accepted', 'success');

            return redirect('/romDashboard');

    }

          public function rom_decline(Request $request)
    {
       $orderupdate = order::where('id',$request->order_id)
            ->update(['confirmStatus'=>'declined']);
    //  return view('agent.');""
        Alert::toast('Order Declined', 'success');

                 return redirect('/romDashboard');


    }



    public function updateStatus(Request $request, OrderedProduct $orderedProduct)
    {
        $orderedProduct = new orderedproducts;
        $orderedProduct->status = $request->input('status');
        $orderedProduct->save();
        return response()->json(['success' => true]);

    }
  public function confirm_tm(Request $request)
    {
        $products = $request->input('products');
         foreach ($products as $product) {
            foreach ($product as $detail) {

                $orderId = $detail['orderId'];
                 $orderupdate = order::where('id',$orderId)
                ->update(['tm_confirmation'=>'confirmed']);
            }
        }
         LogActivity::addToLog('confirm order');

            Alert::toast('Order Confirmed', 'success');
        return redirect('/tmDashboard');


    }
      public function confirm_kd(Request $request)
    {
        $products = $request->input('products');
         foreach ($products as $product) {
            foreach ($product as $detail) {

                $orderId = $detail['orderId'];
                 $orderupdate = order::where('id',$orderId)
                ->update(['tm_confirmation'=>'confirmed']);
            }
        }
         LogActivity::addToLog('confirm order');

            Alert::toast('Order Confirmed', 'success');
        return redirect('/key_distroDashboard');
    }

    public function confirm(Request $request)
    {

        $row = [];
        $price_status=0;

        $consent= order::where('id', $request->order_id)->get('consent');


        if($request->total_price != $request->subtotal)
        {
            $price_status=1;
        }

        foreach ($request->all() as $key => $value)
        {

             if (strpos($key, 'status_') === 0) {
                $stat = explode("_",$key);
                $itemId = $stat[1];
                $itsStatus = $value;
                $row[$itemId] = ["val" => $value];

             } elseif (strpos($key, 'quantity_') === 0) {
                $stat = explode("_",$key);
                $itemId = $stat[1];
                $itsStatus = $value;
                $row[$itemId] = ["val" => $row[$itemId]['val'],"quantity" => $value];
            //  echo $itsStatus;
             }


        }

        foreach($row as $key=>$val)
        {

            $id = $key;
            $status = $val['val'];

            $quantity = 0;
            if($status == 'quantity_Adjustment') {

                $quantity = $val['quantity'];
            if($consent[0]->consent ==0 ){
                 $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$request->order_id)
        ->get();
             Alert::toast('the client will not accept less quantity', 'warning');
        return view('ROM.rom_unconfirmed_details',compact('orderedProducts'));

            }

            }
             $orderedProduct = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            ->where('ordered_products.product_id',$id)
            ->where('ordered_products.order_id',$request->order_id)
            ->update(['status'=> $status ,'kd_adjusted_quantity' => $quantity]);
            // new added for
            $productss = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            ->where('ordered_products.product_id',$id)
            ->where('ordered_products.order_id',$request->order_id)
            ->get();


            if($status=="Acceptance")
            {

              $stock=product::where('id',$id)
            ->get('products.Qty');


           $new_qty=$stock[0]->Qty - $productss[0]->ordered_quantity;

           if($new_qty<0)
           {
             $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$request->order_id)
        ->get();
             Alert::toast('You dont have enough Stock', 'warning');
        return view('ROM.rom_unconfirmed_details',compact('orderedProducts'));
           }
            $stock_update=product::where('id',$id)
            ->update(['Qty'=> $new_qty]);


            }
             if($status=="quantity_Adjustment")
            {

              $stock=product::where('id',$id)
            ->get('products.Qty');

           $new_qty=$stock[0]->Qty - $quantity;

            if($new_qty<0)
           {
             $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$request->order_id)
        ->get();
             Alert::toast('You dont have enough Stock', 'warning');
        return view('ROM.rom_unconfirmed_details',compact('orderedProducts'));
           }

            $stock_update=product::where('id',$id)
            ->update(['Qty'=> $new_qty]);

            }
            //

        }

        if($price_status==1)

        {
                $orderedProductupdate = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
                ->join('products','products.id','=','ordered_products.product_id')
                // ->where('ordered_products.product_id',$id)
                ->where('ordered_products.order_id',$request->order_id)
                 ->update(['confirmStatus'=>'confirmed','price_update'=>$price_status,'rom_order_confirmation'=>'confirmed','rom_adjusted_confirmation'=>'confirmed']);
               // ->update(['confirmStatus'=>'confirmed_with_price_update','price_update'=>$price_status]);
            }

$statusrecords=OrderedProducts::where('order_id',$request->order_id)->count();
$acceptancerecords=OrderedProducts::where('status','acceptance')->where('order_id',$request->order_id)->count();
$refusalrecords=OrderedProducts::where('status','refusal')->where('order_id',$request->order_id)->count();


      $orderedProduct_ac = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            // ->where('ordered_products.product_id',$id)
            ->where('ordered_products.order_id',$request->order_id)
            ->where('ordered_products.status', 'acceptance')
            // ->where('ordered_products.status', 'refusal')

            ->exists();


         $orderedProduct = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            // ->where('ordered_products.product_id',$id)
            ->where('ordered_products.order_id',$request->order_id)
            ->where('ordered_products.status', 'quantity_adjustment')
            // ->where('ordered_products.status', 'acceptance')

            ->exists();

            // ->get();


            if($orderedProduct){

                 if ($consent[0]->consent ==1 ) {
                if($price_status==1)
                {

                    $orderedProductupdate = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
                    ->join('products','products.id','=','ordered_products.product_id')
                    // ->where('ordered_products.product_id',$id)
                    ->where('ordered_products.order_id',$request->order_id)
                    ->update(['confirmStatus'=>'confirmed','price_update'=>$price_status,'rom_order_confirmation'=>'confirmed','rom_adjusted_confirmation'=>'confirmed']);
                    //->update(['confirmStatus'=>'confirmed_with_price_update','price_update'=>$price_status]);
                }
              else {
         $orderedProductupdate = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            // ->where('ordered_products.product_id',$id)
            ->where('ordered_products.order_id',$request->order_id)
            ->update(['confirmStatus'=>'confirmed','price_update'=>$price_status,'rom_order_confirmation'=>'confirmed','rom_adjusted_confirmation'=>'confirmed']);
            //->update(['confirmStatus'=>'confirmed_with_deviation','price_update'=>$price_status]);
              }
            }

             elseif($consent[0]->consent ==0 ){
                  $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$request->order_id)
        ->get();



             Alert::toast('the client will not accept less quantity', 'warning');


        return view('ROM.rom_unconfirmed_details',compact('orderedProducts'));


                    }

            }

            elseif($statusrecords === $acceptancerecords ){

                if($price_status==1)
                {

                    $orderedProductupdate = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
                    ->join('products','products.id','=','ordered_products.product_id')
                    // ->where('ordered_products.product_id',$id)
                    ->where('ordered_products.order_id',$request->order_id)
                    ->update(['confirmStatus'=>'confirmed','price_update'=>$price_status,'rom_order_confirmation'=>'confirmed','rom_adjusted_confirmation'=>'confirmed']);
                    //->update(['confirmStatus'=>'confirmed_with_deviation','price_update'=>$price_status]);
                }
                else
                {

                    // if ($consent[0]->consent ==1 ) {

            $orderedProductupdate_a = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            // ->where('ordered_products.product_id',$id)
            ->where('ordered_products.order_id',$request->order_id)
            ->update(['confirmStatus'=>'confirmed','rom_order_confirmation'=>'confirmed','rom_adjusted_confirmation'=>'confirmed','price_update'=>$price_status]);
//commented for temporary
//   foreach($row as $key=>$val)
//         {

//              $id = $key;
//             $productss = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
//             ->join('products','products.id','=','ordered_products.product_id')
//             ->where('ordered_products.product_id',$id)
//             ->where('ordered_products.order_id',$request->order_id)
//             ->get();

//             $stock=product::where('id',$request->ordered_product_id)
//             ->get('products.Qty');

//            $new_qty=$stock[0]->Qty - $productss[0]->ordered_quantity;

//             $stock_update=product::where('id',$request->ordered_product_id)
//             ->update(['Qty'=> $new_qty]);





//     }
//untill here


                    // }
                    // elseif($consent[0]->consent ==0 ){
                    //     Alert::toast('the client will not accept less quantity', 'warning');
                    //      return redirect()->back();
                    // }

                }
                // echo "a";
            }
                elseif($statusrecords === $refusalrecords ){

       $orderedProductupdate_b = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            // ->where('ordered_products.product_id',$id)
            ->where('ordered_products.order_id',$request->order_id)
            ->update(['confirmStatus'=>'declined','price_update'=>$price_status]);

                }


          elseif($orderedProduct_ac){
            if($price_status==1)
                    {

                        $orderedProductupdate = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
                        ->join('products','products.id','=','ordered_products.product_id')
                        // ->where('ordered_products.product_id',$id)
                        ->where('ordered_products.order_id',$request->order_id)
                        ->update(['confirmStatus'=>'confirmed','price_update'=>$price_status,'rom_order_confirmation'=>'confirmed','rom_adjusted_confirmation'=>'confirmed']);
                        //->update(['confirmStatus'=>'confirmed_with_deviation','price_update'=>$price_status]);
                    }
                    else {




       $orderedProductupdate_c = OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->join('products','products.id','=','ordered_products.product_id')
            // ->where('ordered_products.product_id',$id)
            ->where('ordered_products.order_id',$request->order_id)
            ->update(['confirmStatus'=>'confirmed','price_update'=>$price_status,'rom_order_confirmation'=>'confirmed','rom_adjusted_confirmation'=>'confirmed']);
           // ->update(['confirmStatus'=>'confirmed_with_deviation','price_update'=>$price_status]);
                    }

                }


    LogActivity::addToLog('Order Confirm');

               Alert::toast('Order Confirmed', 'success');
      return redirect('/romDashboard');


        }





        public function set_order_status(Request $request)
    {

$status = $request->input('status');
        OrderedProducts::query()->update(['status' => $status]);

    //     $id = $request->ordered_product_id;

    //       $orderupdate = order::where('id',$request->order_id)
    //         ->update(['confirmStatus'=>'confirmed']);

    //    $orderedPs=orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
    //     ->join('products','products.id','=','ordered_products.product_id')
    //     ->where('ordered_products.order_id',$request->order_id)

    //     ->get();

    //     foreach ($orderedPs as $item) {
    // $status = $_POST['status_'.$item->id];

    // Save the status to the database for this ordered product
    // ...
        // echo  $item;


//  $orderId = $request->input('order_id');
//     $orderedProductId = $request->input('ordered_product_id');
//     $status = $request->input('status_'.$orderedProductId);

    // Update the order status in the database for the given ordered product
    // $orderedProduct = OrderedProducts::where('id', $orderedProductId)->first();
    // $orderedProduct->status = $status;
    //    $orderedProduct = OrderedProducts::findOrFail($orderedProductId);
    // echo  $orderedProductId;
    // $orderedProduct->save();

    // Redirect back to the page
    // return redirect()->back();
}

// }



//   $status = $request->input('status');
//   $data = array('status' => $status);
//   $jsonData = json_encode($data);

//   return response()->json($jsonData);


    // }


        public function kd_unconfirmed_details(Request $request)
    {
             $auth = Auth::user()->userName;
        $order_id=$request->order_id;

        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)
        ->get();


// echo $orderedProducts;
// Alert::toast('ye','success');
// echo $orderedProducts;
if (count($orderedProducts) === 0 ){
    return back();
    alert::toast('order doesn not exist','warning');
}

else{

        return view('KD.kd_unconfirmed_details',compact('orderedProducts','auth'));

}





    }

            public function tm_unconfirmed_details(Request $request)
    {
             $auth = Auth::user()->id;
               $tm=tm::where('user_id',$auth)->get(['kd_id']);


        $order_id=$request->order_id;


        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',$tm[0]->kd_id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus','orders.price_update']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)
        ->get();




if (count($orderedProducts) === 0 ){
    return back();
    alert::toast('order doesn not exist','warning');
}

else{
        return view('TM.tm_unconfirmed_details',compact('orderedProducts','auth'));

}






    }
public function rom_order_history_details(Request $request)
    {
             $auth = Auth::user()->userName;
        $order_id=$request->order_id;

        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.rom_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)
        ->get();

// echo $orderedProducts;
// Alert::toast('ye','success');
// echo $orderedProducts;
if (count($orderedProducts) === 0 ){
    LogActivity::addToLog('view orders  failed');

    return back();
    alert::toast('order doesn not exist','warning');
}

else{
    LogActivity::addToLog('view order status');

        return view('ROM.rom_orderhistory_details',compact('orderedProducts','auth'));

}






    }
        public function rom_unconfirmed_details(Request $request)
    {
             $auth = Auth::user()->userName;
        $order_id=$request->order_id;

        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.rom_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)
        ->get();

//  echo $orderedProducts;
// Alert::toast('ye','success');


if (count($orderedProducts) === 0 ){
    return back();
    alert::toast('order doesn not exist','warning');
}

else{
        return view('ROM.rom_unconfirmed_details',compact('orderedProducts','auth'));

}






    }



        public function kd_confirmed_details(Request $request)
    {
             $auth = Auth::user()->userName;
        $order_id=$request->order_id;
        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus','orders.price_update']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)->get();
        // echo $orderedProducts[0]->order_id;
    //    echo $orderedProducts[0]->confirmStatus;
    //    echo $orderedProducts[0]->handoverStatus;
        // return view('orderCart.orderDetails',compact('orderedProducts','auth'));


        return view('KD.kd_confirmed_details',compact('orderedProducts','auth'));

        // return view('orderCart.orderDetails');



    }


           public function tm_confirmed_details(Request $request)
    {
             $auth = Auth::user()->userName;
        $order_id=$request->order_id;
        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus','orders.price_update']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)->get();
        // echo $orderedProducts[0]->order_id;
    //    echo $orderedProducts[0]->confirmStatus;
    //    echo $orderedProducts[0]->handoverStatus;
        // return view('orderCart.orderDetails',compact('orderedProducts','auth'));


        return view('TM.tm_confirmed_details',compact('orderedProducts','auth'));

        // return view('orderCart.orderDetails');



    }

          public function kd_returned_details(Request $request)
    {
             $auth = Auth::user()->userName;
        $order_id=$request->order_id;
        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)->get();
        // echo $orderedProducts[0]->order_id;
    //    echo $orderedProducts[0]->confirmStatus;
    //    echo $orderedProducts[0]->handoverStatus;
        // return view('orderCart.orderDetails',compact('orderedProducts','auth'));


        return view('KD.returned_order_details',compact('orderedProducts','auth'));

        // return view('orderCart.orderDetails');



    }

            public function rom_returned_details(Request $request)
    {
             $auth = Auth::user()->userName;
        $order_id=$request->order_id;
        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.rom_id',auth()->user()->id)
        ->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.status','!=','refusal')
        ->where('ordered_products.order_id',$order_id)
        ->get();


        return view('ROM.returned_order_details',compact('orderedProducts','auth'));




    }
  public function orderDetailsofficer(Request $request)
    {


               $auth = Auth::user()->userName;
        $order_id=$request->order_id;

        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)
        ->distinct()
        ->get(['products.image','products.description','products.price','ordered_products.ordered_quantity',
        'ordered_products.kd_adjusted_quantity','ordered_products.subTotal','orders.totalPrice','ordered_products.status']);


         return view('orderCart.orderDetailsofficer',compact('orderedProducts','auth'));


    }
        public function orderDetailsaccionreport(Request $request)
    {


        $auth = Auth::user()->userName;
        $order_id=$request->order_id;

        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)
        ->where('clients.Region','Gambella')
        ->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)
        ->distinct()
        ->get(['products.image','products.description','products.price','products.name','ordered_products.ordered_quantity',
        'ordered_products.kd_adjusted_quantity','ordered_products.subTotal','orders.totalPrice','ordered_products.status']);


         return view('orderCart.orderDetailsaccionreport',compact('orderedProducts','auth'));


    }
 public function orderDetailshoreport(Request $request)
    {
        $auth = Auth::user()->userName;
        $order_id=$request->order_id;

        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)
         ->distinct()
        ->get(['products.image','products.description','products.price','products.name','ordered_products.ordered_quantity',
        'ordered_products.kd_adjusted_quantity','ordered_products.subTotal','orders.totalPrice','ordered_products.status']);


         return view('orderCart.orderDetailshoreport',compact('orderedProducts','auth'));


    }
    public function orderDetailsaccion(Request $request)
    {


               $auth = Auth::user()->userName;
        $order_id=$request->order_id;

        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
         ->join('delivery1s','delivery1s.order_id','=','ordered_products.order_id')
         ->join('delivery1_products', function ($join)
          {
             $join->on('delivery1_products.delivery1_id', '=', 'delivery1s.id')
             ->on('products.id', '=', 'delivery1_products.product_id');
          })
        ->where('ordered_products.order_id',$order_id)
        ->distinct()
        ->get(['products.image','products.description','products.id', 'orders.id', 'products.name','products.price','ordered_products.ordered_quantity','ordered_products.kd_adjusted_quantity','delivery1_products.partial_quantity','delivery1_products.delivered_quantity','ordered_products.subTotal','orders.totalPrice','delivery1_products.amount_status','ordered_products.status']);
         return view('orderCart.orderDetailsaccion',compact('orderedProducts','auth'));


    }
  public function orderDetailsho(Request $request)
    {


               $auth = Auth::user()->userName;
        $order_id=$request->order_id;
         $user=auth()->user()->userType;

        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

       $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
    ->join('products','products.id','=','ordered_products.product_id')
    ->join('delivery1s','delivery1s.order_id','=','ordered_products.order_id')
    ->join('delivery1_products', function ($join) {
        $join->on('delivery1_products.delivery1_id', '=', 'delivery1s.id')
             ->on('products.id', '=', 'delivery1_products.product_id');
    })
    ->where('orders.id', $order_id)
    ->distinct()
    ->get(['products.image','products.description','products.id', 'orders.id', 'products.name','products.price','ordered_products.ordered_quantity','ordered_products.kd_adjusted_quantity','delivery1_products.partial_quantity','delivery1_products.delivered_quantity','ordered_products.subTotal','orders.totalPrice','delivery1_products.amount_status','ordered_products.status']);

        if($user=="HO")
         {
              return view('orderCart.orderDetailsho',compact('orderedProducts','auth'));
         }
         else if($user=="admin")
         {
              return view('orderCart.orderDetailsho',compact('orderedProducts','auth'));
         }




    }


    public function orderDetails(Request $request)
    {


               $auth = Auth::user()->userName;
        $order_id=$request->order_id;
        $client = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts = orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)->get();
        // echo $orderedProducts[0]->order_id;
    //    echo $orderedProducts[0]->confirmStatus;
    //    echo $orderedProducts[0]->handoverStatus;
        // return view('orderCart.orderDetails',compact('orderedProducts','auth'));


        return view('orderCart.orderDetails',compact('orderedProducts','auth'));


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\\Cart::clear();Response
     */
    public function create()
    {
        //
    }

    public function clientCheck(Request $request){
        // $client_ids = explode('|', $request->client);
        $client_id = $client_ids[0];
        $KD_id = $client_ids[1];
        $total = $request->total;
        return view('orderCart.checkClient',compact('client_id','KD_id','total'));
    }
    public function clientCheckSubmit(Request $request)
    {
        $client = client::join('users','users.id','=','clients.user_id')
        ->where('clients.user_id',$client_id)
        ->get('clients.PinCode');
        return $client->PinCode;
        $pin = $request->pinCode;
        if($client->PinCode == $pin)
        {
            return redirect()->route('orderProduct',['client_id'=>$request->client_id, 'KD_id'=>$request->KD_id]);
        }
        else
        {
            return redirect()->back()->withErrors("Wrong Pin Code");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
   {
        $client_id = $request->clients_user_id;
        // $KD_id = $client_ids[1];
        $ord = Auth::id();
        $city = client::where('user_id',$client_id)
        ->get('clients.City');


        $KD_id = client::where('user_id',$client_id)
        ->get('clients.distro_id');
        $agent= agent::where('user_id',Auth::id())->get();
        $rom_id=$agent[0]->rom_id;
        $order_status=cities::where('name','=',$city[0]->City)
        ->get();
        $order_statuses=order_statuses::where('City','=',$city[0]->City)
        ->where('status','=',1)
        ->whereNull('enddate')
        ->get();


        $a=agent::all();
        // echo $KD_id;
        $Hierarchy_id = order::join('handover_hierarchy','handover_hierarchy.id','=','orders.hierarchy_id')
                                ->get();


        $client = client::join('users','users.id','=','clients.user_id')
            ->where('clients.user_id',$client_id)
            ->value('clients.PinCode');

        if($order_status[0]->order_status==1)
        {
             if($client == $request->pinCode)
        {


        $products = \Cart::getcontent();


        $size_of_product=0;
        $size_of_found=0;
         $start_date=$order_statuses[0]->startdate;
         $start_date = Carbon::parse($start_date);

        $start_date = $start_date->format('Y-m-d');
         $prduct_found=OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->where('orders.client_id','=',$client_id)
            ->where('orders.confirmStatus','!=','confirmed')
            ->where('orders.createdDate','>=',$start_date);

             $orders_byclient=$prduct_found->get(['ordered_products.id','ordered_products.ordered_quantity','ordered_products.subTotal','orders.id as order_id','orders.totalPrice']);

             if($orders_byclient->count() > 0)
         {

            foreach($products as $product)
            {
            $size_of_product=$size_of_product+1;
            $amount = $product->quantity;
            $Avaliable_product = product::find($product->id);
            $reserved=$Avaliable_product->reserverd_qty+$amount;
            if ($Avaliable_product->Qty >= $amount && $Avaliable_product->Qty > 0 )
            {

            $prduct_found=OrderedProducts::join('orders','orders.id','=','ordered_products.order_id')
            ->where('orders.client_id','=',$client_id)
            ->where('orders.createdDate','>=',$start_date);

             $update_reserved=product::where('id',$product->id)
            ->update(['reserverd_qty'=> $reserved]);


             $update_reserved=product::where('id',$product->id)
            ->update(['reserverd_qty'=> $reserved]);
            $orders_byclient=$prduct_found->get(['ordered_products.id','ordered_products.ordered_quantity','ordered_products.subTotal',
            'orders.id as order_id','orders.totalPrice']);

            $prduct_found=$prduct_found->where('ordered_products.product_id','=',$product->id)
            ->get(['ordered_products.id','ordered_products.ordered_quantity','ordered_products.subTotal','orders.id as order_id','orders.totalPrice']);
                   if($prduct_found->count() > 0)
            {

               $size_of_found=$size_of_found+1;
               $new_quantity_update=$prduct_found[0]->ordered_quantity+$product->quantity;
               $new_subtotal_update=$prduct_found[0]->subTotal+$product->attributes->subtotal;
               $new_total_update=$prduct_found[0]->totalPrice+$product->attributes->subtotal;



               OrderedProducts::where('id',$prduct_found[0]->id)
               ->update(['ordered_quantity'=>$new_quantity_update,'subTotal'=>$new_subtotal_update]);
                order::where('id',$prduct_found[0]->order_id)
               ->update(['totalPrice'=>$new_total_update]);
               order_details::create([
                  'ordered_id'=>$prduct_found[0]->id,
                  'quantity'=>$product->quantity,
                  'created_date'=>today(),
               ]);


            }
            else
            {

               $new_total_update=$orders_byclient[0]->totalPrice+$product->attributes->subtotal;


              $ordered_product=OrderedProducts::create([
                'product_id' => $product->id,
                'order_id' => $orders_byclient[0]->order_id,
                'ordered_quantity' => $product->quantity,
                'subTotal'=>$product->attributes->subtotal,
            ]);
             order::where('id',$orders_byclient[0]->order_id)
               ->update(['totalPrice'=>$new_total_update]);

                order_details::create([
                  'ordered_id'=>$ordered_product->id,
                  'quantity'=>$product->quantity,
                  'created_date'=>today(),
               ]);
            }
        }
            else {
        Alert::toast('You can not order more than available quantity', 'warning');
              return back();
            }

         }
          LogActivity::addToLog('Order');
        Alert::toast('Successfully Ordered', 'success');
        \Cart::clear();

        return redirect('/showOrders');

            }
         else
         {
             $order = order::create([
            'client_id'=>$client_id,
            'KD_id'=>$KD_id[0]->distro_id,
            'Hierarchy_id'=>$request->hierarchy_id,
            'createdDate'=> today(),
            'createdBy'=> auth()->user()->id,
            'orderedBy'=> auth()->user()->userType,
            'consent'=>1,
            'rom_id'=>  $rom_id,
            'totalPrice'=>$request->total,
            'price_update'=>'0'
        ]);
         foreach($products as $product)
        {
            $amount = $product->quantity;
            $Avaliable_product = product::find($product->id);
            $reserved=$Avaliable_product->reserverd_qty+$amount;
            if ($Avaliable_product->Qty >= $amount && $Avaliable_product->Qty > 0 )
             {
            $update_reserved=product::where('id',$product->id)
            ->update(['reserverd_qty'=> $reserved]);
            $ordered_product=OrderedProducts::create([
                'product_id' => $product->id,
                'order_id' => $order->id,
                'ordered_quantity' => $product->quantity,
                'subTotal'=>$product->attributes->subtotal,
            ]);
            order_details::create([
                  'ordered_id'=>$ordered_product->id,
                  'quantity'=>$product->quantity,
                  'created_date'=>today(),
               ]);
            }
            else {
        Alert::toast('You can not order more than available quantity', 'warning');
               $order = order::find($order->id);

             if ($order) {
                $order->delete();
             }
             else
             {

             }
              return back();
            }
        }
        LogActivity::addToLog('Order');
        Alert::toast('Successfully Ordered', 'success');
        \Cart::clear();

        return redirect('/showOrders');
         }
        }

     else
        {
             Alert::toast('Pin Code Incorrect', 'failed');
         return back();
        }

            }
            else
               {
                Alert::toast('You cannot order now', 'failed');
                 return back();
               }
        }
    public function show(orderedProducts $orderedProducts)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orderedProducts  $orderedProducts
     * @return \Illuminate\Http\Response
     */
    public function edit(orderedProducts $orderedProducts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orderedProducts  $orderedProducts
     * @return \Illuminate\Http\Response
     */
    public function tm_update(Request $request, orderedProducts $orderedProducts)
    {

        $orderupdate = order::where('id',$request->order_id)
            ->update(['tm_confirmation'=>'confirmed']);
        LogActivity::addToLog('confirm order');

            Alert::toast('Order Confirmed', 'success');
        return redirect('/tmDashboard');
    }

       public function update(Request $request, orderedProducts $orderedProducts)
    {

        $orderupdate = order::where('id',$request->order_id)
            ->update(['tm_confirmation'=>'confirmed']);
            LogActivity::addToLog('Order Confirm');

            Alert::toast('Order Confirmed', 'success');
        return redirect('/key_distroDashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orderedProducts  $orderedProducts
     * @return \Illuminate\Http\Response
     */
    public function destroy(orderedProducts $orderedProducts)
    {
        //
    }
}
