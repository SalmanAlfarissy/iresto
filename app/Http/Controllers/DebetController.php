<?php

namespace App\Http\Controllers;

use App\Models\Debet;
use App\Models\Kredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\ContractRepository;

class DebetController extends Controller
{
    protected $repository;

    public function __construct(ContractRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(Request $request)
    {
        $request->validate([
            'bank'=>'required',
            'norek'=>'required',
            'gross_amount'=>'required|numeric',
        ]);

        $user = Auth::user();
        $kredit = Kredit::where('user_id', $user->id)->sum('amount');
        $debet = Debet::where('user_id', $user->id)->sum('amount');
        $saldo = $kredit - $debet;

        if ($request->gross_amount > $saldo ) {
            return $this->result('Your balance is insufficient!');
        }

        $request['customer_details'] = $user;
        $request['item_details'] = [
            "id"=>"t02",
            'name'=>'Transfer Saldo',
        ];
        $request['dataTrans'] = [
            "transaction_time" => "2020-01-09 18:27:19",
            "transaction_status" => "settlement",
            "transaction_id" => Hash::make(rand()),
            "status_code" => "200",
            "payment_type" => "irestopay",
            "order_id" => rand(),
            "gross_amount" => $request->gross_amount,
            "fraud_status" => "accept",
            "currency" => "IDR",
            "bank" => $request->bank,
            "rekening_number" => $request->norek
        ];

        $data = $this->repository->create($request);
        return $this->result('Transfer saldo success!!', $data, true);
    }


}
