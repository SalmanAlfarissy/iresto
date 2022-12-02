<?php

namespace App\Repositories\Ledgerbalance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ContractRepository;

class LedgerBalanceRepository implements ContractRepository
{

	/**
	 * @param mixed $request
	 * @return mixed
	 */
	public function getData($request)
    {
        $user = Auth::user();
        $data = [];
        if ($user->status == "customer") {
            $kredit = DB::table('users')->join('kredit','kredit.user_id','=','users.id')
            ->select('users.id','kredit.amount as kredit','kredit.created_at as kreditdate')
            ->where('user_id',$user->id)
            ->get();

            $debet = DB::table('users')->join('debet','debet.user_id','=','users.id')
            ->select('users.id','debet.amount as debet','debet.created_at as debetdate')
            ->where('user_id',$user->id)
            ->get();

            $saldo = $kredit[0]->kredit;
            $index = 0;
            $no = 0;
            for ($i=0; $i < count($kredit); $i++) {
                $no = $i+1;
                $data[] = [
                    "no"=>$no,
                    "tanggal"=>$kredit[$i]->kreditdate,
                    "debet"=>"",
                    "kredit"=>$kredit[$i]->kredit,
                    "saldo"=>$saldo,
                ];
                $saldo=$saldo + $kredit[$i]->kredit;
                $index = $i;
            }

            $debet1 = 0;
            for ($i=0; $i < count($debet); $i++) {
                $debet1 = $debet1 + $debet[$i]->debet;
                $saldo = $data[$index]['saldo'] - $debet1;
                $no = $no+1;
                $data[] = [
                    "no"=>$no,
                    "tanggal"=>$debet[$i]->debetdate,
                    "debet"=>$debet[$i]->debet,
                    "kredit"=>"",
                    "saldo"=>$saldo,
                ];

            }
            return $data;
        }

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
