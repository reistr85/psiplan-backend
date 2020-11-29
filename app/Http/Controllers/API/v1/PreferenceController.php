<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Notification\GetAllNotificationsService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\GetPsychologistNotificationsByPsychologistIdService;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    private $getPsychologistByUserIdService;
    private $getAllNotificationsService;
    private $getPsychologistNotificationsByPsychologistIdService;

    public function __construct(GetPsychologistByUserIdService $getPsychologistByUserIdService, GetAllNotificationsService $getAllNotificationsService,
                                GetPsychologistNotificationsByPsychologistIdService $getPsychologistNotificationsByPsychologistIdService)
    {
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->getAllNotificationsService = $getAllNotificationsService;
        $this->getPsychologistNotificationsByPsychologistIdService = $getPsychologistNotificationsByPsychologistIdService;
    }

    public function index()
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);
            $notifications = $this->getAllNotificationsService->execute();
            $psychologist_notifications = $this->getPsychologistNotificationsByPsychologistIdService->execute($psychologist->id);

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'notifications' => $notifications,
                'psychologist_notifications' => $psychologist_notifications,
            ], 200);

        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
