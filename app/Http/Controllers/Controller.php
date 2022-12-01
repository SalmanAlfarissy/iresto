<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function result(String $message, $data=null, $status = false)
    {
        return response()->json([
            'message'=>$message,
            'data'=>$data,
            'newtoken'=>csrf_token(),
            'status'=>$status,
        ]);
    }
    function rupiah($angka){
        $rupiah = "Rp " . number_format($angka,2,',','.');
        return $rupiah;
    }
}
