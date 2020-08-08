<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserFormRequest extends APIFormRequest
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
            'name' => 'required|min:3|max:150',
            'email' => 'required|unique:users,email,'.$this->id.',id,deleted_at,NULL',
            'cpf' => 'required|unique:users,cpf,'.$this->id.',id,deleted_at,NULL',
            'password' => 'required|min:6',
            'type_user_id' => 'required:numeric',
            'active' => 'required:numeric',
        ];
    }
}
