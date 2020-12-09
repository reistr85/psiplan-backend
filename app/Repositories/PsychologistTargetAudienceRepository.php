<?php


namespace App\Repositories;


use App\Models\PsychologistTargetAudience;
use App\Models\PsychologistTypeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PsychologistTargetAudienceRepository extends BaseRepository
{
    private $model;

    public function __construct(PsychologistTargetAudience $model)
    {
        $this->model = $model;
    }

    public function store(array $data): Model
    {
        return parent::save($this->model, $data);
    }

    public function destroy(PsychologistTargetAudience $model): bool
    {
        try {
            return parent::delete($model);
        } catch (\Exception $e) {
        }

        return false;
    }

    /**
     * GetPsychologistTargetAudienceByPsychologistId
     *
     * @param int $psychologist_id
     * @return Builder
     * */
    public function getPsychologistTargetAudienceByPsychologistId(int $psychologist_id): Builder
    {
        return $this->model::where('psychologist_id', $psychologist_id);
    }
}
