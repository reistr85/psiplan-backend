<?php


namespace App\Repositories;


use App\Models\Genre;

class GenreRepository extends BaseRepository
{
    private $model;

    public function __construct(Genre $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return self::findAll($this->model);
    }
}
