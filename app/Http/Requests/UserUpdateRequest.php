<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
     * @param DefaultRequest $request
     * @return array
     */
    public function rules(DefaultRequest $request)
    {

        return [
            'name' => 'required|max:255',
            'email'=>[
                'required',
                Rule::unique('users')->ignore($request->segment(3)),
            ],
            'password' => 'required|min:6',
            'roles' => 'required'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Nome',
            'email' => 'Email',
            'password' => 'Senha',
            'roles' => 'Funções',
        ];
    }
}
