<?php

namespace App\Http\Requests\API\v1;


class UpdateClientProfileRequest extends APIFormRequest
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
        return [
            'cpf' => function ($att, $value, $fail) {
                $phone = onlyNumber($value);
                if (strlen($phone) === 11)
                    return $fail("Digite um Celular válido");
            },
            'name' => 'required',
            'email' => 'required|email',
            'birthday' => function($att, $value, $fail){
                $d = \DateTime::createFromFormat('d/m/Y', $value);
                if(!$d || $d->format('d/m/Y') != $value)
                    return $fail("Digite uma data de nascimento válida.");
            },
        ];
    }
}
