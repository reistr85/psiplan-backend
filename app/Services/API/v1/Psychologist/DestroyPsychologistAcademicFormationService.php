<?php


namespace App\Services\API\v1\Psychologist;


use App\Models\PsychologistAcademicFormation;
use App\Repositories\PsychologistAcademicFormationRepository;

class DestroyPsychologistAcademicFormationService extends PsychologistAcademicFormationRepository
{
    public function execute(int $psychologist_id, int $id)
    {
        $psychologist_academic_formation = parent::getByIdAndPsychologistId($psychologist_id, $id);

        if(!$psychologist_academic_formation)
            throw new \Exception("Formação acadêmica não localizada.", 500);

        if(!parent::destroy($psychologist_academic_formation))
            throw new \Exception("Erro ao excluir o registro.", 500);

        return true;
    }
}
