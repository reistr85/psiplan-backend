<?php


namespace App\Repositories;


use App\Models\City;

class CityRepository extends BaseRepository
{
    private $model;

    public function __construct(City $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return self::findAll($this->model);
    }
}
