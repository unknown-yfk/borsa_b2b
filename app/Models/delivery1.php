<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery1 extends Model
{
    use HasFactory;
    protected $fillable = [
        'rom_id',
        'kd_id',
        'order_id',
        'Hierarchy_id',
        'ConfirmationStatus',
        'deliveryTotalPrice',
        'cico_confirmation',
        'handover_to_cico',
        'cico_id',


    ];

    public function delivery1Products() {
        return $this->hasone(delivery1::class);
    }

    public function rom() {
        return $this->hasmany(delivery1::class);
    }
    public function key_distro() {
        return $this->hasmany(delivery1::class);
    }

}
