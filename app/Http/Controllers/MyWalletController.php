<?php

namespace App\Http\Controllers;

use App\Models\Debet;
use App\Models\Kredit;
use Illuminate\Http\Request;
use App\Services\ContractPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MyWalletController extends Controller
{
    protected $payment;

    public function __construct(ContractPayment $payment)
    {
        $this->payment = $payment;
    }

    public function index()
    {
        $user = Auth::user();
        $kredit = Kredit::with('dataUser')->where('user_id',$user->id)->sum('amount');
        $debet = Debet::with('dataUser')->where('user_id',$user->id)->sum('amount');
        $saldo = $kredit - $debet;
        $kredit = $this->rupiah($kredit);
        $debet = $this->rupiah($debet);
        $saldo = $this->rupiah($saldo);
        return view('mywallet.index', [
            'user'=>$user,
            'saldo'=>$saldo,
            'kredit'=>$kredit,
            'debet'=>$debet
        ]);
    }
    public function payment(Request $request)
    {
        $request->validate([
            'gross_amount'=>'required|numeric'
        ]);
        $user = Auth::user();
        $request['customer_details'] = $user;
        $request['item_details'] = [
            "id"=>"t01",
            'name'=>'TopUp Saldo',
            'quantity'=>1,
            'price'=>$request->gross_amount,
        ];
        $data = $this->payment->payment($request);
        return $this->result('TopUp Success!!', $data, true);
    }
}
