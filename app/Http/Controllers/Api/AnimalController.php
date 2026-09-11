<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnimalRequest;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $search = $request->get('search');

        $animals = Animal::with(['tutor', 'specie', 'race'])
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('specie', fn($q) => $q->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('race', fn($q) => $q->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('tutor', fn($q) => $q->where('name', 'like', "%{$search}%"));
            })
            ->orderBy('name', 'asc')
            ->paginate(10)
            ->withQueryString();

        return response()->json([
            $animals,
            $search
        ]);
    }

        /**
     * Store a newly created resource in storage.
     */
    public function store(AnimalRequest $request): JsonResponse
    {
        $animal = Animal::create($request->validated());

        return response()->json([
            $animal
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $animal = Animal::with(['tutor', 'specie', 'race'])->findOrFail($id);
        
        return response()->json($animal);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): JsonResponse
    {
        $animal = Animal::findOrFail($id);

        return response()->json($animal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $animal = Animal::findOrFail($id);
        $animal->update($request->all());

        return response()->json([
            'message' => 'Animal updated successfully',
            'animal' => $animal
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();

        return response()->json([
            'message' => 'Animal deleted successfully'
        ]);
    }
}
