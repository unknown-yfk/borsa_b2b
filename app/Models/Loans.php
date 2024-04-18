<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
      protected $fillable = [
        'id',
        'created_by',
        'client_id',
        'disbursed_date',
        'amount',
        'expected_first_repayment',
        'order_id',
        'status',
        'remaining_amount',
        'loan_product_id',

    ];
    use HasFactory;
}
