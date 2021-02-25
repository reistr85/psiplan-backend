<?php


namespace App\Services\API\v1\City;


use App\Repositories\CityRepository;
use Illuminate\Database\Eloquent\Collection;

class GetCityByIdService extends CityRepository
{
    public function execute(int $id)
    {
        return parent::find($id);
    }
}
