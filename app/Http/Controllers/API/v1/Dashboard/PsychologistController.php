<?php

namespace App\Http\Controllers\API\v1\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Dashboard\GetAllPsychologistsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PsychologistController extends Controller
{

    private $get_all_psychologists_service;

    public function __construct(
        GetAllPsychologistsService $get_all_psychologists_service)
    {
        $this->get_all_psychologists_service = $get_all_psychologists_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $psychologists = $this->get_all_psychologists_service->execute();

            return response()->json(['status' => false, 'message' => 'success', 'psychologists' => $psychologists], 200);
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
     * @return Response
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
