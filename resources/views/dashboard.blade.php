@extends('layouts.app')

@section('content')

    <h1>Dahsboard Administrativo</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Animais Cadastrados</h5>
                    <h2>0</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Consultas Agendadas</h5>
                    <h2>0</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Usuários</h5>
                    <h2>0</h2>
                </div>
            </div>
        </div>
    </div>

@endsection