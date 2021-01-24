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
            'billing.address.zipcode' => 'required',
            'billing.address.state' => 'required|min:2|max:2',
            'billing.address.city' => 'required',
            'billing.address.neighborhood' => 'required',
            'billing.address.street' => 'required',
            'card_number' => function($att, $value, $fail){
                $card_number = preg_replace('#\s+#', '', $value);

                if(strlen($card_number) != 16)
                    return $fail("Digite um número de cartão válido.");
            },
            'card_cvv' => 'required|min:3|max:3',
            'card_expiration_date' => function($att, $value, $fail){
                $month = substr($value, 0, 2);
                $year = substr(@date("Y"), 0, 2).substr($value, 3, 2);

                if($month < @date("m") || !is_numeric($month) || $year < @date("Y") || !is_numeric($year))
                    return $fail("Digite um vencimento válido.");
            },
            'card_holder_name' => 'required',
        ];
    }
}
