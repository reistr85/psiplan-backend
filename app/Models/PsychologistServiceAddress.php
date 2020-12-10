<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychologistServiceAddress extends Model
{
    protected $fillable = ['psychologist_id', 'zip_code', 'state', 'city', 'neighborhood', 'street', 'number', 'complement', 'reference', 'is_active'];
}
