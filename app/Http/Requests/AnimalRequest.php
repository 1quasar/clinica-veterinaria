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
            'specie_id'    => ['required', 'exists:species,id'],
            'race_id'      => ['nullable', 'exists:races,id'],
            'gender'    => ['required', 'in:male,female'],
            'birth_date'    => ['nullable', 'date', 'before_or_equal:today'],
            'weight'        => ['nullable', 'numeric', 'min:0', 'max:999.99'],
            'observation'  => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'tutor_id.required'         => 'Selecione o tutor responsável pelo animal.',
            'tutor_id.exists'           => 'O tutor selecionado é inválido.',
            'name.required'             => 'O nome do animal é obrigatório.',
            'specie_id.required'           => 'A espécie do animal é obrigatória.',
            'specie_id.exists'          => 'Espécie inválida.',
            'race_id.exists'            => 'Raça inválida.',
            'gender.required'           => 'Informe o sexo do animal.',
            'birth_date.before_or_equal'    => 'A data de nascimento não pode ser futura.',
            'weight.numeric'            => 'O peso deve ser um valor numérico válido.',
        ];
    }
}
