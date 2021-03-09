<?php


namespace App\Services\API\v1\Client;


use App\Repositories\CouponRepository;

class GetAllCouponsByClientIdService
{
    private $coupons_repository;

    public function __construct(
        CouponRepository $coupons_repository)
    {
        $this->coupons_repository = $coupons_repository;
    }
    public function execute(int $client_id)
    {
        return $this->coupons_repository->getAllCouponsByClientId($client_id)->with('psychologist')->get();
    }
}
