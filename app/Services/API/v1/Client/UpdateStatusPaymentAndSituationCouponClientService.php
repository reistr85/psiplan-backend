<?php


namespace App\Services\API\v1\Client;


use App\Enums\CouponSituationEnum;
use App\Enums\CouponStatusPaymentEnum;
use App\Repositories\CouponRepository;
use App\Repositories\PsychologistRepository;
use DateTime;

class UpdateStatusPaymentAndSituationCouponClientService
{
    private $coupon_repository;

    public function __construct(
        CouponRepository $coupon_repository)
    {
        $this->coupon_repository = $coupon_repository;
    }

    public function execute(array $data, int $coupon_id)
    {
        $coupon = $this->coupon_repository->find($coupon_id);

        if($coupon->situation == CouponSituationEnum::SITUATION_USED)
            throw new \Exception("Este cupom jä foi utilizado", 500);

        return $this->coupon_repository->edit($coupon, $data);
    }
}
