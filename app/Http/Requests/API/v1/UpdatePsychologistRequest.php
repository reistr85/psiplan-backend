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
                'infoPersonal.birth' => 'required',
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

        if(array_key_exists("image", $this->all())){
            $resolution = ['width' => 800, 'height' => 800];

            if($this->input('action') !== 'avatar')
                $resolution = ['width' => 1024, 'height' => 768];

            return [
                'image' => function ($att, $value, $fail) use($resolution) {
                    $info_image = getimagesize($value);
                    $format_images = ['image/png', 'image/jpeg', 'image/jpg'];

                    if (($info_image[0] > ($resolution['width']+10)) || ($info_image[1] > ($resolution['height']+10)))
                        return $fail("A imagem não pode ser maior que {$resolution['width']}x{$resolution['height']} pixels");

                    if (array_search($info_image['mime'], $format_images) === false)
                        return $fail("A imagem tem que ser nos formatos (jpg, jpeg ou png)");
                }
            ];
        }

        if($this->input('action') === 'url_youtube') {
            return [
                'url_youtube' => function ($att, $value, $fail) {
                    $pattern = '%^(?:https?://)?(?:www.)?(?:youtu.be/|youtube.com(?:/embed/|/v/|/watch?v=))([\w-]{10,12})(?:\S+)$%x';

                    if (!preg_match($pattern, $value) && $value)
                        return $fail("Digite uma URL válida do Youtube");
                }
            ];
        }

        return [];
    }
}
