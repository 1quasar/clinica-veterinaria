<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RaceRequest extends FormRequest
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
            'specie_id' => ['required', 'exists:species,id'],
            'name'      => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'specie_id.required'    => 'Selecione a espécie correspondente.',
            'specie_id.exists'      => 'A espécie selecionada é inválida.',
            'name.required'         => 'O nome da raça é obrigatório.',
        ];
    }
}
