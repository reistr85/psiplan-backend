<?php


namespace App\Repositories;


use App\Models\PagarmeSubscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class PagarmeSubscriptionRepository extends BaseRepository
{

    private $model;

    public function __construct(PagarmeSubscription $model)
    {
        $this->model = $model;
    }

    /**
     * Find
     *
     * @param int $id
     * @return Builder
     */
    public function findByUserId(int $id)
    {
        return $this->model::where('user_id', $id);
    }

    /**
     * Find
     *
     * @param int $id
     * @return Model
     */
    public function find(int $id): Model
    {
        return parent::findById($this->model, $id);
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

    /**
     * Store
     *
     * @param PagarmeSubscription $model
     * @param array $data
     * @return bool
     */
    public function edit(PagarmeSubscription $model, array $data): bool
    {
        return parent::update($model, $data);
    }

}
