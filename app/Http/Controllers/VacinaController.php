<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacinaRequest;
use App\Models\Animal;
use App\Models\Vacina;

class VacinaController extends Controller
{
    public function index()
    {
        $vacinas = Vacina::with(['animal', 'veterinario'])->latest()->paginate(10);

        return view('vacinas.index', compact('vacinas'));
    }

    public function create(Animal $animal)
    {
        return view('vacinas.create', compact('animal'));
    }

    public function store(VacinaRequest $request)
    {
        $data = $request->validated();
        $data['veterinario_id'] = auth()->id();

        Vacina::create($data);

        return redirect()
            ->route('animals.show', $request->animal_id)
            ->with('success', 'Vacina registrada com sucesso!');
    }
}
