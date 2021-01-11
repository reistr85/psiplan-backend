<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\QueryPaymentClientRequest;
use App\Services\API\v1\PaymentQueryClient\CreatePagarmeTransactionService;
use App\Services\API\v1\PaymentQueryClient\CreatePaymentClientUniqueQueryPagarmeService;
use App\Services\API\v1\PaymentQueryClient\GetAllTransactionsPagarmeClientService;
use App\Services\API\v1\Query\UpdateQueryPaymentStatusService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentQueryClientController extends Controller
{

    private $createPaymentClientUniqueQueryPagarmeService;
    private $createPagarmeTransactionService;
    private $updateQueryPaymentStatusService;
    private $getAllTransactionsPagarmeClientService;

    public function __construct(
        CreatePaymentClientUniqueQueryPagarmeService $createPaymentClientUniqueQueryPagarmeService,
        CreatePagarmeTransactionService $createPagarmeTransactionService,
        UpdateQueryPaymentStatusService $updateQueryPaymentStatusService,
        GetAllTransactionsPagarmeClientService $getAllTransactionsPagarmeClientService)
    {
        $this->createPaymentClientUniqueQueryPagarmeService = $createPaymentClientUniqueQueryPagarmeService;
        $this->createPagarmeTransactionService = $createPagarmeTransactionService;
        $this->updateQueryPaymentStatusService = $updateQueryPaymentStatusService;
        $this->getAllTransactionsPagarmeClientService = $getAllTransactionsPagarmeClientService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
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
     * @return Response
     */
    public function store(QueryPaymentClientRequest $request)
    {
        try{
            $user = auth()->user();
            $data = $request->all();

            $response = $this->createPaymentClientUniqueQueryPagarmeService->execute($user->client->id, $data);
            $query_id = $response->items[0]->id;

            $pagarme_transaction = $this->createPagarmeTransactionService->execute(
                $user->id,
                [
                    'user_id' => $user->id,
                    'transaction_id' => $response->id,
                    'query_id' => $query_id,
                    'status' => $response->status,
                    'amount' => $response->amount,
                ]);

            $this->updateQueryPaymentStatusService->execute($query_id, [
                'transaction_id' => $response->id,
                'status_payment' => $response->status,
            ]);

            return response()->json(['status' => true, 'message' => 'Seu pagamento foi efetuado com sucesso.', 'pagarme_transaction' => $pagarme_transaction], 200);
        }catch (\Exception $ex){
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
