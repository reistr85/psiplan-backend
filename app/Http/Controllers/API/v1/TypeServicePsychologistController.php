<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Psychologist\GetAllTypeServicesByPsychologistIdService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TypeServicePsychologistController extends Controller
{

    private $getAllTypeServicesByPsychologistIdService;

    public function __construct(
        GetAllTypeServicesByPsychologistIdService $getAllTypeServicesByPsychologistIdService)
    {
        $this->getAllTypeServicesByPsychologistIdService = $getAllTypeServicesByPsychologistIdService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try{
            $user = auth()->user();
            $psychologist_id = $user->psychologist->id;

            $type_services = $this->getAllTypeServicesByPsychologistIdService->execute($psychologist_id);

            return response()->json(['status' => true, 'message' => 'Successfully', 'type_services' => $type_services], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
