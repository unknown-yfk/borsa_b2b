<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class undelivered1Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'undelivered_quantity',
        'undelivered1_id',
       
        
    ];

    public function undelivered1() {
        return $this->hasmany(undelivered1_products::class);
    }
}
