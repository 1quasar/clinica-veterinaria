<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrescriptionRequest;
use App\Models\Animal;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $prescriptions = Prescription::with(['animal.tutor', 'veterinarian'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('animal', fn($q) => $q->where('name', 'like', "%{$search}%"));
            })
            ->latest('date')
            ->paginate(15);

        return view('prescriptions.index', compact('prescriptions', 'search'));
    }

    public function create(Request $request)
    {
        $animals = Animal::with('tutor')->orderBy('name')->get();
        $selectedAnimalId = $request->get('animal_id');

        return view('prescriptions.create', compact('animals', 'selectedAnimalId'));
    }

    public function store(PrescriptionRequest $request)
    {
        DB::transaction(function () use ($request) {
            $prescription = Prescription::create([
                'animal_id'       => $request->animal_id,
                'veterinarian_id' => auth()->id(),
                'consultation_id' => $request->consultation_id,
                'date'            => $request->date,
                'observations'    => $request->observations,
            ]);

            foreach ($request->items as $item) {
                $prescription->items()->create($item);
            }
        });

        return redirect()
            ->route('prescriptions.index')
            ->with('success', 'Receita emitida com sucesso!');
    }

    public function show(Prescription $prescription)
    {
        $prescription->load(['animal.tutor', 'veterinarian', 'items']);

        return view('prescriptions.show', compact('prescription'));
    }
}