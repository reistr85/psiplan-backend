<?php

namespace App\Http\Controllers\API\v1\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Dashboard\GetAllQueriesService;
use App\Services\API\v1\Dashboard\GetAllPsychologistsService;
use App\Services\API\v1\Dashboard\GetQueryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QueryController extends Controller
{

    private $get_all_queries_service;
    private $get_query_service;

    public function __construct(
        GetAllQueriesService $get_all_queries_service,
        GetQueryService $get_query_service)
    {
        $this->get_all_queries_service = $get_all_queries_service;
        $this->get_query_service = $get_query_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $queries = $this->get_all_queries_service->execute();

            return response()->json(['status' => false, 'message' => 'success', 'queries' => $queries], 200);
        }catch(\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $query = $this->get_query_service->execute($id);

            return response()->json(['status' => false, 'message' => 'success', 'query' => $query], 200);
        }catch(\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
