<?php


namespace App\Services\API\v1\Client;


use App\Enums\CouponSituationEnum;
use App\Enums\CouponStatusPaymentEnum;
use App\Repositories\CouponRepository;
use App\Repositories\PsychologistRepository;
use DateTime;
use mysql_xdevapi\Exception;

class UpdateAllCouponsByCouponsService
{
    private $coupon_repository;

    public function __construct(
        CouponRepository $coupon_repository)
    {
        $this->coupon_repository = $coupon_repository;
    }

    public function execute(array $coupons, $data)
    {
        foreach($coupons as $value){
            $this->coupon_repository->edit($value, $data);
        }
    }
}
