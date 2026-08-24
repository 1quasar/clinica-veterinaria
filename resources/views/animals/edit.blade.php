@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="h3 my-4 text-gray-800">Editar Dados do Paciente: {{ $animal->nome }}</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('animals.update', $animal) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="tutor_id" class="form-label">Tutor Responsável <span class="text-danger">*</span></label>
                        <select name="tutor_id" id="tutor_id" class="form-select @error('tutor_id') is-invalid @enderror" required>
                            @foreach($tutors as $tutor)
                                <option value="{{ $tutor->id }}" {{ old('tutor_id', $animal->tutor_id) == $tutor->id ? 'selected' : '' }}>
                                    {{ $tutor->name }} (CPF: {{ $tutor->cpf }})
                                </option>
                            @endforeach
                        </select>
                        @error('tutor_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome do Pet <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $animal->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="specie" class="form-label">Espécie <span class="text-danger">*</span></label>
                        <input type="text" name="specie" id="specie" class="form-control @error('specie') is-invalid @enderror" value="{{ old('specie', $animal->specie) }}" required>
                        @error('specie')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="race" class="form-label">Raça</label>
                        <input type="text" name="race" id="race" class="form-control @error('race') is-invalid @enderror" value="{{ old('race', $animal->race) }}">
                        @error('race')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="gender" class="form-label">Sexo <span class="text-danger">*</span></label>
                        <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror" required>
                            <option value="male" {{ old('gender', $animal->gender) == 'male' ? 'selected' : '' }}>Macho</option>
                            <option value="female" {{ old('gender', $animal->gender) == 'female' ? 'selected' : '' }}>Fêmea</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="birth_date" class="form-label">Data de Nascimento</label>
                        <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', $animal->birth_date) }}">
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="weight" class="form-label">Peso (kg)</label>
                        <input type="number" step="0.01" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight', $animal->weight) }}">
                        @error('weight')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="observation" class="form-label">Observações Médicas / Gerais</label>
                        <textarea name="observation" id="observation" rows="3" class="form-control @error('observation') is-invalid @enderror">{{ old('observation', $animal->observation) }}</textarea>
                        @error('observation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('animals.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Atualizar Paciente</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

