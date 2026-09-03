<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PrescriptionRequest extends FormRequest
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
            'animal_id' => ['required', 'exists:animals,id'],
            'date_time' => ['required', 'date'],
            'items' => ['required', 'array'],
            'items.*.name' => ['required', 'string'],
            'items.*.dosage' => ['required', 'string'],
            'items.*.frequency' => ['required', 'string'],
            'items.*.duration' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'animal_id.required' => 'O campo animal é obrigatório.',
            'animal_id.exists' => 'O animal selecionado não existe.',
            'date_time.required' => 'O campo data e hora é obrigatório.',
            'date_time.date' => 'O campo data e hora deve ser uma data válida.',
            'items.required' => 'O campo itens é obrigatório.',
            'items.array' => 'O campo itens deve ser um array.',
            'items.*.name.required' => 'O nome do item é obrigatório.',
            'items.*.dosage.required' => 'A dosagem do item é obrigatória.',
            'items.*.frequency.required' => 'A frequência do item é obrigatória.',
            'items.*.duration.required' => 'A duração do item é obrigatória.',
        ];
    }
}
