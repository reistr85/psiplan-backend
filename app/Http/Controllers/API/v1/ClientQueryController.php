<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Query\GetAllQueriesByClientIdService;
use App\Services\API\v1\Client\GetClientByUserIdService;
use Illuminate\Http\Request;

class ClientQueryController extends Controller
{
    private $getClientByUserIdService;
    private $getAllQueriesByClientIdService;

    public function __construct(
        GetClientByUserIdService $getClientByUserIdService,
        GetAllQueriesByClientIdService $getAllQueriesByClientIdService)
    {
        $this->getClientByUserIdService = $getClientByUserIdService;
        $this->getAllQueriesByClientIdService = $getAllQueriesByClientIdService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
