<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Receita extends Model
{
    protected $fillable = [
        'animal_id',
        'veterinario_id',
        'consulta_id',
        'data',
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

    public function consulta(): BelongsTo
    {
        return $this->belongsTo(Consultation::class, 'consulta_id');
    }

    public function itens(): HasMany
    {
        return $this->hasMany(ReceitaItem::class);
    }
}
