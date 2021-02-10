<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsychologistPlan extends Model
{
    use SoftDeletes;

    protected $fillable = ['psychologist_id', 'plan_id', 'is_active'];
}
