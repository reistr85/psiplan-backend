<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistRepository;

class GetAcademicFormationsByPsychologistIdService extends PsychologistRepository
{

    /**
     * Get All Specialties by Psychologist Id.
     *
     * @param int $psychologist_id
     * @return array
     */
    public function execute($psychologist_id)
    {
        return parent::getAcademicFormationsByPsychologistId($psychologist_id)->get();
    }
}
