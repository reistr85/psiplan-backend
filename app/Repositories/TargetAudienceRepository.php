<?php


namespace App\Repositories;


use App\Models\TargetAudience;

class TargetAudienceRepository extends BaseRepository
{
    private $model;

    public function __construct(TargetAudience $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return self::findAll($this->model);
    }
}
