@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h1 class="h3 text-gray-800">Prontuário / Detalhes do Paciente</h1>
        <a href="{{ route('animals.index') }}" class="btn btn-secondary">Voltar para Lista</a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Informações do Paciente</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th class="w-35">Nome:</th>
                            <td class="fw-bold">{{ $animal->name }}</td>
                        </tr>
                        <tr>
                            <th>Espécie:</th>
                            <td>{{ $animal->specie }}</td>
                        </tr>
                        <tr>
                            <th>Raça:</th>
                            <td>{{ $animal->race ?? 'Não informada' }}</td>
                        </tr>
                        <tr>
                            <th>Sexo:</th>
                            <td>{{ ucfirst($animal->gender) }}</td>
                        </tr>
                        <tr>
                            <th>Data de Nasc.:</th>
                            <td>{{ $animal->birth_date ? \Carbon\Carbon::parse($animal->birth_date)->format('d/m/Y') : 'Não informada' }}</td>
                        </tr>
                        <tr>
                            <th>Peso Atual:</th>
                            <td>{{ $animal->weight ? number_format($animal->weight, 2, ',', '.').' kg' : 'Não informado' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">Dados do Tutor Responsável</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th class="w-35">Nome do Tutor:</th>
                            <td class="fw-bold">{{ $animal->tutor->name }}</td>
                        </tr>
                        <tr>
                            <th>CPF:</th>
                            <td>{{ $animal->tutor->cpf }}</td>
                        </tr>
                        <tr>
                            <th>Telefone / WhatsApp:</th>
                            <td>{{ $animal->tutor->phone ?? 'Não informado' }}</td>
                        </tr>
                    </table>
                    <div class="mt-3">
                        <a href="{{ route('tutors.show', $animal->tutor) }}" class="btn btn-outline-info btn-sm">
                            Ver Perfil do Tutor
                        </a>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">Observações</h5>
                </div>
                <div class="card-body">
                    <p class="mb-0 text-muted">{{ $animal->observation ?? 'Nenhuma observação cadastrada para este paciente.' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

