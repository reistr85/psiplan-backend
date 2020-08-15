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

    public function index()
    {
        try{

            $params = true;

            $return = $this->listPsychologistService->index($params);

            return response()->json($return, 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }
}
