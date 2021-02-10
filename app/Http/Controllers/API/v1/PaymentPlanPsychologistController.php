<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\PlanPaymentPsychologistRequest;
use App\Services\API\v1\PaymentPlanPsychologist\CreatePaymentPlanPsychologistPagarmeService;
use App\Services\API\v1\PaymentPlanPsychologist\ReversePaymentPlanPsychologistService;
use App\Services\API\v1\PaymentPlanPsychologist\ReverseSubscriptionPsychologistService;
use App\Services\API\v1\Psychologist\CreateOrUpdatePsychologistAddressService;
use App\Services\API\v1\Psychologist\CreatePagarmeSubscriptionService;
use App\Services\API\v1\Psychologist\CreatePagarmeSubscriptionTransactionService;
use App\Services\API\v1\Psychologist\CreatePsychologistPlanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Exception\Exception;

class PaymentPlanPsychologistController extends Controller
{

    private $create_payment_plan_psychologist_pagarme_service;
    private $create_or_update_psychologist_address_service;
    private $reverse_payment_plan_psychologist_service;
    private $reverse_subscription_psychologist_service;
    private $create_psychologist_plan_service;
    private $create_pagarme_subscription_service;
    private $create_pagarme_subscription_transaction_service;

    public function __construct(
        CreatePaymentPlanPsychologistPagarmeService $create_payment_plan_psychologist_pagarme_service,
        CreateOrUpdatePsychologistAddressService $create_or_update_psychologist_address_service,
        ReversePaymentPlanPsychologistService $reverse_payment_plan_psychologist_service,
        ReverseSubscriptionPsychologistService $reverse_subscription_psychologist_service,
        CreatePsychologistPlanService $create_psychologist_plan_service,
        CreatePagarmeSubscriptionService $create_pagarme_subscription_service,
        CreatePagarmeSubscriptionTransactionService $create_pagarme_subscription_transaction_service)
    {
        $this->create_payment_plan_psychologist_pagarme_service = $create_payment_plan_psychologist_pagarme_service;
        $this->create_or_update_psychologist_address_service = $create_or_update_psychologist_address_service;
        $this->reverse_payment_plan_psychologist_service = $reverse_payment_plan_psychologist_service;
        $this->reverse_subscription_psychologist_service = $reverse_subscription_psychologist_service;
        $this->create_psychologist_plan_service = $create_psychologist_plan_service;
        $this->create_pagarme_subscription_service = $create_pagarme_subscription_service;
        $this->create_pagarme_subscription_transaction_service = $create_pagarme_subscription_transaction_service;
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
        $subscription_id = '';
        $transaction_id = '';

        DB::beginTransaction();
        try {
            $user= auth()->user();

            $this->create_or_update_psychologist_address_service->execute($request->input('customer.address'));
            $transaction = $this->create_payment_plan_psychologist_pagarme_service->execute(
                $request->all(), $subscription_id, $transaction_id);

            if($transaction->current_transaction->status != "paid") {
                $this->reverse_payment_plan_psychologist_service->execute($transaction_id);
                $this->reverse_subscription_psychologist_service->execute($subscription_id);
                return response()->json(['status' => false, 'message' => 'Ocorreu um erro ao contratar o plano. Tente novamente!'], 500);
            }

            $psychologist_plan = $this->create_psychologist_plan_service->execute($request->input('plan_selected.name'));
            $this->create_pagarme_subscription_service->execute([
                'user_id' => $user->id,
                'plan_id' => $psychologist_plan->plan_id,
                'pagarme_subscription_id' => $subscription_id,
                'pagarme_status' => $transaction->status,
            ]);
            $this->create_pagarme_subscription_transaction_service->execute();

            DB::commit();
            return response()->json(['status' => true, 'message' => 'success', 'transaction' => $transaction], 201);
        }catch (\Exception $ex){
            DB::rollBack();

            $this->reverse_payment_plan_psychologist_service->execute($transaction_id);
            $this->reverse_subscription_psychologist_service->execute($subscription_id);
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
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
