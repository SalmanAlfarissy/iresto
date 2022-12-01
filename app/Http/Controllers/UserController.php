<?php

namespace App\Http\Controllers;

use App\Repositories\ContractRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $repository;

    public function __construct(ContractRepository $repository)
    {
        $this->repository = $repository;
    }


    public function index()
    {
        return view('user.index');
    }

    public function getData(Request $request)
    {
        $data = $this->repository->getData($request);
        return $this->result('Get Data Successfully!', $data, true);
    }

    public function create(Request $request)
    {
        $validate = $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email|unique:users,email',
            'phone'=>'required|unique:users,phone',
            'address'=>'',
            'password'=>'required',
            'status'=>'required',
        ]);
        $data = $this->repository->create($validate);
        return $this->result('Create Data User Successfuly!',$data,true);
    }
    public function update(Request $request)
    {
        $validate = $request->validate([
            'id'=>'',
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email|unique:users,email',
            'phone'=>'required',
            'address'=>'',
            'password'=>'required',
            'status'=>'required',
        ]);
        $data = $this->repository->update($validate);
        return $this->result('Update Data User Successfuly!',$data,true);
    }

    public function delete($id)
    {
        $data = $this->repository->delete($id);
        return $this->result('Delete Data Successfully!', $data, true);
    }
}
