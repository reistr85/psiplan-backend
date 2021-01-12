<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\UpdateClientBillingRequest;
use App\Services\API\v1\Client\UpdateClientBillingService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientBillingController extends Controller
{

    private $updateClientBillingService;

    public function __construct(
        UpdateClientBillingService $updateClientBillingService)
    {
        $this->updateClientBillingService = $updateClientBillingService;
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClientBillingRequest $request
     * @return Response
     */
    public function update(UpdateClientBillingRequest $request)
    {
        try{
            $user = auth()->user();
            $client_id = $user->client->id;
            $data = $request->all();

            $this->updateClientBillingService->execute($client_id, $data);

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
