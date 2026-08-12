<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'status' => true,
        ])) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()
            ->withErrors([
                'email' => 'E-mail, senha ou status do usuário inválido.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request) 
    {
        Auth::logout();

        $request->session()->invalidade();
        $request->session()->regenarateToken();

        return redirect()->route('login');
    }
}
