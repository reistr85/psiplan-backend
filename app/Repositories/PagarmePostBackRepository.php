<?php


namespace App\Repositories;


use App\Models\PagarmePostBack;

class PagarmePostBackRepository extends BaseRepository
{
    private $model;

    public function __construct(PagarmePostBack $model)
    {
        $this->model = $model;
    }

    public function store($data)
    {
        return parent::save($this->model, $data);
    }
}
