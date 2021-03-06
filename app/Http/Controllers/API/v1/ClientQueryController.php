<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StoreClientQueryRequest;
use App\Services\API\v1\Client\StoreClientQueryService;
use App\Services\API\v1\Client\StoreCouponClientService;
use App\Services\API\v1\Client\UpdateStatusPaymentAndSituationCouponClientService;
use App\Services\API\v1\Query\GetAllQueriesByClientIdService;
use App\Services\API\v1\Client\GetClientByUserIdService;
use App\Services\API\v1\Query\GetQueriesByIdService;
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

    public function __construct(
        GetClientByUserIdService $getClientByUserIdService,
        GetAllQueriesByClientIdService $getAllQueriesByClientIdService,
        GetQueriesByIdService $getQueriesByIdService,
        StoreClientQueryService $storeClientQueryService,
        StoreCouponClientService $store_coupon_client_service)
    {
        $this->getClientByUserIdService = $getClientByUserIdService;
        $this->getAllQueriesByClientIdService = $getAllQueriesByClientIdService;
        $this->getQueriesByIdService = $getQueriesByIdService;
        $this->storeClientQueryService = $storeClientQueryService;
        $this->store_coupon_client_service = $store_coupon_client_service;
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
            $data = $request->all();

            $coupons = $this->store_coupon_client_service->execute($data);
            $query = $this->storeClientQueryService->execute($data, $coupons);

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Success', 'query' => $query], 200);
        }catch(\Exception $ex){
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $ex->getMessage()], $ex->getCode());
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
