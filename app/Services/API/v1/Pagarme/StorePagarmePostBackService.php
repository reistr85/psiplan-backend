<?php


namespace App\Services\API\v1\Pagarme;


use App\Models\PagarmePostBack;
use App\Repositories\PagarmePostBackRepository;

class StorePagarmePostBackService
{
    private $pagarme_post_back_repository;

    public function __construct(
        PagarmePostBackRepository $pagarme_post_back_repository)
    {
        $this->pagarme_post_back_repository = $pagarme_post_back_repository;
    }

    public function execute($data)
    {
        if(!$data)
            throw new \Exception("Payload empty", 500);

        if($data['pagarme_post_back_type'] == 'Query'){
            $data['pagarme_post_back_type'] = 'App\\Models\\Query';
        }

        return $this->pagarme_post_back_repository->store($data);
    }
}
