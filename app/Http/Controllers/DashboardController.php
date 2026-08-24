<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {

        $totalUsuarios = User::count();
        $usuariosAtivos = User::where('status', true)->count();

        return view('dashboard', compact('totalUsuarios', 'usuariosAtivos'));
    }
}
