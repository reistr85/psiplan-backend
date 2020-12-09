<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsychologistTargetAudience extends Model
{
    use SoftDeletes;

    protected $fillable = ['psychologist_id', 'target_audience_id', 'is_active'];

    public function target_audience(){
        return $this->belongsTo(TargetAudience::class);
    }

    public function psychologist(){
        return $this->belongsTo(Psychologist::class);
    }
}
