<?php


namespace App\Observers\API\v1;


use App\Models\Psychologist;

class PsychologistObserver
{
    public function creating(Psychologist $psychologist)
    {
        $psychologist->is_active = 1;
    }
}
