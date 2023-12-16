<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery2 extends Model
{
    use HasFactory;
    protected $fillable = [
        'rom_id',
        'rsp_id',
        'order_id',
        'deliveryTotalPrice',
        'confirmationStatus',
        
        

    ];

    public function delivery1Products() {
        return $this->hasone(delivery2::class);
    }

    public function rom() {
        return $this->hasmany(delivery2::class);
    }
    public function rsp() {
        return $this->hasmany(delivery2::class);
    }

}
