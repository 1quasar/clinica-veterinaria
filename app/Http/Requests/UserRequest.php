<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password' => [
                $this->isMethod('POST') ? 'required' : 'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
            'role' => [
                'required',
                Rule::in(['admin', 'veterinario', 'recepcionista']),
            ],
            'status' => [
                'required',
                'boolean'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'O campo nome é obrigatório.',
            'email.required'        => 'O campo e-mail é obrigatório.',
            'email.email'           => 'Insira um e-mail válido.',
            'email.unique'          => 'Este e-mail já está cadastrado.',
            'password.required'     => 'A senha é obrigatória.',
            'password.min'          => 'A senha deve ter pelo menos 8 caractéres.',
            'password.comfirmed'    => 'A confirmação de senha não confere.',
            'role.require'          => 'Selecione um perfil de acesso.',
            'role.in'               => 'O perfil selecionado é inválido',
            'status.required'       => 'Selecione o status do usuário.',
        ];
    }
}
