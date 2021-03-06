<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\PlanPaymentPsychologistRequest;
use App\Services\API\v1\PaymentPlanPsychologist\CreatePagarmeBankService;
use App\Services\API\v1\PaymentPlanPsychologist\CreatePagarmeRecipientService;
use App\Services\API\v1\PaymentPlanPsychologist\CreatePaymentPlanPsychologistPagarmeService;
use App\Services\API\v1\PaymentPlanPsychologist\GetPagarmeSubscriptionByIdService;
use App\Services\API\v1\PaymentPlanPsychologist\ReversePaymentPlanPsychologistService;
use App\Services\API\v1\PaymentPlanPsychologist\ReverseSubscriptionPsychologistService;
use App\Services\API\v1\PaymentPlanPsychologist\UpdatePagarmePlanPsychologistService;
use App\Services\API\v1\Psychologist\CreateOrUpdatePsychologistAddressService;
use App\Services\API\v1\Psychologist\CreatePagarmeSubscriptionService;
use App\Services\API\v1\Psychologist\CreatePagarmeSubscriptionTransactionService;
use App\Services\API\v1\Psychologist\CreatePsychologistBankService;
use App\Services\API\v1\Psychologist\CreatePsychologistPlanService;
use App\Services\API\v1\Psychologist\DefinePlanPsychologistService;
use App\Services\API\v1\Psychologist\GetPsychologistPlanByNameService;
use App\Services\API\v1\Psychologist\UpdatePsychologistBankService;
use App\Services\API\v1\User\FormatDataGetUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MongoDB\Driver\Exception\Exception;

class PaymentPlanPsychologistController extends Controller
{

    private $create_payment_plan_psychologist_pagarme_service;
    private $create_or_update_psychologist_address_service;
    private $create_psychologist_bank_service;
    private $update_psychologist_bank_service;
    private $create_pagarme_bank_service;
    private $create_pagarme_recipient_service;
    private $reverse_payment_plan_psychologist_service;
    private $reverse_subscription_psychologist_service;
    private $create_psychologist_plan_service;
    private $create_pagarme_subscription_service;
    private $create_pagarme_subscription_transaction_service;
    private $define_plan_psychologist_service;
    private $format_data_get_user_service;
    private $update_pagarme_plan_psychologist_service;
    private $get_pagarme_subscription_by_id_service;
    private $get_psychologist_plan_by_name_service;

