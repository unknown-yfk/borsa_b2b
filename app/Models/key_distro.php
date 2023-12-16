<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class key_distro extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',

        'address',
        'mobile',
        'key_distro_unique_id',
        'id_file_path',
        'ID_type',
        'ID_number',
        'ID_issue_date',
        'ID_expiry_date',

        'businessName',
        'businessType',
        'businessAddress',
        'licenceFilePath',
        'licenceNumber',
        'issueDate',
        'expiryDate',
        'tinNumber',
        'businessEstablishmentYear',
        'latitude',
        'longtude',
        'HibretBank_Account_Number',
        'AmharaBank_Account_Number',
        'CBEBank_Account_Number',
        'has_tm',

    ];
    protected $dates= ['ID_issue_date','ID_expiry_date','issue_date','expiry_date'];
    public function user() {
        return $this->hasone(User::class);
    }
    // public function client() {
    //     return $this->hasmany(client::class);
    // }
}
