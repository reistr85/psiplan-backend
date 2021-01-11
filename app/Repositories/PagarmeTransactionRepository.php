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

    public function all()
    {
        return parent::findAll($this->model);
    }

    public function getAllByClientId(int $client_id)
    {
        return $this->model::select("pagarme_transactions.id", "queries.day_hour", "pagarme_transactions.status",
            "pagarme_transactions.status", "pagarme_transactions.amount", "pagarme_transactions.transaction_id")
            ->where('client_id', $client_id)
            ->join('queries', 'query_id', 'queries.id')
            ->join('psychologists', 'queries.psychologist_id', 'psychologists.id');
    }

    public function create(array $data)
    {
        return parent::save($this->model, $data);
    }
}
