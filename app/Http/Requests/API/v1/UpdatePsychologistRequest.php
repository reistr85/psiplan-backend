<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePsychologistRequest extends APIFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if($this->input('action') === 'description') {
            return [
                'description' => 'required|min:20',
            ];
        }

        if($this->input('action') === 'approach') {
            return [
                'approach' => 'required|min:5',
            ];
        }

        if($this->input('action') === 'infopersonal') {
            return [
                'infoPersonal.name' => 'required',
                'infoPersonal.email' => 'required|email',
                'infoPersonal.birth' => function($att, $value, $fail){
                    $d = \DateTime::createFromFormat('d/m/Y', $value);
                    if(!$d || $d->format('d/m/Y') != $value)
                        return $fail("Digite uma data de nascimento válida.");
                },
                'infoPersonal.cpf' => function ($att, $value, $fail) {
                    $cpf = onlyNumber($value);
                    if (!checkCPF($cpf))
                        return $fail("Digite um CPF válido");
                },
                'infoPersonal.city_id' => 'required|numeric',
                'infoPersonal.phone' => function ($att, $value, $fail) {
                    $phone = onlyNumber($value);

                    if (strlen($phone) != 11)
                        return $fail("Digite um telefone válido");
                },
            ];
        }

        return [];
    }
}
