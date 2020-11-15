<?php


namespace App\Services\API\v1\User;

use App\Repositories\SpecialitiesRepository;

class GetAllSpecialities extends SpecialitiesRepository
{
    public function execute()
    {
        return parent::getAll();
    }
}
