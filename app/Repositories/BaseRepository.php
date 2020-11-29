<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class BaseRepository
{
    public function findAll($model)
    {
        return $model->all();
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
}
