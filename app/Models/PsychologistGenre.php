<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsychologistGenre extends Model
{
    use SoftDeletes;

    public function genre(){
        return $this->belongsTo(Genre::class);
    }

    public function psychologist(){
        return $this->belongsTo(Psychologist::class);
    }
}
