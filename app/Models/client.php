<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $fillable = [
        'user_id',
        'Mother_name',
        'Gender',
        'birthdate',
        'PhoneType',
        'Nationality',
        'Photo',
        'FamilySize',
        'child_in_school',
        'Marital_Status',
        'Country',
        'City',
        'Bank_Account',
        'Bank_name',
        'Bank_Account_Number',

        'age' ,
        'nochild',
        'child_in_school_under2',
        'camp' ,
        'unhcr_id' ,
        'businesscamp',
        'businesszone',
        'establishment_date',
        'workpermit',
        'financialproduct_saving',
        'financialproduct_loan',
        'financialproduct_payment',
        'otheraccount' ,
        'productused_saving',
        'productused_loan',
        'productused_remittance',
        'productused_payment',
        'Training_taking',
        'Training_given_org',
        'Training_module1' ,
        'Training_module2' ,
        'Training_module3' ,
        'areas_intrested_finance',
        'areas_intrested_scale',
        'areas_intrested_digitize',
        'short_term_personal_goals',
        'short_term_business_goals',
        'leaveethiopia',
        'when_leave',

        'Region',
        'zone',
        'kebele',
        'house_number',
        'ID_type',
        'ID_Number',
        'ID_issue_date',
        'ID_expiry_Date',
        'businessName',
        'businessType',
        'Mother_name',
        'userName',
        'Tin_number',
        'Distance_from_KD',
        'Community_Saving',
        'Community_loan',
        'Receival_of_training',
        'Training_provided_by',
        'Long_term_personal_goals',
        'Long_term_business_goals',
        'Desired_place_of_residence',
        'Training_module',
        'License_number',




        'PinCode',
        'client_unique_id',
        'client_address',
        'client_mobile_phone',
        'Alternative_Phone_Number',

        'client_business_Name',
        'client_business_Type',
        'businessRegisteration',
        'client_latitude',
        'client_longtude',
        'client_yearsInBusiness',
        'distro_id',
        'agent_id',
        'client_verificationData',
        'QRPassword',
        'status',




    ];

    public function user() {
        return $this->hasone(User::class);
    }
    // public function client() {
    //     return $this->hasmany(key_distro::class);
    // }
}
