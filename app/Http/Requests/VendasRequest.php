<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendasRequest extends FormRequest
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
            //'forma_pagamento' => 'required'  
        ];
    }

    public function attributes()
    {
        return [
            
           
            // 'clinica_id' => 'Clínica',

            // 'nome' => 'Nome',
            // 'valor_venda' => 'Data do Exame',
            // 'status' => 'Status',
            // 'data_venda' => 'Data Venda',
            // 'valor_pagamento' => 'Valor Pagamento',
            // 'forma_pagamento' => 'Forma Pagamento'  
            // nome: '',
            // entrada: '',
            // desconto: '',
            // aluno_id: '',
            // pacote_id: '',
            // valor_venda: '',
            // parcelas: '',
            // forma_pagamento:'',
            // exames: '',
            // alou:'',
        ];
    }

   
}