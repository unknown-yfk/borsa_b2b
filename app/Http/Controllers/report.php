<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\tm;
use App\Models\User;

use App\Models\order;
use App\Models\delivery1;
use App\Models\delivery2;
use Illuminate\Http\Request;
use App\Models\orderedProducts;
use App\Models\ProductList;
use App\Models\product;
use App\Models\client;
use App\Models\Loans;

use Illuminate\Support\Facades\DB;


class report extends Controller
{
    public function kdReportOrderAccepted()
    {
        # code..
        $order = order::join('key_distros','orders.KD_id','key_distros.user_id')->where('KD_id',Auth::id())->get(['orders.id as order_id','orders.*','key_distros.*']);
        return view('KD.reportOrderAccepted',compact('order'));
    }
    public function kdReportHandover()
    {
        #code ...
        $handover = delivery1::join('users','users.id','=','delivery1s.rom_id')
        ->join('roms','roms.user_id','=','delivery1s.rom_id')
        ->leftjoin('orders','delivery1s.order_id','=','orders.id')
        ->where('delivery1s.kd_id', Auth::id())
        ->get();
        return view('KD.reportHandover', compact('handover'));
    }

        public function tmReportOrderAccepted()
    {
        # code..
            $tm=tm::join('users','users.id','=','tms.user_id')
             ->where('users.id',auth()->user()->id)
             ->get();

     $tmkd_id = $tm[0]->kd_id;



        $client= order::join('users','users.id','=','orders.client_id')
     ->join('clients','clients.user_id','=','orders.client_id')
        // ->join('agents', 'orders.rom_id', '=', 'agents.rom_id')

//  ->whereIn('orders.KD_id', function($query) {
//                     $query->select('kd_id')
//                           ->distinct()
//                           ->from('tms');
//                 })


        // ->where('orders.confirmStatus','confirmed')
        // ->where('orders.rom_order_confirmation','confirmed')
        ->where('orders.KD_id',$tmkd_id)
        // ->where('orders.rom_adjusted_confirmation','confirmed')
        //  ->where('orders.tm_confirmation','confirmed')
        ->orderBy('created_at', 'DESC')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);
        //  echo $order;
        return view('TM.reportOrderAccepted',compact('client'));
    }
    public function tmReportHandover()
    {
        #code ...

            $tm=tm::join('users','users.id','=','tms.user_id')
             ->where('users.id',auth()->user()->id)
             ->get();

     $tmkd_id = $tm[0]->kd_id;
        $handover = delivery1::join('users','users.id','=','delivery1s.rom_id')
        ->join('roms','roms.user_id','=','delivery1s.rom_id')
        ->leftjoin('orders','delivery1s.order_id','=','orders.id')
        ->where('delivery1s.kd_id', $tmkd_id )
        ->get();
        return view('TM.reportHandover', compact('handover'));
    }
    public function romReportHanoveraccepted()
    {
        # code...
        $handover = delivery1::join('users','users.id','=','delivery1s.kd_id')
        ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        ->leftjoin('orders','delivery1s.order_id','=','orders.id')
        ->where('delivery1s.rom_id', Auth::id())
        ->get();
        return view('ROM.reportHandoverAccepted',compact('handover'));
    }
    public function romReportHanoverdelivered()
    {
        $handover = delivery1::join('users','users.id','=','delivery1s.rom_id')
        ->join('roms','roms.user_id','=','users.id')
        ->leftjoin('orders','delivery1s.order_id','=','orders.id')
        ->where('delivery1s.rom_id', Auth::id())
        ->get('delivery1s.*');


        // echo $handover;
        return view('ROM.reportHandoverDelivered',compact('handover'));
    }
  public function adminPaymentReport()
    {
        #code ...
        $paymentReport = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('transaction','transaction.order_id','=','orders.id')
        ->get(['orders.id','orders.paymentStatus','orders.created_at','users.firstName','users.middleName','users.lastName','orders.KD_id','transaction.*']);
        return view('admin.adminPaymentReport',compact('paymentReport'));
    }

    public function hoproductReport(Request $request)
    {
         $total = ProductList::select('productlist.id','productlist.name',DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered'))
         ->join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->where('products.KD_ID','!=','5389')
        ->groupBy('productlist.id','productlist.name')
        ->get();

        return view('ho.productreport',compact('total'));
    }
     public function accionproductReport(Request $request)
    {
         $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        if ($fromDate && $toDate) {

         $users = ProductList::select('productlist.id','productlist.name',DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered'))
         ->join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('clients.Region','Gambella')
        ->where('products.KD_ID','!=','5389')
        ->groupBy('productlist.id','productlist.name')
        ->whereBetween('users.created_at', [$fromDate, $toDate])
        ->get();
        }
        else
        {
         $total = ProductList::select('productlist.id','productlist.name',DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered'))
         ->join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('clients.Region','Gambella')
        ->where('products.KD_ID','!=','5389')
        ->groupBy('productlist.id','productlist.name')
        ->get();
        }
        return view('accion.productreport',compact('total'));
    }

    public function romproductReport(Request $request)
    {
         $id=Auth::id();
         $total = ProductList::select('productlist.id','productlist.name',DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered'))
         ->join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->where('products.KD_ID','!=','5389')
        ->where('orders.rom_id',$id)
        ->groupBy('productlist.id','productlist.name')
        ->get();

        return view('ROM.productreport',compact('total'));
    }

   public function hoproductperagentReport()
    {


        $total = ProductList::join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','users.id')
        ->where('products.KD_ID','!=','5389')
        ->get(['users.firstName','users.middleName','users.lastName','productlist.name','ordered_products.ordered_quantity','orders.createdDate','clients.Region','clients.City']);

        return view('ho.productreportperagent',compact('total'));
    }

       public function accionproductperagentReport()
    {


        $total = ProductList::join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','users.id')
        ->where('clients.Region','=','Gambella')
        ->where('products.KD_ID','!=','5389')
        ->get(['users.firstName','users.middleName','users.lastName','productlist.name','ordered_products.ordered_quantity']);

        return view('accion.productreportperagent',compact('total'));
    }
     public function hodeliveryperagentReport()
    {


        // $LastMileReport = delivery1::join('delivery1_products','delivery1_products.delivery1_id','=','delivery1s.id')
        // ->join('products','products.id','=','delivery1_products.product_id')
        // ->join('productlist','productlist.id','=','products.productlist_id')
        // ->join('orders','orders.id','=','delivery1s.order_id')
        // ->join('users','users.id','=','orders.client_id')
        // ->join('clients','users.id','=','clients.user_id')
        // ->where('users.id','!=','5393')
        // ->where('orders.deliveryStatus','=','Delivered')
        //  ->groupBy('users.firstName','users.middleName','users.lastName','productlist.name','delivery1_products.delivered_quantity','clients.City',
        //  'clients.Region','delivery1_products.subTotal','delivery1_products.id','delivery1_products.partial_quantity','delivery1_products.amount_status')

        // ->get(['users.firstName','users.middleName','users.lastName','productlist.name','delivery1_products.delivered_quantity',
        // 'clients.City','clients.Region','delivery1_products.subTotal','delivery1_products.id','delivery1_products.partial_quantity','delivery1_products.amount_status']);

        $LastMileReport = delivery1::join('delivery1_products','delivery1_products.delivery1_id','=','delivery1s.id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->join('productlist','productlist.id','=','products.productlist_id')
        ->join('orders','orders.id','=','delivery1s.order_id')
        ->join('users','users.id','=','orders.client_id')
        ->join('clients','users.id','=','clients.user_id')
        ->where('users.id','!=','5393')
        ->groupBy('orders.created_at','clients.City','clients.Region','productlist.name','users.firstName','users.middleName','users.lastName',
        'delivery1_products.delivered_quantity','delivery1_products.partial_quantity','productlist.id','delivery1_products.amount_status',
        'delivery1_products.partial_quantity','delivery1_products.delivered_quantity','delivery1_products.subTotal')
        ->get(['orders.created_at','clients.City','clients.Region','productlist.name','users.firstName','users.middleName','users.lastName',
        'delivery1_products.delivered_quantity','delivery1_products.partial_quantity','productlist.id','delivery1_products.amount_status','delivery1_products.partial_quantity','delivery1_products.delivered_quantity',
        'delivery1_products.subTotal']);


        $product=delivery1::join('delivery1_products','delivery1_products.delivery1_id','=','delivery1s.id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->join('productlist','productlist.id','=','products.productlist_id')
        ->groupBy('productlist.id','productlist.name')
        ->get(['productlist.name','productlist.id']);



        return view('ho.deliveryreportperagent',compact('LastMileReport','product'));
    }


     public function romproductperagentReport()
    {

        $id=Auth::id();
        $total = ProductList::join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','users.id')
        ->where('products.KD_ID','!=','5389')
        ->where('orders.rom_id',$id)
        ->get(['users.firstName','users.middleName','users.lastName','productlist.name','ordered_products.ordered_quantity','clients.Region','clients.City','orders.createdDate']);

        return view('ROM.productreportperagent',compact('total'));
    }
    public function hoproductperloactionReport(Request $request)
    {

       $Region = $request->input('Region');
        $productname = $request->input('productname');
         $from = $request->input('from');
        $to = $request->input('to');


        if ($Region || $productname || $from || $to)
         {
        $total = ProductList::select('clients.Region', 'productlist.name') ->selectRaw('SUM(ordered_products.ordered_quantity) as total_ordered')
            ->selectRaw('MAX(orders.createdDate) as min')
            ->selectRaw('MIN(orders.createdDate) as max')
            ->join('products', 'products.productlist_id', '=', 'productlist.id')
            ->join('ordered_products', 'ordered_products.product_id', '=', 'products.id')
            ->join('orders', 'orders.id', '=', 'ordered_products.order_id')
            ->join('clients', 'clients.user_id', '=', 'orders.client_id')
            ->where('products.KD_ID', '!=', '5389');

        if ($Region) {
            $total->where('clients.Region', 'like', '%' . $Region . '%');
        }

        if ($productname) {
            $total->where('productlist.name', 'like', '%' . $productname . '%');
        }

        if ($from && $to) {
            $total->whereBetween('orders.createdDate', [$from, $to]);
        }

        $total->groupBy('clients.Region', 'productlist.name');

        $total = $total->get();

        }
        else
        {
            $total = ProductList::select('clients.Region','productlist.name',DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered'),
            DB::raw('Max(orders.createdDate) as min') , DB::raw('MIN(orders.createdDate) as max'))
        ->join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('products.KD_ID','!=','5389')
        ->groupBy('clients.Region','productlist.name')
        ->get();
        }
        return view('ho.productreportperlocation',compact('total'));

    }
     public function accionproductperloactionReport(Request $request)
    {

       $Region = $request->input('Region');
        $productname = $request->input('productname');
         $from = $request->input('from');
        $to = $request->input('to');


        if ($Region || $productname || $from || $to)
         {
        $total = ProductList::select('clients.Region', 'productlist.name') ->selectRaw('SUM(ordered_products.ordered_quantity) as total_ordered')
            ->selectRaw('MAX(orders.createdDate) as min')
            ->selectRaw('MIN(orders.createdDate) as max')
            ->join('products', 'products.productlist_id', '=', 'productlist.id')
            ->join('ordered_products', 'ordered_products.product_id', '=', 'products.id')
            ->join('orders', 'orders.id', '=', 'ordered_products.order_id')
            ->join('clients', 'clients.user_id', '=', 'orders.client_id')
            ->where('clients.Region', '=', 'Gambella')
            ->where('products.KD_ID', '!=', '5389');

        if ($Region) {
            $total->where('clients.Region', 'like', '%' . $Region . '%');
        }

        if ($productname) {
            $total->where('productlist.name', 'like', '%' . $productname . '%');
        }

        if ($from && $to) {
            $total->whereBetween('orders.createdDate', [$from, $to]);
        }

        $total->groupBy('clients.Region', 'productlist.name');

        $total = $total->get();

        }
        else
        {
            $total = ProductList::select('clients.Region','productlist.name',DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered'),
            DB::raw('Max(orders.createdDate) as min') , DB::raw('MIN(orders.createdDate) as max'))
        ->join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('products.KD_ID','!=','5389')
        ->where('clients.Region', '=', 'Gambella')
        ->groupBy('clients.Region','productlist.name')
        ->get();
        }
        return view('accion.productreportperlocation',compact('total'));

    }
     public function romproductperloactionReport(Request $request)
    {
        $id=Auth::id();

       $Region = $request->input('Region');
        $productname = $request->input('productname');
         $from = $request->input('from');
        $to = $request->input('to');
        //  dd($productname,$Region);
        if ($Region || $productname || $from || $to) {

        $total = ProductList::select('clients.Region','productlist.name',
        DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered'),DB::raw('Max(orders.createdDate) as min') , DB::raw('MIN(orders.createdDate) as max'))
        ->join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('products.KD_ID','!=','5389')
        ->where('orders.rom_id',$id);

         if ($Region) {
            $total->where('clients.Region', 'like', '%' . $Region . '%');
        }

        if ($productname) {
            $total->where('productlist.name', 'like', '%' . $productname . '%');
        }

        if ($from && $to) {
            $total->whereBetween('orders.createdDate', [$from, $to]);
        }

        $total->groupBy('clients.Region', 'productlist.name');

        $total = $total->get();



        }
        else
        {
            $total = ProductList::select('clients.Region','productlist.name',DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered'),
            DB::raw('Max(orders.createdDate) as min') , DB::raw('MIN(orders.createdDate) as max'))
        ->join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('products.KD_ID','!=','5389')
        ->where('orders.rom_id',$id)
        ->groupBy('clients.Region','productlist.name')
        ->get();
        }
        return view('ROM.productreportperlocation',compact('total'));

    }
        public function hoproductpersubloactionReport(Request $request)
    {
        $Region = $request->input('Region');
        $City = $request->input('City');
        $productname = $request->input('productname');
        $from = $request->input('from');
        $to = $request->input('to');

        if ($Region || $productname || $City || $from || $to) {

        // $total = ProductList::select('clients.Region','clients.City','productlist.name',DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered')
        // ,DB::raw('Max(orders.createdDate) as min') , DB::raw('MIN(orders.createdDate) as max'))
        // ->join('products','products.productlist_id','=','productlist.id')
        // ->join('ordered_products','ordered_products.product_id','=','products.id')
        // ->join('orders','orders.id','=','ordered_products.order_id')
        // ->join('clients','clients.user_id','=','orders.client_id')
        // ->where('products.KD_ID','!=','5389')

        // ->where('clients.Region', 'like', '%' . $Region . '%')
        // ->where('productlist.name', 'like', '%' . $productname . '%')
        // ->where('clients.City', 'like', '%' . $City . '%')

        // ->whereBetween('orders.createdDate', [$from, $to])
        // ->groupBy('clients.Region','productlist.name','clients.City')
        // ->get();

         $total = ProductList::select('clients.Region','clients.City','productlist.name',DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered')
        ,DB::raw('Max(orders.createdDate) as min') , DB::raw('MIN(orders.createdDate) as max'))
        ->join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('products.KD_ID','!=','5389');

        if ($Region) {
            $total->where('clients.Region', 'like', '%' . $Region . '%');
        }
        if ($City) {
            $total->where('clients.City', 'like', '%' . $City . '%');
        }

        if ($productname) {
            $total->where('productlist.name', 'like', '%' . $productname . '%');
        }

        if ($from && $to) {
            $total->whereBetween('orders.createdDate', [$from, $to]);
        }

        $total->groupBy('clients.Region','productlist.name','clients.City');

        $total = $total->get();

        }
        else
        {
            $total = ProductList::select('clients.Region','clients.City','productlist.name',DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered')
            ,DB::raw('Max(orders.createdDate) as min') , DB::raw('MIN(orders.createdDate) as max'))
        ->join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('products.KD_ID','!=','5389')
        ->groupBy('clients.Region','productlist.name','clients.City')
        ->get();
        }
        return view('ho.productreportpersublocation',compact('total'));
    }

        public function accionproductpersubloactionReport(Request $request)
    {
        $Region = $request->input('Region');
        $City = $request->input('City');
        $productname = $request->input('productname');
        $from = $request->input('from');
        $to = $request->input('to');

        if ($Region || $productname || $City || $from || $to) {

        // $total = ProductList::select('clients.Region','clients.City','productlist.name',DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered')
        // ,DB::raw('Max(orders.createdDate) as min') , DB::raw('MIN(orders.createdDate) as max'))
        // ->join('products','products.productlist_id','=','productlist.id')
        // ->join('ordered_products','ordered_products.product_id','=','products.id')
        // ->join('orders','orders.id','=','ordered_products.order_id')
        // ->join('clients','clients.user_id','=','orders.client_id')
        // ->where('products.KD_ID','!=','5389')

        // ->where('clients.Region', 'like', '%' . $Region . '%')
        // ->where('productlist.name', 'like', '%' . $productname . '%')
        // ->where('clients.City', 'like', '%' . $City . '%')

        // ->whereBetween('orders.createdDate', [$from, $to])
        // ->groupBy('clients.Region','productlist.name','clients.City')
        // ->get();

         $total = ProductList::select('clients.Region','clients.City','productlist.name',DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered')
        ,DB::raw('Max(orders.createdDate) as min') , DB::raw('MIN(orders.createdDate) as max'))
        ->join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('clients.Region','=','Gambella')
        ->where('products.KD_ID','!=','5389');

        if ($Region) {
            $total->where('clients.Region', 'like', '%' . $Region . '%');
        }
        if ($City) {
            $total->where('clients.City', 'like', '%' . $City . '%');
        }

        if ($productname) {
            $total->where('productlist.name', 'like', '%' . $productname . '%');
        }

        if ($from && $to) {
            $total->whereBetween('orders.createdDate', [$from, $to]);
        }

        $total->groupBy('clients.Region','productlist.name','clients.City');

        $total = $total->get();

        }
        else
        {
            $total = ProductList::select('clients.Region','clients.City','productlist.name',DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered')
            ,DB::raw('Max(orders.createdDate) as min') , DB::raw('MIN(orders.createdDate) as max'))
        ->join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('products.KD_ID','!=','5389')
        ->where('clients.Region','=','Gambella')
        ->groupBy('clients.Region','productlist.name','clients.City')
        ->get();
        }
        return view('accion.productreportpersublocation',compact('total'));
    }
    public function romproductpersubloactionReport(Request $request)
    {
        $id=Auth::id();
        $Region = $request->input('Region');
        $City = $request->input('City');
        $productname = $request->input('productname');
        $from = $request->input('from');
        $to = $request->input('to');
        //  dd($productname,$Region);
        if ($Region || $productname || $City || $from || $to) {

        $total = ProductList::select('clients.Region','clients.City','productlist.name',DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered')
        ,DB::raw('Max(orders.createdDate) as min') , DB::raw('MIN(orders.createdDate) as max'))
        ->join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('products.KD_ID','!=','5389')
        ->where('orders.rom_id',$id);

        if ($Region) {
            $total->where('clients.Region', 'like', '%' . $Region . '%');
        }
        if ($City) {
            $total->where('clients.City', 'like', '%' . $City . '%');
        }

        if ($productname) {
            $total->where('productlist.name', 'like', '%' . $productname . '%');
        }

        if ($from && $to) {
            $total->whereBetween('orders.createdDate', [$from, $to]);
        }

        $total->groupBy('clients.Region','productlist.name','clients.City');

        $total = $total->get();

        }
        else
        {
            $total = ProductList::select('clients.Region','clients.City','productlist.name',DB::raw('SUM(ordered_products.ordered_quantity) as total_ordered')
            ,DB::raw('Max(orders.createdDate) as min') , DB::raw('MIN(orders.createdDate) as max'))
        ->join('products','products.productlist_id','=','productlist.id')
        ->join('ordered_products','ordered_products.product_id','=','products.id')
        ->join('orders','orders.id','=','ordered_products.order_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('products.KD_ID','!=','5389')
        ->where('orders.rom_id',$id)
        ->groupBy('clients.Region','productlist.name','clients.City')
        ->get();
        }
        return view('ROM.productreportpersublocation',compact('total'));
    }
     public function hoonboardingReport(Request $request)
    {
        //   $fromDate = $request->input('from_date');
        // $toDate = $request->input('to_date');
        // $user=auth()->user()->userType;
        // if ($fromDate && $toDate) {

        //  $users = User::select('users.id','users.created_at','clients.client_unique_id','clients.Training_module1','clients.Training_module2',
        //  'clients.age','clients.Nationality','clients.Region','clients.City','clients.camp',
        //  'clients.Training_module3',DB::raw('CONCAT(users.firstName," ",users.middleName," ",users.lastName) AS full_name'))
        // ->join('clients','clients.user_id','=','users.id')
        // ->where('users.id','!=','5393')
        // ->whereBetween('users.created_at', [$fromDate, $toDate])
        // ->get();
        // }
        // else
        // {
        //      $users = User::select('users.id','users.created_at','clients.client_unique_id','clients.Training_module1','clients.Training_module2',
        //  'clients.age','clients.Nationality','clients.Region','clients.City','clients.camp',
        //  'clients.Training_module3',DB::raw('CONCAT(users.firstName," ",users.middleName," ",users.lastName) AS full_name'))
        // ->join('clients','clients.user_id','=','users.id')
        // ->where('users.id','!=','5393')
        // ->get();
        // }
        //   if($user=="HO")
        //  {
        //       return view('ho.onboardingreport',compact('users'));
        //  }
        //  else if($user=="admin")
        //  {
        //       return view('admin.onboardingreport',compact('users'));
        //  }

         $fromDate = $request->input('from_date');
$toDate = $request->input('to_date');
$userType = auth()->user()->userType;

$users = User::select(
        'users.id',
        'users.created_at',
        'clients.client_unique_id',
        'clients.Training_module1',
        'clients.Training_module2',
        'clients.age',
        'clients.Nationality',
        'clients.Region',
        'clients.City',
        'clients.camp',
        'clients.Training_module3',
        'clients.client_mobile',
        DB::raw('CONCAT(users.firstName, " ", users.middleName, " ", users.lastName) AS full_name')
    )
    ->join('clients', 'clients.user_id', '=', 'users.id')
    ->where('users.id', '!=', '5393')
    ->when($fromDate && $toDate, function ($users) use ($fromDate, $toDate) {
        return $users->whereBetween('users.created_at', [$fromDate, $toDate]);
    })
    ->get();
    //->paginate(10);

if ($userType == "HO") {
    return view('ho.onboardingreport', compact('users'));
} elseif ($userType == "admin") {
    return view('admin.onboardingreport', compact('users'));
}


    }
     public function acciononboardingReport(Request $request)
    {
          $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        if ($fromDate && $toDate) {

         $users = User::select('users.id','users.created_at','clients.client_unique_id','clients.Training_module1','clients.Training_module2',
         'clients.age','clients.Nationality','clients.Region','clients.City','clients.camp',
         'clients.Training_module3',DB::raw('CONCAT(users.firstName," ",users.middleName," ",users.lastName) AS full_name'))
        ->join('clients','clients.user_id','=','users.id')
        ->where('clients.Region','=','Gambella')
        ->where('users.id','!=','5393')
        ->whereBetween('users.created_at', [$fromDate, $toDate])
        ->get();
        }
        else
        {
             $users = User::select('users.id','users.created_at','clients.client_unique_id','clients.Training_module1','clients.Training_module2',
         'clients.age','clients.Nationality','clients.Region','clients.City','clients.camp',
         'clients.Training_module3',DB::raw('CONCAT(users.firstName," ",users.middleName," ",users.lastName) AS full_name'))
        ->join('clients','clients.user_id','=','users.id')
        ->where('users.id','!=','5393')
        ->where('clients.Region','=','Gambella')
        ->get();
        }
        return view('accion.onboardingreport',compact('users'));
    }

    public function analyistonboardingReport()
    {


         $users = User::select('users.id','users.created_at','clients.client_unique_id','clients.Training_module1','clients.Training_module2',
         'clients.age','clients.Nationality','clients.Region','clients.City','clients.camp',
         'clients.Training_module3',DB::raw('CONCAT(users.firstName," ",users.middleName," ",users.lastName) AS full_name'))
        ->join('clients','clients.user_id','=','users.id')
        ->get();

        return view('analyist.onboardingreport',compact('users'));
    }

     public function hoorderfulfilmentReport(Request $request)
    {

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        if ($fromDate && $toDate)
        {
             $results = DB::table('orders')
            ->join('clients', 'orders.client_id', '=', 'clients.user_id')
            ->join('users', 'orders.client_id', '=', 'users.id')
            ->leftJoin('delivery1s', 'orders.id', '=', 'delivery1s.order_id')
            ->select(
                'orders.id AS id',
                'orders.client_id',
                'users.firstname',
                'users.lastname',
                'users.created_at AS user_reg',
                'orders.createdDate AS order_placed_Date',
                DB::raw('CASE WHEN orders.deliveryStatus = "delivered" THEN orders.updated_at ELSE NULL END AS deliveryDate'),
                'orders.totalPrice AS orderAmount',
                'orders.confirmStatus AS status',
                'clients.region AS Location',
                'clients.city AS sub_location',
                DB::raw('COALESCE(delivery1s.deliveryTotalPrice, NULL) AS deliveryTotal'),
                'orders.deliveryStatus AS DeliveryStatus'
            )
            ->whereBetween('orders.created_at', [$fromDate, $toDate])
            ->get();
        }
        else
        {
            $results = DB::table('orders')
            ->join('clients', 'orders.client_id', '=', 'clients.user_id')
            ->join('users', 'orders.client_id', '=', 'users.id')
            ->leftJoin('delivery1s', 'orders.id', '=', 'delivery1s.order_id')
            ->select(
                'orders.id AS id',
                'orders.client_id',
                'users.firstname',
                'users.lastname',
                'users.created_at AS user_reg',
                'orders.createdDate AS order_placed_Date',
                DB::raw('CASE WHEN orders.deliveryStatus = "delivered" THEN orders.updated_at ELSE NULL END AS deliveryDate'),
                'orders.totalPrice AS orderAmount',
                'orders.confirmStatus AS status',
                'clients.region AS Location',
                'clients.city AS sub_location',
                DB::raw('COALESCE(delivery1s.deliveryTotalPrice, NULL) AS deliveryTotal'),
                'orders.deliveryStatus AS DeliveryStatus'
            )

            ->get();
        }
        // dd($results);
        return view('ho.hoOrderFulfilmentReport', compact('results'));
    }
     public function accionorderfulfilmentReport(Request $request)
    {

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        if ($fromDate && $toDate)
        {
             $results = DB::table('orders')
            ->join('clients', 'orders.client_id', '=', 'clients.user_id')
            ->join('users', 'orders.client_id', '=', 'users.id')
            ->leftJoin('delivery1s', 'orders.id', '=', 'delivery1s.order_id')
            ->select(
                'orders.id AS id',
                'clients.client_unique_id',
                'users.firstname',
                'users.lastname',
                'users.created_at AS user_reg',
                'orders.createdDate AS order_placed_Date',
                DB::raw('CASE WHEN orders.deliveryStatus = "delivered" THEN orders.updated_at ELSE NULL END AS deliveryDate'),
                'orders.totalPrice AS orderAmount',
                'orders.confirmStatus AS status',
                'clients.region AS Location',
                'clients.city AS sub_location',
                DB::raw('COALESCE(delivery1s.deliveryTotalPrice, NULL) AS deliveryTotal'),
                'orders.deliveryStatus AS DeliveryStatus'
            )
            ->whereBetween('orders.created_at', [$fromDate, $toDate])
            ->where('clients.Region','=','Gambella')
            ->get();
        }
        else
        {
            $results = DB::table('orders')
            ->join('clients', 'orders.client_id', '=', 'clients.user_id')
            ->join('users', 'orders.client_id', '=', 'users.id')
            ->leftJoin('delivery1s', 'orders.id', '=', 'delivery1s.order_id')
            ->select(
                'orders.id AS id',
                'clients.client_unique_id',
                'users.firstname',
                'users.lastname',
                'users.created_at AS user_reg',
                'orders.createdDate AS order_placed_Date',
                DB::raw('CASE WHEN orders.deliveryStatus = "delivered" THEN orders.updated_at ELSE NULL END AS deliveryDate'),
                'orders.totalPrice AS orderAmount',
                'orders.confirmStatus AS status',
                'clients.region AS Location',
                'clients.city AS sub_location',
                DB::raw('COALESCE(delivery1s.deliveryTotalPrice, NULL) AS deliveryTotal'),
                'orders.deliveryStatus AS DeliveryStatus'
            )
            ->where('clients.Region','=','Gambella')
            ->get();
        }

        return view('accion.accionOrderFulfilmentReport', compact('results'));
    }

    public function filterorders(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('hoorderfulfilmentReport', [
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date')
        ]);
    }
    public function filterordersaccion(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('accionorderfulfilmentReport', [
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date')
        ]);
    }

     public function filterorderaccion(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('accionorderReport', [
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date')
        ]);
    }
      public function filterproductpersubloaction(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('hoproductpersubloactionReport', [
            'Region' => $request->input('Region'),
            'productname' => $request->input('productname'),
            'City' => $request->input('City'),
            'from' => $request->input('from'),
            'to' => $request->input('to')
        ]);
    }

    public function filterproductpersubloactionaccion(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('accionproductpersubloactionReport', [
            'Region' => $request->input('Region'),
            'productname' => $request->input('productname'),
            'City' => $request->input('City'),
            'from' => $request->input('from'),
            'to' => $request->input('to')
        ]);
    }
       public function filterproductpersubloactionrom(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('romproductpersubloactionReport', [
            'Region' => $request->input('Region'),
            'productname' => $request->input('productname'),
            'City' => $request->input('City'),
            'from' => $request->input('from'),
            'to' => $request->input('to')
        ]);
    }
      public function filterproductperloaction(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('hoproductperloactionReport', [
            'Region' => $request->input('Region'),
            'productname' => $request->input('productname'),
            'from' => $request->input('from'),
            'to' => $request->input('to')
        ]);
    }
      public function filterproductperloactionaccion(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('accionproductperloactionReport', [
            'Region' => $request->input('Region'),
            'productname' => $request->input('productname'),
            'from' => $request->input('from'),
            'to' => $request->input('to')
        ]);
    }
      public function filterproductperloactionrom(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('romproductperloactionReport', [
            'Region' => $request->input('Region'),
            'productname' => $request->input('productname'),
            'from' => $request->input('from'),
            'to' => $request->input('to')
        ]);
    }

      public function filterproductperagent(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('hoproductperagentReport', [
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date')
        ]);
    }
     public function filterproductperagentrom(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('romproductperagentReport', [
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date')
        ]);
    }

     public function filterproduct(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('hoproductReport', [
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date')
        ]);
    }
     public function filterproductaccion(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('accionproductReport', [
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date')
        ]);
    }

      public function filterproductrom(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('romproductReport', [
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date')
        ]);
    }
     public function filteronboarding(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('hoonboardingReport', [
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date')
        ]);
    }

    public function filteronboardingaccion(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('acciononboardingReport', [
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date')
        ]);
    }
     public function filterorder(Request $request)
    {
        // Redirect to the hoTargetAndOnboardingReport route with the selected date range as query parameters
        return redirect()->route('hoorderReport', [
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date')
        ]);
    }
     public function filterlastMile(Request $request)
    {

        return redirect()->route('hoLastmileReport', [
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date')
        ]);
    }
      public function filterlastMileaccion(Request $request)
    {

        return redirect()->route('accionLastmileReport', [
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date')
        ]);
    }

     public function hodeliveryReport(Request $request)
    {
       $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    $regionFilters = $request->input('region_filter');
    $cityFilters = $request->input('city_filter');


     $user=auth()->user()->userType;
     if($user=="accion")
    {
       $regionFilters="";
        $uniqueRegions = "";
        $uniqueCities = [];

          $lastMileReport = OrderedProducts::select(
        'ordered_products.order_id as orderedId',
        'orders.totalPrice',
        'orders.client_id',
        'clients.user_id',
        'users.firstname as firstname',
        'users.lastname as lastname',
        'users.middleName as middleName',
        'clients.Region',
        'clients.City',
        'orders.created_at as created_at',
        DB::raw('GROUP_CONCAT(products.productlist_id ) AS product_ids'),
        DB::raw('GROUP_CONCAT(ordered_products.ordered_quantity ORDER BY ordered_products.id) AS ordered_quantities')


      )
        ->join('orders', 'ordered_products.order_id', '=', 'orders.id')
        ->join('clients', 'orders.client_id', '=', 'clients.user_id')
        ->join('users', 'clients.user_id', '=', 'users.id')
        ->join('products','ordered_products.product_id','=','products.id')
        ->where('clients.Region','Gambella');

        $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
            ->join('clients', 'clients.user_id', '=', 'orders.client_id')
            ->join('products', 'products.id', '=', 'ordered_products.product_id')
            ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
            ->groupBy('productlist.id', 'productlist.name')
            ->where('clients.Region','Gambella')
            ->get(['productlist.name', 'productlist.id']);

            if ($fromDate && $toDate) {
            $lastMileReport->whereBetween('orders.created_at', [$fromDate, $toDate]);
        }


        if (!$regionFilters) {
            $uniqueCities = client::distinct()->pluck('City')->toArray();
        }

        if ($regionFilters) {
            $lastMileReport->whereIn('clients.Region', $regionFilters);


            $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


            if ($cityFilters) {
                $lastMileReport->whereIn('clients.City', $cityFilters);
            }
        } elseif ($cityFilters) {
            $lastMileReport->whereIn('clients.City', $cityFilters);
        }
        $lastMileReport=$lastMileReport->groupBy(
            'ordered_products.order_id',
            'orders.totalPrice',
            'orders.client_id',
            'clients.user_id',
            'users.firstname',
            'users.middleName',
            'users.lastname',
            'clients.Region',
            'clients.City',
            'orders.created_at'
        )
        ->get();
            $uniqueCities = [];

    }
     else {
    $uniqueRegions = client::distinct()->pluck('Region')->toArray();
    $uniqueCities = [];
    //  $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


    // $query = delivery1::join('delivery1_products', 'delivery1_products.delivery1_id', '=', 'delivery1s.id')
    //     ->join('products', 'products.id', '=', 'delivery1_products.product_id')
    //     ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
    //     ->join('orders', 'orders.id', '=', 'delivery1s.order_id')
    //     ->join('users', 'users.id', '=', 'orders.client_id')
    //     ->join('clients', 'users.id', '=', 'clients.user_id')
    //     ->where('users.id', '!=', '5393');



    $lastMileReport = OrderedProducts::select(
        'ordered_products.order_id as orderedId',
        'orders.totalPrice',
        'orders.client_id',
        'clients.user_id',
        'users.firstname as firstname',
        'users.lastname as lastname',
        'users.middleName as middleName',
        'clients.Region',
        'clients.City',
        'orders.created_at as created_at',
        DB::raw('GROUP_CONCAT(products.productlist_id ) AS product_ids'),
        DB::raw('GROUP_CONCAT(ordered_products.ordered_quantity ORDER BY ordered_products.id) AS ordered_quantities')


    )
    ->join('orders', 'ordered_products.order_id', '=', 'orders.id')
    ->join('clients', 'orders.client_id', '=', 'clients.user_id')
    ->join('users', 'clients.user_id', '=', 'users.id')
    ->join('products','ordered_products.product_id','=','products.id');

    $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
        ->join('products', 'products.id', '=', 'ordered_products.product_id')
        ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
        ->groupBy('productlist.id', 'productlist.name')
        ->get(['productlist.name', 'productlist.id']);

        if ($fromDate && $toDate) {
        $lastMileReport->whereBetween('orders.created_at', [$fromDate, $toDate]);
    }


    if (!$regionFilters) {
        $uniqueCities = client::distinct()->pluck('City')->toArray();
    }

    if ($regionFilters) {
        $lastMileReport->whereIn('clients.Region', $regionFilters);


        $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


        if ($cityFilters) {
            $lastMileReport->whereIn('clients.City', $cityFilters);
        }
    } elseif ($cityFilters) {
        $lastMileReport->whereIn('clients.City', $cityFilters);
    }

    $lastMileReport=$lastMileReport ->groupBy(
        'ordered_products.order_id',
        'orders.totalPrice',
        'orders.client_id',
        'clients.user_id',
        'users.firstname',
        'users.middleName',
        'users.lastname',
        'clients.Region',
        'clients.City',
        'orders.created_at'
    )
    ->get();
    }



    return view('ho.hodeliveryReport', compact('lastMileReport', 'product', 'uniqueRegions', 'uniqueCities'));
    }




    public function ordercapturetransaction(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $regionFilters = $request->input('region_filter');
        $cityFilters = $request->input('city_filter');

        $user=auth()->user()->userType;
        if($user=="accion")
        {
         $uniqueRegions = "";
        $uniqueCities = [];

        $lastMileReport = OrderedProducts::select(
            'ordered_products.order_id as orderedId',
            'orders.client_id',
            'orders.totalPrice',
            'clients.user_id',
            'users.firstname as firstname',
            'users.lastname as lastname',
            'users.middleName as middleName',
            'clients.Region',
            'clients.City',
            'orders.created_at as created_at',
            DB::raw('GROUP_CONCAT(products.productlist_id ) AS product_ids'),
            DB::raw('GROUP_CONCAT(ordered_products.subTotal ORDER BY ordered_products.id) AS ordered_quantities'),

            DB::raw('GROUP_CONCAT(ordered_products.subTotal ) AS subTotal')


        )
            ->join('orders', 'ordered_products.order_id', '=', 'orders.id')
            ->join('clients', 'orders.client_id', '=', 'clients.user_id')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->join('products', 'ordered_products.product_id', '=', 'products.id')
            ->where('clients.Region','Gambella');

        $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
            ->join('clients', 'clients.user_id', '=', 'orders.client_id')
            ->join('products', 'products.id', '=', 'ordered_products.product_id')
            ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
            ->groupBy('productlist.id', 'productlist.name')
            ->where('clients.Region','Gambella')
            ->get(['productlist.name', 'productlist.id']);


            if ($fromDate && $toDate) {
            $lastMileReport->whereBetween('orders.created_at', [$fromDate, $toDate]);
        }


        if (!$regionFilters) {
            $uniqueCities = client::distinct()->pluck('City')->toArray();
        }

        if ($regionFilters) {
            $lastMileReport->whereIn('clients.Region', $regionFilters);


            $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


            if ($cityFilters) {
                $lastMileReport->whereIn('clients.City', $cityFilters);
            }
        } elseif ($cityFilters) {
            $lastMileReport->whereIn('clients.City', $cityFilters);
        }
            $uniqueCities = [];
            $lastMileReport=$lastMileReport->groupBy(
                'ordered_products.order_id',
                'orders.client_id',
                'clients.user_id',
                'users.firstname',
                'users.middleName',
                'users.lastname',
                'clients.Region',
                'clients.City',
                'orders.created_at',
                 'orders.totalPrice'
            )
            ->get();
        }
        else
        {
 $uniqueRegions = client::distinct()->pluck('Region')->toArray();
        $uniqueCities = [];

        $query = delivery1::join('delivery1_products', 'delivery1_products.delivery1_id', '=', 'delivery1s.id')
            ->join('products', 'products.id', '=', 'delivery1_products.product_id')
            ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
            ->join('orders', 'orders.id', '=', 'delivery1s.order_id')
            ->join('users', 'users.id', '=', 'orders.client_id')
            ->join('clients', 'users.id', '=', 'clients.user_id')
            ->where('users.id', '!=', '5393');


        $lastMileReport = OrderedProducts::select(
            'ordered_products.order_id as orderedId',
            'orders.client_id',
            'orders.totalPrice',
            'clients.user_id',
            'users.firstname as firstname',
            'users.lastname as lastname',
            'users.middleName as middleName',
            'clients.Region',
            'clients.City',
            'orders.created_at as created_at',
            DB::raw('GROUP_CONCAT(products.productlist_id ) AS product_ids'),
            DB::raw('GROUP_CONCAT(ordered_products.subTotal ORDER BY ordered_products.id) AS ordered_quantities'),

            DB::raw('GROUP_CONCAT(ordered_products.subTotal ) AS subTotal')


        )
            ->join('orders', 'ordered_products.order_id', '=', 'orders.id')
            ->join('clients', 'orders.client_id', '=', 'clients.user_id')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->join('products', 'ordered_products.product_id', '=', 'products.id')
            ;

        $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'ordered_products.product_id')
            ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
            ->groupBy('productlist.id', 'productlist.name')
            ->get(['productlist.name', 'productlist.id']);

            if ($fromDate && $toDate) {
            $lastMileReport->whereBetween('orders.created_at', [$fromDate, $toDate]);
        }


        if (!$regionFilters) {
            $uniqueCities = client::distinct()->pluck('City')->toArray();
        }

        if ($regionFilters) {
            $lastMileReport->whereIn('clients.Region', $regionFilters);


            $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


            if ($cityFilters) {
                $lastMileReport->whereIn('clients.City', $cityFilters);
            }
        } elseif ($cityFilters) {
            $lastMileReport->whereIn('clients.City', $cityFilters);
        }


           $lastMileReport=$lastMileReport->groupBy(
                'ordered_products.order_id',
                'orders.client_id',
                'clients.user_id',
                'users.firstname',
                'users.middleName',
                'users.lastname',
                'clients.Region',
                'clients.City',
                'orders.created_at',
                 'orders.totalPrice'
            )
            ->get();
        }


        return view('ho.hoOrderCaptureTransaction', compact('lastMileReport', 'product', 'uniqueRegions', 'uniqueCities'));
    }

    public function orderfulfilment(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $regionFilters = $request->input('region_filter');
        $cityFilters = $request->input('city_filter');
        $user=auth()->user()->userType;

          if($user=="accion")
     {
       $regionFilters="";
        $uniqueRegions = "";
        $uniqueCities = [];




         $query = delivery1::join('delivery1_products', 'delivery1_products.delivery1_id', '=', 'delivery1s.id')
            ->join('products', 'products.id', '=', 'delivery1_products.product_id')
            ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
            ->join('orders', 'orders.id', '=', 'delivery1s.order_id')
            ->join('users', 'users.id', '=', 'orders.client_id')
            ->join('clients', 'users.id', '=', 'clients.user_id')
            ->where('users.id', '!=', '5393');




        $lastMileReport = DB::table('delivery1_products as dp')
        ->select(
            'ds.order_id',
            'o.totalPrice',
            'o.client_id',
            'c.user_id',
            'u.firstname',
            'u.middlename',
            'u.lastname',
            'c.Region',
            'c.City',
            'o.deliveryStatus',
            'dp.created_at',
             DB::raw('CASE WHEN o.deliveryStatus = "delivered" THEN o.updated_at ELSE NULL END AS deliveryDate'),
            DB::raw('GROUP_CONCAT(dp.product_id) AS product_ids'),
            DB::raw('
                GROUP_CONCAT(
                    CASE
                        WHEN dp.amount_status IS NULL OR dp.amount_status = "full" THEN dp.delivered_quantity
                        WHEN dp.amount_status = "partial" AND dp.partial_quantity IS NOT NULL THEN dp.partial_quantity
                        ELSE 0
                    END
                ) AS delivered_quantities
            '),
            DB::raw('
                GROUP_CONCAT(
                    CASE
                        WHEN dp.amount_status IS NULL OR dp.amount_status = "full" THEN dp.subTotal
                        WHEN dp.amount_status = "partial" AND dp.partial_quantity IS NOT NULL THEN dp.subTotal * dp.partial_quantity / dp.delivered_quantity
                        ELSE 0
                    END
                ) AS total_amounts
            '),
            DB::raw('
                GROUP_CONCAT(
                    products.productlist_id
                ) AS productlist_ids
            ')
        )
        ->join('delivery1s as ds', 'dp.delivery1_id', '=', 'ds.id')
        ->join('orders as o', 'ds.order_id', '=', 'o.id')
        ->join('clients as c', 'o.client_id', '=', 'c.id')
        ->join('users as u', 'c.user_id', '=', 'u.id')
        ->join('products', 'dp.product_id', '=', 'products.id') // Join with products table
        ->where('dp.delivered_quantity', '>', 0)
        ->where('c.Region','Gambella')

      ;





        $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
            ->join('clients', 'clients.user_id', '=', 'orders.client_id')
            ->join('products', 'products.id', '=', 'ordered_products.product_id')
            ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
            ->groupBy('productlist.id', 'productlist.name')
            ->where('clients.Region','Gambella')
            ->get(['productlist.name', 'productlist.id']);
            $uniqueCities=[];

            if ($fromDate && $toDate) {
            $lastMileReport->whereBetween('o.created_at', [$fromDate, $toDate]);
        }


        if (!$regionFilters) {
            $uniqueCities = client::distinct()->pluck('City')->toArray();
        }

        if ($regionFilters) {
            $lastMileReport->whereIn('c.Region', $regionFilters);


            $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


            if ($cityFilters) {
                $lastMileReport->whereIn('c.City', $cityFilters);
            }
        } elseif ($cityFilters) {
            $lastMileReport->whereIn('c.City', $cityFilters);
        }
        $lastMileReport=$lastMileReport->groupBy(
            'ds.order_id',
            'o.client_id',
            'c.user_id',
            'u.firstname',
            'u.middlename',
            'u.lastname',
            'c.Region',
            'c.City',
            'o.totalPrice',
            'dp.created_at',
            'o.deliveryStatus',
            'o.updated_at'
        )
        ->get();
     }
     else{
        $uniqueRegions = client::distinct()->pluck('Region')->toArray();
        $uniqueCities = [];

        $query = delivery1::join('delivery1_products', 'delivery1_products.delivery1_id', '=', 'delivery1s.id')
            ->join('products', 'products.id', '=', 'delivery1_products.product_id')
            ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
            ->join('orders', 'orders.id', '=', 'delivery1s.order_id')
            ->join('users', 'users.id', '=', 'orders.client_id')
            ->join('clients', 'users.id', '=', 'clients.user_id')
            ->where('users.id', '!=', '5393');


        $lastMileReport = DB::table('delivery1_products as dp')
        ->select(
            'ds.order_id',
            'o.totalPrice',
            'o.client_id',
            'c.user_id',
            'u.firstname',
            'u.middlename',
            'u.lastname',
            'c.Region',
            'c.City',
            'o.created_at',
            'o.deliveryStatus',
             DB::raw('CASE WHEN o.deliveryStatus = "delivered" THEN o.updated_at ELSE NULL END AS deliveryDate'),
            DB::raw('GROUP_CONCAT(dp.product_id) AS product_ids'),
            DB::raw('
                GROUP_CONCAT(
                    CASE
                        WHEN dp.amount_status IS NULL OR dp.amount_status = "full" THEN dp.delivered_quantity
                        WHEN dp.amount_status = "partial" AND dp.partial_quantity IS NOT NULL THEN dp.partial_quantity
                        ELSE 0
                    END
                ) AS delivered_quantities
            '),
            DB::raw('
                GROUP_CONCAT(
                    CASE
                        WHEN dp.amount_status IS NULL OR dp.amount_status = "full" THEN dp.subTotal
                        WHEN dp.amount_status = "partial" AND dp.partial_quantity IS NOT NULL THEN dp.subTotal * dp.partial_quantity / dp.delivered_quantity
                        ELSE 0
                    END
                ) AS total_amounts
            '),
            DB::raw('
                GROUP_CONCAT(
                    products.productlist_id
                ) AS productlist_ids
            ')
        )
        ->join('delivery1s as ds', 'dp.delivery1_id', '=', 'ds.id')
        ->join('orders as o', 'ds.order_id', '=', 'o.id')
        ->join('clients as c', 'o.client_id', '=', 'c.user_id')
        ->join('users as u', 'c.user_id', '=', 'u.id')
        ->join('products', 'dp.product_id', '=', 'products.id') // Join with products table
        ->where('dp.delivered_quantity', '>', 0);





        $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'ordered_products.product_id')
            ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
            ->groupBy('productlist.id', 'productlist.name')
            ->get(['productlist.name', 'productlist.id']);
            if ($fromDate && $toDate) {
            $lastMileReport->whereBetween('o.created_at', [$fromDate, $toDate]);
        }


        if (!$regionFilters) {
            $uniqueCities = client::distinct()->pluck('City')->toArray();
        }

        if ($regionFilters) {
            $lastMileReport->whereIn('c.Region', $regionFilters);


            $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


            if ($cityFilters) {
                $lastMileReport->whereIn('c.City', $cityFilters);
            }
        } elseif ($cityFilters) {
            $lastMileReport->whereIn('c.City', $cityFilters);
        }
         $lastMileReport=$lastMileReport->groupBy(
            'ds.order_id',
            'o.client_id',
            'c.user_id',
            'u.firstname',
            'u.middlename',
            'u.lastname',
            'c.Region',
            'c.City',
            'o.totalPrice',
            'o.created_at',
            'o.deliveryStatus',
            'o.updated_at'


        )
        ->get();
        }



        return view('ho.hoOrderFulfilment', compact('lastMileReport', 'product', 'uniqueRegions', 'uniqueCities'));
    }
    public function orderfulfilmenttransaction(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $regionFilters = $request->input('region_filter');
        $cityFilters = $request->input('city_filter');
        $user=auth()->user()->userType;

          if($user=="accion")
     {
       $regionFilters="";
        $uniqueRegions = "";

        $uniqueCities = [];


        $query = delivery1::join('delivery1_products', 'delivery1_products.delivery1_id', '=', 'delivery1s.id')
            ->join('products', 'products.id', '=', 'delivery1_products.product_id')
            ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
            ->join('orders', 'orders.id', '=', 'delivery1s.order_id')
            ->join('users', 'users.id', '=', 'orders.client_id')
            ->join('clients', 'users.id', '=', 'clients.user_id')
            ->where('users.id', '!=', '5393');



        $lastMileReport = DB::table('delivery1_products as dp')
        ->select(
            'ds.order_id',
            'o.client_id',
            'o.totalPrice',
            'c.user_id',
            'u.firstname',
            'u.middlename',
            'u.lastname',
            'c.Region',
            'c.City',
            'dp.created_at',
            'o.deliveryStatus',
            DB::raw('GROUP_CONCAT(dp.product_id) AS product_ids'),
            DB::raw('
                GROUP_CONCAT(
                    CASE
                        WHEN dp.amount_status IS NULL OR dp.amount_status = "full" THEN dp.delivered_quantity
                        WHEN dp.amount_status = "partial" AND dp.partial_quantity IS NOT NULL THEN dp.partial_quantity
                        ELSE 0
                    END
                ) AS delivered_quantities
            '),
            DB::raw('
                GROUP_CONCAT(
                    CASE
                        WHEN dp.amount_status IS NULL OR dp.amount_status = "full" THEN dp.subTotal
                        WHEN dp.amount_status = "partial" AND dp.partial_quantity IS NOT NULL THEN dp.subTotal * dp.partial_quantity / dp.delivered_quantity
                        ELSE 0
                    END
                ) AS total_amounts
            '),
            DB::raw('
                GROUP_CONCAT(
                    products.productlist_id
                ) AS productlist_ids
            ')
        )
        ->join('delivery1s as ds', 'dp.delivery1_id', '=', 'ds.id')
        ->join('orders as o', 'ds.order_id', '=', 'o.id')
        ->join('clients as c', 'o.client_id', '=', 'c.id')
        ->join('users as u', 'c.user_id', '=', 'u.id')
        ->join('products', 'dp.product_id', '=', 'products.id') // Join with products table
        ->where('dp.delivered_quantity', '>', 0)
        ->where('c.Region','Gambella');






        $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
            ->join('clients', 'clients.user_id', '=', 'orders.client_id')
            ->join('products', 'products.id', '=', 'ordered_products.product_id')
            ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
            ->groupBy('productlist.id', 'productlist.name')
            ->where('clients.Region','Gambella')
            ->get(['productlist.name', 'productlist.id']);
        $uniqueCities = [];
        if ($fromDate && $toDate) {
            $lastMileReport->whereBetween('o.created_at', [$fromDate, $toDate]);
        }


        if (!$regionFilters) {
            $uniqueCities = client::distinct()->pluck('City')->toArray();
        }

        if ($regionFilters) {
            $lastMileReport->whereIn('c.Region', $regionFilters);


            $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


            if ($cityFilters) {
                $lastMileReport->whereIn('c.City', $cityFilters);
            }
        } elseif ($cityFilters) {
            $lastMileReport->whereIn('c.City', $cityFilters);
        }
        $lastMileReport=$lastMileReport->groupBy(
            'ds.order_id',
            'o.client_id',
            'o.totalPrice',
            'c.user_id',
            'u.firstname',
            'u.middlename',
            'u.lastname',
            'c.Region',
            'c.City',
            'dp.created_at',
            'o.deliveryStatus'
        )
        ->get();

     }
     else
     {
             $uniqueRegions = client::distinct()->pluck('Region')->toArray();
        $uniqueCities = [];


        $query = delivery1::join('delivery1_products', 'delivery1_products.delivery1_id', '=', 'delivery1s.id')
            ->join('products', 'products.id', '=', 'delivery1_products.product_id')
            ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
            ->join('orders', 'orders.id', '=', 'delivery1s.order_id')
            ->join('users', 'users.id', '=', 'orders.client_id')
            ->join('clients', 'users.id', '=', 'clients.user_id')
            ->where('users.id', '!=', '5393');



        $lastMileReport = DB::table('delivery1_products as dp')
        ->select(
            'ds.order_id',
            'o.client_id',
            'o.totalPrice',
            'c.user_id',
            'u.firstname',
            'u.middlename',
            'u.lastname',
            'c.Region',
            'c.City',
            'dp.created_at',
            'o.deliveryStatus',
            DB::raw('GROUP_CONCAT(dp.product_id) AS product_ids'),
            DB::raw('
                GROUP_CONCAT(
                    CASE
                        WHEN dp.amount_status IS NULL OR dp.amount_status = "full" THEN dp.delivered_quantity
                        WHEN dp.amount_status = "partial" AND dp.partial_quantity IS NOT NULL THEN dp.partial_quantity
                        ELSE 0
                    END
                ) AS delivered_quantities
            '),
            DB::raw('
                GROUP_CONCAT(
                    CASE
                        WHEN dp.amount_status IS NULL OR dp.amount_status = "full" THEN dp.subTotal
                        WHEN dp.amount_status = "partial" AND dp.partial_quantity IS NOT NULL THEN dp.subTotal * dp.partial_quantity / dp.delivered_quantity
                        ELSE 0
                    END
                ) AS total_amounts
            '),
            DB::raw('
                GROUP_CONCAT(
                    products.productlist_id
                ) AS productlist_ids
            ')
        )
        ->join('delivery1s as ds', 'dp.delivery1_id', '=', 'ds.id')
        ->join('orders as o', 'ds.order_id', '=', 'o.id')
        ->join('clients as c', 'o.client_id', '=', 'c.id')
        ->join('users as u', 'c.user_id', '=', 'u.id')

        ->join('products', 'dp.product_id', '=', 'products.id') // Join with products table
        ->where('dp.delivered_quantity', '>', 0);






        $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'ordered_products.product_id')
            ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
            ->groupBy('productlist.id', 'productlist.name')
            ->get(['productlist.name', 'productlist.id']);

             if ($fromDate && $toDate) {
            $lastMileReport->whereBetween('o.created_at', [$fromDate, $toDate]);
        }


        if (!$regionFilters) {
            $uniqueCities = client::distinct()->pluck('City')->toArray();
        }

        if ($regionFilters) {
            $lastMileReport->whereIn('c.Region', $regionFilters);


            $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


            if ($cityFilters) {
                $lastMileReport->whereIn('c.City', $cityFilters);
            }
        } elseif ($cityFilters) {
            $lastMileReport->whereIn('c.City', $cityFilters);
        }
     }

       $lastMileReport=$lastMileReport->groupBy(
            'ds.order_id',
            'o.client_id',
            'o.totalPrice',
            'c.user_id',
            'u.firstname',
            'u.middlename',
            'u.lastname',
            'c.Region',
            'c.City',
            'dp.created_at',
            'o.deliveryStatus'
        )
        ->get();

        return view('ho.hoFulfilmentTransaction', compact('lastMileReport', 'product', 'uniqueRegions', 'uniqueCities'));
    }



     public function ordersummary(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $regionFilters = $request->input('region_filter');


            $uniqueRegions = client::distinct()->pluck('Region')->toArray();

            $query = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
                ->join('products', 'products.id', '=', 'ordered_products.product_id')
                ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
                ->join('users', 'users.id', '=', 'orders.client_id')
                ->join('clients', 'users.id', '=', 'clients.user_id')
                ->where('users.id', '!=', '5393');




            if ($fromDate && $toDate) {
                $query->whereBetween('orders.createdDate', [$fromDate, $toDate]);
            }

            if ($regionFilters) {
                $query->whereIn('clients.Region', $regionFilters);
            }


            $LastMileReport = $query
                ->groupBy('orders.createdDate', 'clients.City', 'clients.Region', 'productlist.name', 'users.firstName', 'users.middleName', 'users.lastName',
                    'ordered_products.ordered_quantity','productlist.id','ordered_products.subTotal')
                ->get(['orders.createdDate', 'clients.City', 'clients.Region', 'productlist.name', 'users.firstName', 'users.middleName', 'users.lastName',
                    'ordered_products.ordered_quantity','productlist.id','ordered_products.subTotal']);


            echo $LastMileReport;

            $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
                ->join('products', 'products.id', '=', 'ordered_products.product_id')
                ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
                ->groupBy('productlist.id', 'productlist.name')
                ->get(['productlist.name', 'productlist.id']);


              // return view('ho.ordersummary', compact('LastMileReport', 'product', 'uniqueRegions'));
           // return view('ho.hodeliveryReport', compact('LastMileReport', 'product', 'uniqueRegions'));
    }

 public function hoorderReport(Request $request)
    {
           $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $user=auth()->user()->userType;
        if ($fromDate && $toDate)
         {
         $LastMileReport = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('agents','agents.user_id','=','clients.agent_id')
        ->distinct()
        ->where('users.id','!=','5393')
        ->whereBetween('orders.created_at', [$fromDate, $toDate])
        ->get(['orders.id','orders.deliveryStatus','orders.created_at','orders.createdBy','orders.confirmStatus','orders.client_id','orders.KD_id','clients.agent_id'
              ,'orders.rom_order_confirmation','orders.rom_adjusted_confirmation','orders.tm_confirmation','agents.rom_id','clients.City','clients.Region']);
         }
         else
         {
              $LastMileReport = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('agents','agents.user_id','=','clients.agent_id')
        ->distinct()
        ->where('users.id','!=','5393')
        ->get(['orders.id','orders.deliveryStatus','orders.created_at','orders.createdBy','orders.confirmStatus','orders.client_id','orders.KD_id','clients.agent_id'
              ,'orders.rom_order_confirmation','orders.rom_adjusted_confirmation','orders.tm_confirmation','agents.rom_id','clients.City','clients.Region']);

         }
         if($user=="HO")
         {
              return view('ho.hoorderReport',compact('LastMileReport'));
         }
         else if($user=="admin")
         {
              return view('admin.orderReport',compact('LastMileReport'));
         }
    }
     public function accionorderReport(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        if ($fromDate && $toDate)
         {
         $LastMileReport =  order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('agents','agents.user_id','=','clients.agent_id')
        ->where('clients.Region','=','Gambella')
        ->distinct()
        ->whereBetween('orders.createdDate', [$fromDate, $toDate])
       ->get(['orders.id','orders.deliveryStatus','orders.createdDate','orders.createdBy','orders.confirmStatus','orders.client_id','orders.KD_id','clients.agent_id'
              ,'orders.rom_order_confirmation','orders.rom_adjusted_confirmation','orders.tm_confirmation','agents.rom_id','clients.City','clients.Region']);

            }
            else {
         $LastMileReport = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('agents','agents.user_id','=','clients.agent_id')
        ->where('clients.Region','=','Gambella')
        ->distinct()
        ->get(['orders.id','orders.deliveryStatus','orders.createdDate','orders.createdBy','orders.confirmStatus','orders.client_id','orders.KD_id','clients.agent_id'
              ,'orders.rom_order_confirmation','orders.rom_adjusted_confirmation','orders.tm_confirmation','agents.rom_id','clients.City','clients.Region']);
            }
              return view('accion.accionorderReport',compact('LastMileReport'));
    }
     public function test(Request $request)
    {
 if (isset($request->search['value'])) {
            $search = $request->search['value'];
        } else {
            $search = 'undefined';
        }

        if (isset($request->length)) {
            $limit = $request->length;
        } else {
            $limit = 10;
        }

        if (isset($request->start))
        {
            $ofset = $request->start;
        }
        else
         {
            $ofset = 0;
         }
      //  $id = Auth::guard('parents')->id();
        $total = 0;
        $services = User::select('users.first_name','users.middle_name','users.last_name',
       )

        ->where(function ($query) use ($search)
         {
            $query->orWhere('first_name', 'like',$search );
          })
            ->get();
        $i = 1 + $ofset;
        $data = [];
        $data_checkup = [];

        foreach ($services as $service) {

           // $userprofile = '<a href="' . url('parent/studenthistory/form/' . base64_encode($service->id)) . '" class="btn btn-info  badge-info "><i class="fa fa-file"></i></a>';
            $data[] = array(
                $i++,
                $service->first_name ,
                $service->middle_name ,
                $service->last_name,
                // $service->school_name,
                // $service->date,
               // $userprofile
            );
        }

        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] =  $total;
        $records['data'] = $data;

        echo json_encode($records);

    }
public function officerorderReport()
    {
         $LastMileReport = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('agents','agents.user_id','=','clients.agent_id')
        ->distinct()
        ->get(['orders.id','orders.deliveryStatus','orders.created_at','orders.createdBy','orders.confirmStatus','orders.client_id','orders.KD_id','clients.agent_id'
              ,'orders.rom_order_confirmation','orders.rom_adjusted_confirmation','orders.tm_confirmation','agents.rom_id']);
        return view('officer.officerorderReport',compact('LastMileReport'));
    }
    public function adminLastmileReport()
    {
         $LastMileReport = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('delivery3s','delivery3s.order_id','orders.id')
        ->get(['orders.id','orders.deliveryStatus','orders.created_at','delivery3s.createdAt','users.firstName','users.middleName','users.lastName','delivery3s.rsp_id']);
        return view('admin.adminLastMileReport',compact('LastMileReport'));
    }
    public function officerLastmileReport()
    {
         $LastMileReport = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('delivery1s','delivery1s.order_id','orders.id')
        ->distinct()
        ->get(['orders.id','orders.deliveryStatus','orders.created_at','orders.client_id','delivery1s.kd_id','delivery1s.rom_id','clients.agent_id']);
        return view('officer.officerLastMileReport',compact('LastMileReport'));
    }
         public function hoLastmileReport(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
         $user=auth()->user()->userType;

        if ($fromDate && $toDate)
         {
         $LastMileReport = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('delivery1s','delivery1s.order_id','orders.id')
        ->distinct()
        ->where('users.id','!=','5393')
        ->whereBetween('orders.created_at', [$fromDate, $toDate])
        ->get(['orders.id','orders.deliveryStatus','orders.created_at','orders.client_id','delivery1s.kd_id','delivery1s.rom_id','clients.agent_id','clients.City','clients.Region']);
         }
         else
         {
            $LastMileReport = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('delivery1s','delivery1s.order_id','orders.id')
        ->distinct()
        ->where('users.id','!=','5393')
        ->get(['orders.id','orders.deliveryStatus','orders.created_at','orders.client_id','delivery1s.kd_id','delivery1s.rom_id','clients.agent_id','clients.City','clients.Region']);

         }
         if($user=="HO")
         {
              return view('ho.hoLastMileReport',compact('LastMileReport'));
         }
         else if($user=="admin")
         {
              return view('admin.LastMileReport',compact('LastMileReport'));
         }

    }
      public function accionLastmileReport(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        if ($fromDate && $toDate)
         {
         $LastMileReport = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('delivery1s','delivery1s.order_id','orders.id')
        ->where('clients.Region','=','Gambella')
        ->distinct()
        ->whereBetween('orders.createdDate', [$fromDate, $toDate])
       ->get(['orders.id','orders.deliveryStatus','orders.createdDate','orders.client_id','delivery1s.kd_id','delivery1s.rom_id','clients.agent_id','clients.City','clients.Region']);
        }
        else
        {
         $LastMileReport = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('delivery1s','delivery1s.order_id','orders.id')
        ->where('clients.Region','=','Gambella')
        ->distinct()
        ->get(['orders.id','orders.deliveryStatus','orders.createdDate','orders.client_id','delivery1s.kd_id','delivery1s.rom_id','clients.agent_id','clients.City','clients.Region']);
        }
        return view('accion.accionLastMileReport',compact('LastMileReport'));
    }

    public function adminKDOrderConformationReport()
    {
        $orderConformation = order::join('users','users.id','=','orders.KD_id')
        ->join('key_distros','key_distros.user_id','=','orders.KD_id')
        ->get(['orders.id','orders.confirmStatus','orders.created_at','users.firstName','users.middleName','users.lastName','orders.client_id']);
        return view('admin.adminKDOrderConformationReport',compact('orderConformation'));
    }


    public function orderCaptureReport(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $regionFilters = $request->input('region_filter');
        $cityFilters = $request->input('city_filter');

        $uniqueRegions = client::distinct()->pluck('Region')->toArray();
        $uniqueCities = [];


        // $query = delivery1::join('delivery1_products', 'delivery1_products.delivery1_id', '=', 'delivery1s.id')
        //     ->join('products', 'products.id', '=', 'delivery1_products.product_id')
        //     ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
        //     ->join('orders', 'orders.id', '=', 'delivery1s.order_id')
        //     ->join('users', 'users.id', '=', 'orders.client_id')
        //     ->join('clients', 'users.id', '=', 'clients.user_id')
        //     ->where('users.id', '!=', '5393');


        $lastMileReport = OrderedProducts::select(
            'ordered_products.order_id as orderedId',
            'orders.client_id',
            'orders.totalPrice as totalPrice',
            'orders.rom_id as romId',
            'clients.user_id',
            'users.firstname as firstname',
            'users.lastname as lastname',
            'users.middleName as middleName',
            'clients.Region',
            'clients.City',
            'orders.created_at as created_at',
            DB::raw('GROUP_CONCAT(products.productlist_id ) AS product_ids'),
            DB::raw('GROUP_CONCAT(ordered_products.ordered_quantity ORDER BY ordered_products.id) AS ordered_quantities'),
            DB::raw('GROUP_CONCAT(ordered_products.subTotal ) AS subTotal')


        )
            ->join('orders', 'ordered_products.order_id', '=', 'orders.id')
            ->join('clients', 'orders.client_id', '=', 'clients.user_id')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->join('products', 'ordered_products.product_id', '=', 'products.id')
            ->where('orders.rom_id', Auth::id());


        $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'ordered_products.product_id')
            ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
            ->groupBy('productlist.id', 'productlist.name')
            ->get(['productlist.name', 'productlist.id']);

            if ($fromDate && $toDate) {
            $lastMileReport->whereBetween('orders.created_at', [$fromDate, $toDate]);
        }


        if (!$regionFilters) {
            $uniqueCities = client::distinct()->pluck('City')->toArray();
        }

        if ($regionFilters) {
            $lastMileReport->whereIn('clients.Region', $regionFilters);


            $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


            if ($cityFilters) {
                $lastMileReport->whereIn('clients.City', $cityFilters);
            }
        }
        elseif ($cityFilters) {
            $lastMileReport->whereIn('clients.City', $cityFilters);
        }
         $lastMileReport = $lastMileReport
                ->groupBy(
                'ordered_products.order_id',
                'orders.totalPrice',
                'orders.client_id',
                'orders.rom_id',
                'clients.user_id',
                'users.firstname',
                'users.middleName',
                'users.lastname',
                'clients.Region',
                'clients.City',
                'orders.created_at'
            )
            ->get();

        return view('ROM.romOrderCaptureReport', compact('lastMileReport', 'product', 'uniqueRegions', 'uniqueCities'));
    }
    public function romordercapturetransaction(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $regionFilters = $request->input('region_filter');
        $cityFilters = $request->input('city_filter');

        $uniqueRegions = client::distinct()->pluck('Region')->toArray();
        $uniqueCities = [];

        // $query = delivery1::join('delivery1_products', 'delivery1_products.delivery1_id', '=', 'delivery1s.id')
        //     ->join('products', 'products.id', '=', 'delivery1_products.product_id')
        //     ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
        //     ->join('orders', 'orders.id', '=', 'delivery1s.order_id')
        //     ->join('users', 'users.id', '=', 'orders.client_id')
        //     ->join('clients', 'users.id', '=', 'clients.user_id')
        //     ->where('users.id', '!=', '5393');


        $lastMileReport = OrderedProducts::select(
            'ordered_products.order_id as orderedId',
            'orders.client_id',
            'orders.totalPrice as totalPrice',
            'clients.user_id',
            'users.firstname as firstname',
            'users.lastname as lastname',
            'users.middleName as middleName',
            'clients.Region',
            'clients.City',
            'orders.created_at as created_at',
            DB::raw('GROUP_CONCAT(products.productlist_id ) AS product_ids'),
            DB::raw('GROUP_CONCAT(ordered_products.subTotal ORDER BY ordered_products.id) AS ordered_quantities'),

            DB::raw('GROUP_CONCAT(ordered_products.subTotal ) AS subTotal')


        )
            ->join('orders', 'ordered_products.order_id', '=', 'orders.id')
            ->join('clients', 'orders.client_id', '=', 'clients.user_id')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->join('products', 'ordered_products.product_id', '=', 'products.id')
            ->where('orders.rom_id', Auth::id())
            ;

        $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'ordered_products.product_id')
            ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
            ->groupBy('productlist.id', 'productlist.name')
            ->get(['productlist.name', 'productlist.id']);

            if ($fromDate && $toDate) {
            $lastMileReport->whereBetween('orders.created_at', [$fromDate, $toDate]);
        }


        if (!$regionFilters) {
            $uniqueCities = client::distinct()->pluck('City')->toArray();
        }

        if ($regionFilters) {
            $lastMileReport->whereIn('clients.Region', $regionFilters);


            $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


            if ($cityFilters) {
                $lastMileReport->whereIn('clients.City', $cityFilters);
            }
        } elseif ($cityFilters) {
            $lastMileReport->whereIn('clients.City', $cityFilters);
        }

          $lastMileReport=$lastMileReport->groupBy(
                'ordered_products.order_id',
                'orders.client_id',
                'orders.totalPrice',
                'clients.user_id',
                'users.firstname',
                'users.middleName',
                'users.lastname',
                'clients.Region',
                'clients.City',
                'orders.created_at'
            )
            ->get();

        return view('ROM.romOrderCaptureTransaction', compact('lastMileReport', 'product', 'uniqueRegions', 'uniqueCities'));
    }

    public function romorderfulfilment(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $regionFilters = $request->input('region_filter');
        $cityFilters = $request->input('city_filter');

        $uniqueRegions = client::distinct()->pluck('Region')->toArray();
        $uniqueCities = [];

        // $query = delivery1::join('delivery1_products', 'delivery1_products.delivery1_id', '=', 'delivery1s.id')
        //     ->join('products', 'products.id', '=', 'delivery1_products.product_id')
        //     ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
        //     ->join('orders', 'orders.id', '=', 'delivery1s.order_id')
        //     ->join('users', 'users.id', '=', 'orders.client_id')
        //     ->join('clients', 'users.id', '=', 'clients.user_id')
        //     ->where('users.id', '!=', '5393');



        $lastMileReport = DB::table('delivery1_products as dp')
        ->select(
            'ds.order_id',
            'ds.deliveryTotalPrice as totalPrice',
            'o.client_id',
            'c.user_id',
            'u.firstname',
            'u.middlename',
            'u.lastname',
            'c.Region',
            'c.City',
            'dp.created_at',
            DB::raw('GROUP_CONCAT(dp.product_id) AS product_ids'),
            DB::raw('
                GROUP_CONCAT(
                    CASE
                        WHEN dp.amount_status IS NULL OR dp.amount_status = "full" THEN dp.delivered_quantity
                        WHEN dp.amount_status = "partial" AND dp.partial_quantity IS NOT NULL THEN dp.partial_quantity
                        ELSE 0
                    END
                ) AS delivered_quantities
            '),
            DB::raw('
                GROUP_CONCAT(
                    CASE
                        WHEN dp.amount_status IS NULL OR dp.amount_status = "full" THEN dp.subTotal
                        WHEN dp.amount_status = "partial" AND dp.partial_quantity IS NOT NULL THEN dp.subTotal * dp.partial_quantity / dp.delivered_quantity
                        ELSE 0
                    END
                ) AS total_amounts
            '),
            DB::raw('
                GROUP_CONCAT(
                    products.productlist_id
                ) AS productlist_ids
            ')
        )
        ->join('delivery1s as ds', 'dp.delivery1_id', '=', 'ds.id')
        ->join('orders as o', 'ds.order_id', '=', 'o.id')
        ->join('clients as c', 'o.client_id', '=', 'c.id')
        ->join('users as u', 'c.user_id', '=', 'u.id')
        ->join('products', 'dp.product_id', '=', 'products.id') // Join with products table
        ->where('dp.delivered_quantity', '>', 0)
        ->where('ds.rom_id', Auth::id())
        ;





        $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'ordered_products.product_id')
            ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
            ->groupBy('productlist.id', 'productlist.name')
            ->get(['productlist.name', 'productlist.id']);

            if ($fromDate && $toDate) {
            $lastMileReport->whereBetween('o.created_at', [$fromDate, $toDate]);
        }


        if (!$regionFilters) {
            $uniqueCities = client::distinct()->pluck('City')->toArray();
        }

        if ($regionFilters) {
            $lastMileReport->whereIn('c.Region', $regionFilters);


            $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


            if ($cityFilters) {
                $lastMileReport->whereIn('c.City', $cityFilters);
            }
        } elseif ($cityFilters) {
            $lastMileReport->whereIn('c.City', $cityFilters);
        }

         $lastMileReport=$lastMileReport->groupBy(
            'ds.order_id',
            'ds.deliveryTotalPrice',
            'ds.rom_id',
            'o.client_id',
            'c.user_id',
            'u.firstname',
            'u.middlename',
            'u.lastname',
            'c.Region',
            'c.City',
            'dp.created_at'
        )
        ->get();
        return view('ROM.romOrderFulfilment', compact('lastMileReport', 'product', 'uniqueRegions', 'uniqueCities'));
    }

    public function romorderfulfilmenttransaction(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $regionFilters = $request->input('region_filter');
        $cityFilters = $request->input('city_filter');

        $uniqueRegions = client::distinct()->pluck('Region')->toArray();
        $uniqueCities = [];

        // $query = delivery1::join('delivery1_products', 'delivery1_products.delivery1_id', '=', 'delivery1s.id')
        //     ->join('products', 'products.id', '=', 'delivery1_products.product_id')
        //     ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
        //     ->join('orders', 'orders.id', '=', 'delivery1s.order_id')
        //     ->join('users', 'users.id', '=', 'orders.client_id')
        //     ->join('clients', 'users.id', '=', 'clients.user_id')
        //     ->where('users.id', '!=', '5393');


        $lastMileReport = DB::table('delivery1_products as dp')
        ->select(
            'ds.order_id',
            'ds.deliveryTotalPrice as totalPrice',
            'o.client_id',
            'c.user_id',
            'u.firstname',
            'u.middlename',
            'u.lastname',
            'c.Region',
            'c.City',
            'dp.created_at',
            DB::raw('GROUP_CONCAT(dp.product_id) AS product_ids'),
            DB::raw('
                GROUP_CONCAT(
                    CASE
                        WHEN dp.amount_status IS NULL OR dp.amount_status = "full" THEN dp.delivered_quantity
                        WHEN dp.amount_status = "partial" AND dp.partial_quantity IS NOT NULL THEN dp.partial_quantity
                        ELSE 0
                    END
                ) AS delivered_quantities
            '),
            DB::raw('
                GROUP_CONCAT(
                    CASE
                        WHEN dp.amount_status IS NULL OR dp.amount_status = "full" THEN dp.subTotal
                        WHEN dp.amount_status = "partial" AND dp.partial_quantity IS NOT NULL THEN dp.subTotal * dp.partial_quantity / dp.delivered_quantity
                        ELSE 0
                    END
                ) AS total_amounts
            '),
            DB::raw('
                GROUP_CONCAT(
                    products.productlist_id
                ) AS productlist_ids
            ')
        )
        ->join('delivery1s as ds', 'dp.delivery1_id', '=', 'ds.id')
        ->join('orders as o', 'ds.order_id', '=', 'o.id')
        ->join('clients as c', 'o.client_id', '=', 'c.id')
        ->join('users as u', 'c.user_id', '=', 'u.id')
        ->join('products', 'dp.product_id', '=', 'products.id') // Join with products table
        ->where('dp.delivered_quantity', '>', 0)
        ->where('ds.rom_id', Auth::id())
       ;






        $product = order::join('ordered_products', 'ordered_products.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'ordered_products.product_id')
            ->join('productlist', 'productlist.id', '=', 'products.productlist_id')
            ->groupBy('productlist.id', 'productlist.name')
            ->get(['productlist.name', 'productlist.id']);


              if ($fromDate && $toDate) {
            $lastMileReport->whereBetween('o.created_at', [$fromDate, $toDate]);
        }


        if (!$regionFilters) {
            $uniqueCities = client::distinct()->pluck('City')->toArray();
        }

        if ($regionFilters) {
            $lastMileReport->whereIn('c.Region', $regionFilters);


            $uniqueCities = client::whereIn('Region', $regionFilters)->distinct()->pluck('City')->toArray();


            if ($cityFilters) {
                $lastMileReport->whereIn('c.City', $cityFilters);
            }
        } elseif ($cityFilters) {
            $lastMileReport->whereIn('c.City', $cityFilters);
        }

       $lastMileReport=$lastMileReport ->groupBy(
            'ds.order_id',
            'ds.deliveryTotalPrice',
            'o.client_id',
            'c.user_id',
            'ds.rom_id',
            'u.firstname',
            'u.middlename',
            'u.lastname',
            'c.Region',
            'c.City',
            'dp.created_at'
        )
        ->get();


        return view('ROM.romFulfilmentTransaction', compact('lastMileReport', 'product', 'uniqueRegions', 'uniqueCities'));
    }
    public function holoanReport(Request  $request)
    {

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $regionFilters = $request->input('region_filter');
        $cityFilters = $request->input('city_filter');
        if ($fromDate && $toDate)
         {
         $loan = Loans::join('users','users.id','=','loans.client_id')
        ->join('clients','clients.user_id','=','loans.client_id')
        ->distinct()
        ->where('users.id','!=','5393')
        ->whereBetween('loans.created_at', [$fromDate, $toDate])
        ->get(['loans.*','clients.agent_id','clients.City','clients.Region','users.firstName','users.middleName'
        ,'users.lastName']);
         }
         else
         {
            $loan = Loans::join('users','users.id','=','loans.client_id')
        ->join('clients','clients.user_id','=','loans.client_id')
        ->distinct()
        ->where('users.id','!=','5393')
        ->get(['loans.*','clients.agent_id','clients.City','clients.Region','users.firstName','users.middleName'
        ,'users.lastName']);
         }

              return view('admin.LoanReport',compact('loan'));

    }



}
