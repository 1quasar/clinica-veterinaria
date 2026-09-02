<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
         $fileRule = $this->isMethod('post') 
                ? ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120']
                : ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'];
        return [
           'animal_id'          => ['required', 'exists:animals,id'],
           'consultation_id'    => ['nullable', 'exists:consultations,id'],
           'name'               => ['required', 'string', 'max:255'],
           'exam_date'          => ['required', 'date', 'before_or_equal:today'],
           'laboratory'         => ['nullable', 'string', 'max:255'],
           'file'               => $fileRule,
           'observations'       => ['nullable', 'string', 'max:1000'],  
        ];
    }


    public function messages(): array
    {
        return [
            'animal_id.required'        => 'Selecione o paciente (animal).',
            'animal_id.exists'          => 'O paciente selecionado é inválido.',
            'consultation_id.exists'    => 'A consulta selecionada é inválida.',
            'name.required'             => 'O nome do exame é obrigatório.',
            'exam_date.required'        => 'Informe a data de realização do exame.',
            'exam.before_or_equal'      => 'A data do exame não pode ser futura.',
            'file.required'        => 'O arquivo do laudo/exame é obrigatório.',
            'file.mimes'                => 'O arquivo deve ser um documento PDF ou imagem (JPG, JPEG, PNG).',
            'file.max'                  => 'O arquivo não pode exceder 5 MB.',
        ];
    }
}
