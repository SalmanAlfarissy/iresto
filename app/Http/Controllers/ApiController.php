<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Env;

class ApiController extends Controller
{
    public function paymentHandler(Request $request)
    {
        $json = json_decode($request->getContent());
        $signature_key = hash('sha512', $json->order_id . $json->status_code . $json->gross_amount . env('MIDTRANS_SERVER_KEY'));
        if ($signature_key != $json->signature_key) {
            return abort(404);
        }
        $transaction = Transaction::where('order_id',$json->order_id)->first();
        $transaction->update(['transaction_status'=>$json->transaction_status]);
        return $transaction;
    }
}
