<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsychologistAddress extends Model
{
    use SoftDeletes;

    protected $fillable = ['psychologist_id', 'zip_code', 'state', 'city', 'neighborhood', 'street',
        'number', 'complement'];
}
