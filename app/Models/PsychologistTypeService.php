<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsychologistTypeService extends Model
{
    use SoftDeletes;

    protected $fillable = ['psychologist_id', 'type_service_id', 'is-active'];
}
