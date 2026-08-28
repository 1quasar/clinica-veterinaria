@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="h3 my-4 text-gray-800">Cadastrar Novo Exame</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            {{-- ATENÇÃO: enctype="multipart/form-data" é obrigatório para upload de arquivos --}}
            <form action="{{ route('exams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="animal_id" class="form-label">Paciente (Pet) <span class="text-danger">*</span></label>
                        <select name="animal_id" id="animal_id" class="form-select @error('animal_id') is-invalid @enderror" required>
                            <option value="">-- Selecione o Paciente --</option>
                            @foreach($animals as $animal)
                                <option value="{{ $animal->id }}" {{ old('animal_id') == $animal->id ? 'selected' : '' }}>
                                    {{ $animal->name }} (Tutor: {{ $animal->tutor->name }})
                                </option>
                            @endforeach
                        </select>
                        @error('animal_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label for="consultation_id" class="form-label">Consulta Vinculada (Opcional)</label>
                        <select name="consultation_id" id="consultation_id" class="form-select @error('consultation_id') is-invalid @enderror">
                            <option value="">-- Nenhuma / Exame Avulso --</option>
                            @foreach($consultations as $consultation)
                                <option value="{{ $consultation->id }}" {{ old('consultation_id') == $consultation->id ? 'selected' : '' }}>
                                    Consulta #{{ $consultation->id }} - {{ $consultation->animal->name }} ({{ $consultation->date_time->format('d/m/Y') }})
                                </option>
                            @endforeach
                        </select>
                        @error('consultation_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome do Exame <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Ex: Hemograma Completo, Raio-X Torácico" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-3">
                        <label for="exam_date" class="form-label">Data de Realização <span class="text-danger">*</span></label>
                        <input type="date" name="exam_date" id="exam_date" class="form-control @error('exam_date') is-invalid @enderror" value="{{ old('exam_date', date('Y-m-d')) }}" required>
                        @error('exam_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-3">
                        <label for="laboratory" class="form-label">Laboratório / Clínica</label>
                        <input type="text" name="laboratory" id="laboratory" class="form-control @error('laboratory') is-invalid @enderror" value="{{ old('laboratory') }}" placeholder="Ex: VetLab Central">
                        @error('laboratory')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-12">
                        <label for="file" class="form-label">Arquivo Anexo (Laudo / Imagem) <span class="text-danger">*</span></label>
                        <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" accept=".pdf,.png,.jpg,.jpeg" required>
                        <small class="text-muted">Formatos permitidos: PDF, JPG, PNG. Tamanho máximo: 5 MB.</small>
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-12">
                        <label for="observations" class="form-label">Observações Médicas</label>
                        <textarea name="observations" id="observations" rows="3" class="form-control @error('observations') is-invalid @enderror" placeholder="Anotações adicionais sobre o resultado do exame...">{{ old('observations') }}</textarea>
                        @error('observations')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('exams.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar Exame</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

