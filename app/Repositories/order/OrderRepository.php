<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\ContractRepository;
use Illuminate\Support\Facades\Auth;

class OrderRepository implements ContractRepository
{

    protected $model;
    /**
     */
    public function __construct(Order $model)
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
        if ($user->status == 'customer') {
            $data = Order::with('dataMenu')->where('user_id', $user->id)->where('payment_confirmation','0')->get();
            $total_price = 0;
            foreach ($data as $index => $item) {
                $item->no = $index+1;
                $item->total = $item->dataMenu['price']*$item->amount;
                $item->price = $item->dataMenu['price'];
                $total_price += $item->total;
            }
            $check_status = Order::where('user_id', $user->id)
            ->where('status','success')
            ->count();
            return [
               'data'=>$data,
               'total_price'=>$total_price,
               'check_status'=>$check_status
            ];
        }
        $data = Order::with('dataMenu')->with('dataUser')->where('payment_confirmation','0')->get();
        foreach ($data as $index => $item) {
            $item->no = $index+1;
            $item->total = $item->dataMenu['price']*$item->amount;
            $item->price = $item->dataMenu['price'];
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
        $user = Auth::user();
        if($user->status == 'customer'){
            $this->model->user_id = $user->id;
            $this->model->menu_id = $request['menu_id'];
            $this->model->amount = $request['amount'];
            $this->model->seat_number = $request['seat_number'];
            $this->model->status = $request['status'] ?? 'order';
            $this->model->save();
            return $this->model;
        }
	}

	/**
	 *
	 * @param mixed $request
	 * @return mixed
	 */
	public function update($request)
    {
        $user = Auth::user();
        if($user->status == 'customer'){
            $this->model = $this->model->where('user_id', $request['user_id'])
            ->update([
                'payment_confirmation'=> $request['payment_confirmation'],
                'seat_number'=>$request['seat_number'],
                'status'=>$request['status']
            ]);
            $this->model = $request['dataTrans'];
            return $this->model;
        }
        $data = $this->model->find($request['id']);
        $data->status = 'success';
        $data->save();
        return $data;
	}

	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function delete($id)
    {
        $data = $this->model->find($id);
        $data->delete();
        return $data;
	}
}
