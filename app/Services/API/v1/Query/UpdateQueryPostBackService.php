<?php


namespace App\Services\API\v1\Query;


use App\Enums\CouponSituationEnum;
use App\Repositories\CouponRepository;
use App\Repositories\QueryRepository;
use App\Enums\CouponSourceEnum;
use App\Enums\QueryStatusPaymentEnum;
use App\Enums\CouponStatusPaymentEnum;
use App\Services\API\v1\Client\StoreCouponClientService;

class UpdateQueryPostBackService
{
    private $query_repository;
    private $coupon_repository;
    private $store_coupon_client_service;

    public function __construct(
        QueryRepository $query_repository,
        CouponRepository $coupon_repository,
        StoreCouponClientService $store_coupon_client_service)
    {
        $this->query_repository = $query_repository;
        $this->coupon_repository = $coupon_repository;
        $this->store_coupon_client_service = $store_coupon_client_service;
    }

    public function execute(int $query_id, array $data, $query_box)
    {
        $query = $this->query_repository->find($query_id);

        if(!$query)
            throw new \Exception("Consulta não encontrada", 500);

        if($query_box == 'yes' && $data['status_payment'] == QueryStatusPaymentEnum::STATUS_PAYMENT_PAID ||
            $query->status_payment != QueryStatusPaymentEnum::STATUS_PAYMENT_PAID){
          $coupons = $this->store_coupon_client_service
              ->execute($query->psychologist_id, $query->client_id,  CouponSourceEnum::QUERY_PACKAGE, 4,
                  CouponStatusPaymentEnum::STATUS_PAYMENT_PAID);

          if(count($coupons)) {
              $coupon_id = $coupons[0]['id'];
              $data['coupon_id'] = $coupon_id;
          }
        }

        $coupon = $this->coupon_repository->find($data['coupon_id']);
        $query_update = $this->query_repository->edit($query, $data);

        if($query_update)
            return $this->coupon_repository->edit($coupon, [
                'query_id' => $query_id,
                'situation' => CouponSituationEnum::SITUATION_USED
            ]);
    }
}
