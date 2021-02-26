<?php


namespace App\Repositories;

use App\Models\Plan;
use App\Models\PsychologistVideoPlatform;
use App\Models\VideoPlatform;
use Illuminate\Database\Eloquent\Builder;

class PsychologistVideoPlatformRepository extends BaseRepository
{
    private $model;

    public function __construct(PsychologistVideoPlatform $model)
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

    public function getByPsychologistId(string $id): Builder
    {
        return $this->model::where('psychologist_id', $id);
    }
}
