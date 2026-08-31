<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specie;
use App\Http\Requests\SpecieRequest;

class SpecieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $species = Specie::withCount(['races', 'animals'])
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('name', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('species.index', compact('species', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('species.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpecieRequest $request)
    {
        Specie::create($request->validated());
        
        return redirect()
            ->route('species.index')
            ->with('success', 'Espécie cadastrada com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specie $specie)
    {
        return view('species.edit', compact('specie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SpecieRequest $request, Specie $specie)
    {
        $specie->update($request->validated());

        return redirect()
            ->route('species.index')
            ->with('success', 'Espécie atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specie $specie)
    {
        if ($specie->animals()->exists()) {
            return back()
                ->with('error', 'Não é possível exluir uma espécie que possúi animais associados.');
        }
            
        $specie->delete();

        return redirect()
            ->route('species.index')
            ->with('success', 'Espécie removida com sucesso!');
    }
}
