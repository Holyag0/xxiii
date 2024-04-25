<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColaboradorRequest extends FormRequest
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
        $id = $this->segment(3);

        return [
            'nome' => 'required',
            'funcoes' => 'required',
            'cpf' => "required|min:11|max:11|unique:colaboradores,cpf,{$id},id",
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'cpf' => 'CPF',
            'funcoes' => 'Funções'
        ];
    }
}
