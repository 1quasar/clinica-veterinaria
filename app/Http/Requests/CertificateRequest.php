<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class CertificateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $fileRule = $this->isMethod('post')
            ? ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120']
            : ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'];
        return [
            'animal_id'     => ['required', 'exists:animals_'],
            'title'         => ['required', 'string', 'max:255'],
            'issue_date'    => ['required', 'date', 'before_or_equal:today'],
            'file'          => $fileRule,
            'notes'         => ['nullable', 'string', 'max:1000'],
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'animal_id.required'        => 'Selecione o paciente (animal).',
            'animal_id.exists'          => 'O paciente selecionado é inválido.',
            'title.required'            => 'O título do atestado médico é obrigatório.',
            'issue_date.required'       => 'Informe a data de emissão do atestado médico.',
            'exam.before_or_equal'      => 'A data de emissão do atestado não pode ser futura.',
            'file.required'             => 'O arquivo do atestado médico é obrigatório.',
            'file.mimes'                => 'O arquivo deve ser um documento PDF ou imagem (JPG, JPEG, PNG).',
            'file.max'                  => 'O arquivo não pode exceder 5 MB.',
        ];
    }
}
