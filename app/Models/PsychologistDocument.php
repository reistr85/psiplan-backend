<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsychologistDocument extends Model
{
    use SoftDeletes;

    protected $fillable = ['psychologist_id', 'crp', 'status_crp', 'address', 'status_address', 'certificate_crp',
        'status_certificate_crp', 'epsi', 'status_epsi', 'is_active'];
}
