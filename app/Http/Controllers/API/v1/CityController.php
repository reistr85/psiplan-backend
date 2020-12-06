<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\City\GetCitiesByNameService;
use App\Services\API\v1\City\GetCitiesByStateService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private $getCitiesByStateService;
    private $getCitiesByNameService;

    public function __construct(GetCitiesByStateService $getCitiesByStateService, GetCitiesByNameService $getCitiesByNameService)
    {
        $this->getCitiesByStateService = $getCitiesByStateService;
        $this->getCitiesByNameService = $getCitiesByNameService;
    }

    public function index(Request $request)
    {
        try{
            $cities = $this->getCitiesByStateService->execute($request->input('state'));

            return response()->json(['status' => true, 'message' => 'Successfully', 'cities' => $cities], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    public function getCitiesByName(Request $request)
    {
        try{
            $cities = $this->getCitiesByNameService->execute($request->input('name'));

            return response()->json(['status' => true, 'message' => 'Successfully', 'cities' => $cities], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
