<?php

namespace App\Repositories\ExpenseVoucher;

use LaravelEasyRepository\Repository;

interface ExpenseVoucherRepository extends Repository{

    public function all();
    public function create($data);
    public function find($id);
    public function update($id, $data);
    public function delete($id);
    public function search($search, $perPage = 10);
}
