<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $fillable = [
        'order_id',
        'total_price',
        'bank_name',
        'from_client',
        'to_kd',
        'date',
    ];
}