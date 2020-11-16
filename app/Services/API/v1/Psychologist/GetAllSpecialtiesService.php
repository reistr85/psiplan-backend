<?php


namespace App\Services\API\v1\Psychologist;

use App\Repositories\SpecialtiesRepository;

class GetAllSpecialtiesService extends SpecialtiesRepository
{
    public function execute()
    {
        return parent::getAll();
    }
}
