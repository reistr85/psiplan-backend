<?php


namespace App\Services\API\v1\Client;


use App\Enums\CouponSituationEnum;
use App\Enums\CouponStatusPaymentEnum;
use App\Repositories\CouponRepository;
use App\Repositories\PsychologistRepository;
use DateTime;

class StoreCouponClientService
{
    private $coupon_repository;
    private $psychologist_repository;

    public function __construct(
        CouponRepository $coupon_repository,
        PsychologistRepository $psychologist_repository)
    {
        $this->coupon_repository = $coupon_repository;
        $this->psychologist_repository = $psychologist_repository;
    }

    public function execute(array $data)
    {
        if(!$data['query_box'])
            return null;

        $coupons = [];
        $psychologist = $this->psychologist_repository->find($data['psychologist_id']);
        $client = auth()->user()->client;

        for ($i=0; $i<=3; $i++) {
            $mt = explode(' ', microtime());
            $cp = ((int)$mt[1]) * 1000000 + ((int)round($mt[0] * 1000000));

            $data_coupon = [
                'psychologist_id' => $psychologist->id,
                'client_id' => $client->id,
                'coupon' => "{$psychologist->id}{$cp}{$psychologist->id}",
                'situation' => CouponSituationEnum::SITUATION_NOT_USED,
                'status_payment' => CouponStatusPaymentEnum::STATUS_PAYMENT_UNPAID,
            ];

            array_push($coupons, $this->coupon_repository->store($data_coupon));
        }

        return $coupons;
    }

    function microseconds() {
        $mt = explode(' ', microtime());
        return ((int)$mt[1]) * 1000000 + ((int)round($mt[0] * 1000000));
    }
}
