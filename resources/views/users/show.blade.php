@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2>Detalhes do Usuário</h2>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">ID:</div>
            <div class="col-md-9">{{ $usuario->id }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Nome:</div>
            <div class="col-md-9">{{ $usuario->name }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">E-mail:</div>
            <div class="col-md-9">{{ $usuario->email }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Perfil:</div>
            <div class="col-md-9"><span class="badge bg-secondary">{{ ucfirst($usuario->role) }}</span></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Status:</div>
            <div class="col-md-9">
                @if($usuario->status)
                    <span class="badge bg-success">Ativo</span>
                @else
                    <span class="badge bg-danger">Inativo</span>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Criado em:</div>
            <div class="col-md-9">{{ $usuario->created_at->format('d/m/Y H:i') }}</div>
        </div>

        <div class="mt-4">
            <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>
@endsection

