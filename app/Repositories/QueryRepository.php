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

    /**
     * Find
     *
     * @param int $id
     * @return Model
     */
    public function find(int $id): ?Model
    {
        return $this->model->where('id', $id)
            ->with('psychologist.serviceAddress', 'client', 'psychologistAvailabilityCalendar.typeService')
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
        return $this->model::where('client_id', $id)->with(['psychologist'])->get();
    }

    public function store($data)
    {
        return $this->model::create($data);
    }
}
