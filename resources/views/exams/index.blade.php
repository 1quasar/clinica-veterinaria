@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h1 class="h3 text-gray-800">Exames Médicos</h1>
        <a href="{{ route('exams.create') }}" class="btn btn-primary">
            <i class="bi bi-file-earmark-medical"></i> Novo Exame
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('exams.index') }}" method="GET" class="row g-2 mb-3">
                <div class="col-md-10">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Pesquisar por nome do exame, laboratório ou paciente..." 
                           value="{{ $search ?? '' }}">
                </div>
                <div class="col-md-2 d-grid gap-2 d-md-flex">
                    <button type="submit" class="btn btn-secondary w-100">Pesquisar</button>
                    @if($search)
                        <a href="{{ route('exams.index') }}" class="btn btn-outline-secondary">Limpar</a>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Data</th>
                            <th>Exame</th>
                            <th>Paciente / Tutor</th>
                            <th>Laboratório</th>
                            <th>Arquivo Anexo</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($exams as $exam)
                            <tr>
                                <td>{{ $exam->exam_date->format('d/m/Y') }}</td>
                                <td class="fw-bold">{{ $exam->name }}</td>
                                <td>
                                    {{ $exam->animal->name }}
                                    <br>
                                    <small class="text-muted">Tutor: {{ $exam->animal->tutor->name }}</small>
                                </td>
                                <td>{{ $exam->laboratory ?? 'Não informado' }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $exam->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-file-earmark-arrow-down"></i> Visualizar Anexo
                                    </a>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('exams.show', $exam) }}" class="btn btn-sm btn-info text-white me-1">Ver</a>
                                    <a href="{{ route('exams.edit', $exam) }}" class="btn btn-sm btn-warning me-1">Editar</a>
                                    
                                    <form action="{{ route('exams.destroy', $exam) }}" method="POST" class="d-inline form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-delete">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Nenhum exame cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $exams->links() }}
            </div>
        </div>
    </div>
</div>

@endsection