<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    use HasFactory;
     protected $fillable = [
        'ordered_id',
        'quantity',
        'created_date'
     ];
}
