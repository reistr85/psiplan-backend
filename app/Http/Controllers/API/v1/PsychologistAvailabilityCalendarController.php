<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PsychologistAvailabilityCalendarController extends Controller
{
    public function __construct()
    {
    }

    public function store(Request $request)
    {
        try{

            return response()->json(['status' => true, 'message' => 'Registros salvo com sucesso!'], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
