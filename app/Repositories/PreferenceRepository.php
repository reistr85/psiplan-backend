<?php


namespace App\Repositories;


use App\Models\Preference;

class PreferenceRepository extends BaseRepository
{
    private $model;

    public function __construct(Preference $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return parent::findAll($this->model);
    }
}
