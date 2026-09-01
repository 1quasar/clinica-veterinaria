<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacina extends Model
{
    protected $fillable = [
        'animal_id',
        'veterinario_id',
        'nome',
        'data_aplicacao',
        'data_proxima_dose',
        'lote',
        'fabricante',
        'observacoes',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function veterinario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'veterinario_id');
    }
}
