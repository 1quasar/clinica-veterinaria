@extends('layouts.app') 

@section('content') 
<div class="container-fluid px-4 mt-4"> 
    <div class="card mb-4 border-start border-primary border-4 shadow-sm"> 
        <div class="card-body"> 
            <h2 class="h4 mb-1 fw-bold text-dark">Emitir Receituário Clínico</h2> 
            <p class="text-muted mb-0">Selecione o paciente e informe as prescrições médicas necessários.</p> 
        </div> 
    </div> 

    <form action="{{ route('prescriptions.store') }}" method="POST" class="mt-3"> 
        @csrf 

        {{-- Se vier de um atendimento de consulta, vincula automaticamente --}} 
        @if(request('consultation_id')) 
            <input type="hidden" name="consultation_id" value="{{ request('consultation_id') }}"> 
        @endif 

        <div class="card card-body shadow-sm border-0 mb-4 p-4"> 
            <div class="row g-3"> 
                <div class="col-md-8"> 
                    <label class="form-label small fw-bold">Paciente (Animal) <span class="text-danger">*</span></label> 
                    <select name="animal_id" class="form-select form-select-sm @error('animal_id') is-invalid @enderror" required> 
                        <option value="">-- Selecione o Paciente --</option> 
                        @foreach($animals as $animal) 
                            <option value="{{ $animal->id }}" {{ old('animal_id', $selectedAnimalId) == $animal->id ? 'selected' : '' }}> 
                                {{ $animal->name }} — Tutor: {{ $animal->tutor->name ?? 'N/A' }} 
                            </option> 
                        @endforeach 
                    </select> 
                    @error('animal_id')<div class="invalid-feedback">{{ $message }}</div>@enderror 
                </div> 
                <div class="col-md-4"> 
                    <label class="form-label small fw-bold">Data de Emissão <span class="text-danger">*</span></label> 
                    <input type="date" name="date" class="form-control form-control-sm @error('date') is-invalid @enderror" value="{{ old('date', date('Y-m-d')) }}" required> 
                    @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror 
                </div> 
            </div> 
        </div> 

        <div class="d-flex justify-content-between align-items-center mb-3"> 
            <h4 class="h5 mb-0 fw-bold text-dark"><i class="bi bi-capsule"></i> Medicamentos Prescritos</h4> 
            <button type="button" id="add-item" class="btn btn-sm btn-outline-success fw-bold"> 
                <i class="bi bi-plus-lg"></i> Adicionar Medicamento 
            </button> 
        </div> 

        {{-- Container Insumos Dinâmicos JavaScript --}} 
        <div id="items-container"> 
            <div class="card card-body shadow-sm border-0 mb-3 prescription-item-block"> 
                <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2"> 
                    <h6 class="mb-0 fw-bold text-secondary text-uppercase fs-7 item-number">Medicamento #1</h6> 
                    <button type="button" class="btn btn-sm btn-outline-danger remove-item d-none"> 
                        <i class="bi bi-trash"></i> Remover 
                    </button> 
                </div> 
                <div class="row g-3"> 
                    <div class="col-md-3"> 
                        <label class="form-label small">Princípio Ativo / Nome Comercial</label> 
                        <input type="text" name="items[0][medication]" class="form-control form-control-sm" placeholder="Ex: Amoxicilina 250mg" required> 
                    </div> 
                    <div class="col-md-3"> 
                        <label class="form-label small">Dosagem / Posologia</label> 
                        <input type="text" name="items[0][dosage]" class="form-control form-control-sm" placeholder="Ex: 1/2 comprimido ou 2ml" required> 
                    </div> 
                    <div class="col-md-3"> 
                        <label class="form-label small">Frequência de Administração</label> 
                        <input type="text" name="items[0][frequency]" class="form-control form-control-sm" placeholder="Ex: A cada 12 horas (BID)" required> 
                    </div> 
                    <div class="col-md-3"> 
                        <label class="form-label small">Duração do Tratamento</label> 
                        <input type="text" name="items[0][duration]" class="form-control form-control-sm" placeholder="Ex: 7 dias" required> 
                    </div> 
                    <div class="col-md-12"> 
                        <label class="form-label small">Orientações de Uso Específicas (Opcional)</label> 
                        <input type="text" name="items[0][guidelines]" class="form-control form-control-sm" placeholder="Ex: Fornecer misturado à ração logo após o almoço"> 
                    </div> 
                </div> 
            </div> 
        </div> 

        <div class="card card-body shadow-sm border-0 mb-4 p-4"> 
            <label class="form-label small fw-bold">Observações Gerais do Receituário</label> 
            <textarea name="observations" class="form-control" rows="2" placeholder="Recomendações gerais de repouso, retorno clínico ou cuidados preventivos...">{{ old('observations') }}</textarea> 
        </div> 

        <div class="d-flex justify-content-end gap-2 mb-5"> 
            <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary btn-sm fw-bold">Cancelar</a> 
            <button type="submit" class="btn btn-primary btn-sm fw-bold">Emitir e Registrar</button> 
        </div> 
    </form> 
