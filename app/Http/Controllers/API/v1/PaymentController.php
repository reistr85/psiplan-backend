<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\Payment\CreatePaymentUniqueQueryPagarmeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentController extends Controller
{

    private $createPaymentUniqueQueryPagarmeService;

    public function __construct(
        CreatePaymentUniqueQueryPagarmeService $createPaymentUniqueQueryPagarmeService)
    {
        $this->createPaymentUniqueQueryPagarmeService = $createPaymentUniqueQueryPagarmeService;
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

            $response = $this->createPaymentUniqueQueryPagarmeService->execute($data);

            return response()->json(['status' => true, 'message' => 'Success', 'transaction' => $response], 200);
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
