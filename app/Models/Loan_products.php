<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan_products extends Model
{
    protected $fillable = [
        'id',
        'org_name',
        'loan_period',
        'intrest_rate',
        'max_amount'
    ];

    // Define relationships
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    use HasFactory;
}
