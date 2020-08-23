<?php


namespace App\Repositories;


class BaseRepository
{
    public function findAll($model)
    {
        return $model->all();
    }
}
