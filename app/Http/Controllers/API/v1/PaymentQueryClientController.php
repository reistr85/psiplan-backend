<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\PaymentQueryClient\CreatePagarmeTransactionService;
use App\Services\API\v1\PaymentQueryClient\CreatePaymentClientUniqueQueryPagarmeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentQueryClientController extends Controller
{

    private $createPaymentClientUniqueQueryPagarmeService;
    private $createPagarmeTransactionService;

    public function __construct(
        CreatePaymentClientUniqueQueryPagarmeService $createPaymentClientUniqueQueryPagarmeService,
        CreatePagarmeTransactionService $createPagarmeTransactionService)
    {
        $this->createPaymentClientUniqueQueryPagarmeService = $createPaymentClientUniqueQueryPagarmeService;
        $this->createPagarmeTransactionService = $createPagarmeTransactionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try{
            $user = auth()->user();
            $data = $request->all();

            $response = $this->createPaymentClientUniqueQueryPagarmeService->execute($data);
            $pagarme_transaction = $this->createPagarmeTransactionService->execute(
                $user->id,
                [
                    'transaction_id' => $response->id,
                    'status' => $response->status,
                    'amount' => $response->amount,
                ]);

            return response()->json(['status' => true, 'message' => 'Success', 'pagarme_transaction' => $pagarme_transaction], 200);
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
