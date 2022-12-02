<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Repositories\ContractRepository;

class MenuController extends Controller
{
    protected $repository;

    public function __construct(ContractRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $data = Menu::orderBy('category','asc')->get();
        foreach ($data as $index => $item) {
            $item->price = $this->rupiah($item->price);
        }

        return view('menu.index', compact('data'));
    }
    public function _index()
    {
        return view('menu.admin');
    }
    public function getData(Request $request)
    {
        $data = $this->repository->getData($request);
        return $this->result('Getdata Successfully!!', $data, true);
    }

    public function create(Request $request)
    {
        $validate = $request->validate([
            'name'=>'required',
            'category'=>'required',
            'price'=>'required|numeric',
            'description'=>'',
            'image'=>'mimes:png,jpg,jpeg',
        ]);
        $data = $this->repository->create($validate);
        return $this->result('Create data menu successfully!!', $data, true);
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'id'=>'',
            'name'=>'required',
            'category'=>'required',
            'price'=>'required|numeric',
            'description'=>'',
            'image'=>'mimes:png,jpg,jpeg',
        ]);
        $data = $this->repository->update($validate);
        return $this->result('Update data menu successfully!!', $data, true);
    }

    public function delete($id)
    {
        $data = $this->repository->delete($id);
        return $this->result('Delete data successfully!!', $data, true);
    }

}
