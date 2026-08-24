@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2>Detalhes do Usuário</h2>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">ID:</div>
            <div class="col-md-9">{{ $user->id }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Nome:</div>
            <div class="col-md-9">{{ $user->name }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">E-mail:</div>
            <div class="col-md-9">{{ $user->email }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Perfil:</div>
            <div class="col-md-9"><span class="badge bg-secondary">{{ ucfirst($user->role) }}</span></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Status:</div>
            <div class="col-md-9">
                @if($user->status)
                    <span class="badge bg-success">Ativo</span>
                @else
                    <span class="badge bg-danger">Inativo</span>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Criado em:</div>
            <div class="col-md-9">{{ $user->created_at->format('d/m/Y H:i') }}</div>
        </div>

        <div class="mt-4">
            <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>
@endsection

