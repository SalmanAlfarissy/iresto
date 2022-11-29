<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Http\Request;

class MyWalletController extends Controller
{
    public function index()
    {
        return view('mywallet.index');
    }
    public function payment(Request $request)
    {
        // Set your Merchant Server Key
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phonenumber,
            ),
            'item_detail'=> array(
                [
                    "id" => "a01",
                    "price" => 7000,
                    "quantity" => 1,
                    "name" => "Apple"
                ],
                [
                    "id" => "b02",
                    "price" => 3000,
                    "quantity" => 2,
                    "name" => "Orange"
                ]
            ),

        );
        // return $params;

        $snapToken = Snap::getSnapToken($params);
        return view('welcome',['snapToken'=>$snapToken]);
    }

    public function dataTransaksi(Request $request)
    {
        $trans = new Transaction();
        $trans->transaction_id = $request->json['transaction_id'];
        $trans->order_id = $request->json['order_id'];
        $trans->gross_amount = $request->json['gross_amount'];
        $trans->payment_type = $request->json['payment_type'];
        $trans->transaction_status = $request->json['transaction_status'];
        $trans->payment_code = $request->json['payment_code'] ?? null;
        $trans->pdf_url = $request->json['pdf_url'] ?? null;
        $trans->save();
        return response()->json([
            'dataTransaksi'=>$trans,
            'newToken'=>csrf_token(),
            'message'=>'add data success!!'
        ]);
    }
}
