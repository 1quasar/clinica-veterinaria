<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class VacinaRequest extends FormRequest
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
            'animal_id'             => ['required', 'exists:animals,id'],
            'nome'                  => ['required', 'string', 'max:255'],
            'data_aplicacao'        => ['required', 'date'],
            'data_proxima_dose'     => ['nullable', 'date', 'after:data_aplicacao'],
            'lote'                  => ['nullable', 'string', 'max:255'],
            'fabricante'            => ['nullable', 'string', 'max:255'],
            'observacoes'           => ['nullable', 'string'],
        ];
    }

    public function messages(): array 
    {
        return [
            //
        ];
    }
}
