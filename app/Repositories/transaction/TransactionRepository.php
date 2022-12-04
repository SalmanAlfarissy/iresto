<?php

namespace App\Repositories\Transaction;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ContractRepository;

class TransactionRepository implements ContractRepository
{
    protected $model;

    public function __construct(Transaction $model)
    {
        $this->model = $model;
    }


	/**
	 * @param mixed $request
	 * @return mixed
	 */
	public function getData($request)
    {
        $user = Auth::user();
        if ($user->status == "customer") {
            if ($request) {
                $this->model = $this->model->where('user_id',$user->id)
                ->whereDate('created_at', '>=', $request['startdate'])
                ->whereDate('created_at', '<=', $request['enddate'])
                ->get();
                return $this->model;
            }
            $this->model = $this->model->where('user_id',$user->id)->get();
            return $this->model;
        }
        if ($request) {
            $this->model = $this->model->whereDate('created_at', '>=', $request['startdate'])
            ->whereDate('created_at', '<=', $request['enddate'])
            ->get();
            return $this->model;
        }
        $this->model = $this->model->get();
        return $this->model;
	}

	/**
	 *
	 * @param mixed $request
	 * @return mixed
	 */
	public function create($request)
    {
        $check = $request['item_details'] ?? false;
        if($check){
            $item = $request['item_details'];
        }else {
            $item = [
                "id"=>"t03",
                'name'=>'Pembayaran pesanan',
                'quantity'=>1,
                'price'=>$request['dataTrans']['gross_amount'],
            ];
        }
        $user = Auth::user();
        $this->model->user_id = $user->id;
        $this->model->transaction_id = $request['dataTrans']['transaction_id'];
        $this->model->order_id = $request['dataTrans']['order_id'];
        $this->model->item_details = json_encode($item);
        $this->model->gross_amount = $request['dataTrans']['gross_amount'];
        $this->model->payment_type = $request['dataTrans']['payment_type'];
        $this->model->transaction_status = $request['dataTrans']['transaction_status'];
        $this->model->payment_code = $request['dataTrans']['payment_code'] ?? null;
        $this->model->pdf_url = $request['dataTrans']['pdf_url'] ?? null;
        $this->model->fraud_status = $request['dataTrans']['fraud_status'];
        $this->model->status_code = $request['dataTrans']['status_code'];
        $this->model->save();
        return $this->model;
	}

	/**
	 *
	 * @param mixed $request
	 * @return mixed
	 */
	public function update($request) {
	}

	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function delete($id) {
	}
}
