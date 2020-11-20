<?php


namespace App\Observers\API\v1;


use App\Models\PsychologistAcademicFormation;

class PsychologistAcademicFormationObserver
{
    public function creating(PsychologistAcademicFormation $psychologistAcademicFormation)
    {
        $psychologistAcademicFormation->is_active = 1;
    }
}
