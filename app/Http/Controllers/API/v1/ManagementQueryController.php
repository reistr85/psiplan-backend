<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\CouponSourceEnum;
use App\Enums\CouponStatusPaymentEnum;
use App\Http\Controllers\Controller;
use App\Services\API\v1\Client\StoreCouponClientService;
use App\Services\API\v1\Management\DestroyQueryService;
use App\Services\API\v1\Management\GetQueriesServices;
use App\Services\API\v1\Management\GetQueryByIdService;
use App\Services\API\v1\Management\UpdateQueryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagementQueryController extends Controller
{
    private $get_queries_service;
    private $update_query_service;
    private $destroy_query_service;
    private $store_coupon_client_service;
    private $get_query_by_id_service;

    public function __construct(
        GetQueriesServices $get_queries_service,
        UpdateQueryService $update_query_service,
        DestroyQueryService $destroy_query_service,
        StoreCouponClientService $store_coupon_client_service,
        GetQueryByIdService $get_query_by_id_service)
    {
        $this->get_queries_service = $get_queries_service;
        $this->update_query_service = $update_query_service;
        $this->destroy_query_service = $destroy_query_service;
        $this->store_coupon_client_service = $store_coupon_client_service;
        $this->get_query_by_id_service = $get_query_by_id_service;
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
            $psychologist = $user->psychologist;
            $queries = $this->get_queries_service->execute($psychologist->id);

            return response()->json(['status' => true, 'message' => 'success', 'queries' => $queries], 200);
        }catch (\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try{
            $data = $request->all();
            $this->update_query_service->execute($id, $data);

            return response()->json(['status' => true, 'message' => 'success'], 200);
        }catch (\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $query = $this->get_query_by_id_service->execute($id);
            $response = $this->destroy_query_service->execute($id);

            if($response && $query->status_payment == CouponStatusPaymentEnum::STATUS_PAYMENT_PAID)
                $coupons = $this->store_coupon_client_service
                    ->execute($query->psychologist_id, $query->client_id,
                        CouponSourceEnum::QUERY_CANCELED, 1,
                        CouponStatusPaymentEnum::STATUS_PAYMENT_PAID);

            DB::commit();
            return response()->json(['status' => true, 'message' => 'success'], 200);
        }catch (\Exception $ex){
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }
}
