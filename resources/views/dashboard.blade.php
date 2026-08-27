@extends('layouts.app')

@section('content')

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h1 class="h3 text-gray-800">Painel Gerencial</h1>
        <span class="badge bg-primary fs-6">
            <i class="bi bi-calendar-check"></i> {{ \Carbon\Carbon::now()->locale('pt_BR')->translatedFormat('l, d \d\e F \d\e Y') }}
        </span>
    </div>

    {{-- CARDS DE KPIS --}}
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-start border-4 border-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total de Tutores</div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ number_format($totalTutors, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fs-1 text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-start border-4 border-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">Pacientes (Animais)</div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ number_format($totalAnimals, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-heart-pulse fs-1 text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-start border-4 border-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">Consultas Hoje</div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ number_format($todayAppointments, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calendar-event fs-1 text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-start border-4 border-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-info text-uppercase mb-1">Faturamento (Mês)</div>
                            <div class="h5 mb-0 fw-bold text-gray-800">R$ {{ number_format($monthRevenue, 2, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cash-coin fs-1 text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- GRÁFICOS --}}
    <div class="row g-4 mb-4">
        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-dark text-white fw-bold">
                    <i class="bi bi-graph-up me-1"></i> Evolução de Consultas (Últimos Meses)
                </div>
                <div class="card-body">
                    <canvas id="chartConsultas" style="max-height: 320px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-dark text-white fw-bold">
                    <i class="bi bi-pie-chart me-1"></i> Pacientes por Espécie
                </div>
                <div class="card-body">
                    <canvas id="chartEspecies" style="max-height: 320px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- TABELA DE CONSULTAS DO DIA --}}
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0 fs-6">
                <i class="bi bi-clock-history me-1"></i> Próximos Atendimentos Agendados para Hoje
            </h5>
            <a href="{{ route('consultations.index') }}" class="btn btn-sm btn-light">Ver Todas</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Horário</th>
                            <th>Paciente (Pet)</th>
                            <th>Tutor</th>
                            <th>Veterinário</th>
                            <th>Status</th>
                            <th class="text-end">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($consultationOfDay as $consultation)
                            <tr>
                                <td class="fw-bold">{{ $consultation->date_time->format('H:i') }}</td>
                                <td>{{ $consultation->animal->name }}</td>
                                <td>{{ $consultation->animal->tutor->name }}</td>
                                <td>{{ $consultation->veterinarian->name }}</td>
                                <td>
                                    @switch($consultation->status)
                                        @case('agendada')
                                            <span class="badge bg-warning text-dark">Agendada</span>
                                            @break
                                        @case('em_andamento')
                                            <span class="badge bg-info text-white">Em Andamento</span>
                                            @break
                                        @case('concluida')
                                            <span class="badge bg-success">Concluída</span>
                                            @break
                                        @case('cancelada')
                                            <span class="badge bg-danger">Cancelada</span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('consultations.edit', $consultation) }}" class="btn btn-sm btn-outline-primary">
                                        Atender / Editar
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-3 text-muted">Nenhuma consulta agendada para o dia de hoje.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Gráfico de Evolução de Consultas
        const ctxConsultas = document.getElementById('chartConsultas').getContext('2d');
        new Chart(ctxConsultas, {
            type: 'bar',
            data: {
                labels: @json($labelsMonths),
                datasets: [{
                    label: 'Total de Consultas',
                    data: @json($dataAppointments),
                    backgroundColor: 'rgba(13, 110, 253, 0.7)',
                    borderColor: 'rgba(13, 110, 253, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });

        // 2. Gráfico de Pacientes por Espécie
        const ctxSpecies = document.getElementById('chartEspecies').getContext('2d');
        new Chart(ctxSpecies, {
            type: 'doughnut',
            data: {
                labels: @json($labelsSpecies),
                datasets: [{
                    data: @json($speciesData),
                    backgroundColor: [
                        '#0d6efd',
                        '#198754',
                        '#ffc107',
                        '#0dcaf0',
                        '#dc3545',
                        '#6c757d'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
</script>

@endsection