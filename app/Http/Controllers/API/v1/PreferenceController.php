<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Preference\GetAllPreferencesService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\GetPsychologistNotificationsByPsychologistIdService;
use App\Services\API\v1\Psychologist\UpdatePsychologistPreferenceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    private $getPsychologistByUserIdService;
    private $get_all_preferences_service;
    private $getPsychologistNotificationsByPsychologistIdService;
    private $update_psychologist_preference_service;

    public function __construct(
        GetPsychologistByUserIdService $getPsychologistByUserIdService,
        GetAllPreferencesService $get_all_preferences_service,
        GetPsychologistNotificationsByPsychologistIdService $getPsychologistNotificationsByPsychologistIdService,
        UpdatePsychologistPreferenceService $update_psychologist_preference_service)
    {
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->get_all_preferences_service = $get_all_preferences_service;
        $this->getPsychologistNotificationsByPsychologistIdService = $getPsychologistNotificationsByPsychologistIdService;
        $this->update_psychologist_preference_service = $update_psychologist_preference_service;
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
            $preferences = $this->get_all_preferences_service->execute();
            $psychologist_preferences = $this->getPsychologistNotificationsByPsychologistIdService->execute($psychologist->id);

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'preferences' => $preferences,
                'psychologist_preferences' => $psychologist_preferences,
            ], 200);

        }catch(\Exception $e){
            dd($e);
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
            $preference_id = $id;
            $is_active = $request->input('is_active');

            $this->update_psychologist_preference_service->execute($psychologist->id, $preference_id, $is_active);

            return response()->json([
                'status' => true,
                'message' => 'Atualizado com sucesso.',
            ], 200);

        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
