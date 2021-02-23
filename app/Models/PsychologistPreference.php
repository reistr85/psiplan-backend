<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsychologistPreference extends Model
{
    use SoftDeletes;

    protected $fillable = ['psychologist_id', 'preference_id', 'is_active'];
}
