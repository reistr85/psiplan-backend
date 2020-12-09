<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychologistServiceAddress extends Model
{
    protected $fillable = ['psychologist_id', 'zip_code', 'state', 'city', 'neighborhood', 'address', 'number', 'complement', 'reference', 'active'];
}
