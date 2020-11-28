<?php


namespace App\Observers\API\v1;


use App\Models\PsychologistLanguage;

class PsychologistLanguageObserver
{
    public function creating(PsychologistLanguage $psychologistLanguage)
    {
        $psychologistLanguage->is_active = 1;
    }
}
