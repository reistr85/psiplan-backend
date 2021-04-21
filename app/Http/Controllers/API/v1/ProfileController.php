<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\TypeServiceEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\UpdatePsychologistRequest;
use App\Services\API\v1\Psychologist\DeleteImageGalleryService;
use App\Services\API\v1\Psychologist\GetAcademicFormationsByPsychologistIdService;
use App\Services\API\v1\Psychologist\GetAllSpecialtyService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\Psychologist\GetPsychologistDocumentService;
use App\Services\API\v1\Psychologist\GetSpecialtiesByPsychologistIdService;
use App\Services\API\v1\Psychologist\UpdatePsychologistPercentageProfileService;
use App\Services\API\v1\Psychologist\UpdatePsychologistService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    private $getAllSpecialtiesService;
    private $getSpecialtiesByPsychologistIdService;
    private $getPsychologistByUserIdService;
    private $getAcademicFormationsByPsychologistIdService;
    private $updatePsychologistService;
    private $getPsychologistDocumentService;
    private $update_psychologist_percentage_profile_service;
    private $delete_image_gallery_service;

    public function __construct(
        GetAllSpecialtyService $getAllSpecialtiesService,
        GetSpecialtiesByPsychologistIdService $getSpecialtiesByPsychologistIdService,
        GetPsychologistByUserIdService $getPsychologistByUserIdService,
        GetAcademicFormationsByPsychologistIdService $getAcademicFormationsByPsychologistIdService,
        UpdatePsychologistService $updatePsychologistService,
        GetPsychologistDocumentService $getPsychologistDocumentService,
        UpdatePsychologistPercentageProfileService $update_psychologist_percentage_profile_service,
        DeleteImageGalleryService $delete_image_gallery_service)
    {
        $this->getAllSpecialtiesService = $getAllSpecialtiesService;
        $this->getSpecialtiesByPsychologistIdService = $getSpecialtiesByPsychologistIdService;
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->getAcademicFormationsByPsychologistIdService = $getAcademicFormationsByPsychologistIdService;
        $this->updatePsychologistService = $updatePsychologistService;
        $this->getPsychologistDocumentService = $getPsychologistDocumentService;
        $this->update_psychologist_percentage_profile_service = $update_psychologist_percentage_profile_service;
        $this->delete_image_gallery_service = $delete_image_gallery_service;
    }

    /**
     * Get Info Profile
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $psychologist = $this->getPsychologistByUserIdService->execute();

            $specialties = $this->getAllSpecialtiesService->execute();
            $psychologist_specialties = $this->getSpecialtiesByPsychologistIdService->execute($psychologist->id);
            $psychologist_academic_formations = $this->getAcademicFormationsByPsychologistIdService->execute($psychologist->id);
            $psychologist_document = $this->getPsychologistDocumentService->execute($psychologist->id);

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'psychologist' => $psychologist,
                'specialties' => $specialties,
                'psychologist_specialities' => $psychologist_specialties,
                'psychologist_academic_formations' => $psychologist_academic_formations,
                'psychologist_document' => $psychologist_document,
            ], 200);
        }catch (\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show Psychologist.
     *
     * @return JsonResponse
     */
    public function show()
    {
        try{
            $user = auth()->user();
            $psychologist = $user->psychologist;

            return response()->json(['status' => true, 'message' => 'Success', 'profile' => $psychologist], 200);
        }catch (\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update Psychologist.
     *
     * @param UpdatePsychologistRequest $request
     * @return JsonResponse
     */
    public function update(UpdatePsychologistRequest $request)
    {
        try{
            $user = auth()->user();
            $psychologist = $user->psychologist;
            $data = $request->all();
            $type = $request->input('action');
            $value_percentage = 0;
            $image = $this->updatePsychologistService->execute($psychologist->id, $data);

            if($type == 'avatar')
                $value_percentage = TypeServiceEnum::PERCENTAGE_AVATAR_VALUE;

            if($type == 'description')
                $value_percentage = TypeServiceEnum::PERCENTAGE_DESCRIPTION_VALUE;

            if($type == 'url_youtube') {
                $value_percentage = TypeServiceEnum::PERCENTAGE_YOUTUBE_VALUE;

                if(is_null($data['url_youtube']))
                    $value_percentage = -$value_percentage;
            }

            if($type == 'gallery_tow' || $type == 'gallery_three' || $type == 'gallery_four' || $type == 'gallery_five') {
                $value_percentage = TypeServiceEnum::PERCENTAGE_GALLERY_VALUE;
                $type = 'gallery';
            }

            if($type == 'approach')
                $value_percentage = TypeServiceEnum::PERCENTAGE_APPROACH_VALUE;

            $percentage = $this->update_psychologist_percentage_profile_service->execute($psychologist->id, $type, $value_percentage);

            return response()->json(['status' => true, 'message' => 'Registro alterado com sucesso', 'image' => $image,
                'percentage' => $percentage], 200);
        }catch (\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteImageGalery(Request $request)
    {
        try {
            $user = auth()->user();
            $psychologist = $user->psychologist;

            $this->delete_image_gallery_service->execute($psychologist, $request->all());
            return response()->json(['status' => true, 'message' => 'Registro alterado com sucesso'], 200);
        }catch (\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }
}
