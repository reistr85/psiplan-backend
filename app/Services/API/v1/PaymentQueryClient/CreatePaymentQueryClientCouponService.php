<?php


namespace App\Services\API\v1\PaymentQueryClient;


use App\Enums\CouponSituationEnum;
use App\Enums\CouponStatusPaymentEnum;
use App\Enums\QueryStatusPaymentEnum;
use App\Repositories\CouponRepository;
use App\Repositories\QueryRepository;
use App\Services\API\v1\Client\UpdateCouponClientByIdService;
use App\Services\API\v1\Query\UpdateQueryByIdService;

class CreatePaymentQueryClientCouponService
{
    private $query_repository;
    private $coupon_repository;
    private $update_coupon_client_by_id_service;
    private $update_query_by_id_service;

    public function __construct(
        QueryRepository $query_repository,
        CouponRepository $coupon_repository,
        UpdateCouponClientByIdService $update_coupon_client_by_id_service,
        UpdateQueryByIdService $update_query_by_id_service)
    {
        $this->query_repository = $query_repository;
        $this->coupon_repository = $coupon_repository;
        $this->update_coupon_client_by_id_service = $update_coupon_client_by_id_service;
        $this->update_query_by_id_service = $update_query_by_id_service;
    }

    public function execute(int $query_id, $coupon)
    {
        $coupon = $this->coupon_repository->getCouponByCoupon($coupon)->first();
        $psychologist = $coupon->psychologist;
        $query = $this->query_repository->find($query_id);

        if(!$coupon)
            throw new \Exception("Cupom não localizado.");

        if($coupon->status_payment == CouponStatusPaymentEnum::STATUS_PAYMENT_UNPAID)
            throw new \Exception("Este cupom não está pago.");

        if($coupon->situation == CouponSituationEnum::SITUATION_USED)
            throw new \Exception("Este cupom já foi ultilizado.");

        if($psychologist->id != $query->psychologist_id)
            throw new \Exception("Este cupom não pode ser utilizado com esse Psicólogo.");

        $update_coupon = $this->update_coupon_client_by_id_service
            ->execute([
                'situation' => CouponSituationEnum::SITUATION_USED,
            ], $coupon->id);

        if(!$update_coupon)
            throw new \Exception("Erro no cupom.");

        $query = $this->update_query_by_id_service->execute($query_id, [
            'status_payment' => QueryStatusPaymentEnum::STATUS_PAYMENT_PAID,
        ]);

        if(!$query)
            throw new \Exception("Erro ao pagar a consulta.");

        return true;
    }
}
