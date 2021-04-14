<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\CouponSituationEnum;
use App\Enums\CouponStatusPaymentEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\QueryPaymentClientRequest;
use App\Services\API\v1\Client\UpdateAllCouponsByQueryIdService;
use App\Services\API\v1\Client\UpdateCouponClientByIdService;
use App\Services\API\v1\PaymentQueryClient\CreatePagarmeTransactionService;
use App\Services\API\v1\PaymentQueryClient\CreatePaymentClientUniqueQueryPagarmeService;
use App\Services\API\v1\PaymentQueryClient\CreatePaymentQueryClientCouponService;
use App\Services\API\v1\PaymentQueryClient\GetAllTransactionsPagarmeClientService;
use App\Services\API\v1\Query\GetQueriesByIdService;
use App\Services\API\v1\Query\UpdateQueryByIdService;
use App\Services\API\v1\SendEmail\SendEmailNewQueryClientService;
use App\Services\API\v1\SendEmail\SendEmailNewQueryPsychologistService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PaymentQueryClientController extends Controller
{

    private $createPaymentClientUniqueQueryPagarmeService;
    private $createPagarmeTransactionService;
    private $update_query_by_id_service;
    private $getAllTransactionsPagarmeClientService;
    private $get_query_by_id_service;
    private $update_coupon_client_by_id_service;
    private $update_all_coupons_by_query_id_service;
    private $create_payment_query_client_coupon_service;
    private $send_email_new_query_client_service;
    private $send_email_new_query_psychologist_service;

    public function __construct(
        CreatePaymentClientUniqueQueryPagarmeService $createPaymentClientUniqueQueryPagarmeService,
        CreatePagarmeTransactionService $createPagarmeTransactionService,
        UpdateQueryByIdService $update_query_by_id_service,
        GetAllTransactionsPagarmeClientService $getAllTransactionsPagarmeClientService,
        GetQueriesByIdService $get_query_by_id_service,
        UpdateCouponClientByIdService $update_coupon_client_by_id_service,
        UpdateAllCouponsByQueryIdService $update_all_coupons_by_query_id_service,
        CreatePaymentQueryClientCouponService $create_payment_query_client_coupon_service,
        SendEmailNewQueryClientService $send_email_new_query_client_service,
        SendEmailNewQueryPsychologistService $send_email_new_query_psychologist_service)
    {
        $this->createPaymentClientUniqueQueryPagarmeService = $createPaymentClientUniqueQueryPagarmeService;
        $this->createPagarmeTransactionService = $createPagarmeTransactionService;
        $this->update_query_by_id_service = $update_query_by_id_service;
        $this->getAllTransactionsPagarmeClientService = $getAllTransactionsPagarmeClientService;
        $this->get_query_by_id_service = $get_query_by_id_service;
        $this->update_coupon_client_by_id_service = $update_coupon_client_by_id_service;
        $this->update_all_coupons_by_query_id_service = $update_all_coupons_by_query_id_service;
        $this->create_payment_query_client_coupon_service = $create_payment_query_client_coupon_service;
        $this->send_email_new_query_client_service = $send_email_new_query_client_service;
        $this->send_email_new_query_psychologist_service = $send_email_new_query_psychologist_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try{
            $user = auth()->user();
            $transactions = $this->getAllTransactionsPagarmeClientService->execute($user->client->id);


            return response()->json(['status' => true, 'message' => 'Success', 'transactions' => $transactions], 200);
        }catch (\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QueryPaymentClientRequest $request
     * @return JsonResponse
     */
    public function store(QueryPaymentClientRequest $request)
    {
        DB::beginTransaction();
        try{
            $user = auth()->user();
            $query = $this->get_query_by_id_service->execute($request->input('query_id'));
            $data = $request->all();

            if($data['coupon']){
                $this->create_payment_query_client_coupon_service->execute($query->id, $data['coupon']);

                DB::commit();
                return response()->json(['status' => true, 'message' => 'Realizado com Sucesso'], 200);
            }

            $data['amount'] = $query->price;
            $data['metadata']['query_id'] = $query->id;
            $data['metadata']['client_id'] = $query->client_id;
            $data['metadata']['psychologist_id'] = $query->psychologist_id;
            $data['metadata']['model'] = 'Query';
            $data['metadata']['model_id'] = $query->id;
            $data['metadata']['query_box'] = $query->query_box;

            $response = $this->createPaymentClientUniqueQueryPagarmeService->execute($user->client->id, $data);
            $amount = $response->amount;

            $pagarme_transaction = $this->createPagarmeTransactionService->execute(
                $user->id,
                [
                    'user_id' => $user->id,
                    'transaction_id' => $response->id,
                    'query_id' => $query->id,
                    'status' => $response->status,
                    'amount' => substr($amount, '0', (strlen($amount)-2)).".".substr($amount, (strlen($amount)-2), (strlen($amount))),
                    'payment_method' => $response->payment_method,
                    'billet_url' => $response->boleto_url,
                    'billet_barcode' => $response->boleto_barcode,
                ]);

            $this->update_query_by_id_service->execute($query->id, [
                'transaction_id' => $response->id,
                'status_payment' => $response->status,
            ]);

            if($response->status == CouponStatusPaymentEnum::STATUS_PAYMENT_PAID && $query->coupon_id) {
                $dataCoupon = [
                    'status_payment' => CouponStatusPaymentEnum::STATUS_PAYMENT_PAID,
                    'situation' => CouponSituationEnum::SITUATION_USED,
                ];

                $this->update_all_coupons_by_query_id_service->execute($query->id, ['status_payment' => CouponStatusPaymentEnum::STATUS_PAYMENT_PAID]);
                $this->update_coupon_client_by_id_service
                    ->execute($dataCoupon, $query->coupon_id);
            }

            $this->send_email_new_query_client_service->execute($query->id);
            $this->send_email_new_query_psychologist_service->execute($query->id);

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Seu pagamento foi efetuado com sucesso.', 'pagarme_transaction' => $pagarme_transaction], 200);
        }catch (\Exception $ex){
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
