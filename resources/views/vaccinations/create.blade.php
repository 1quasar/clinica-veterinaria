@extends('layouts.app') 
 
@section('content') 
<div class="container-fluid px-4 mt-4"> 
   <div class="card mb-4 border-start border-success border-4 shadow-sm"> 
       <div class="card-body"> 
           <h2 class="h4 mb-1 fw-bold text-dark">Registrar Vacinação — {{ $animal->name }}</h2> 
           <p class="text-muted mb-0">Espécie: {{ $animal->specie->name }} | Tutor: {{ $animal->tutor->name }}</p> 
       </div> 
   </div> 
 
   <form action="{{ route('vaccinations.store') }}" method="POST" class="card shadow-sm border-0"> 
       @csrf 
       <!-- Input oculto associando o pet --> 
       <input type="hidden" name="animal_id" value="{{ $animal->id }}"> 
 
       <div class="card-body bg-white rounded p-4"> 
           <div class="row g-3"> 
               <div class="col-md-6"> 
                   <label class="form-label small fw-bold">Nome da Vacina / Antígeno <span class="text-danger">*</span></label> 
                   <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Ex: Antirrábica, V10, Quádrupla Felina" required> 
                   @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror 
               </div> 
 
               <div class="col-md-3"> 
                   <label class="form-label small fw-bold">Data de Aplicação <span class="text-danger">*</span></label> 
                   <input type="date" name="application_date" class="form-control @error('application_date') is-invalid @enderror" value="{{ old('application_date', date('Y-m-d')) }}" required> 
                   @error('application_date')<div class="invalid-feedback">{{ $message }}</div>@enderror 
               </div> 
 
               <div class="col-md-3"> 
                   <label class="form-label small fw-bold">Próxima Dose / Reforço (Opcional)</label> 
                   <input type="date" name="next_dose_date" class="form-control @error('next_dose_date') is-invalid @enderror" value="{{ old('next_dose_date') }}"> 
                   @error('next_dose_date')<div class="invalid-feedback">{{ $message }}</div>@enderror 
               </div> 
 
               <div class="col-md-6"> 
                   <label class="form-label small fw-bold">Lote de Fabricação</label> 
                   <input type="text" name="batch" class="form-control @error('batch') is-invalid @enderror" value="{{ old('batch') }}" placeholder="Ex: L74829"> 
                   @error('batch')<div class="invalid-feedback">{{ $message }}</div>@enderror 
               </div> 
 
               <div class="col-md-6"> 
                   <label class="form-label small fw-bold">Laboratório Fabricante</label> 
                   <input type="text" name="manufacturer" class="form-control @error('manufacturer') is-invalid @enderror" value="{{ old('manufacturer') }}" placeholder="Ex: Zoetis, Boehringer Ingelheim"> 
                   @error('manufacturer')<div class="invalid-feedback">{{ $message }}</div>@enderror 
               </div> 
 
               <div class="col-md-12"> 
                   <label class="form-label small fw-bold">Observações Adicionais</label> 
                   <textarea name="observations" class="form-control @error('observations') is-invalid @enderror" rows="3" placeholder="Anotações sobre reações adversas, peso no momento da aplicação ou via de administração...">{{ old('observations') }}</textarea> 
                   @error('observations')<div class="invalid-feedback">{{ $message }}</div>@enderror 
               </div> 
           </div> 
       </div> 
       <div class="card-footer bg-light d-flex justify-content-end gap-2 p-3"> 
           <a href="{{ route('vaccinations.index') }}" class="btn btn-secondary btn-sm fw-bold">Cancelar</a> 
           <button type="submit" class="btn btn-success btn-sm fw-bold">Salvar Registro</button> 
       </div> 
   </form> 
</div> 
@endsection