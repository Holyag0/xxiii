<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceitasRequest extends FormRequest
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
            'categoria_id'=>'required',
            'valor' => 'required',
            'data_vencimento' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'categoria_id' => 'Categoria',
            'valor' => 'Valor',
            'data_vencimento' => 'Data Vencimento',
        ];
    }
}
