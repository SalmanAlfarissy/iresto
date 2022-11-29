<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\ContractRepository;
use Illuminate\Support\Facades\Hash;

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
	public function getData($request)
    {
        if ($request->id) {
            return $this->model->find($request->id);
        }
        $data = $this->model->get();
        foreach ($data as $index => $item) {
            $item->no = $index+1;
            $item->date = $item->created_at->format('d M Y');
        }
        return $data;
	}

	/**
	 *
	 * @param mixed $request
	 * @return mixed
	 */
	public function create($request)
    {
        $this->model->firstname = $request['firstname'];
        $this->model->lastname = $request['lastname'];
        $this->model->email = $request['email'];
        $this->model->phone = $request['phone'];
        $this->model->address = $request['address'];
        $password = Hash::make($request['password']);
        $this->model->password = $password;
        $this->model->status = $request['status'];
        $this->model->save();
        return $this->model;
	}

	/**
	 *
	 * @param mixed $request
	 * @return mixed
	 */
	public function update($request)
    {
        $this->model = $this->model->find($request['id']);
        $this->model->firstname = $request['firstname'];
        $this->model->lastname = $request['lastname'];
        $this->model->email = $request['email'];
        $this->model->phone = $request['phone'];
        $this->model->address = $request['address'];
        $password = Hash::make($request['password']);
        $this->model->password = $password;
        $this->model->status = $request['status'];
        $this->model->save();
        return $this->model;
	}

	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function delete($id)
    {
        return $this->model->find($id)->delete();
	}
}
