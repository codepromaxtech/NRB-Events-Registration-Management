<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'photo_path',
        'passport_number',
        'nationality',
        'country',
        'gender',
        'organization',
        'type_of_business',
        'designation',
        'website',
        'business_description',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'zip_code',
        'payment_proof_path',
        'signature_path',
        'status',
    ];
    //
}
