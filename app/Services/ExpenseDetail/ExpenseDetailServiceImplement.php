<?php

namespace App\Services\ExpenseDetail;

use LaravelEasyRepository\Service;
use App\Repositories\ExpenseDetail\ExpenseDetailRepository;

class ExpenseDetailServiceImplement extends Service implements ExpenseDetailService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ExpenseDetailRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function all()
    {
      return $this->model->all();
    }

    public function create($data)
    {
      return $this->model->create($data);
    }

    public function find($id)
    {
      return $this->model->find($id);
    }

    public function update($id, $data)
    {
      $details = $this->model->find($id);

      if(is_null($details)) {
        return null;
      }

      return $details->update($data);
    }

    public function delete($id)
    {
      $details = $this->find($id);
      return $details->delete();
    }
}
