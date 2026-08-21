@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h1 class="h3 text-gray-800">Pacientes (Animais)</h1>
        <a href="{{ route('animals.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Novo Paciente
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
            <form action="{{ route('animals.index') }}" method="GET" class="row g-2 mb-3">
                <div class="col-md-10">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Pesquisar por nome do pet, espécie ou nome do tutor..." 
                           value="{{ $search ?? '' }}">
                </div>
                <div class="col-md-2 d-grid gap-2 d-md-flex">
                    <button type="submit" class="btn btn-secondary w-100">Pesquisar</button>
                    @if($search)
                        <a href="{{ route('animals.index') }}" class="btn btn-outline-secondary">Limpar</a>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nome do Pet</th>
                            <th>Espécie / Raça</th>
                            <th>Sexo</th>
                            <th>Tutor Responsável</th>
                            <th>Peso (kg)</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($animals as $animal)
                            <tr>
                                <td class="fw-bold">{{ $animal->name }}</td>
                                <td>{{ $animal->specie }} {{ $animal->race ? '('.$animal->race.')' : '' }}</td>
                                <td>
                                    @if($animal->gender == 'male')
                                        <span class="badge bg-info text-dark">Macho</span>
                                    @else
                                        <span class="badge bg-danger">Fêmea</span>
                                    @endif
                                </td>
                                <td>{{ $animal->tutor->name }}</td>
                                <td>{{ $animal->weight ? number_format($animal->weight, 2, ',', '.').' kg' : 'N/I' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('animals.show', $animal) }}" class="btn btn-sm btn-info text-white me-1">Ver</a>
                                    <a href="{{ route('animals.edit', $animal) }}" class="btn btn-sm btn-warning me-1">Editar</a>
                                    
                                    <form action="{{ route('animals.destroy', $animal) }}" method="POST" class="d-inline form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-delete">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Nenhum paciente cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $animals->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('.form-delete');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Confirma a exclusão?',
                    text: "Esta ação removerá o registro do paciente permanentemente!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection

