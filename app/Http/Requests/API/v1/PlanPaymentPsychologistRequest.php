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
            'payment.customer.name' => 'required',
            'payment.customer.email' => 'required|email',
            'payment.customer.document_number' => function ($att, $value, $fail) {
                $cpf = onlyNumber($value);
                if (!checkCPF($cpf))
                    return $fail("Digite um CPF válido");
            },
            'payment.customer.address.zipcode' => 'required|min:8|max:8',
            'payment.customer.address.state' => 'required|min:2|max:2',
            'payment.customer.address.city' => 'required',
            'payment.customer.address.neighborhood' => 'required',
            'payment.customer.address.street' => 'required',
            'payment.customer.phone.number' => function($att, $value, $fail){
                $phone = onlyNumber($value);

                if(strlen($phone) != 11)
                    return $fail("Digite um telefone válido.");
            },
            'payment.card_number' => function($att, $value, $fail){
                $card_number = preg_replace('#\s+#', '', $value);

                if(strlen($card_number) != 16)
                    return $fail("Digite um número de cartão válido.");
            },
            'payment.card_cvv' => 'required|min:3|max:3',
            'payment.card_expiration_date' => function($att, $value, $fail){
                $month = substr($value, 0, 2);
                $year = substr(@date("Y"), 0, 2).substr($value, 3, 2);

                if($month < @date("m") || !is_numeric($month) || $year < @date("Y") || !is_numeric($year))
                    return $fail("Digite um vencimento válido");
            },
            'payment.card_holder_name' => 'required',
            'payment.plan_selected' => 'required',
            'bank.agency' => 'required',
            'bank.agency_dv' => 'required',
            'bank.bank_code' => function($att, $value, $fail){
                if($value == '000')
                    return $fail("Selecione o Banco");
            },
            'bank.cpf_holder_account' => 'required',
            'bank.name_holder_account' => 'required',
            'bank.number_account_dv' => 'required',
            'bank.type_account_name' => function($att, $value, $fail){
                if(!$value)
                    return $fail("Selecione o Tipo de Conta");
            },
        ];
    }
}
