<?php


namespace App\Services\API\v1\Query;

use App\Repositories\QueryRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class GetAllQueriesByClientIdService extends QueryRepository
{
    /**
     * Execute
     *
     * @param int $client_id
     * @return Collection
     * @throws Exception
     */
    public function execute(int $client_id): Collection
    {
        $queries = parent::getAllQueriesFindByClientId($client_id);

        return $queries;
    }
}
