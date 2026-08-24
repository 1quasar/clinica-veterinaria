@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">
                            Login
                        </h2>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <small><li>{{ $error }}</li></small>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="post">

                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    E-mail
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    required
                                    autofocus
                                >
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    Senha
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="passowrd"
                                    required
                                >
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label for="remember" class="form-check-label">Lembrar de Min</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Entrar
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection