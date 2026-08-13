@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2>Editar Usuário: {{ $usuario->name }}</h2>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('usuarios.update', $usuario) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nome Completo</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $usuario->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $usuario->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nova Senha (deixe em branco para manter a atual)</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Confirmar Nova Senha</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Perfil de Acesso</label>
                    <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                        <option value="admin" {{ old('role', $usuario->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                        <option value="veterinario" {{ old('role', $usuario->role) == 'veterinario' ? 'selected' : '' }}>Veterinário</option>
                        <option value="recepcionista" {{ old('role', $usuario->role) == 'recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                    </select>
                    @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="1" {{ old('status', $usuario->status) == '1' ? 'selected' : '' }}>Ativo</option>
                        <option value="0" {{ old('status', $usuario->status) == '0' ? 'selected' : '' }}>Inativo</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Atualizar Usuário</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection

