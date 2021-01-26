<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Query extends Model
{
    use SoftDeletes;

    protected $fillable = ['psychologist_id', 'client_id', 'psychologist_availability_calendar_id', 'day_hour',
        'evaluation', 'status_query', 'transaction_id',  'status_payment', 'is_active'];

    public function psychologist()
    {
        return $this->belongsTo(Psychologist::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function psychologistAvailabilityCalendar()
    {
        return $this->belongsTo(PsychologistAvailabilityCalendar::class);
    }
}
