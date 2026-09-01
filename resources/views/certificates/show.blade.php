@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h1 class="h3 text-gray-800">Detalhes do Atestado: {{ $certificate->title }}</h1>
        <div>
            <a href="{{ route('certificates.edit', $certificate) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('certificates.index') }}" class="btn btn-secondary">Voltar</a>
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
                        <tr><th>Nome do Atestado:</th><td class="fw-bold">{{ $certificate->title }}</td></tr>
                        <tr><th>Data de Emissão:</th><td>{{ $certificate->issue_date->format('d/m/Y') }}</td></tr>
                        <tr><th>Paciente:</th><td>{{ $certificate->animal->name }}</td></tr>
                        <tr><th>Tutor:</th><td>{{ $certificate->animal->tutor->name }}</td></tr>
                        <tr><th>Laboratório:</th><td>{{ $certificate->laboratory ?? 'Não informado' }}</td></tr>
                        <tr>
                            <th>Consulta:</th>
                            <td>
                                @if($certificate->consultation)
                                    <a href="{{ route('consultations.show', $certificate->consultation) }}">Consulta #{{ $certificate->consultation->id }}</a>
                                @else
                                    <span class="text-muted">Avulso</span>
                                @endif
                            </td>
                        </tr>
                    </table>

                    <div class="mt-3">
                        <h6><strong>Observações:</strong></h6>
                        <p class="text-muted">{{ $certificate->observations ?? 'Nenhuma observação cadastrada.' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Visualização do Anexo</h5>
                    <a href="{{ asset('storage/' . $certificate->file_path) }}" download class="btn btn-sm btn-light">
                        <i class="bi bi-download"></i> Baixar Arquivo
                    </a>
                </div>
                <div class="card-body text-center">
                    @php $ext = pathinfo($certificate->file_path, PATHINFO_EXTENSION); @endphp

                    @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $certificate->file_path) }}" class="img-fluid rounded border shadow-sm" style="max-height: 500px;" alt="Atestado">
                    @elseif(strtolower($ext) === 'pdf')
                        <iframe src="{{ asset('storage/' . $certificate->file_path) }}" width="100%" height="500px" class="border rounded"></iframe>
                    @else
                        <div class="py-5">
                            <i class="bi bi-file-earmark-text display-1 text-secondary"></i>
                            <p class="mt-3">Visualização direta indisponível para este formato de arquivo.</p>
                            <a href="{{ asset('storage/' . $certificate->file_path) }}" target="_blank" class="btn btn-primary">Abrir Arquivo</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

