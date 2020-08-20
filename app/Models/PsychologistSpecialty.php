<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychologistSpecialty extends Model
{
    public function specialty(){
        return $this->belongsTo(Specialty::class);
    }

    public function psychologist(){
        return $this->belongsTo(Psychologist::class);
    }
}
