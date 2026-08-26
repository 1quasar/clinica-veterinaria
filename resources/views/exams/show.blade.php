@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h1 class="h3 text-gray-800">Detalhes do Exame: {{ $exam->name }}</h1>
        <div>
            <a href="{{ route('exams.edit', $exam) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('exams.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Informações Gerais</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><th>Nome do Exame:</th><td class="fw-bold">{{ $exam->name }}</td></tr>
                        <tr><th>Data:</th><td>{{ $exam->exam_date->format('d/m/Y') }}</td></tr>
                        <tr><th>Paciente:</th><td>{{ $exam->animal->name }}</td></tr>
                        <tr><th>Tutor:</th><td>{{ $exam->animal->tutor->name }}</td></tr>
                        <tr><th>Laboratório:</th><td>{{ $exam->laboratory ?? 'Não informado' }}</td></tr>
                        <tr>
                            <th>Consulta:</th>
                            <td>
                                @if($exam->consultation)
                                    <a href="{{ route('consultations.show', $exam->consultation) }}">Consulta #{{ $exam->consultation->id }}</a>
                                @else
                                    <span class="text-muted">Avulso</span>
                                @endif
                            </td>
                        </tr>
                    </table>

                    <div class="mt-3">
                        <h6><strong>Observações:</strong></h6>
                        <p class="text-muted">{{ $exam->observations ?? 'Nenhuma observação cadastrada.' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Visualização do Anexo</h5>
                    <a href="{{ asset('storage/' . $exam->file_path) }}" download class="btn btn-sm btn-light">
                        <i class="bi bi-download"></i> Baixar Arquivo
                    </a>
                </div>
                <div class="card-body text-center">
                    @php $ext = pathinfo($exam->file_path, PATHINFO_EXTENSION); @endphp

                    @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $exam->file_path) }}" class="img-fluid rounded border shadow-sm" style="max-height: 500px;" alt="Exame">
                    @elseif(strtolower($ext) === 'pdf')
                        <iframe src="{{ asset('storage/' . $exam->file_path) }}" width="100%" height="500px" class="border rounded"></iframe>
                    @else
                        <div class="py-5">
                            <i class="bi bi-file-earmark-text display-1 text-secondary"></i>
                            <p class="mt-3">Visualização direta indisponível para este formato de arquivo.</p>
                            <a href="{{ asset('storage/' . $exam->file_path) }}" target="_blank" class="btn btn-primary">Abrir Arquivo</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

