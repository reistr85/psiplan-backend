<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePsychologistRequest extends APIFormRequest
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

        if($this->input('action') === 'description') {
            return [
                'description' => 'required|min:20',
            ];
        }

        if($this->input('action') === 'approach') {
            return [
                'approach' => 'required|min:5',
            ];
        }

        if($this->input('action') === 'infopersonal') {
            return [
                'infoPersonal.name' => 'required',
                'infoPersonal.email' => 'required|email',
                'infoPersonal.birth' => function($att, $value, $fail){
                    $d = \DateTime::createFromFormat('d/m/Y', $value);
                    if(!$d || $d->format('d/m/Y') != $value)
                        return $fail("Digite uma data de nascimento válida.");
                },
                'infoPersonal.cpf' => function ($att, $value, $fail) {
                    $cpf = onlyNumber($value);
                    if (!checkCPF($cpf))
                        return $fail("Digite um CPF válido");
                },
                'infoPersonal.city_id' => 'required|numeric',
                'infoPersonal.phone' => function ($att, $value, $fail) {
                    $phone = onlyNumber($value);

                    if (strlen($phone) != 11)
                        return $fail("Digite um telefone válido");
                },
            ];
        }

        if($this->input('action') === 'infoadditional') {
            return [
                'infoAdditional.crp' => 'required|min:3',
                'infoAdditional.pis' => function ($att, $value, $fail) {
                    $pis = onlyNumber($value);
                    if (!checkPIS($pis))
                        return $fail("Digite um PIS válido");
                },
            ];
        }

        if($this->input('action') === 'infobank') {
            return [
                'infoBank.bank' => 'required',
                'infoBank.agency' => 'required',
                'infoBank.type_account' => 'required',
                'infoBank.number_account' => 'required',
                'infoBank.cpf_holder_account' => function ($att, $value, $fail) {
                    $cpf = onlyNumber($value);
                    if (!checkCPF($cpf))
                        return $fail("Digite um CPF válido");
                }
            ];
        }

        return [];
    }
}
