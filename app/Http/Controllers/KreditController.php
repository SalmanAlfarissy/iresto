<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ContractRepository;

class KreditController extends Controller
{
    protected $repository;

    public function __construct(ContractRepository $repository)
    {
        $this->repository = $repository;
    }
    public function create(Request $request)
    {
        $user = Auth::user();
        $request['customer_details'] = $user;
        $request['item_details'] = [
            "id"=>"t01",
            'name'=>'TopUp Saldo',
            'quantity'=>1,
            'price'=>$request->dataTrans['gross_amount'],
        ];
        $data = $this->repository->create($request);
        return $this->result('Create data kredit is success!!', $data, true);
    }


}
