<?php

namespace App\Http\Requests;

use App\Enum\GroupPermissionEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

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
     * @return array<string, mixed>
     */
    public function rules()
    {

        $request = $this->request->all();

        Validator::extend('unique_cpf', function ($key, $value) use ($request) {
            return User::where('id', '<>', $this->route()->parameter('user')->id)
                    ->whereCpf($request['cpf'])
                    ->count() === 0;
        });

        return [
            'email' => ['required', 'email'],
            'cpf' => ['required', 'cpf', 'unique_cpf'],
            'senha' => ['nullable'],
            'confirmacao_senha' => ['required_if:senha,', 'same:senha'],
        ];
    }

    public function messages()
    {
        return [
            'cpf.unique_cpf' => 'CPF já cadastrado',
        ];
    }

}
