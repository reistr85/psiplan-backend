<?php


namespace App\Observers\API\v1;


use App\Models\Query;

class QueryObserver
{
    public function creating(Query $query)
    {
        $query->is_active = 1;
    }
}
