<?php

namespace App\Http\Requests\API\v1;


class QueryPaymentClientRequest extends APIFormRequest
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
            'customer.name' => 'required',
            'customer.email' => 'required|email',
            'customer.documents.0.number' => function ($att, $value, $fail) {
                $cpf = onlyNumber($value);
                if (!checkCPF($cpf))
                    return $fail("Digite um CPF válido");
            },
            'customer.phone_numbers' => 'required',
            'customer.birthday' => function($att, $value, $fail){
                $d = \DateTime::createFromFormat('d/m/Y', $value);
                if(!$d || $d->format('d/m/Y') != $value)
                    return $fail("Digite uma data de nascimento válida.");
            },
        ];
    }
}
