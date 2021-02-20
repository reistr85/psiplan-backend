<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsychologistProgressProfile extends Model
{
    use SoftDeletes;

    protected $fillable = ['psychologist_id', 'type', 'value', 'is_active'];
}
