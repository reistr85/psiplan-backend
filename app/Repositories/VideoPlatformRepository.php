<?php


namespace App\Repositories;

use App\Models\Plan;
use App\Models\VideoPlatform;
use Illuminate\Database\Eloquent\Builder;

class VideoPlatformRepository extends BaseRepository
{
    private $model;

    public function __construct(VideoPlatform $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return parent::findAll($this->model);
    }

    public function store($data)
    {
        return parent::save($this->model, $data);
    }

    public function getByName(string $name): Builder
    {
        return $this->model::where('name', $name);
    }
}
