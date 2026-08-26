<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Race extends Model
{
    use HasFactory;

    protected $fillable = ['specie_id', 'name'];

    public function specie(): BelongsTo
    {
        return $this->belongsTo(Specie::class);
    }

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }
}
