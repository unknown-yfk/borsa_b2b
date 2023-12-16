<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kd_stock extends Model
{
    use HasFactory;
    protected $table = "kd_stock";
    protected $fillable = [
        'price',


         ];

}
