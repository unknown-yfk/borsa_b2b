<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    use HasFactory;
    protected $table = 'productlist';
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'packsize',
        'catagory_id',
        'productType_id',
        'min_order',
        'max_order',
    ];
}
