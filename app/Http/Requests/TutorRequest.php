<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TutorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Apenas logados podem enviar esse formulário
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $tutorId = $this->route('tutor');

        return [
            'name'      => ['required', 'string', 'max:255'],
            'cpf'       => ['required', 'string', 'max:14', 'unique:tutors,cpf,' . $tutorId],
            'phone'     => ['required', 'string', 'max:20'],
            'address'   => ['nullable', 'string', 'max:255'],
        ];
    }


    public function messages(): array
    {
        return [
            'name.required'     => 'O nome do Tutor é obrigatório.',
            'cpf.required'      => 'O CPF é obrigatório.',
            'cpf.unique'        => 'Este CPF já está cadastrado no sistema.',
            'phone.required'    => 'O telefone de contato é obrigatório.',
        ];
    }
}
