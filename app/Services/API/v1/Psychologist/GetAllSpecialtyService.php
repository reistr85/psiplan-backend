<?php


namespace App\Services\API\v1\Psychologist;

use App\Repositories\SpecialtyRepository;

class GetAllSpecialtyService extends SpecialtyRepository
{
    public function execute()
    {
        return parent::getAll();
    }
}
