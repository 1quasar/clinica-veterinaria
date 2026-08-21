<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Race;
use App\Models\Specie;
use App\Http\Requests\RaceRequest;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $races = Race::with('specie')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            })
            ->orderBy('name', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('races.index', compact('races', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $species = Specie::orderBy('name', 'asc')->get();

        return view('races.create', compact('species'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RaceRequest $request)
    {
        Race::create($request->validated());

        return redirect()
            ->route('races.index')
            ->with('success', 'Raça cadastrada com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Race $race)
    {
        $species = Specie::orderBy('name', 'asc')->get();

        return view('races.edit', compact('race', 'species'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RaceRequest $request, Race $race)
    {
        $race->update($request->validated());

        return redirect()
            ->route('races.index')
            ->with('success', 'Raça atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Race $race)
    {
        if ($race->animals()->exists()) {
            return back()
                ->with('error', 'Não é possível exluir uma raça que possui animais associados.');
        }

        $race->delete();

        return redirect()
            ->route('races.index')
            ->with('success', 'Raça removida com sucesso!');
    }
}
