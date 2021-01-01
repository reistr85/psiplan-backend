<?php


namespace App\Observers\API\v1;


use App\Models\Client;

class ClientObserver
{
    public function creating(Client $client)
    {
        $client->is_active = 1;
    }
}
