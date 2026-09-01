<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceitaRequest;
use App\Models\Animal;
use App\Models\Receita;
use Illuminate\Support\Facades\DB;

class ReceitaController extends Controller
{
    public function index()
    {
        $receitas = Receita::with(['animal', 'veterinario', 'itens'])->latest()->paginate(10);

        return view('receitas.index', compact('receitas'));
    }

    public function create(Animal $animal)
    {
        return view('receitas.create', compact('animal'));
    }

    public function store(ReceitaRequest $request)
    {
        DB::transaction(function () use ($request) {
            $receita = Receita::create([
                'animal_id'     => $request->animal_id,
                'veterinario_id'    => auth()->id(),
                'consulta_id'       => $request->consulta_id,
                'data'              => $request->data,
                'observacoes'       => $request->observacoes,
            ]);

            foreach ($request->itens as $item) {
                $receita->itens()->create($item);
            }
        });

        if ($request->consulta_id) {
            return redirect()
                ->route('consultations.show', $request->consulta_id)
                ->with('success', 'Receita emitida e vinculada à consulta!');
        }

        return redirect()
            ->route('animals.show', $request->animal_id)
            ->with('success', 'Receita emitida com sucesso!');
    }

    public function show(Receita $receita)
    {
        
    }
}
