<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    public function findAll($model)
    {
        return $model->all();
    }

    /**
    * Update Base
    *
    * @param Model
    * @param array $data
    * @return bool
    */
    public function update($model, $data)
    {
        return $model->update($data);
    }
}
