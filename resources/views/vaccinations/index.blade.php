@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h1 class="h3 text-gray-800 mb-0">
            Histórico Geral de Vacinações
        </h1>
        <a href="{{ route('vaccinations.create', 'animal') }}" class="btn btn-success">
            <i class="bi bi-shield-plus me-1"></i> Registrar Vacina
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('vaccinations.index') }}" method="GET" class="d-flex gap-2 mb-3">
                <input type="text" name="search" class="form-control" placeholder="Pesquisar por vacina ou paciente..." value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-secondary">Pesquisar</button>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Data Aplicação</th>
                            <th>Paciente</th>
                            <th>Vacina</th>
                            <th>Lote / Fabricante</th>
                            <th>Veterinário</th>
                            <th>Próxima Dose</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vaccinations as $vax)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($vax->application_date)) }}</td>
                                <td class="fw-bold">{{ $vax->animal->name }}</td>
                                <td>{{ $vax->name }}</td>
                                <td>{{ $vax->batch ?? 'N/A' }} / {{ $vax->manufacturer ?? 'N/A' }}</td>
                                <td>{{ $vax->veterinarian->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $vax->next_dose_date ? 'success' : 'secondary' }}">
                                        {{ $vax->next_dose_date ? date('d/m/Y', strtotime($vax->next_dose_date)) : 'Dose Única' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-3 text-muted">
                                    Nenhum registro de vacina localizado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-2">{{ $vaccinations->links() }}</div>
        </div>
    </div>
</div>
@endsection