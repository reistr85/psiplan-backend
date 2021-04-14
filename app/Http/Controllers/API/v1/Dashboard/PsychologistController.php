<?php

namespace App\Http\Controllers\API\v1\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Dashboard\GetAllPsychologistsService;
use App\Services\API\v1\Dashboard\GetPsychologistService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\API\v1\Dashboard\UpdatePsychologistService;

class PsychologistController extends Controller
{

    private $get_all_psychologists_service;
    private $get_psychologist_service;
    private $update_psychologist;

    public function __construct(
        GetAllPsychologistsService $get_all_psychologists_service,
        GetPsychologistService $get_psychologist_service,
        UpdatePsychologistService $update_psychologist)
    {
        $this->get_all_psychologists_service = $get_all_psychologists_service;
        $this->get_psychologist_service = $get_psychologist_service;
        $this->update_psychologist = $update_psychologist;
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
        try {
            $psychologist = $this->get_psychologist_service->execute($id);

            return response()->json(['status' => true, 'message' => 'success', 'psychologist' => $psychologist], 200);
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
      try {
          $this->update_psychologist->execute($id, $request->all());

          return response()->json(['status' => true, 'message' => 'success'], 200);
      }catch(\Exception $ex){
          return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
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
