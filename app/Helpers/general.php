<?php

namespace App\Helpers;

use App\Models\rsp;
use App\Models\rom;
use App\Models\agent;
use App\Models\key_distro;
use App\Models\users;
use App\Models\client;
use App\Models\ProductCatagory;
use App\Models\ProductType;

class general {
    public static function get_rsp_name($id)
    {
        $rsp = rsp::join('users','users.id','=','rsps.user_id')
        ->where('rsps.user_id',$id)->value('firstName');
        $rsp1 = rsp::join('users','users.id','=','rsps.user_id')
        ->where('rsps.user_id',$id)->value('middleName');
        $rsp2 = rsp::join('users','users.id','=','rsps.user_id')
        ->where('rsps.user_id',$id)->value('lastName');
        $RSP = $rsp . ' ' . $rsp1 . ' ' .$rsp2;
        return $RSP;
    }
     public static function get_rom_name($id)
    {
        $rsp = rom::join('users','users.id','=','roms.user_id')
        ->where('roms.user_id',$id)->value('firstName');
        $rsp1 = rom::join('users','users.id','=','roms.user_id')
        ->where('roms.user_id',$id)->value('middleName');
        $rsp2 = rom::join('users','users.id','=','roms.user_id')
        ->where('roms.user_id',$id)->value('lastName');
        $RSP = $rsp . ' ' . $rsp1 . ' ' .$rsp2;
        return $RSP;
    }
      public static function get_agent_name($id)
    {
        $rsp = agent::join('users','users.id','=','agents.user_id')
        ->where('agents.user_id',$id)->value('firstName');
        $rsp1 = agent::join('users','users.id','=','agents.user_id')
        ->where('agents.user_id',$id)->value('middleName');
        $rsp2 = agent::join('users','users.id','=','agents.user_id')
        ->where('agents.user_id',$id)->value('lastName');
        $RSP = $rsp . ' ' . $rsp1 . ' ' .$rsp2;
        return $RSP;
    }
    public static function get_kd_name($id)
    {
        $kd = key_distro::join('users','users.id','=','key_distros.user_id')
        ->where('key_distros.user_id',$id)->value('firstName');
        $kd1 = key_distro::join('users','users.id','=','key_distros.user_id')
        ->where('key_distros.user_id',$id)->value('middleName');
        $kd2 = key_distro::join('users','users.id','=','key_distros.user_id')
        ->where('key_distros.user_id',$id)->value('lastName');
        $KD = $kd . ' ' . $kd1 . ' ' .$kd2;
        return $KD;
    }
    public static function get_client_name($id)
    {
        $client = client::join('users','users.id','=','clients.user_id')
        ->where('clients.user_id',$id)->value('firstName');
        $client1 = client::join('users','users.id','=','clients.user_id')
        ->where('clients.user_id',$id)->value('middleName');
        $client2 = client::join('users','users.id','=','clients.user_id')
        ->where('clients.user_id',$id)->value('lastName');
        $Client = $client . ' ' . $client1 . ' ' .$client2;
        return $Client;

    }
      public static function get_name($id)
    {
        $client = users::where('id',$id)->value('firstName');
        $client1 = users::where('id',$id)->value('middleName');
        $client2 = users::where('id',$id)->value('lastName');
        $Client = $client . ' ' . $client1 . ' ' .$client2;
        return $Client;

    }
    public static function get_CategoryName($id)
    {
        $categoryName = ProductCatagory::where('id',$id)->value('catagoryName');
        return $categoryName;
    }

    public static function get_ProductType($id)
    {
        $productTypeName = ProductType::where('id',$id)->value('productTypeName');
        return $productTypeName;
    }


     public static function IDGenerator($model, $trow, $length = 4, $prefix){
         $data = $model::orderBy('id','desc')->first();
        if(!$data){
            $og_length = $length;
            $last_number = '';
        }else{
            $code = substr($data->$trow, strlen($prefix)+1);
            $actial_last_number = ((int)$code/1)*1;
            $increment_last_number = ((int)$actial_last_number)+1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for($i=0;$i<$og_length;$i++){
            $zeros.="0";
        }

           return $prefix.$zeros.$last_number;



}
public static function IDGenerator_client($model, $trow, $length = 4, $prefix,$data){


        if(!$data){
            $og_length = $length;
            $last_number = '';
        }else{
            $code = substr($data->$trow, strlen($prefix)+1);

            $actial_last_number = ((int)$code/1)*1;
            $increment_last_number = ((int)$actial_last_number)+1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for($i=0;$i<$og_length;$i++){
            $zeros.="0";
        }

//  dd($prefix.$zeros.$last_number);
           return $prefix.$zeros.$last_number;


    }
}
