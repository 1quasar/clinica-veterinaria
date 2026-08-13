@extends('layouts.app')

@section('content')

    <div class="col-md-12 mb-4">
        <h2>Painel Principal</h2>
        <p class="text-muted">{{ auth()->user()->name }}</p>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Perfil Atual</h5>
                <p class="card-text fs-4 fw-bold">{{ ucfirst(auth()->user()->role) }}</p>
            </div>
        </div>
    </div>

    @if(auth()->user()->role === 'admin')
    <div class="col-md-4 mb-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Usuários Ativos</h5>
                <p class="card-text fs-4 fw-bold">{{ $usuariosAtivos }} / {{ $totalUsuarios }}</p>
            </div>
        </div>
    </div>
    @endif

    </div>

@endsection