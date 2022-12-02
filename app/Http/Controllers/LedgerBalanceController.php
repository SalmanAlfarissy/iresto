<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Debet;
use App\Repositories\ContractRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LedgerBalanceController extends Controller
{
    protected $repository;

    public function __construct(ContractRepository $repository)
    {
        $this->repository = $repository;
    }


    public function index()
    {
        return view('ledgerbalence.index');
    }

    public function getData(Request $request)
    {
        $data = $this->repository->getData($request);
        return $this->result('Getdata success!!',$data,true);
    }
}
