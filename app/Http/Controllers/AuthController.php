<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ],
            [
                'email.required' => 'O campo e-mail é obrigatório.',
                'email.email'   => 'Informe um e-mail válido.',
                'password.required' => 'O campo senha é obrigatório.',
            ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Verifica se o usuário está ativo logo após autenticar

            if (!Auth::user()->status) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Seu usuário está inativo. Entre em contato com o administrador.',
                ])->onlyInput('email');
            }

            return redirect()->intended(route('dashboard'));
        }

        return back()
            ->withErrors([
                'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request) 
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
