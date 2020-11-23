<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PsychologistDocumentRepository;

class GetPsychologistDocumentService extends PsychologistDocumentRepository
{
    public function execute($psychologist_id)
    {
        return parent::getByPsychologistId($psychologist_id)->first();
    }
}
