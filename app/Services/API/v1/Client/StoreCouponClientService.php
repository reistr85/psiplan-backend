<?php


namespace App\Services\API\v1\Client;


use App\Enums\CouponSituationEnum;
use App\Enums\CouponStatusPaymentEnum;
use App\Repositories\ClientRepository;
use App\Repositories\CouponRepository;
use App\Repositories\PsychologistRepository;
use DateTime;

class StoreCouponClientService
{
    private $coupon_repository;
    private $psychologist_repository;
    private $client_repository;

    public function __construct(
        CouponRepository $coupon_repository,
        PsychologistRepository $psychologist_repository,
        ClientRepository $client_repository)
    {
        $this->coupon_repository = $coupon_repository;
        $this->psychologist_repository = $psychologist_repository;
        $this->client_repository = $client_repository;
    }

    public function execute(int $psychologist_id, int $client_id, $source, int $qtd, string $status_payment)
    {
        $coupons = [];

        for ($i=1; $i<=$qtd; $i++) {
            $mt = explode(' ', microtime());
            $cp = ((int)$mt[1]) * 1000000 + ((int)round($mt[0] * 1000000));

            $data_coupon = [
                'psychologist_id' => $psychologist_id,
                'client_id' => $client_id,
                'query_id' => null,
                'coupon' => "{$psychologist_id}{$cp}{$psychologist_id}",
                'situation' => CouponSituationEnum::SITUATION_NOT_USED,
                'status_payment' => $status_payment,
                'source' => $source,
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
