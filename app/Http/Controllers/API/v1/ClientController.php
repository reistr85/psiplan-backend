<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\UpdateClientBillingRequest;
use App\Services\API\v1\Client\CreateClientBillingService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{

    private $createClientBillingService;

    public function __construct(
        CreateClientBillingService $createClientBillingService)
    {
        $this->createClientBillingService = $createClientBillingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

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
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        try{
            $user = auth()->user();
            $client = $user->client;

            return response()->json(['status' => true, 'message' => "Success", 'client' => $client], 200);

        }catch(\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClientBillingRequest $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateClientBillingRequest $request)
    {
        try{
            $user = auth()->user();
            $client_id = $user->client->id;
            $data = $request->all();

            $this->createClientBillingService->execute($client_id, $data);

            return response()->json(['status' => true, 'message' => "Os dados foram salvo com sucesso."], 200);

        }catch(\Exception $ex){
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
