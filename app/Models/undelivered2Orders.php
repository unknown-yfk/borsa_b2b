<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class undelivered2Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'rom_id',
        'rsp_id',
        'order_id',
       

    ];

    public function undelivered2Products() {
        return $this->hasone(undelivered2Orders::class);
    }

    public function rom() {
        return $this->hasmany(undelivered2Orders::class);
    }
    public function rsp() {
        return $this->hasmany(undelivered2Orders::class);
    }
    
}
