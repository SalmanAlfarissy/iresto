<?php

namespace App\Services\Payment;
use Midtrans\Snap;
use Midtrans\Config;
use App\Services\ContractPayment;

class MidtransPaymentGateway implements ContractPayment
{
    public function payment($request)
    {
        // Set your Merchant Server Key
        Config::$serverKey = "SB-Mid-server-GTeziv9mbxep5iSDO_vLIn5p";
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $request['gross_amount'],
            ),
            'customer_details' => array(
                'first_name' => $request['customer_details']['firstname'],
                'last_name' => $request['customer_details']['lastname'],
                'email' => $request['customer_details']['email'],
                'phone' => $request['customer_details']['phonenumber'],
                'address' => $request['customer_details']['address'],
            ),
            'item_details'=> array(
                $request['item_details'],
            ),

        );

        $snapToken = Snap::getSnapToken($params);
        return $snapToken;
    }
}
