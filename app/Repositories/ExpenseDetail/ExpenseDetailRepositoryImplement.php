<?php

namespace App\Repositories\ExpenseDetail;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\ExpenseDetail;

class ExpenseDetailRepositoryImplement extends Eloquent implements ExpenseDetailRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(ExpenseDetail $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
