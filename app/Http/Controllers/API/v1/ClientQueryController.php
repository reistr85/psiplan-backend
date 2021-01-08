<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Query\GetAllQueriesByClientIdService;
use App\Services\API\v1\Client\GetClientByUserIdService;
use App\Services\API\v1\Query\GetQueriesByIdService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientQueryController extends Controller
{
    private $getClientByUserIdService;
    private $getAllQueriesByClientIdService;
    private $getQueriesByIdService;

    public function __construct(
        GetClientByUserIdService $getClientByUserIdService,
        GetAllQueriesByClientIdService $getAllQueriesByClientIdService,
        GetQueriesByIdService $getQueriesByIdService)
    {
        $this->getClientByUserIdService = $getClientByUserIdService;
        $this->getAllQueriesByClientIdService = $getAllQueriesByClientIdService;
        $this->getQueriesByIdService = $getQueriesByIdService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
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
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try{
            $user = auth()->user();
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
