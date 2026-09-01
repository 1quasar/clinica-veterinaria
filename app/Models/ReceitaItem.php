<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReceitaItem extends Model
{
    protected $table = 'receita_itens';

    protected $fillable = [
        'receita_id',
        'medicamento',
        'dosagem',
        'frequencia',
        'duracao',
        'orientacoes',
    ];

    public function receita(): BelongsTo
    {
        return $this->belongsTo(Receita::class);
    }
}
