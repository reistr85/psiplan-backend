<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\PlanPaymentPsychologistRequest;
use App\Services\API\v1\PaymentPlanPsychologist\CreatePaymentPlanPsychologistPagarmeService;
use App\Services\API\v1\Psychologist\CreateOrUpdatePsychologistAddressService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Exception\Exception;

class PaymentPlanPsychologistController extends Controller
{

    private $create_payment_plan_psychologist_pagarme_service;
    private $create_or_update_psychologist_address_service;

    public function __construct(
        CreatePaymentPlanPsychologistPagarmeService $create_payment_plan_psychologist_pagarme_service,
        CreateOrUpdatePsychologistAddressService $create_or_update_psychologist_address_service)
    {
        $this->create_payment_plan_psychologist_pagarme_service = $create_payment_plan_psychologist_pagarme_service;
        $this->create_or_update_psychologist_address_service = $create_or_update_psychologist_address_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PlanPaymentPsychologistRequest $request
     * @return JsonResponse
     */
    public function store(PlanPaymentPsychologistRequest $request)
    {
        DB::beginTransaction();
        try {
            $psychologist = auth()->user()->psychologist;
            $psychologist_address = $this->create_or_update_psychologist_address_service->execute($request->input('customer.address'));

            $r = $this->create_payment_plan_psychologist_pagarme_service->execute($request->all());

            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'data' => $r], 200);
        }catch (\Exception $ex){
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
