<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Tutor;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutor_id',
        'name',
        'specie',
        'race',
        'birth_date',
        'weight',
        'observation',
    ];

    /**
     * Um animal pertence a um tutor.
     */
    public function tutor(): BelongsTo
    {
        return $this->belongsTo(Tutor::class, 'tutor_id');
    }
}
