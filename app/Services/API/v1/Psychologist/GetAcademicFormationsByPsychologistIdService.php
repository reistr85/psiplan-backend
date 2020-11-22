<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistAcademicFormationRepository;

class GetAcademicFormationsByPsychologistIdService extends PsychologistAcademicFormationRepository
{

    /**
     * Get All Specialties by Psychologist Id.
     *
     * @param int $psychologist_id
     * @return array
     */
    public function execute($psychologist_id)
    {
        return parent::getAllByPsychologistId($psychologist_id)->get();
    }
}
