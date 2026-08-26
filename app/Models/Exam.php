<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Animal;
use App\Models\Consultation;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'consultation_id',
        'name',
        'exam_date',
        'laboratory',
        'file_path',
        'observations',
    ];

    protected $casts = [
        'exam_date' => 'date',
    ];


    /**
     * O exame pertence a um Animal
     */
    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }

    /**
     * O exame pode estar vinculado a uma Consulta
     */
    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }
}
