<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\ContractRepository;

class UserRepository implements ContractRepository
{
    protected $model;

    public function __construct(User $model)
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
	public function create($request) {
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
