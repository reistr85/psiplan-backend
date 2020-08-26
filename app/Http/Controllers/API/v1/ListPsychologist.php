<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\ListPsychologistService;
use Illuminate\Http\Request;

class ListPsychologist extends Controller
{
    private $listPsychologistService;

    public function __construct(ListPsychologistService $listPsychologistService)
    {
        $this->listPsychologistService = $listPsychologistService;
    }

    public function index(Request $request)
    {
        try{
            $params = $request->only(['city_id', 'target_audience_id', 'genre_id', 'order_price', 'specialty_id', 'language_id']);
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
}
