<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery_4products extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'delivery4_id',
        'delivered_quantity',
        'subTotal',
        
    ];

    public function delivery_4() {
        return $this->hasmany(delivery_4products::class);
    }

}
