<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistSpecialtyRepository;

class CreatePsychologistSpecialtyService extends PsychologistSpecialtyRepository
{
    public function execute($psychologist_id, $specialties)
    {
        if(!count($specialties))
            throw new \Exception("É preciso selecionar pelo menos uma especialidade.", 500);


        $psychologistSpecialties = parent::getAllByPsychologistId($psychologist_id)->get();

        $psychologistSpecialties->map(function($item) {
            parent::destroy($item);
        });

        parent::store($specialties);
    }
}
