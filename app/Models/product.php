<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
   protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'packsize',
        'catagory_id',
        'productlist_id',
        'productType_id',
    ];

}
