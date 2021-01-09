<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\CreateEvaluationRequest;
use App\Services\API\v1\Psychologist\CreateEvaluationPsychologistService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EvaluationController extends Controller
{

    private $createEvaluationPsychologistService;

    public function __construct(
        CreateEvaluationPsychologistService $createEvaluationPsychologistService)
    {
        $this->createEvaluationPsychologistService = $createEvaluationPsychologistService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateEvaluationRequest $request
     * @return Response
     */
    public function store(CreateEvaluationRequest $request)
    {
        try{
            $user = auth()->user();
            $data_evaluation = $request->all();
            $data_evaluation['client_id'] = $user->client->id;

            $this->createEvaluationPsychologistService->execute($data_evaluation);

            return response()->json(['status' => true, 'message' => 'Sua avaliação foi registrada com sucesso'], 200);
        }catch (\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
