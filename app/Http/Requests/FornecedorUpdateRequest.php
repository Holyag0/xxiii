<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorUpdateRequest extends FormRequest
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
            'nome'=>'required|min:3|max:150',
            'email' => 'required|min:5',
            'cep'  => 'required|min:8|max:10',
            'logradouro' => 'required',
            'numero' => 'required|min:2',
            'bairro' => 'required|min:5',
            'cidade' => 'required|min:3',
            'estado' => 'required|min:2',
            'celular' => 'required|min:11|max:20',
        ];
    }
    public function attributes()
    {
        return [
            'nome' => 'Nome',
        ];
    }
}
