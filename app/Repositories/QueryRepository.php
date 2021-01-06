<?php


namespace App\Repositories;


use App\Models\Query;
use Illuminate\Database\Eloquent\Collection;

class QueryRepository
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
     * @return Collection
     */
    public function getAllQueriesFindByClientId(int $id): Collection
    {
        return $this->model::where('client_id', $id)->with(['psychologist'])->get();
    }
}