</div> 

<script> 
document.addEventListener('DOMContentLoaded', function () { 
    let blockIndex = 1; 

    const container = document.getElementById('items-container'); 
    const addBtn = document.getElementById('add-item'); 

    addBtn.addEventListener('click', function () { 
        const newBlock = document.createElement('div'); 
        newBlock.className = 'card card-body shadow-sm border-0 mb-3 prescription-item-block'; 
        newBlock.innerHTML = ` 
            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2"> 
                <h6 class="mb-0 fw-bold text-secondary text-uppercase fs-7 item-number">Medicamento #${blockIndex + 1}</h6> 
                <button type="button" class="btn btn-sm btn-outline-danger remove-item"> 
                    <i class="bi bi-trash"></i> Remover 
                </button> 
            </div> 
            <div class="row g-3"> 
                <div class="col-md-3"> 
                    <label class="form-label small">Princípio Ativo / Nome Comercial</label> 
                    <input type="text" name="items[${blockIndex}][medication]" class="form-control form-control-sm" required> 
                </div> 
                <div class="col-md-3"> 
                    <label class="form-label small">Dosagem / Posologia</label> 
                    <input type="text" name="items[${blockIndex}][dosage]" class="form-control form-control-sm" required> 
                </div> 
                <div class="col-md-3"> 
                    <label class="form-label small">Frequência de Administração</label> 
                    <input type="text" name="items[${blockIndex}][frequency]" class="form-control form-control-sm" required> 
                </div> 
                <div class="col-md-3"> 
                    <label class="form-label small">Duração do Tratamento</label> 
                    <input type="text" name="items[${blockIndex}][duration]" class="form-control form-control-sm" required> 
                </div> 
                <div class="col-md-12"> 
                    <label class="form-label small">Orientações de Uso Específicas (Opcional)</label> 
                    <input type="text" name="items[${blockIndex}][guidelines]" class="form-control form-control-sm"> 
                </div> 
            </div> 
        `; 
        container.appendChild(newBlock); 
        blockIndex++; 
        syncRemoveButtons(); 
    }); 

    container.addEventListener('click', function (e) { 
        if (e.target && e.target.closest('.remove-item')) { 
            e.target.closest('.prescription-item-block').remove(); 
            reindexBlocks(); 
            syncRemoveButtons(); 
        } 
    }); 

    function reindexBlocks() { 
        const blocks = container.querySelectorAll('.prescription-item-block'); 
        blockIndex = blocks.length; 
        blocks.forEach((block, index) => { 
            block.querySelector('.item-number').textContent = `Medicamento #${index + 1}`; 
            
            block.querySelectorAll('input').forEach(input => { 
                const nameAttr = input.getAttribute('name'); 
                if (nameAttr) { 
                    const updatedName = nameAttr.replace(/items\[\d+\]/, `items[${index}]`); 
                    input.setAttribute('name', updatedName); 
                } 
            }); 
        }); 
    } 

    function syncRemoveButtons() { 
        const blocks = container.querySelectorAll('.prescription-item-block'); 
        blocks.forEach((block) => { 
            const btn = block.querySelector('.remove-item'); 
            if (blocks.length === 1) { 
                btn.classList.add('d-none'); 
            } else { 
                btn.classList.remove('d-none'); 
            } 
        }); 
    } 
}); 
</script> 
@endsection