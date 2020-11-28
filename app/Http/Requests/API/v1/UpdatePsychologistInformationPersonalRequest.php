<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePsychologistInformationPersonalRequest extends APIFormRequest
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
            'infoPersonal.name' => 'required',
            'infoPersonal.email' => 'required|email',
            'infoPersonal.birth' => 'required:date',
            'infoPersonal.cpf' => function($att, $value, $fail) {
                $cpf = onlyNumber($value);
                if (!checkCPF($cpf))
                    return $fail("Digite um CPF válido");
            },
            'infoPersonal.city_id' => 'required|numeric',
            'infoPersonal.phone' => function($att, $value, $fail) {
                $phone = onlyNumber($value);

                if(strlen($phone) != 11)
                    return $fail("Digite um Telefone válido");
            },
        ];
    }
}
