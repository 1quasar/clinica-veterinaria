@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Emitir Receita — {{ $animal->nome }}</h2>

    <form action="{{ route('receitas.store') }}" method="POST" class="mt-3">
        @csrf
        <input type="hidden" name="animal_id" value="{{ $animal->id }}">

        @if(request('consulta_id'))
            <input type="hidden" name="consulta_id" value="{{ request('consulta_id') }}">
        @endif

        <div class="card card-body mb-3">
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Data</label>
                    <input type="date" name="data" class="form-control" value="{{ old('data', date('Y-m-d')) }}" required>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Medicamentos</h4>
            <button type="button" id="add-medicamento" class="btn btn-sm btn-outline-success">
                + Adicionar Outro Medicamento
            </button>
        </div>

        <div id="medicamentos-container">
            <div class="card card-body mb-3 item-medicamento">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 fw-bold text-secondary">Medicamento #1</h6>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-medicamento d-none">
                        Remover
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <input type="text" name="itens[0][medicamento]" class="form-control" placeholder="Medicamento" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="text" name="itens[0][dosagem]" class="form-control" placeholder="Dosagem (ex: 500mg)" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="text" name="itens[0][frequencia]" class="form-control" placeholder="Frequência (ex: 12/12h)" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="text" name="itens[0][duracao]" class="form-control" placeholder="Duração (ex: 7 dias)" required>
                    </div>
                </div>
                <div class="mt-2">
                    <input type="text" name="itens[0][orientacoes]" class="form-control" placeholder="Orientações adicionais">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Observações da Receita</label>
            <textarea name="observacoes" class="form-control" rows="2">{{ old('observacoes') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Emitir Receita</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let itemIndex = 1;

    const container = document.getElementById('medicamentos-container');
    const addButton = document.getElementById('add-medicamento');

    addButton.addEventListener('click', function () {
        const newItem = document.createElement('div');
        newItem.className = 'card card-body mb-3 item-medicamento';
        newItem.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0 fw-bold text-secondary">Medicamento #${itemIndex + 1}</h6>
                <button type="button" class="btn btn-sm btn-outline-danger remove-medicamento">
                    Remover
                </button>
            </div>
            <div class="row">
                <div class="col-md-3 mb-2">
                    <input type="text" name="itens[${itemIndex}][medicamento]" class="form-control" placeholder="Medicamento" required>
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" name="itens[${itemIndex}][dosagem]" class="form-control" placeholder="Dosagem (ex: 500mg)" required>
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" name="itens[${itemIndex}][frequencia]" class="form-control" placeholder="Frequência (ex: 12/12h)" required>
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" name="itens[${itemIndex}][duracao]" class="form-control" placeholder="Duração (ex: 7 dias)" required>
                </div>
            </div>
            <div class="mt-2">
                <input type="text" name="itens[${itemIndex}][orientacoes]" class="form-control" placeholder="Orientações adicionais">
            </div>
        `;
        container.appendChild(newItem);
        itemIndex++;
        updateRemoveButtons();
    });

    container.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-medicamento')) {
            const items = container.querySelectorAll('.item-medicamento');
            if (items.length > 1) {
                e.target.closest('.item-medicamento').remove();
                updateRemoveButtons();
            }
        }
    });

    function updateRemoveButtons() {
        const items = container.querySelectorAll('.item-medicamento');
        items.forEach((item) => {
            const removeBtn = item.querySelector('.remove-medicamento');
            if (items.length === 1) {
                removeBtn.classList.add('d-none');
            } else {
                removeBtn.classList.remove('d-none');
            }
        });
    }
});
</script>
@endsection

