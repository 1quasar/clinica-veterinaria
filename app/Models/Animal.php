<?php

namespace App\Models;

use App\Models\Tutor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutor_id',
        'name',
        'specie_id',
        'race_id',
        'gender',
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

    public function specie(): BelongsTo
    {
        return $this->belongsTo(Specie::class, 'specie_id');
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class, 'race_id');
    }
    
    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function vaccinations(): HasMany
    {
        return $this->hasMany(Vaccination::class);
    }

    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }
}
