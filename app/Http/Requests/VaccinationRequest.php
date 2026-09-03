<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class VaccinationRequest extends FormRequest
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
            'animal_id'          => ['required', 'exists:animals,id'],
            'name'               => ['required', 'string', 'max:255'],
            'application_date'   => ['required', 'date', 'before_or_equal:today'],
            'next_dose_date'     => ['nullable', 'date', 'after:application_date'],
            'batch'              => ['nullable', 'string', 'max:255'],
            'manufacturer'       => ['nullable', 'string', 'max:255'],
            'observations'       => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'animal_id.required'        => 'Selecione o paciente (animal).',
            'animal_id.exists'          => 'O paciente selecionado é inválido.',
            'name.required'             => 'O nome da vacinação é obrigatório.',
            'application_date.required' => 'Informe a data de aplicação da vacinação.',
            'application_date.before_or_equal' => 'A data de aplicação não pode ser futura.',
            'next_dose_date.after'      => 'A data da próxima dose deve ser posterior à data de aplicação.',
        ];
    }
}
