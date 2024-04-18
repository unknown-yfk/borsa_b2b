<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cash_paid extends Model
{
    protected $fillable = [
        'id',
        'created_by',
        'client_id',
        'order_id',
        'amount'
    ];

    use HasFactory;
}
