<?php

namespace App\Services\ExpenseDetail;

use LaravelEasyRepository\BaseService;

interface ExpenseDetailService extends BaseService{

    public function all();
    public function create($data);
    public function find($id);
    public function update($id, $data);
    public function delete($id);
}
