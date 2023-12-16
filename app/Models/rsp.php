<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rsp extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'address',
        'mobile',
        'rsp_unique_id',
        'id_filepath',
        'ID_type',
        'ID_number',
        'ID_issue_date',
        'ID_expiry_date',

        'company_id_filepath',
        'company_id_number',
        'company_id_issue_date',
        'company_id_expiry_date',

    ];
    protected $dates= ['ID_issue_date','ID_expiry_date','company_id_issue_date','company_id_expiry_date'];
    public function user() {
        return $this->hasone(User::class);
    }

}
