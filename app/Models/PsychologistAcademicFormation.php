<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychologistAcademicFormation extends Model
{
    protected $fillable = ['psychologist_id', 'type', 'description', 'institution', 'is_active'];
}
