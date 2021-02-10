<?php


namespace App\Observers\API\v1;

use App\Models\PsychologistPlan;

class PsychologistPlanObserver
{
    public function creating(PsychologistPlan $psychologist_plan)
    {
        $psychologist_plan->is_active = 1;
    }
}
