<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsychologistAvailabilityCalendar extends Model
{
    use SoftDeletes;

    protected $fillable = ['psychologist_id', 'type_service_id', 'day_hour', 'available', 'is_active'];

    public function typeService()
    {
        return $this->belongsTo(TypeService::class);
    }
}
