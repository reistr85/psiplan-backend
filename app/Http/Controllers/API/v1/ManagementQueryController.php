<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Management\GetQueriesServices;
use App\Services\API\v1\Management\UpdateQueryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ManagementQueryController extends Controller
{
    private $get_queries_service;
    private $update_query_service;

    public function __construct(
        GetQueriesServices $get_queries_service,
        UpdateQueryService $update_query_service)
    {
        $this->get_queries_service = $get_queries_service;
        $this->update_query_service = $update_query_service;
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
            return response()->json(['status' => false, 'message' => $ex->getMessage()], $ex->getCode());
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
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try{
            $user = auth()->user();
            $data = $request->all();
            $this->update_query_service->execute($id, $data);

            return response()->json(['status' => true, 'message' => 'success'], 200);
        }catch (\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], $ex->getCode());
        }
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
