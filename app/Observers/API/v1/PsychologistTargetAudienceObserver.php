<?php


namespace App\Observers\API\v1;


use App\Models\PsychologistTargetAudience;

class PsychologistTargetAudienceObserver
{
    public function creating(PsychologistTargetAudience $psychologistTargetAudience)
    {
        $psychologistTargetAudience->is_active = 1;
    }
}
