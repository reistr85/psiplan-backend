<?php


namespace App\Repositories;


use App\Models\Query;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class QueryRepository extends BaseRepository
{
    private $model;

    public function __construct(Query $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model;
    }

    /**
     * Find
     *
     * @param int $id
     * @return Model
     */
    public function find(int $id): ?Model
    {
        return $this->model->where('id', $id)
            ->with('psychologist', 'psychologist.serviceAddress', 'client',
                'psychologistAvailabilityCalendar', 'psychologistAvailabilityCalendar.typeService', 'videoPlatform')
            ->first();
    }

    /**
     * getAllQueriesFindByClientId
     *
     * @param int $id
     * @return Collection
     */
    public function getAllQueriesFindByClientId(int $id): Collection
    {
        return $this->model::where('client_id', $id)->with(
            [
                'psychologist',
                'psychologistAvailabilityCalendar',
                'psychologistAvailabilityCalendar.typeService',
                'videoPlatform',
            ])->get();
    }

    /**
     * getAllQueriesFindByPsychologistId
     *
     * @param int $id
     * @return Collection
     */
    public function getAllQueriesFindByPsychologistId(int $id)
    {
        return $this->model::where('psychologist_id', $id)->with(['client', 'psychologistAvailabilityCalendar.typeService']);
    }

    public function store($data)
    {
        return $this->model::create($data);
    }

    public function edit(Model $model, array $data){
        return parent::update($model, $data);
    }

    public function destroy($model)
    {
        return parent::delete($model);
    }
}
