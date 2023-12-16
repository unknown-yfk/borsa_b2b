<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Handover_hierarchy extends Model
{

    protected $table = 'handover_hierarchy';
    protected $fillable = [
        'name',
        'status'
    ];
    use HasFactory;
}
