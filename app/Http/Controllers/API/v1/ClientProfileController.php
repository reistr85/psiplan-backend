<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\UpdateClientBillingRequest;
use App\Http\Requests\API\v1\UpdateClientProfileRequest;
use App\Services\API\v1\Client\UpdateClientProfileService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientProfileController extends Controller
{

    private $updateClientProfileService;

    public function __construct(
        UpdateClientProfileService $updateClientProfileService)
    {
        $this->updateClientProfileService = $updateClientProfileService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
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
     * @param UpdateClientProfileRequest $request
     * @return Response
     */
    public function update(UpdateClientProfileRequest $request)
    {
        try{
            $user = auth()->user();
            $client_id = $user->client->id;
            $data = $request->all();

            $this->updateClientProfileService->execute($client_id, $data);

            return response()->json(['status' => true, 'message' => "Os dados foram salvo com sucesso."], 200);

        }catch(\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], $ex->getCode());
        }
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
