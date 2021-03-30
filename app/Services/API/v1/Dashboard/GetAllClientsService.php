<?php


namespace App\Services\API\v1\Dashboard;


use App\Repositories\ClientRepository;

class GetAllClientsService
{
    private $client_repository;

    public function __construct(
        ClientRepository $client_repository)
    {
        $this->client_repository = $client_repository;
    }

    public function execute()
    {
        return $this->client_repository->getAll()->get();
    }
}
