<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\ListPsychologistService;
use Illuminate\Http\Request;

class ListPsychologist extends Controller
{
    private $listPsychologistService;
    private $getPsychologistByUserIdService;

    public function __construct(
        ListPsychologistService $listPsychologistService,
        GetPsychologistByUserIdService $getPsychologistByUserIdService)
    {
        $this->listPsychologistService = $listPsychologistService;
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
    }

    public function index(Request $request)
    {
        try{
            $params = $request->only(['text', 'city_id', 'target_audience_id', 'genre_id', 'order_price', 'specialty_id', 'language_id']);
            $return = $this->listPsychologistService->index($params);

            return response()->json($return, 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function getFilters(Request $request)
    {
        try{
            $return = $this->listPsychologistService->getFilters();

            return response()->json($return, 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try{
            $psychologist = $this->getPsychologistByUserIdService->execute($id);

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'psychologist' => $psychologist,
            ], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }
}
