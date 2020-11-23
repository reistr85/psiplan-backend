<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsychologistSpecialty extends Model
{
    use SoftDeletes;

    protected $fillable = ['psychologist_id', 'specialty_id', 'is_active'];

    public function specialty(){
        return $this->belongsTo(Specialty::class);
    }

    public function psychologist(){
        return $this->belongsTo(Psychologist::class);
    }
}
