<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\NotificationsEnum;
use App\Enums\NotificationsStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StoreClientQueryRequest;
use App\Jobs\FreeDayScheduling;
use App\Services\API\v1\Client\StoreClientQueryService;
use App\Services\API\v1\Client\StoreCouponClientService;
use App\Services\API\v1\Client\UpdateAllCouponsByCouponsService;
use App\Services\API\v1\Psychologist\GetPsychologistByIdService;
use App\Services\API\v1\Query\GetAllQueriesByClientIdService;
use App\Services\API\v1\Client\GetClientByUserIdService;
use App\Services\API\v1\Query\GetQueriesByIdService;
use App\Services\API\v1\User\StoreUserNotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientQueryController extends Controller
{
    private $getClientByUserIdService;
    private $getAllQueriesByClientIdService;
    private $getQueriesByIdService;
    private $storeClientQueryService;
    private $store_coupon_client_service;
    private $update_all_coupons_by_coupons_service;
    private $store_user_notification_service;
    private $get_psychologist_by_id_service;

    public function __construct(
        GetClientByUserIdService $getClientByUserIdService,
        GetAllQueriesByClientIdService $getAllQueriesByClientIdService,
        GetQueriesByIdService $getQueriesByIdService,
        StoreClientQueryService $storeClientQueryService,
        StoreCouponClientService $store_coupon_client_service,
        UpdateAllCouponsByCouponsService $update_all_coupons_by_coupons_service,
        StoreUserNotificationService $store_user_notification_service,
        GetPsychologistByIdService $get_psychologist_by_id_service)
    {
        $this->getClientByUserIdService = $getClientByUserIdService;
        $this->getAllQueriesByClientIdService = $getAllQueriesByClientIdService;
        $this->getQueriesByIdService = $getQueriesByIdService;
        $this->storeClientQueryService = $storeClientQueryService;
        $this->store_coupon_client_service = $store_coupon_client_service;
        $this->update_all_coupons_by_coupons_service = $update_all_coupons_by_coupons_service;
        $this->store_user_notification_service = $store_user_notification_service;
        $this->get_psychologist_by_id_service = $get_psychologist_by_id_service;
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
            $client = $user->client;
            $queries = $this->getAllQueriesByClientIdService->execute($client->id);

            return response()->json(['status' => true, 'message' => 'Success', 'client' => $client, 'queries' => $queries], 200);
        }catch(\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientQueryRequest $request
     * @return JsonResponse
     */
    public function store(StoreClientQueryRequest $request)
    {
        DB::beginTransaction();
        try{
            $client = auth()->user()->client;
            $data = $request->all();
            $coupons = [];

            $query = $this->storeClientQueryService->execute($data, $coupons);
            $this->update_all_coupons_by_coupons_service->execute($coupons, ['query_id' => $query->id]);
            FreeDayScheduling::dispatch($query)->delay(now()->addMinutes(env('TIME_QUERY_CANCELED')));

            $data_notification_client = [
                'user_id' => $client->user_id,
                'notification_id' => NotificationsEnum::NOTIFICATION_NEW_QUERY['id'],
                'title' => NotificationsEnum::NOTIFICATION_NEW_QUERY['title'],
                'description' => NotificationsEnum::NOTIFICATION_NEW_QUERY['description'],
                'status' => NotificationsStatusEnum::STATUS_NOT_READ,
                'details' => NotificationsEnum::NOTIFICATION_NEW_QUERY['details'],
            ];

            $psychologist = $this->get_psychologist_by_id_service->execute($data['psychologist_id']);
            $data_notification_psychologist = [
                'user_id' => $psychologist->user_id,
                'notification_id' => NotificationsEnum::NOTIFICATION_NEW_QUERY['id'],
                'title' => NotificationsEnum::NOTIFICATION_NEW_QUERY['title'],
                'description' => NotificationsEnum::NOTIFICATION_NEW_QUERY['description'],
                'status' => NotificationsStatusEnum::STATUS_NOT_READ,
                'details' => NotificationsEnum::NOTIFICATION_NEW_QUERY['details'],
            ];

            $this->store_user_notification_service->execute($data_notification_client);
            $this->store_user_notification_service->execute($data_notification_psychologist);

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Success', 'query' => $query], 200);
        }catch(\Exception $ex){
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try{
            $query = $this->getQueriesByIdService->execute($id);

            return response()->json(['status' => true, 'message' => 'Success', 'query' => $query], 200);
        }catch(\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }
}
