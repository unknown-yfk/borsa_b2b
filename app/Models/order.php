<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'KD_id',
        'createdDate',
        'createdBy',
        'Hierarchy_id',
        'orderedBy',
        'confirmStatus',
        'paymentStatus',
        'deliveryStatus',
        'totalPrice',
        'consent',
        'rom_id'

    ];

    public function orderedProducts() {
        return $this->hasone(order::class);
    }
    public function client() {
        return $this->hasmany(order::class);
    }
    public function key_distro() {
        return $this->hasmany(order::class);
    }
}
