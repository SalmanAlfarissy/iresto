<?php

namespace App\Repositories\Transaction;

use App\Models\Transaction;
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
	public function getData($request) {
	}

	/**
	 *
	 * @param mixed $request
	 * @return mixed
	 */
	public function create($request)
    {
        $this->model->user_id = $request['customer_details']['id'];
        $this->model->transaction_id = $request['dataTrans']['transaction_id'];
        $this->model->order_id = $request['dataTrans']['order_id'];
        $this->model->item_details = json_encode($request['item_details']);
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
