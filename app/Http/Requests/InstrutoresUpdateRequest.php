<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InstrutoresUpdateRequest extends FormRequest
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
    public function rules(DefaultRequest $request)
    {
        $id = $this->segment(3);
   
        return [
            'nome'=>'required|min:3|max:50',
            'cpf' => "required|cpf|min:11|max:11|unique:instrutores,cpf,{$id},id",
            'email'=>[
                'required',
                Rule::unique('instrutores')->ignore($request->segment(3)),
            ],
            
            'categoria' => 'required',
            'venc_cnh' => 'required',
            'venc_ci' => 'required',
            'n_registro_cnh' => 'required',
            'portal' => 'required',
            
            'logradouro' => 'required',
            'cep' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'cel' => 'required',

            'saida_almoco' => 'required',
            'retorno_almoco' => 'required',
            'status' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'email' => 'Email',
            
            'categoria' => 'Categoria',
            'venc_cnh' => 'Vencimento CNH',
            'venc_ci' => 'Vencimento Carteira de Instrutor',
            'n_registro_cnh' => 'Número de Registro da CNH',
            'portal' => 'Portal',
            

            'cep' => 'CEP',
            'logradouro' => 'Logradouro',
            'numero' => 'Número',
            'bairro' => 'Bairro',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
            'cel' => 'Celular',
           
            'saida_almoco' => 'Saída para Almoço',
            'retorno_almoco' => 'Retorno do Almoço',
        ];
    }

    public function validationData()
    {
        $data = $this->all();

        $data['cpf'] = preg_replace('/[^0-9]/', '', $data['cpf']);

        return $data;
    }
}
