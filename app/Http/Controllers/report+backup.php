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
        $handover = delivery2::join('users','users.id','=','delivery2s.rsp_id')
        ->join('rsps','rsps.user_id','=','delivery2s.rsp_id')
        ->leftjoin('orders','delivery2s.order_id','=','orders.id')
        ->where('delivery2s.rom_id', Auth::id())
        ->get('delivery2s.*');

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
 public function analyistonboardingReport()
    {


         $users = User::select('users.id','users.created_at','clients.client_unique_id','clients.Training_module1','clients.Training_module2',
         'clients.age','clients.Nationality','clients.Region','clients.City','clients.camp',
         'clients.Training_module3',DB::raw('CONCAT(users.firstName," ",users.middleName," ",users.lastName) AS full_name'))
        ->join('clients','clients.user_id','=','users.id')
        ->get();

        return view('analyist.onboardingreport',compact('users'));
    }
 public function hoorderReport()
    {
         $LastMileReport = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('agents','agents.user_id','=','clients.agent_id')
        ->distinct()
        ->get(['orders.id','orders.deliveryStatus','orders.created_at','orders.createdBy','orders.confirmStatus','orders.client_id','orders.KD_id','clients.agent_id'
              ,'orders.rom_order_confirmation','orders.rom_adjusted_confirmation','orders.tm_confirmation','agents.rom_id','clients.City','clients.Region']);
        return view('ho.hoorderReport',compact('LastMileReport'));
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
         public function hoLastmileReport()
    {
         $LastMileReport = order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->join('delivery1s','delivery1s.order_id','orders.id')
        ->distinct()
        ->get(['orders.id','orders.deliveryStatus','orders.created_at','orders.client_id','delivery1s.kd_id','delivery1s.rom_id','clients.agent_id','clients.City','clients.Region']);
        return view('ho.hoLastMileReport',compact('LastMileReport'));
    }

    public function adminKDOrderConformationReport()
    {
        $orderConformation = order::join('users','users.id','=','orders.KD_id')
        ->join('key_distros','key_distros.user_id','=','orders.KD_id')
        ->get(['orders.id','orders.confirmStatus','orders.created_at','users.firstName','users.middleName','users.lastName','orders.client_id']);
        return view('admin.adminKDOrderConformationReport',compact('orderConformation'));
    }
}
