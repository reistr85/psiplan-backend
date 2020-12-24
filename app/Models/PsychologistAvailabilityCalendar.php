<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychologistAvailabilityCalendar extends Model
{
    protected $fillable = ['psychologist_id', 'day_hour', 'available', 'is_active'];
}
