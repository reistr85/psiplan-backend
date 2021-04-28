<?php

namespace App\Http\Controllers\API\v1\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Dashboard\GetAllSearchPeriodService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchPeriodController extends Controller
{
    private $get_all_search_period_service;

    public function __construct(
        GetAllSearchPeriodService $get_all_search_period_service
    )
    {
        $this->get_all_search_period_service = $get_all_search_period_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $type
     * @param $data_initial
     * @param $data_final
     * @return JsonResponse
     */
    public function index($type, $data_initial, $data_final)
    {
        try {
            $items = $this->get_all_search_period_service->execute($type, $data_initial, $data_final);

            return response()->json(['status' => false, 'message' => 'success', 'items' => $items], 200);
        }catch(\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * @param  \Illuminate\Http\Request  $request
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
