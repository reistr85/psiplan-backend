<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\CreateAuthRequest;
use App\Services\API\v1\Auth\CreateAuthService;
use App\Services\API\v1\Auth\MeService;
use App\Services\API\v1\Auth\RefreshAuthService;
use App\Services\API\v1\Psychologist\GetClientByUserIdService;
use App\Services\API\v1\Psychologist\GetPsychologistByUserIdService;
use App\Services\API\v1\User\GetUserByEmailOrCPFService;
use Comtele\Services\TextMessageService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

    private $createAuthService;
    private $getUserByEmailOrCPFService;
    private $getPsychologistByUserIdService;
    private $getClientByUserIdService;
    private $meService;
    private $refreshAuthService;

    public function __construct(
        CreateAuthService $createAuthService,
        GetUserByEmailOrCPFService $getUserByEmailOrCPFService,
        GetPsychologistByUserIdService $getPsychologistByUserIdService,
        MeService $meService,
        GetClientByUserIdService $getClientByUserIdService,
        RefreshAuthService $refreshAuthService)
    {
        $this->createAuthService = $createAuthService;
        $this->getUserByEmailOrCPFService = $getUserByEmailOrCPFService;
        $this->getPsychologistByUserIdService = $getPsychologistByUserIdService;
        $this->meService = $meService;
        $this->getClientByUserIdService = $getClientByUserIdService;
        $this->refreshAuthService = $refreshAuthService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param CreateAuthRequest $request
     * @return JsonResponse
     */
    public function login(CreateAuthRequest $request)
    {
        try{
            $credentials = $request->only(['email', 'password']);

            $auth = $this->createAuthService->execute($credentials);
            $user = $this->getUserByEmailOrCPFService->execute('email', $credentials['email']);

            $userData['id'] = encode($user->id);
            $userData['type_user_id'] = encode($user->type_user_id);
            $userData['name'] = $user->name;
            $userData['email'] = $user->email;

            if($user->type_user_id === 2) {
                $psychologist = $this->getPsychologistByUserIdService->execute($user->id);
                $userData['plan_id'] = encode($psychologist->plan_id);
                $userData['psychologist_id'] = encode($psychologist->id);
            }

            if($user->type_user_id === 3) {
                $client = $this->getClientByUserIdService->execute($user->id);
                $userData['client_id'] = encode($client->id);
            }

            return response()->json(['status' => true, 'message' => 'Successfully',  'access_token' => $auth['access_token'], 'user' => $userData], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me()
    {
        try{
            $user = auth()->user();
            $psychologist = null;
            $client = null;
            $data_user = [];

            if($user->type_user_id === 2){
                $psychologist = $this->getPsychologistByUserIdService->execute($user->id);

                $data_user = [
                    'id' => encode($user->id),
                    'type_user_id' => encode($user->type_user_id),
                    'name' => $user->name,
                    'email' => $user->email,
                    'plan_id' => encode($psychologist->plan_id),
                    'psychologist_id' => encode($psychologist->id),
                ];
            }else if($user->type_user_id === 3){
                $client = $this->getClientByUserIdService->execute($user->id);

                $data_user = [
                    'id' => encode($user->id),
                    'type_user_id' => encode($user->type_user_id),
                    'name' => $user->name,
                    'email' => $user->email,
                    'client_id' => encode($client->id),
                ];
            }

            $token = '';//auth()->refresh();

            return response()->json(['status' => true, 'message' => 'Successfully', 'user' => $data_user, 'access_token' => $token], 200);
        }catch(\Exception $e){
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        try{
            auth()->logout();
            return response()->json(['status' => true, 'message' => 'Successfully logged out'], 200);
        }catch (\Exception $e){
            return response()->json(['error' => true, 'status' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function sms()
    {

        $key = "69118cae-a8d9-461d-b592-f66a0e070f57";

        $textMessageService = new TextMessageService($key);
        $result = $textMessageService->send(
            "my_id",          // Sender: Id de requisicao da sua aplicacao para ser retornado no relatorio, pode ser passado em branco.
            "Hello PHP",      // Content: Conteudo da mensagem a ser enviada.
            ["84988481941"]  // Receivers: Numero de telefone que vai ser enviado o SMS.
        );

        $teste = 1;
    }
}
