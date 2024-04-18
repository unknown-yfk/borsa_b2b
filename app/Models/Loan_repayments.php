<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan_repayments extends Model
{
      protected $fillable = [
        'id',
        'loan_id',
        'paid_amount',
        'date'
    ];
    use HasFactory;
}
