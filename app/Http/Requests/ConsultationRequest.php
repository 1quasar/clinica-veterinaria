<?php

namespace App\Http\Requests;

use App\Models\Consultation;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ConsultationRequest extends FormRequest
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
            'animal_id'       => ['required', 'exists:animals,id'],
            'veterinarian_id' => ['required', 'exists:users,id'],
            'date_time'       => ['required', 'date'],
            'status'          => ['required', 'in:agendada,em_andamento,concluida,cancelada'],
            'reason'          => ['required', 'string', 'max:1000'],
            'diagnosis'       => ['nullable', 'string', 'max:2000'],
            'prescription'    => ['nullable', 'string', 'max:2000'],
            'value'           => ['required', 'numeric', 'min:0', 'max:99999.99'],
        ];
    }

    /**
     * Validação customizada para conflito de horários com intervalo.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->date_time || !$this->veterinarian_id) {
                return;
            }

            // Intervalo mínimo entre consultas em minutos
            $durationInMinutes = 30; 
            
            $requestedTime = Carbon::parse($this->date_time);
            
            // Obtém o ID para ignorar a própria consulta no fluxo de edição
            $consultationId = $this->route('consultation') ? $this->route('consultation')->id : null;

            $hasConflict = Consultation::where('veterinarian_id', $this->veterinarian_id)
                ->where('status', '!=', 'cancelada')
                ->when($consultationId, fn($q) => $q->where('id', '!=', $consultationId))
                ->whereBetween('date_time', [
                    $requestedTime->copy()->subMinutes($durationInMinutes - 1),
                    $requestedTime->copy()->addMinutes($durationInMinutes - 1)
                ])
                ->exists();

            if ($hasConflict) {
                $validator->errors()->add(
                    'date_time', 
                    "O veterinário já possui uma consulta agendada nesse intervalo. Respeite a margem de {$durationInMinutes} minutos entre atendimentos."
                );
            }
        });
    }

    public function messages(): array
    {
        return [
            'animal_id.required'       => 'Selecione o paciente.',
            'animal_id.exists'         => 'O paciente selecionado é inválido.',
            'veterinarian_id.required' => 'Selecione o veterinário responsável.',
            'veterinarian_id.exists'   => 'O veterinário selecionado é inválido.',
            'date_time.required'       => 'Informe a data e horário da consulta.',
            'status.required'          => 'Selecione o status do atendimento.',
            'reason.required'          => 'Descreva o motivo principal da consulta.',
            'value.required'           => 'Informe o valor da consulta.',
            'value.numeric'            => 'O valor deve ser um número válido.',
        ];
    }
}