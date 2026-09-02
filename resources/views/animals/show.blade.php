@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Prontuário do Paciente: {{ $animal->name }}</h2>
        <div>
            <a href="{{ route('animals.edit', $animal) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('animals.history', $animal->id) }}" class="btn btn-info">Histórico do Paciente</a>
            <a href="{{ route('animals.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-light"><strong>Informações do Pet</strong></div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr><th>Nome:</th><td>{{ $animal->name }}</td></tr>
                        <tr><th>Espécie:</th><td>{{ $animal->specie->name }}</td></tr>
                        <tr><th>Raça:</th><td>{{ $animal->race->name ?? 'Não informada' }}</td></tr>
                        <tr><th>Sexo:</th><td>{{ ($animal->gender) === 'male' ? 'Macho' : 'Fêmea' }}</td></tr>
                        <tr><th>Data de Nascimento:</th><td>{{ $animal->birth_date ? date('d/m/Y', strtotime($animal->birth_date)) : 'Não informada' }}</td></tr>
                        <tr><th>Peso:</th><td>{{ $animal->weight ? $animal->weight . ' kg' : 'Não informado' }}</td></tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-light"><strong>Informações do Tutor</strong></div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr><th>Tutor:</th><td>{{ $animal->tutor->name }}</td></tr>
                        <tr><th>CPF:</th><td>{{ $animal->tutor->cpf }}</td></tr>
                        <tr><th>Telefone:</th><td>{{ $animal->tutor->phone ?? 'Não informado' }}</td></tr>
                        <tr><th>Endereço:</th><td>{{ $animal->tutor->address ?? 'Não informado' }}</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light"><strong>Observações Médicas</strong></div>
        <div class="card-body">
            <p class="mb-0">{{ $animal->observation ?? 'Nenhuma observação registrada.' }}</p>
        </div>
    </div>
</div>
@endsection