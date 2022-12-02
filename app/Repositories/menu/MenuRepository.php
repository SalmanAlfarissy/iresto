<?php

namespace App\Repositories\Menu;

use App\Models\Menu;
use App\Repositories\ContractRepository;

class MenuRepository implements ContractRepository
{

    protected $model;
    /**
     */
    public function __construct(Menu $model)
    {
        $this->model = $model;
    }
	/**
	 * @param mixed $request
	 * @return mixed
	 */
	public function getData($request)
    {
        if ($request['id']) {
            $this->model = $this->model->find($request['id']);
            return $this->model;
        }

        $this->model = $this->model->get();
        foreach ($this->model as $index => $item) {
            $item->no = $index+1;
            $item->date = $item->created_at->format('d M Y');
        }
        return $this->model;
	}

	/**
	 *
	 * @param mixed $request
	 * @return mixed
	 */
	public function create($request)
    {
        $this->model->name = $request['name'];
        $this->model->category = $request['category'];
        $this->model->price = $request['price'];
        $this->model->description = $request['description'];

        if (!empty($request['image'])){
            $file_name = time().rand().'.'.$request['image']->getClientOriginalExtension();
            $request['image']->move(public_path().'/image/content',$file_name);
            $this->model->image = $file_name;
        }

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
        $this->model->name = $request['name'];
        $this->model->category = $request['category'];
        $this->model->price = $request['price'];
        $this->model->description = $request['description'];

        if (!empty($request['image'])){
            $file_name = $this->model->image;
            $request['image']->move(public_path().'/image/content',$file_name);
        }

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
        $data = $this->model->find($id);
        $file = public_path('image/content/').$data->image;
        if (file_exists($file)){
            @unlink($file);
        }
        $data->delete();
        return $data;
	}
}
