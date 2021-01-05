<?php


namespace App\Repositories;


use App\Models\PagarmeTransaction;

class PagarmeTransactionRepository extends BaseRepository
{
    private $model;

    public function __construct(PagarmeTransaction $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return parent::save($this->model, $data);
    }
}
