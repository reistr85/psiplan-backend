<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Psychologist\GetInfoQueriesService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\TargetAudience\GetAllTargetAudiencesService;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    private $getPsychologistByUserIdService;
    private $getInfoQueriesService;
    private $getTargetAudiencesService;

    public function __construct(GetPsychologistByUserIdService $getPsychologistByUserIdService, GetInfoQueriesService $getInfoQueriesService,
                                GetAllTargetAudiencesService $getTargetAudiencesService)
    {
        $this->getInfoQueriesService = $getInfoQueriesService;
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->getTargetAudiencesService = $getTargetAudiencesService;
    }

    public function index(Request $request)
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);

            $target_audiences = $this->getTargetAudiencesService->execute();
            $this->getInfoQueriesService->execute($psychologist);

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'target_audiences' => $target_audiences,
            ], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
