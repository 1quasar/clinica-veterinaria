@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h1 class="h3 text-gray-800">Relatório Geral de Atendimentos</h1>
    </div>

    {{-- CARD DE FILTROS --}}
    <div class="card shadow mb-4">
        <div class="card-header bg-dark text-white fw-bold">
            <i class="bi bi-filter-square me-1"></i> Filtros de Pesquisa
        </div>
        <div class="card-body">
            <form action="{{ route('reports.index') }}" method="GET" id="formFiltro" class="row g-3">
                <div class="col-md-3">
                    <label for="start_date" class="form-label">Data Inicial</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate ?? '' }}">
                </div>

                <div class="col-md-3">
                    <label for="finish_date" class="form-label">Data Final</label>
                    <input type="date" name="finish_date" id="finish_date" class="form-control" value="{{ $finishDate ?? '' }}">
                </div>

                <div class="col-md-3">
                    <label for="status" class="form-label">Status da Consulta</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">-- Todos os Status --</option>
                        <option value="agendada" {{ ($status ?? '') == 'agendada' ? 'selected' : '' }}>Agendada</option>
                        <option value="em_andamento" {{ ($status ?? '') == 'em_andamento' ? 'selected' : '' }}>Em Andamento</option>
                        <option value="concluida" {{ ($status ?? '') == 'concluida' ? 'selected' : '' }}>Concluída</option>
                        <option value="cancelada" {{ ($status ?? '') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="veterinarian_id" class="form-label">Veterinário</label>
                    <select name="veterinarian_id" id="veterinarian_id" class="form-select">
                        <option value="">-- Todos os Veterinários --</option>
                        @foreach($veterinarians as $vet)
                            <option value="{{ $vet->id }}" {{ ($veterinarianId ?? '') == $vet->id ? 'selected' : '' }}>
                                {{ $vet->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 d-flex justify-content-between align-items-center mt-4">
                    <div>
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bi bi-search"></i> Filtrar na Tela
                        </button>
                        <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary">Limpar Filtros</a>
                    </div>

                    {{-- Botão de Exportação para PDF (Envia os mesmos parâmetros via GET) --}}
                    <button type="submit" formmethod="GET" formdata-action="{{ route('reports.pdf') }}" class="btn btn-danger" onclick="this.form.action='{{ route('reports.pdf') }}'; this.form.target='_blank';">
                        <i class="bi bi-file-earmark-pdf"></i> Gerar e Exportar PDF
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- TABELA DE PRÉ-VISUALIZAÇÃO --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Data/Hora</th>
                            <th>Paciente / Tutor</th>
                            <th>Veterinário</th>
                            <th>Status</th>
                            <th class="text-end">Valor (R$)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($consultations as $consultation)
                            <tr>
                                <td>{{ $consultation->date_time->format('d/m/Y H:i') }}</td>
                                <td>
                                    <strong>{{ $consultation->animal->name }}</strong>
                                    <br>
                                    <small class="text-muted">Tutor: {{ $consultation->animal->tutor->name }}</small>
                                </td>
                                <td>{{ $consultation->veterinarian->name }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ ucfirst($consultation->status) }}</span>
                                </td>
                                <td class="text-end">R$ {{ number_format($consultation->value, 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Nenhum registro encontrado para os filtros selecionados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Garante que o envio normal do botão Filtrar resgate a ação padrão
    document.getElementById('formFiltro').addEventListener('submit', function() {
        this.target = '_blank';
        this.action = "{{ route('reports.pdf') }}";
    });
</script>
@endsection

