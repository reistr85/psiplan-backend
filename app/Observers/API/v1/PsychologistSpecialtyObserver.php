<?php


namespace App\Observers\API\v1;


use App\Models\PsychologistSpecialty;

class PsychologistSpecialtyObserver
{
    public function creating(PsychologistSpecialty $psychologistSpecialty)
    {
        $psychologistSpecialty->is_active = 1;
    }
}
