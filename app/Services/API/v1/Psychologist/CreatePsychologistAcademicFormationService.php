<?php


namespace App\Services\API\v1\Psychologist;


use App\Models\PsychologistAcademicFormation;
use App\Repositories\PsychologistAcademicFormationRepository;

class CreatePsychologistAcademicFormationService extends PsychologistAcademicFormationRepository
{
    public function execute(array $data)
    {
        $psychologistAcademicFormation = self::store($data);

        if(!$psychologistAcademicFormation)
            throw new \Exception("Erro ao criar o registro.", 500);

        return $psychologistAcademicFormation;
    }
}
