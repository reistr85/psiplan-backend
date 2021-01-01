<?php


namespace App\Repositories;


use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class ClientRepository extends BaseRepository
{
    private $model;

    public function __construct(Client $model)
    {
        $this->model = $model;
    }

    /**
     * Find
     *
     * @param int $id
     * @return Model
     */
    public function findByUserId(int $id): Model
    {
        return $this->model::where('user_id', $id)->first();
    }

    /**
     * Store
     *
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model
    {
        return parent::save($this->model, $data);
    }
}
