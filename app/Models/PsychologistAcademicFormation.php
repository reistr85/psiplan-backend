<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsychologistAcademicFormation extends Model
{
    use SoftDeletes;

    protected $fillable = ['psychologist_id', 'type', 'description', 'institution', 'is_active'];
}
