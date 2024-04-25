<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DespesaRequest extends FormRequest
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
            'centro_custo_id'=>'required',
            'fornecedor_id'=>'required',
            'valor' => 'required',
            'data_vencimento' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'centro_custo_id' => 'Centro de Custos',
            'fornecedor_id' => 'Fornecedores',
            'valor' => 'Valor',
            'data_vencimento' => 'Data Vencimento',
        ];
    }
}
