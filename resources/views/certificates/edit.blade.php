@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="h3 my-4 text-gray-800">Editar Atestado: {{ $certificate->title }}</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('certificates.update', $certificate) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="animal_id" class="form-label">Paciente (Pet) <span class="text-danger">*</span></label>
                        <select name="animal_id" id="animal_id" class="form-select @error('animal_id') is-invalid @enderror" required>
                            @foreach($animals as $animal)
                                <option value="{{ $animal->id }}" {{ old('animal_id', $certificate->animal_id) == $animal->id ? 'selected' : '' }}>
                                    {{ $animal->name }} (Tutor: {{ $animal->tutor->name }})
                                </option>
                            @endforeach
                        </select>
                        @error('animal_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label for="title" class="form-label">Título do Atestado <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $certificate->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-3">
                        <label for="issue_date" class="form-label">Data de Emissão <span class="text-danger">*</span></label>
                        <input type="date" name="issue_date" id="issue_date" class="form-control @error('issue_date') is-invalid @enderror" value="{{ old('issue_date', $certificate->issue_date->format('Y-m-d')) }}" required>
                        @error('issue_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-12">
                        <label for="file" class="form-label">Substituir Arquivo Anexo (Opcional)</label>
                        <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" accept=".pdf,.png,.jpg,.jpeg">
                        <small class="text-muted d-block">Deixe em branco para manter o arquivo atual. Formatos: PDF, JPG, PNG. Máx: 5 MB.</small>
                        <div class="mt-2">
                            <a href="{{ asset('storage/' . $certificate->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                <i class="bi bi-file-earmark-check"></i> Ver Arquivo Atual
                            </a>
                        </div>
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-12">
                        <label for="observations" class="form-label">Observações Médicas</label>
                        <textarea name="observations" id="observations" rows="3" class="form-control @error('observations') is-invalid @enderror">{{ old('observations', $certificate->observations) }}</textarea>
                        @error('observations')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('certificates.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Atualizar Atestado</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

