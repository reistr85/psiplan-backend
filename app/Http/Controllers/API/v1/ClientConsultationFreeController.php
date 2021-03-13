<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Client\RequestConsultationFreeClientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientConsultationFreeController extends Controller
{
    private $request_consultation_free_client_service;

    public function __construct(
        RequestConsultationFreeClientService $request_consultation_free_client_service)
    {
        $this->request_consultation_free_client_service = $request_consultation_free_client_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $user = auth()->user();
            $client = $user->client;
            $psychologist_id = $request->input('psychologist_id');
            $this->request_consultation_free_client_service->execute($client, $psychologist_id);

            DB::commit();
            return response()->json(['status' => true, 'message' => 'success'], 200);
        }catch (\Exception $ex){
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
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
