<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReceitaRequest extends FormRequest
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
        return [
            'animal_id'                 => ['required', 'exists:animals,id'],
            'consulta_id'               => ['nullable', 'exists:consultations,id'],
            'data'                      => ['required', 'date'],
            'observacoes'               => ['nullable', 'string'],
            'itens'                     => ['required', 'array', 'min:1'],
            'itens.*.medicamento'       => ['required', 'string', 'max:255'],
            'itens.*.dosagem'           => ['required', 'string', 'max:100'],
            'itens.*.frequencia'        => ['required', 'string', 'max:100'],
            'itens.*.duracao'           => ['required', 'string', 'max:100'],
            'itens.*.orientacoes'       => ['nullable', 'string'],
        ];
    }

    public function messages(): array 
    {
        return [
            //
        ];
    }
}
