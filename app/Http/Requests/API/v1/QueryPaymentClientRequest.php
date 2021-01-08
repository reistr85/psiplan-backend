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
            'customer.documents.0.number' => 'required',
            'customer.phone_numbers' => 'required',
            'customer.birthday' => 'required|date',
        ];
    }
}
