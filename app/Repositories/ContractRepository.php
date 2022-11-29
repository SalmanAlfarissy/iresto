<?php

namespace App\Repositories;

interface ContractRepository
{
    public function getData($request);
    public function create($request);
    public function update($request);
    public function delete($id);
}