    public function __construct(
        CreatePaymentPlanPsychologistPagarmeService $create_payment_plan_psychologist_pagarme_service,
        CreateOrUpdatePsychologistAddressService $create_or_update_psychologist_address_service,
        ReversePaymentPlanPsychologistService $reverse_payment_plan_psychologist_service,
        ReverseSubscriptionPsychologistService $reverse_subscription_psychologist_service,
        CreatePsychologistPlanService $create_psychologist_plan_service,
        CreatePagarmeSubscriptionService $create_pagarme_subscription_service,
        CreatePagarmeSubscriptionTransactionService $create_pagarme_subscription_transaction_service,
        DefinePlanPsychologistService $define_plan_psychologist_service,
        FormatDataGetUserService $format_data_get_user_service,
        UpdatePagarmePlanPsychologistService $update_pagarme_plan_psychologist_service,
        GetPagarmeSubscriptionByIdService $get_pagarme_subscription_by_id_service,
        GetPsychologistPlanByNameService $get_psychologist_plan_by_name_service,
        CreatePsychologistBankService $create_psychologist_bank_service,
        CreatePagarmeBankService $create_pagarme_bank_service,
        CreatePagarmeRecipientService $create_pagarme_recipient_service,
        UpdatePsychologistBankService $update_psychologist_bank_service)
    {
        $this->create_payment_plan_psychologist_pagarme_service = $create_payment_plan_psychologist_pagarme_service;
        $this->create_or_update_psychologist_address_service = $create_or_update_psychologist_address_service;
        $this->reverse_payment_plan_psychologist_service = $reverse_payment_plan_psychologist_service;
        $this->reverse_subscription_psychologist_service = $reverse_subscription_psychologist_service;
        $this->create_psychologist_plan_service = $create_psychologist_plan_service;
        $this->create_pagarme_subscription_service = $create_pagarme_subscription_service;
        $this->create_pagarme_subscription_transaction_service = $create_pagarme_subscription_transaction_service;
        $this->define_plan_psychologist_service = $define_plan_psychologist_service;
        $this->format_data_get_user_service = $format_data_get_user_service;
        $this->update_pagarme_plan_psychologist_service = $update_pagarme_plan_psychologist_service;
        $this->get_pagarme_subscription_by_id_service = $get_pagarme_subscription_by_id_service;
        $this->get_psychologist_plan_by_name_service = $get_psychologist_plan_by_name_service;
        $this->create_psychologist_bank_service = $create_psychologist_bank_service;
        $this->create_pagarme_bank_service = $create_pagarme_bank_service;
        $this->create_pagarme_recipient_service = $create_pagarme_recipient_service;
        $this->update_psychologist_bank_service = $update_psychologist_bank_service;
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
     * @param PlanPaymentPsychologistRequest $request
     * @return JsonResponse
     */
    public function store(PlanPaymentPsychologistRequest $request)
    {
        $subscription_id = '';
        $transaction_id = '';
        $bank_id = '';
        $recipient_id = '';

        DB::beginTransaction();
        try {
            $user= auth()->user();
            $psychologist = $user->psychologist;

            $this->create_or_update_psychologist_address_service->execute($psychologist, $request->input('payment.customer.address'));
            $psychologist_bank = $this->create_psychologist_bank_service->execute($psychologist, $request->input('bank'));
            $this->create_pagarme_bank_service->execute($psychologist_bank, $bank_id);
            $this->create_pagarme_recipient_service->execute($psychologist, $bank_id, $recipient_id);
            $transaction = $this->create_payment_plan_psychologist_pagarme_service->execute(
                $request->input('payment'), $recipient_id, $subscription_id, $transaction_id);

            if($transaction->current_transaction->status != "paid") {
                if($bank_id)
                    //$this->reverse_payment_plan_psychologist_service->execute($transaction_id);

                if($recipient_id)
                    //$this->reverse_subscription_psychologist_service->execute($subscription_id);

                if($subscription_id)
                    $this->reverse_subscription_psychologist_service->execute($subscription_id);

                if($subscription_id)
                    $this->reverse_subscription_psychologist_service->execute($subscription_id);

                return response()->json(['status' => false, 'message' => 'Ocorreu um erro ao contratar o plano. Tente novamente!'], 500);
            }

            $psychologist_plan = $this->create_psychologist_plan_service->execute($psychologist, $request->input('payment.plan_selected.name'));
            $pagarme_subscription = $this->create_pagarme_subscription_service->execute([
                'user_id' => $user->id,
                'psychologist_plan_id' => $psychologist_plan->id,
                'subscription_id' => $subscription_id,
                'status' => $transaction->status,
            ]);

            $amount = $transaction->current_transaction->amount;
            $this->create_pagarme_subscription_transaction_service->execute([
                'user_id' => $user->id,
                'pagarme_subscription_id' => $pagarme_subscription->id,
                'transaction_id' => $transaction->current_transaction->id,
                'status' => $transaction->current_transaction->status,
                'amount' => substr($amount, '0', (strlen($amount)-2)).".".substr($amount, (strlen($amount)-2), (strlen($amount))),
            ]);

            $dataBank['bank_id'] = $bank_id;
            $this->define_plan_psychologist_service->execute($psychologist_plan->plan_id, $recipient_id);
            $this->update_psychologist_bank_service->execute($dataBank);
            $userData = $this->format_data_get_user_service->execute();

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Plano contratado com sucesso', 'user' => $userData], 201);
        }catch (\Exception $ex){
            DB::rollBack();

            if($transaction_id)
                $this->reverse_payment_plan_psychologist_service->execute($transaction_id);

            if($subscription_id)
                $this->reverse_subscription_psychologist_service->execute($subscription_id);

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
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        try{
            $pagarme_subscription = $this->get_pagarme_subscription_by_id_service->execute();
            $this->update_pagarme_plan_psychologist_service->execute(
                $pagarme_subscription, $request->input('plan_name'));
            $psychologist_plan = $this->get_psychologist_plan_by_name_service->execute($request->input('plan_name'));

            $userData = $this->format_data_get_user_service->execute();
            $userData['plan_id'] = encode($psychologist_plan->id);
            $userData['plan_name'] = $psychologist_plan->name;

            return response()->json(['status' => true, 'message' => 'success', 'user' => $userData], 200);
        }catch (\Exception $ex){
            Log::error($ex);
            return response()->json(['status' => false, 'message' => $ex->getMessage()], $ex->getCode());
        }
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
