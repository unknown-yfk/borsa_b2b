<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderedProducts;
use App\Models\user;
use App\Models\client;
use App\Models\rsp;
use App\Models\delivery2;
use App\Models\order;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class delivery3Controller extends Controller
{
    public function deliveryToClient(Request $request)
    {
        $id = $request->delivery2_id;
        $deliverdOrder = delivery2::find($id);
        $user_id = Auth::id();
        $order_id = $deliverdOrder->order_id;
        $order = order::find($order_id);
        $client_id = $order->client_id;
        return view('RSP.qr_scanner',compact('client_id'));
    }
    public function deliveryToClientStore(Request $request)
    {

    }
}
