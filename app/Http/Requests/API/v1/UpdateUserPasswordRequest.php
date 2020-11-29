<?php

namespace App\Http\Requests\API\v1;


class UpdateUserPasswordRequest extends APIFormRequest
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
            'new_password' => 'required|min:8',
            'new_password_confirm' => 'required|same:new_password|min:8',
        ];
    }
}
