<?php


namespace App\Observers\API\v1;


use App\Models\PsychologistTypeService;
use App\User;

class PsychologistTypeServiceObserver
{
    public function creating(PsychologistTypeService $psychologistTypeService)
    {
        $psychologistTypeService->is_active = 1;
    }
}
