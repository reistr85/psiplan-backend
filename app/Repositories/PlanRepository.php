<?php


namespace App\Repositories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Builder;

class PlanRepository extends BaseRepository
{
    private $model;

    public function __construct(Plan $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return parent::findAll($this->model);
    }

    public function getByName(string $name): Builder
    {
        return $this->model::where('name', $name);
    }
}
