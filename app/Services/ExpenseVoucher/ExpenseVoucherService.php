<?php

namespace App\Services\ExpenseVoucher;

use LaravelEasyRepository\BaseService;

interface ExpenseVoucherService extends BaseService{

    public function getAll($perPage = 10);
    public function getById($id);
    public function createVoucher($data);
    public function printPdf($id);
    
    public function updateVoucher($id, $data);
    public function deleteVoucher($id);
    public function getSearch($data, $perPage);
}
