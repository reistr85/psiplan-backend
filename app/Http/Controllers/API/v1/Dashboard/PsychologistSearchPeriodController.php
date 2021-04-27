<?php

namespace App\Http\Controllers\API\v1\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Dashboard\GetAllPsychologistSearchPeriodService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PsychologistSearchPeriodController extends Controller
{

    private $get_all_psychologists_search_period_service;

    public function __construct(
        GetAllPsychologistSearchPeriodService $get_all_psychologists_search_period_service
    )
    {
        $this->get_all_psychologists_search_period_service = $get_all_psychologists_search_period_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $data_initial
     * @param $data_final
     * @return JsonResponse
     */
    public function index($data_initial, $data_final)
    {
        try {
            $psychologists = $this->get_all_psychologists_search_period_service->execute($data_initial, $data_final);

            return response()->json(['status' => false, 'message' => 'success', 'psychologists' => $psychologists], 200);
        }catch(\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
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
     * @return Response
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
