<?php


namespace App\Services\API\v1\Query;


use App\Repositories\QueryRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;

class GetQueriesByIdService extends QueryRepository
{
    /**
     * Find
     *
     * @param int $id
     * @return Model
     * @throws Exception
     */
    public function execute(int $id): Model
    {
        $client_id_logged = auth()->user()->client->id;
        $query = parent::find($id);

        if(!$query)
            throw new \Exception("A consulta selecionada não foi localizada!", 500);

        if($query->client_id != $client_id_logged)
            throw new \Exception("A consulta selecionada não foi localizada!", 500);

        return $query;
    }
}
