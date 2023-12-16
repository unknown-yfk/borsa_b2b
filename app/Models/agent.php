<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class agent extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rom_id',

        'address',
        'mobile',
        'agent_unique_id',
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

    ];
    protected $dates= ['ID_issue_date','ID_expiry_date','issue_date','expiry_date'];
    public function user() {
        return $this->hasone(User::class);
    }
}
