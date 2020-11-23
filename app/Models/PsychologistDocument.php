<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsychologistDocument extends Model
{
    use SoftDeletes;

    protected $fillable = ['psychologist_id', 'crp', 'address', 'certificate_crp', 'epsi', 'is_active'];
}
