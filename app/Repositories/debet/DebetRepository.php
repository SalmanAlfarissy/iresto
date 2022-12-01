<?php

namespace App\Repositories\Debet;

use App\Models\Debet;
use App\Repositories\ContractRepository;

class DebetRepository implements ContractRepository
{
    protected $model;

    public function __construct(Debet $model)
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
        $this->model->amount = $request['dataTrans']['gross_amount'];
        $this->model->save();
        $this->model['dataTrans'] = $request['dataTrans'];
        $this->model['customer_details'] = $request['customer_details'];
        $this->model['item_details'] = $request['item_details'];
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
