<?php


namespace App\Services\API\v1\City;


use App\Repositories\CityRepository;
use Illuminate\Database\Eloquent\Collection;

class GetCitiesByNameService extends CityRepository
{
    public function execute(string $name): Collection
    {
        $cities = parent::getByName($name)->get();

        return $cities;
    }
}
