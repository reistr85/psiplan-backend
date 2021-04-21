<?php


namespace App\Repositories;


use App\Models\PsychologistTypeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PsychologistTypeServiceRepository extends BaseRepository
{
    private $model;

    public function __construct(PsychologistTypeService $model)
    {
        $this->model = $model;
    }

    public function store(array $data): Model
    {
        return parent::save($this->model, $data);
    }

    public function destroy(PsychologistTypeService $model): bool
    {
        try {
            return parent::delete($model);
        } catch (\Exception $e) {
        }

        return false;
    }

    /**
     * GetPsychologistTypeServiceByPsychologistId
     *
     * @param int $psychologist_id
     * @return Builder
     * */
    public function getPsychologistTypeServiceByPsychologistId(int $psychologist_id): Builder
    {
        return $this->model::where('psychologist_id', $psychologist_id);
    }

    public function getPsychologistTypeServiceByTypeServiceIdByPsychologistId(int $psychologist_id, int $type_service_id)
    {
        return $this->model::where('psychologist_id', $psychologist_id)
            ->where('type_service_id', $type_service_id);
    }
}
