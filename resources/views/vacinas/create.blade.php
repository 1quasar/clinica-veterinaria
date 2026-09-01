@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Registrar Vacina — {{ $animal->name }}</h2>

    <form action="{{ route('vacinas.store') }}" method="POST" class="card card-body mt-3">
        @csrf
        <input type="hidden" name="animal_id" value="{{ $animal->id }}">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nome da Vacina</label>
                <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}" required>
                @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Data de Aplicação</label>
                <input type="date" name="data_aplicacao" class="form-control" value="{{ old('data_aplicacao', date('Y-m-d')) }}" required>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Próxima Dose (Opcional)</label>
                <input type="date" name="data_proxima_dose" class="form-control" value="{{ old('data_proxima_dose') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Lote</label>
                <input type="text" name="lote" class="form-control" value="{{ old('lote') }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Fabricante</label>
                <input type="text" name="fabricante" class="form-control" value="{{ old('fabricante') }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Observações</label>
            <textarea name="observacoes" class="form-control" rows="2">{{ old('observacoes') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Salvar Vacina</button>
    </form>
</div>
@endsection

