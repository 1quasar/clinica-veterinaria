<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Tutor;
use App\Http\Requests\AnimalRequest;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $animals = Animal::with('tutor')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('specie', 'like', "%{$search}%")
                    ->orWhereHas('tutor', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('name', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('animals.index', compact('animals', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tutors = Tutor::orderBy('name', 'asc')->get();
        return view('animals.create', compact('tutors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnimalRequest $request)
    {
        Animal::create($request->validated());

        return redirect()
            ->route('animals.index')
            ->with('success', 'Paciente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Animal $animal)
    {
        $animal->load('tutor');
        return view('animals.show', compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Animal $animal)
    {
        $tutors = Tutor::orderBy('name', 'asc')->get();
        return view('animals.edit', compact('animal', 'tutors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnimalRequest $request, Animal $animal)
    {
        $animal->update($request->validated());

        return redirect()
            ->route('animals.index')
            ->with('success', 'Dados do paciente atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();

        return redirect()
            ->route('animals.index')
            ->with('success', 'Paciente removido do sistema.');
    }
}
