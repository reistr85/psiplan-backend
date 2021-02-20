<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Notification\GetAllNotificationsService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\GetPsychologistNotificationsByPsychologistIdService;
use App\Services\API\v1\Psychologist\UpdatePsychologistNotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    private $getPsychologistByUserIdService;
    private $getAllNotificationsService;
    private $getPsychologistNotificationsByPsychologistIdService;
    private $updatePsychologistNotificationService;

    public function __construct(GetPsychologistByUserIdService $getPsychologistByUserIdService, GetAllNotificationsService $getAllNotificationsService,
                                GetPsychologistNotificationsByPsychologistIdService $getPsychologistNotificationsByPsychologistIdService,
                                UpdatePsychologistNotificationService $updatePsychologistNotificationService)
    {
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->getAllNotificationsService = $getAllNotificationsService;
        $this->getPsychologistNotificationsByPsychologistIdService = $getPsychologistNotificationsByPsychologistIdService;
        $this->updatePsychologistNotificationService = $updatePsychologistNotificationService;
    }

    /**
     * Get All Data Preferences
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try{
            $user = auth()->user();
            $psychologist = $user->psychologist;
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

    /**
     * Update Preferences
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try{
            $user = auth()->user();
            $psychologist = $user->psychologist;
            $notification_id = $id;
            $is_active = $request->input('is_active');

            $this->updatePsychologistNotificationService->execute($psychologist->id, $notification_id, $is_active);

            return response()->json([
                'status' => true,
                'message' => 'Notificação atualizada com sucesso.',
            ], 200);

        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
