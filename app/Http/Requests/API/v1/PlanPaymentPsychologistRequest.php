<?php

namespace App\Http\Requests\API\v1;


class PlanPaymentPsychologistRequest extends APIFormRequest
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
            'customer.document_number' => function ($att, $value, $fail) {
                $cpf = onlyNumber($value);
                if (!checkCPF($cpf))
                    return $fail("Digite um CPF válido");
            },
            'customer.address.zipcode' => 'required|min:8|max:8',
            'customer.address.state' => 'required|min:2|max:2',
            'customer.address.city' => 'required',
            'customer.address.neighborhood' => 'required',
            'customer.address.street' => 'required',
            'customer.address.street_number' => 'required',
            'customer.phone.number' => function($att, $value, $fail){
                $phone = onlyNumber($value);

                if(strlen($phone) != 11)
                    return $fail("Digite um telefone válido.");
            },
            'card_number' => function($att, $value, $fail){
                $card_number = preg_replace('#\s+#', '', $value);

                if(strlen($card_number) != 16)
                    return $fail("Digite um número de cartão válido.");
            },
            'card_cvv' => 'required|min:3|max:3',
            'card_expiration_date' => function($att, $value, $fail){
                $month = substr($value, 0, 2);
                $year = substr(@date("Y"), 0, 2).substr($value, 2, 2);

                if($month < @date("m") || !is_numeric($month) || $year < @date("Y") || !is_numeric($year))
                    return $fail("Digite um vencimento válido.");
            },
            'card_holder_name' => 'required',
            'plan_selected' => 'required'
        ];
    }
}
