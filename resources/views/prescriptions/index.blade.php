@extends('layouts.app') 
 
@section('content') 
<div class="container-fluid px-4"> 
    <div class="d-flex justify-content-between align-items-center my-4"> 
        <h1 class="h3 text-gray-800">Livro de Registro de Receitas</h1> 
    </div> 
 
    <div class="card shadow mb-4"> 
        <div class="card-body"> 
            <form action="{{ route('prescriptions.index') }}" method="GET" class="d-flex gap-2 mb-3"> 
                <input type="text" name="search" class="form-control" placeholder="Pesquisar por paciente..." value="{{ $search ?? '' }}"> 
                <button type="submit" class="btn btn-secondary">Pesquisar</button> 
            </form> 
 
            <div class="table-responsive"> 
                <table class="table table-striped table-hover align-middle"> 
                    <thead class="table-dark"> 
                        <tr> 
                            <th>Emissão</th> 
                            <th>Paciente</th> 
                            <th>Tutor</th> 
                            <th>Veterinário Emissor</th> 
                            <th>Vínculo Clínico</th> 
                            <th class="text-end">Ações</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        @forelse($prescriptions as $presc) 
                            <tr> 
                                <td>{{ date('d/m/Y', strtotime($presc->date)) }}</td> 
                                <td class="fw-bold">{{ $presc->animal->name }}</td> 
                                <td>{{ $presc->animal->tutor->name }}</td> 
                                <td>{{ $presc->veterinarian->name }}</td> 
                                <td> 
                                    <span class="badge bg-{{ $presc->consultation_id ? 'info' : 'secondary' }}"> 
                                        {{ $presc->consultation_id ? 'Consulta #' . $presc->consultation_id : 'Atendimento Avulso' }} 
                                    </span> 
                                </td> 
                                <td class="text-end"> 
                                    <a href="{{ route('prescriptions.show', $presc) }}" class="btn btn-sm btn-primary">Visualizar Impressão</a> 
                                </td> 
                            </tr> 
                        @empty 
                            <tr><td colspan="6" class="text-center py-3 text-muted">Nenhuma receita localizada no livro de registros.</td></tr> 
                        @endforelse 
                    </tbody> 
                </table> 
            </div> 
            <div class="mt-2">{{ $prescriptions->links() }}</div> 
        </div> 
    </div> 
</div> 
@endsection