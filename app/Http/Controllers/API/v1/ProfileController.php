<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\User\GetAllSpecialities;
use http\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    private $getAllSpecialities;

    public function __construct(GetAllSpecialities $getAllSpecialities)
    {
        $this->getAllSpecialities = $getAllSpecialities;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $specialities = $this->getAllSpecialities->execute();

            return response()->json(['status' => true, 'message' => 'Successfully', 'specialities' => $specialities], 200);
        }catch (Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
