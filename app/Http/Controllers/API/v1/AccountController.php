<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private $getPsychologistByUserIdService;

    public function __construct(GetPsychologistByUserIdService $getPsychologistByUserIdService)
    {
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
    }

    public function index()
    {
        try{
            $user = auth()->user();
            $psychologist = $this->getPsychologistByUserIdService->execute($user->id);

            return response()->json(['status' => true, 'message' => 'Successfully', 'psychologist' => $psychologist,], 200);

        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
