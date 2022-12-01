<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Traits\ToStringFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ContractRepository;

class TransactionController extends Controller
{
    protected $repository;

    public function __construct(ContractRepository $repository)
    {
        $this->repository = $repository;
    }


    public function index()
    {
        return view('transaction.index');
    }

    public function create(Request $request)
    {
        $data = $this->repository->create($request->dataTrans);
        return $this->result('Create data transaction is success!!', $data, true);
    }
}
