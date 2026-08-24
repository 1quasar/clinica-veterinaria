@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2>Detalhes do Tutor</h2>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">ID:</div>
            <div class="col-md-9">{{ $tutor->id }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Nome:</div>
            <div class="col-md-9">{{ $tutor->name }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">CPF:</div>
            <div class="col-md-9">{{ $tutor->cpf }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Telefone:</div>
            <div class="col-md-9">{{ $tutor->phone }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Endereço:</div>
            <div class="col-md-9">{{ $tutor->address ?? 'Não informado' }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Data de Cadastro:</div>
            <div class="col-md-9">{{ $tutor->created_at->format('d/m/Y H:i') }}</div>
        </div>

        <div class="mt-4">
            <a href="{{ route('tutors.edit', $tutor) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('tutors.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>
@endsection

