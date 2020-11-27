<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\City\GetCitiesByStateService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private $getCitiesByState;

    public function __construct(GetCitiesByStateService $getCitiesByState)
    {
        $this->getCitiesByState = $getCitiesByState;
    }

    public function index(Request $request)
    {
        try{
            $cities = $this->getCitiesByState->execute($request->input('state'));

            return response()->json(['status' => true, 'message' => 'Successfully', 'cities' => $cities], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
