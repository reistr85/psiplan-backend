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

    public function findByQueryId(int $query_id)
    {
        return $this->model->where('query_id', $query_id);
    }

    public function getAllByClientId(int $client_id)
    {
        return $this->model::select("pagarme_transactions.id", "pagarme_transactions.status",
            "pagarme_transactions.status as status_payment", "pagarme_transactions.amount",
            "pagarme_transactions.transaction_id", "pagarme_transactions.payment_method", "pagarme_transactions.billet_url",
            "pagarme_transactions.created_at", "queries.day_hour",
            "queries.id as query_id")
            ->where('client_id', $client_id)
            ->join('queries', 'query_id', 'queries.id')
            ->join('psychologists', 'queries.psychologist_id', 'psychologists.id');
    }

    public function create(array $data)
    {
        return parent::save($this->model, $data);
    }

    public function edit($model, array $data)
    {
        return parent::update($model, $data);
    }
}
