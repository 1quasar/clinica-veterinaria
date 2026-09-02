@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card mb-4 border-start border-primary border-4 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h4 mb-1 fw-bold text-dark">Histórico Clínico: {{ $animal->name }}</h2>
                    <p class="text-muted mb-0">
                        <strong>Tutor: </strong>{{ $animal->tutor->name }} | 
                        <strong>Espécie: </strong>{{ $animal->specie->name }} |
                        <strong>Raça: </strong>{{ $animal->race->name ?? 'S.R.D' }}
                    </p>
                </div>
                <a href="{{ route('animals.index') }}" class="btn btn-secondary btn-sm fw-bold">Voltar ao Módulo</a>
            </div>
        </div>

        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body bg-white rounded">
                <form action="{{ route('animals.history', $animal->id) }}" method="get" class="row-3">

                    <div class="col-md-4">
                        <label for="start_date" class="form-label small fw-bold">Data Inicial</label>
                        <input type="date" name="start_date" id="start_date" class="form-control form-control-sm" value="{{ request('start_date') }}">
                    </div>

                    <div class="col-md-4">
                        <label for="finish_date" class="form-label small fw-bold">Data Final</label>
                        <input type="date" name="finish_date" id="finish_date" class="form-control form-control-sm" value="{{ request('finish_date') }}">
                    </div>

                    <div class="col-md-3">
                        <label for="register_type" class="form-label small fw-bold">Tipo de Registro</label>

                        <select name="register_type" id="register_type" class="form-select form-select-sm">
                            <option value="">-- Selecione um Tipo --</option>
                            <option value="consulta" {{ request('register_type') == 'consulta' ? 'selected' }}>Consultas</option>
                            <option value="exame" {{ request('register_type') == 'exame' ? 'selected' }}>Exames</option>
                            <option value="vacina" {{ request('register_type') == 'vacina' ? 'selected' }}>Vacinas</option>
                            <option value="receita" {{ request('register_type') == 'receita' ? 'selected' }}>Receitas</option>
                        </select>
                    </div>

                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-sm w-100 fw bold">Filtrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection