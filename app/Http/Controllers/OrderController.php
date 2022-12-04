<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ContractRepository;

class OrderController extends Controller
{
    protected $repository;

    public function __construct(ContractRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        // $user = Auth::user();
        // $data = Order::with('dataMenu')->where('user_id', $user->id)->get();
        // $total_price = 0;
        // foreach ($data as $index => $item) {
        //     $item->no = $index+1;
        //     $item->total = $this->rupiah($item->dataMenu['price']*$item->amount);
        //     $item->price = $this->rupiah($item->dataMenu['price']);
        //     $total_price += $item->dataMenu['price']*$item->amount;
        // }
        // $count_status = Order::with('dataMenu')->where('user_id', $user->id)->where('status','success')->count();

        return view('order.index');
    }
    public function _index()
    {
        $data = Order::with('dataMenu')->with('dataUser')->get();
        foreach ($data as $index => $item) {
            $item->no = $index+1;
            $item->total = $this->rupiah($item->dataMenu['price']*$item->amount);
            $item->price = $this->rupiah($item->dataMenu['price']);
        }
        return view('order.admin',[
            'data'=>$data,
        ]);
    }

    public function getData(Request $request)
    {
        $user = Auth::user();
        $data = $this->repository->getData($request);
        if($user->status == 'customer'){
            foreach ($data['data'] as $item) {
                $item['price'] = $this->rupiah( $item['price']);
                $item['total'] = $this->rupiah( $item['total']);
            }
            $data['default_total_price'] = $data['total_price'];
            $data['total_price'] = $this->rupiah($data['total_price']);
            return $this->result('Getdata successfully!', $data, true);
        }
        foreach ($data as $item) {
            $item->price = $this->rupiah( $item->price);
            $item->total = $this->rupiah( $item->total);
        }
        return $this->result('Getdata successfully!', $data, true);
    }
    public function create(Request $request)
    {
        $request['item_details'] = [
            "id"=>"t03",
            'name'=>'Pembayaran pesanan',
            'quantity'=>1,
            'price'=>$request->gross_amount,
        ];
        $data = $this->repository->create($request);
        return $this->result('Order successfully added', $data, true);
    }

    public function update(Request $request)
    {

        $data = $this->repository->update($request);
        return $this->result('Update data order success!', $data, true);
    }

    public function delete($id)
    {
        $data = $this->repository->delete($id);
        return $this->result('Delete data was success!', $data, true);
    }
}
