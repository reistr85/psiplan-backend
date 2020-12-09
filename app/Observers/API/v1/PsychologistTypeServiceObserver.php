<?php


namespace App\Observers\API\v1;


use App\Models\PsychologistTypeService;

class PsychologistTypeServiceObserver
{
    public function creating(PsychologistTypeService $psychologistTypeService)
    {
        $psychologistTypeService->is_active = 1;
    }
}
