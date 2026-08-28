<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Atendimentos Médicos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #0d6efd;
            text-transform: uppercase;
        }
        .header p {
            margin: 3px 0 0;
            font-size: 11px;
            color: #666;
        }
        .info-filtros {
            margin-bottom: 15px;
            background-color: #f8f9fa;
            padding: 8px;
            border-radius: 4px;
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #dddddd;
            padding: 6px 8px;
            text-align: left;
        }
        table th {
            background-color: #343a40;
            color: #ffffff;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .text-right {
            text-align: right;
        }
        .total-box {
            float: right;
            width: 250px;
            border: 1px solid #343a40;
            padding: 8px;
            background-color: #e9ecef;
            text-align: right;
            font-size: 12px;
            font-weight: bold;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 9px;
            color: #999999;
            border-top: 1px solid #dddddd;
            padding-top: 5px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Sistema Clínico Veterinário — VetSys</h1>
        <p>Relatório de Atendimentos e Consultas Médicas</p>
        <p>Gerado em: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <div class="info-filtros">
        <strong>Filtros Aplicados:</strong> 
        Período: {{ $startDate ? date('d/m/Y', strtotime($startDate)) : 'Início' }} até {{ $finishDate ? date('d/m/Y', strtotime($finishDate)) : 'Atual' }}
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 12%;">Data/Hora</th>
                <th style="width: 28%;">Paciente / Tutor</th>
                <th style="width: 25%;">Veterinário</th>
                <th style="width: 15%;">Status</th>
                <th style="width: 20%;" class="text-right">Valor (R$)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($consultations as $consultation)
                <tr>
                    <td>{{ $consultation->date_time->format('d/m/Y H:i') }}</td>
                    <td>
                        <strong>{{ $consultation->animal->name }}</strong><br>
                        <small>Tutor: {{ $consultation->animal->tutor->name }}</small>
                    </td>
                    <td>{{ $consultation->veterinarian->name }}</td>
                    <td>{{ ucfirst($consultation->status) }}</td>
                    <td class="text-right">R$ {{ number_format($consultation->value, 2, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Nenhuma consulta localizada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total-box">
        Total Concluído: R$ {{ number_format($revenueTotal, 2, ',', '.') }}
    </div>

    <div class="footer">
        VetSys — Relatório Emitido Automaticamente pelo Sistema. Página 1
    </div>

</body>
</html>

