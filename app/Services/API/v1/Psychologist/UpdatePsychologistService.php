<?php


namespace App\Services\API\v1\Psychologist;


use App\Models\Psychologist;
use App\Repositories\PsychologistRepository;
use Illuminate\Http\Request;

class UpdatePsychologistService extends PsychologistRepository
{
    public function execute(Psychologist $psychologist, string $action, Request $request)
    {
        if($action === 'description'){
            if(strlen($request->input('description')) < 20)
                throw new \Exception("A descrição precisa conter no mímino 20 caracteres", 422);
        }

        if($action === 'approach'){
            if(strlen($request->input('approach')) < 3)
                throw new \Exception("A descrição precisa conter no mímino 3 caracteres", 422);
        }

        $psi = parent::update($psychologist, $request->except('action'));

        if(!$psi)
            throw new \Exception("Erro ao alterar o psicólogo.", 500);

        return $psi;
    }
}
