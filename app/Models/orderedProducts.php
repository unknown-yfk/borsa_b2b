<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderedProducts extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'order_id',
        'ordered_quantity',
        'subTotal',
        'status',
        'kd_adjusted_quantity'
    ];
    protected $table = 'ordered_products';

    public function order() {
        return $this->hasmany(orderedProducts::class);
    }
}
