<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;

class QrController extends Controller
{
    public function generate(Request $request)
    {
        $data = $request->input('data');

        // Generate the QR code
        $qrCode = new QrCode($data);

        // Return the QR code image to the view
        return response($qrCode->writeString(), 200, [
            'Content-Type' => $qrCode->getContentType(),
        ]);
    }
}
