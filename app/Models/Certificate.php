<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Animal;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'title',
        'issue_date',
        'file_path',
        'notes',
    ];

    protected $casts = [
        'issue_date' => 'date',
    ];

    /**
     *  O exame pertence a um Animal
     */
    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }
}
