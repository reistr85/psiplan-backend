<?php

namespace App\Http\Requests\API\v1;


class UpdateClientBillingRequest extends APIFormRequest
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
                $cpf = onlyNumber($value);
                if (!checkCPF($cpf))
                    return $fail("Digite um CPF válido");
            },
            'zip_code' => 'required|digits:8',
            'state' => 'required|min:2|max:2',
            'city' => 'required',
            'neighborhood' => 'required',
            'street' => 'required',
        ];
    }
}
