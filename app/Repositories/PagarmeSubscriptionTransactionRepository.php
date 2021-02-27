<?php


namespace App\Repositories;

use App\Models\PagarmeSubscriptionTransaction;
use Illuminate\Database\Eloquent\Model;

class PagarmeSubscriptionTransactionRepository extends BaseRepository
{
    private $model;

    public function __construct(PagarmeSubscriptionTransaction $model)
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
     * @param PagarmeSubscriptionTransaction $model
     * @param array $data
     * @return bool
     */
    public function edit(PagarmeSubscriptionTransaction $model, array $data): bool
    {
        return parent::update($model, $data);
    }

    public function getAllSubscriptionTransactionsByUserId(int $user_id)
    {
        return $this->model->where('user_id', $user_id)->with('plan', 'subscription');
    }
}
