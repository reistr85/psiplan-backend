<?php


namespace App\Services\API\v1\Query;


use App\Repositories\QueryRepository;

class UpdateQueryPaymentStatusService extends QueryRepository
{
    public function execute(int $id, array $data)
    {
        $query = parent::find($id);

        if(!$query)
            throw new \Exception("A consulta não foi localizada!", 400);

        $query->update($data);
    }
}
