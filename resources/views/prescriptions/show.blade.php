@extends('layouts.app') 
 
@section('content') 
<div class="container-fluid px-4 my-4 d-print-none"> 
   <div class="d-flex justify-content-between align-items-center mb-4"> 
       <h1 class="h4 text-gray-800 fw-bold mb-0">Visualização do Documento Clínico</h1> 
       <div> 
           <button onclick="window.print()" class="btn btn-primary btn-sm fw-bold me-1"> 
               <i class="bi bi-printer"></i> Imprimir Receituário 
           </button> 
           <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary btn-sm fw-bold">Voltar ao Livro</a> 
       </div> 
   </div> 
</div> 
 
{{-- FOLHA OFICIAL DE RECEITA (ESTILIZADA COM COMPONENTES PARA IMPRESSÃO) --}} 
<div class="container bg-white p-5 shadow-sm rounded border border-light mx-auto" style="max-width: 800px; min-height: 850px;"> 
   <!-- Cabeçalho Institucional --> 
   <div class="text-center border-bottom border-primary border-2 pb-3 mb-4"> 
       <h2 class="h3 fw-bold text-primary text-uppercase mb-1"><i class="bi bi-hospital"></i> Clínica Veterinária VetSys</h2> 
       <p class="text-muted small mb-0">Atendimento Médico Hospitalar Avançado e Diagnósticos</p> 
       <small class="text-secondary" style="font-size: 0.75rem;">Documento emitido via Prontuário Integrado</small> 
   </div> 
 
   <!-- Dados de Rastreabilidade do Paciente --> 
   <div class="p-3 bg-light rounded border mb-4"> 
       <div class="row g-2 small"> 
           <div class="col-6"><strong>Paciente (Pet):</strong> {{ $prescription->animal->name }}</div> 
           <div class="col-6"><strong>Tutor Responsável:</strong> {{ $prescription->animal->tutor->name }}</div> 
           <div class="col-6"><strong>Espécie:</strong> {{ $prescription->animal->specie->name }}</div> 
           <div class="col-6"><strong>Data de Emissão:</strong> {{ date('d/m/Y', strtotime($prescription->date)) }}</div> 
       </div> 
   </div> 
 
   <!-- Título do Documento --> 
   <div class="text-center my-4"> 
       <h4 class="fw-bold text-secondary border-bottom d-inline-block pb-1 text-uppercase fs-6">Prescrição de Medicamentos / Via do Paciente</h4> 
   </div> 
 
   <!-- Listagem Limpa para Impressão --> 
   <div class="prescription-items-print-list py-2"> 
       <ol class="list-group list-group-numbered list-group-flush"> 
           @foreach($prescription->items as $item) 
               <li class="list-group-item bg-transparent border-0 px-0 pb-4"> 
                   <span class="fw-bold text-dark fs-5 ms-1">{{ $item->medication }}</span> 
                   <div class="ps-4 mt-1 text-secondary small" style="line-height: 1.5;"> 
                       <div><i class="bi bi-arrow-return-right me-1"></i><strong>Posologia:</strong> Administrar {{ $item->dosage }}</div> 
                       <div><i class="bi bi-arrow-return-right me-1"></i><strong>Intervalo:</strong> {{ $item->frequency }}</div> 
                       <div><i class="bi bi-arrow-return-right me-1"></i><strong>Período:</strong> Manter por {{ $item->duration }}</div> 
                       @if($item->guidelines) 
                           <div class="text-dark mt-1 font-italic"><em>* Orientação Especial: {{ $item->guidelines }}</em></div> 
                       @endif 
                   </div> 
               </li> 
           @endforeach 
       </ol> 
   </div> 
 
   <!-- Observações Adicionais --> 
   @if($prescription->observations) 
       <div class="mt-4 pt-3 border-top"> 
           <h6 class="fw-bold small text-secondary text-uppercase mb-2">Recomendações Gerais / Cuidados Extras:</h6> 
           <p class="text-muted small mb-0" style="line-height: 1.6; text-align: justify;">{{ $prescription->observations }}</p> 
       </div> 
   @endif 
 
   <!-- Bloco de Assinatura Carimbo (Fundo da Folha) --> 
   <div class="text-center mx-auto" style="margin-top: 120px; max-width: 300px; border-top: 1px solid #aaa;"> 
       <small class="d-block fw-bold text-dark mt-2">Dr(a). {{ $prescription->veterinarian->name }}</small> 
       <span class="text-muted d-block" style="font-size: 0.7rem;">Médico(a) Veterinário(a) Responsável</span> 
       <span class="text-secondary d-block" style="font-size: 0.65rem;">Perfil: {{ ucfirst($prescription->veterinarian->role) }}</span> 
   </div> 
</div> 
 
{{-- CSS Adicional em Linha Tratando Ocultamento de Menus na Impressão Física --}} 
<style> 
@media print { 
   body { background-color: #fff !important; } 
   .sidebar, header, footer, .d-print-none, .alert { display: none !important; } 
   .main-wrapper, main { padding: 0 !important; margin: 0 !important; } 
   .container { max-width: 100% !important; border: none !important; shadow: none !important; box-shadow: none !important; p: 0 !important; } 
} 
</style> 
@endsection