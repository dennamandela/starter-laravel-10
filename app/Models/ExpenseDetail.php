<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function voucher()
    {
        return $this->belongsTo(ExpenseVoucher::class);
    }
}
