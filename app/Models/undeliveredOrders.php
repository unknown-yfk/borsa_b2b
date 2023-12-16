<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class undeliveredOrders extends Model
{
    use HasFactory;
    protected $fillable = [
        'rom_id',
        'kd_id',
        'order_id',
       

    ];

    public function undelivered1Products() {
        return $this->hasone(undeliveredOrders::class);
    }

    public function rom() {
        return $this->hasmany(undeliveredOrders::class);
    }
    public function key_distro() {
        return $this->hasmany(undeliveredOrders::class);
    }
    
}
