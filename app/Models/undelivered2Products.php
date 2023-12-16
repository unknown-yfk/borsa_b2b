<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class undelivered2Products extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'product_id',
        'undelivered_quantity',
        'undelivered2_id',
       
        
    ];

    public function undelivered2() {
        return $this->hasmany(undelivered2_products::class);
    }
}
