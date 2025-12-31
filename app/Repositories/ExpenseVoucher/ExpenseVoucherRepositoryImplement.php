<?php

namespace App\Repositories\ExpenseVoucher;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\ExpenseVoucher;

class ExpenseVoucherRepositoryImplement extends Eloquent implements ExpenseVoucherRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(ExpenseVoucher $model)
    {
        $this->model = $model;
    }

    public function all($perPage = 10)
    {
        return $this->model->with('details')->paginate($perPage);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->with('details')->findOrFail($id);
    }

    public function update($id, $data)
    {
        $voucher = $this->model->find($id);

        if(is_null($voucher)) {
            return null;
        }

        return $voucher->update($data);
    }

    public function delete($id)
    {
        $voucher = $this->find($id);
        return $voucher->delete();
    }

    public function search($search, $perPage = 10)
    {
        $query = $this->model->with('details');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('number', 'like', "%{$search}%")
                ->orWhere('paid_to', 'like', "%{$search}%")
                ->orWhereHas('details', function ($dq) use ($search) {
                    $dq->where('description', 'like', "%{$search}%");
                });
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
