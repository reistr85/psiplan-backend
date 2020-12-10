<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    public function findById(Model $model, $id)
    {
        return $model->find($id);
    }

    public function findAll($model)
    {
        return $model->all();
    }

    /**
     * Save Base
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function save(Model $model, array $data): Model
    {
        return $model->create($data);
    }

    /**
     * Update Base
     *
     * @param Model $model
     * @param array $data
     * @return bool
     */
    public function update(Model $model, array $data): bool
    {
        return $model->update($data);
    }

    /**
     * Delete Base
     *
     * @param Model $model
     * @return bool
     * @throws \Exception
     */
    public function delete(Model $model): bool
    {
        return $model->delete();
    }
}
