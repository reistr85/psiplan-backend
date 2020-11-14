<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\Auth\CreateAuthService;
use App\Services\API\v1\Auth\MeService;
use App\Services\API\v1\User\GetUserByEmailOrCPFService;
use Comtele\Services\TextMessageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private $createAuthService;
    private $getUserByEmailOrCPFService;
    private $meService;

    public function __construct(CreateAuthService $createAuthService, GetUserByEmailOrCPFService $getUserByEmailOrCPFService,
                                MeService $meService)
    {
        $this->createAuthService = $createAuthService;
        $this->getUserByEmailOrCPFService = $getUserByEmailOrCPFService;
        $this->meService = $meService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        try{
            $credentials = $request->only(['email', 'password']);

            $auth = $this->createAuthService->execute($credentials);
            $user = $this->getUserByEmailOrCPFService->execute('email', $credentials['email']);

            return response()->json(['status' => true, 'message' => 'Successfully',  'access_token' => $auth['access_token'], 'user' => $user], 200);
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
            $data_user = $this->meService->execute(auth()->user());
            return response()->json(['status' => true, 'message' => 'Successfully', 'data_user' => $data_user], 200);
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
