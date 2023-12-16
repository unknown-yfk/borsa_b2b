<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery_4s extends Model
{

    use HasFactory;
    protected $fillable = [
        'sender_id',
        'client_id',
        'order_id',
        'confirmation_status',
        'deliveryTotalPrice',
        ];


 public function delivery4Products() {
    return $this->hasone(delivery_4s::class);
    }




}
