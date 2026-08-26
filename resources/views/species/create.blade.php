@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2>Cadastrar Espécie</h2>

    <div class="card mt-3 col-md-6">
        <div class="card-body">
            <form action="{{ route('species.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome da Espécie <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ route('species.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection