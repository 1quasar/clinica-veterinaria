<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specie;
use App\Models\Race;

class SpecieRaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dog = Specie::create(['name' => 'Cão']);
        $cat = Specie::create(['name' => 'Gato']);
        $bird = Specie::create(['name' => 'Ave']);

        Race::insert([
            ['specie_id' => $dog->id, 'name' => 'Golden Retriever', 'created_at' => now(), 'updated_at' => now()],
            ['specie_id' => $dog->id, 'name' => 'Labrador Retriever', 'created_at' => now(), 'updated_at' => now()],
            ['specie_id' => $dog->id, 'name' => 'SRC (Sem Raça Definida)', 'created_at' => now(), 'updated_at' => now()],
            ['specie_id' => $cat->id, 'name' => 'Persa', 'created_at' => now(), 'updated_at' => now()],
            ['specie_id' => $dog->id, 'name' => 'Siamês', 'created_at' => now(), 'updated_at' => now()],
            ['specie_id' => $dog->id, 'name' => 'SRD (Sem Raça Definida)', 'created_at' => now(), 'updated_at' => now()],
            ['specie_id' => $bird->id, 'name' => 'Calopsita', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
