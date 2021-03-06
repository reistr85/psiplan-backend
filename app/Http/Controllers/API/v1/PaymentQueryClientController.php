<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\CouponSituationEnum;
use App\Enums\CouponStatusPaymentEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\QueryPaymentClientRequest;
use App\Services\API\v1\Client\UpdateStatusPaymentAndSituationCouponClientService;
use App\Services\API\v1\PaymentQueryClient\CreatePagarmeTransactionService;
use App\Services\API\v1\PaymentQueryClient\CreatePaymentClientUniqueQueryPagarmeService;
use App\Services\API\v1\PaymentQueryClient\GetAllTransactionsPagarmeClientService;
use App\Services\API\v1\Query\GetQueriesByIdService;
use App\Services\API\v1\Query\UpdateQueryPaymentStatusService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PaymentQueryClientController extends Controller
{

    private $createPaymentClientUniqueQueryPagarmeService;
    private $createPagarmeTransactionService;
    private $updateQueryPaymentStatusService;
    private $getAllTransactionsPagarmeClientService;
    private $get_query_by_id_service;
    private $update_status_payment_and_situation_coupon_client_service;

    public function __construct(
        CreatePaymentClientUniqueQueryPagarmeService $createPaymentClientUniqueQueryPagarmeService,
        CreatePagarmeTransactionService $createPagarmeTransactionService,
        UpdateQueryPaymentStatusService $updateQueryPaymentStatusService,
        GetAllTransactionsPagarmeClientService $getAllTransactionsPagarmeClientService,
        GetQueriesByIdService $get_query_by_id_service,
        UpdateStatusPaymentAndSituationCouponClientService $update_status_payment_and_situation_coupon_client_service)
    {
        $this->createPaymentClientUniqueQueryPagarmeService = $createPaymentClientUniqueQueryPagarmeService;
        $this->createPagarmeTransactionService = $createPagarmeTransactionService;
        $this->updateQueryPaymentStatusService = $updateQueryPaymentStatusService;
        $this->getAllTransactionsPagarmeClientService = $getAllTransactionsPagarmeClientService;
        $this->get_query_by_id_service = $get_query_by_id_service;
        $this->update_status_payment_and_situation_coupon_client_service = $update_status_payment_and_situation_coupon_client_service;
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
        try{
            $user = auth()->user();
            $query = $this->get_query_by_id_service->execute($request->input('query_id'));
            $data = $request->all();
            $data['amount'] = $query->price;
            $data['metadata']['query_id'] = $query->query_id;
            $data['metadata']['client_id'] = $query->client_id;
            $data['metadata']['psychologist_id'] = $query->psychologist_id;
dd($data);
            $response = $this->createPaymentClientUniqueQueryPagarmeService->execute($user->client->id, $data);
            $amount = $response->amount;

            DB::beginTransaction();
            $pagarme_transaction = $this->createPagarmeTransactionService->execute(
                $user->id,
                [
                    'user_id' => $user->id,
                    'transaction_id' => $response->id,
                    'query_id' => $query->id,
                    'status' => $response->status,
                    'amount' => substr($amount, '0', (strlen($amount)-2)).".".substr($amount, (strlen($amount)-2), (strlen($amount))),
                ]);

            $this->updateQueryPaymentStatusService->execute($query->id, [
                'transaction_id' => $response->id,
                'status_payment' => $response->status,
            ]);

            if($response->status == CouponStatusPaymentEnum::STATUS_PAYMENT_PAID) {
                $this->update_status_payment_and_situation_coupon_client_service->execute([
                    'status_payment' => CouponStatusPaymentEnum::STATUS_PAYMENT_PAID,
                    'situation' => CouponSituationEnum::SITUATION_USED,
                ], $query->coupon_id);
            }

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Seu pagamento foi efetuado com sucesso.', 'pagarme_transaction' => $pagarme_transaction], 200);
        }catch (\Exception $ex){
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $ex->getMessage()], $ex->getCode());
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
