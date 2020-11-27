<?php


namespace App\Services\API\v1\City;


use App\Repositories\CityRepository;

class GetCitiesByStateService extends CityRepository
{
    public function execute($state)
    {
        return parent::getByState($state);
    }
}
