<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistRepository;

class GetAllTypeServicesByPsychologistIdService extends PsychologistRepository
{
    public function execute(int $psychologist_id)
    {
        return parent::getAllTypeServicesByPsychologistIdService($psychologist_id);
    }
}
