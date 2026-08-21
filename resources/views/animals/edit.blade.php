@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2>Editar Paciente</h2>

    <div class="card mt-3">
        <div class="card-body">
            <form action="{{ route('animals.update', $animal) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tutor_id" class="form-label">Tutor Responsável <span class="text-danger">*</span></label>
                        <select name="tutor_id" id="tutor_id" class="form-select @error('tutor_id') is-invalid @enderror" required>
                            @foreach($tutors as $tutor)
                                <option value="{{ $tutor->id }}" {{ old('tutor_id', $animal->tutor_id) == $tutor->id ? 'selected' : '' }}>
                                    {{ $tutor->name }} (CPF: {{ $tutor->cpf }})
                                </option>
                            @endforeach
                        </select>
                        @error('tutor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label for="name" class="form-label">name do Pet <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $animal->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="specie_id" class="form-label">Espécie <span class="text-danger">*</span></label>
                        <select name="specie_id" id="specie_id" class="form-select @error('specie_id') is-invalid @enderror" required>
                            @foreach($species as $specie)
                                <option value="{{ $specie->id }}" {{ old('specie_id', $animal->specie_id) == $specie->id ? 'selected' : '' }}>
                                    {{ $specie->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('specie_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4">
                        <label for="race_id" class="form-label">Raça</label>
                        <select name="race_id" id="race_id" class="form-select @error('race_id') is-invalid @enderror">
                            <option value="">-- Selecione a Raça --</option>
                            @foreach($races as $race)
                                <option value="{{ $race->id }}" {{ old('race_id', $animal->race_id) == $race->id ? 'selected' : '' }}>
                                    {{ $race->name }} ({{ $race->specie->name }})
                                </option>
                            @endforeach
                        </select>
                        @error('race_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4">
                        <label for="gender" class="form-label">Sexo<span class="text-danger">*</span></label>
                        <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror" required>
                            <option value="male" {{ old('gender', $animal->gender) == 'male' ? 'selected' : '' }}>Macho</option>
                            <option value="female" {{ old('gender', $animal->gender) == 'female' ? 'selected' : '' }}>Fêmea</option>
                        </select>
                        @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="birth_date" class="form-label">Data de Nascimento</label>
                        <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', $animal->birth_date) }}">
                        @error('birth_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label for="weight" class="form-label">Peso (kg)</label>
                        <input type="number" step="0.01" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight', $animal->weight) }}">
                        @error('weight')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="observation" class="form-label">Observações Médicas</label>
                    <textarea name="observation" id="observation" rows="3" class="form-control @error('observation') is-invalid @enderror">{{ old('observation', $animal->observation) }}</textarea>
                    @error('observation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-primary">Atualizar Paciente</button>
                <a href="{{ route('animals.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection