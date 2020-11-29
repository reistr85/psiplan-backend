<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Notification\GetAllNotificationsService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{

    private $getPsychologistByUserIdService;
    private $getAllNotificationsService;

    public function __construct(GetPsychologistByUserIdService $getPsychologistByUserIdService, GetAllNotificationsService $getAllNotificationsService)
    {
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->getAllNotificationsService = $getAllNotificationsService;
    }

    public function index()
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);
            $notifications = $this->getAllNotificationsService->execute();

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'notifications' => $notifications,
            ], 200);

        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
