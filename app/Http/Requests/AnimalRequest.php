<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AnimalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tutor_id'  => ['required', 'exists:tutors,id'],
            'name'      => ['required', 'string', 'max:255'],
            'specie'    => ['required', 'string', 'max:100'],
            'race'      => ['nullable', 'string', 'max:100'],
            'gender'    => ['required', 'in:male,female'],
            'birth_date'    => ['nullable', 'date', 'before_or_equal:today'],
            'weight'        => ['nullable', 'numeric', 'min:0', 'max:999.99'],
            'observations'  => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'tutor_id.required'         => 'Selecione o tutor responsável pelo animal.',
            'tutor_id.exists'           => 'O tutor selecionado é inválido.',
            'name.required'             => 'O nome do animal é obrigatório.',
            'specie.required'           => 'A espécie do animal é obrigatória.',
            'gender.required'           => 'Informe o sexo do animal.',
            'birth_date.before_or_equal'    => 'A data de nascimento não pode ser futura.',
            'weight.numeric'            => 'O peso deve ser um valor numérico válido.',
        ];
    }
}
