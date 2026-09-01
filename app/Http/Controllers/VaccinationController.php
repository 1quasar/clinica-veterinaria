<?php

namespace App\Http\Controllers;

use App\Http\Requests\VaccinationRequest;
use App\Models\Animal;
use App\Models\Vaccination;
use Illuminate\Http\Request;

class VaccinationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $vaccinations = Vaccination::with(['animal.tutor', 'veterinarian'])
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('animal', fn($q) => $q->where('name', 'like', "%{$search}%"));
            })
            ->latest('application_date')
            ->paginate(15);

        return view('vaccinations.index', compact('vaccinations', 'search'));
    }

    public function create(Request $request)
    {
        $animals = Animal::with('tutor')->orderBy('name')->get();
        $selectedAnimalId = $request->get('animal_id');

        return view('vaccinations.create', compact('animals', 'selectedAnimalId'));
    }

    public function store(VaccinationRequest $request)
    {
        $data = $request->validated();
        $data['veterinarian_id'] = auth()->id();

        Vaccination::create($data);

        return redirect()
            ->route('vaccinations.index')
            ->with('success', 'Vacinação registrada com sucesso!');
    }
}