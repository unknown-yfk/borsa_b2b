<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery2Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'delivery2_id',
        'delivered_quantity',
        'subTotal',
        
    ];

    public function delivery2() {
        return $this->hasmany(delivery2Products::class);
    }

}
