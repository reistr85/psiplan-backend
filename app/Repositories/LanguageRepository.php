<?php


namespace App\Repositories;


use App\Models\Language;

class LanguageRepository extends BaseRepository
{
    private $model;

    public function __construct(Language $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return parent::findAll($this->model);
    }
}
