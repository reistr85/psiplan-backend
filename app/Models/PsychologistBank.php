<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychologistBank extends Model
{
    protected $fillable = ['psychologist_id', 'bank_id', 'bank_code', 'bank_type_account', 'agency', 'agency_dv',
        'number_account', 'number_account_dv', 'name_holder_account', 'cpf_holder_account', 'is_active'];
}
