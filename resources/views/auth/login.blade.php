@extends('layouts.app')

<style>
    /* Remove os espaçamentos do layout pai na tela de login */
    body {
        background-color: #ffffff !important;
    }
    main.p-4, 
    main .container-fluid {
        padding: 0 !important;
        margin: 0 !important;
        max-width: 100% !important;
    }
</style>

@section('content')
<div class="row g-0 min-vh-100">

    <!-- Lado Esquerdo: Marca & Apresentação (50% da tela) -->
    <div class="col-lg-6 d-none d-lg-flex flex-column justify-content-between p-5 text-white position-relative overflow-hidden" 
         style="background: linear-gradient(135deg, #0d6efd 0%, #053b8b 100%);">
        
        <!-- Topo: Logo e Nome -->
        <div class="d-flex align-items-center gap-3 z-1">
            <div class="bg-white bg-opacity-10 p-3 rounded-3 d-flex align-items-center justify-content-center">
                <i class="bi bi-hospital fs-2 text-white"></i>
            </div>
            <h3 class="fw-bold mb-0">Clínica Vet</h3>
        </div>

        <!-- Centro: Mensagem Principal e Recursos -->
        <div class="my-auto z-1 py-4" style="max-width: 520px;">
            <h1 class="fw-bold display-5 mb-3">Gestão veterinária simples e eficiente.</h1>
            <p class="fs-5 text-white-50 mb-4">
                Sua plataforma completa para agendamentos, prontuários, exames e acompanhamento de pacientes.
            </p>

            <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center gap-3 bg-white bg-opacity-10 p-3 rounded-3">
                    <i class="bi bi-calendar-check fs-4 text-info"></i>
                    <span>Agendamentos e consultas em tempo real</span>
                </div>
                <div class="d-flex align-items-center gap-3 bg-white bg-opacity-10 p-3 rounded-3">
                    <i class="bi bi-file-earmark-medical fs-4 text-info"></i>
                    <span>Histórico médico e exames centralizados</span>
                </div>
                <div class="d-flex align-items-center gap-3 bg-white bg-opacity-10 p-3 rounded-3">
                    <i class="bi bi-heart-pulse fs-4 text-info"></i>
                    <span>Gestão completa de tutores e animais</span>
                </div>
            </div>
        </div>

        <!-- Rodapé do Lado Esquerdo -->
        <div class="z-1 text-white-50 small">
            &copy; {{ date('Y') }} Clínica Vet. Todos os direitos reservados.
        </div>

        <!-- Marca d'água de fundo -->
        <i class="bi bi-heart-pulse-fill position-absolute text-white" 
           style="font-size: 32rem; right: -8rem; bottom: -8rem; opacity: 0.05; pointer-events: none;"></i>
    </div>

    <!-- Lado Direito: Formulário de Login (50% da tela) -->
    <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white p-4 p-md-5">
        <div class="w-100" style="max-width: 420px;">
            
            <!-- Logo visível apenas em telas menores (Mobile) -->
            <div class="d-lg-none text-center mb-4">
                <i class="bi bi-hospital fs-1 text-primary"></i>
                <h3 class="fw-bold mt-2">Clínica Vet</h3>
            </div>

            <div class="mb-4">
                <h2 class="fw-bold text-dark mb-1">Acessar Conta</h2>
                <p class="text-muted">Informe suas credenciais para entrar na plataforma</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li><small>{{ $error }}</small></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold text-secondary">E-mail</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            class="form-control border-start-0 bg-light @error('email') is-invalid @enderror" 
                            id="email" 
                            placeholder="seu@email.com"
                            required 
                            autofocus
                        >
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold text-secondary">Senha</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control border-start-0 bg-light @error('password') is-invalid @enderror" 
                            id="password" 
                            placeholder="••••••••"
                            required
                        >
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label for="remember" class="form-check-label text-secondary small">Lembrar de mim</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2.5 fw-bold shadow-sm fs-6">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Entrar
                </button>
            </form>

        </div>
    </div>

</div>
@endsection