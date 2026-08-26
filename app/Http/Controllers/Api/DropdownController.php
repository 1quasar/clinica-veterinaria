<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Race;
use Illuminate\Http\JsonResponse;

class DropdownController extends Controller
{
    public function animalsByTutor(int $tutor): JsonResponse
    {
        $animals = Animal::where('tutor_id', $tutor)
            ->with('specie:id,name')
            ->orderBy('name', 'asc')
            ->get(['id', 'name', 'specie_id']);

        return response()->json($animals);
    }

    public function racesBySpecie(int $specie): JsonResponse
    {
        $races = Race::where('specie_id', $specie)
            ->orderBy('name', 'asc')
            ->get(['id', 'name']);

        return response()->json($races);
    }
}
