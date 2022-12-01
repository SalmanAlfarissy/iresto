<?php

namespace App\Repositories\Kredit;

use App\Models\Kredit;
use App\Repositories\ContractRepository;

class KreditRepository implements ContractRepository
{
    protected $model;

    public function __construct(Kredit $model)
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
