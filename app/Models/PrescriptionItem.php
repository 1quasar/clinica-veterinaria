<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrescriptionItem extends Model
{
    protected $table = 'prescription_items';
    protected $fillable = [
        'prescription_id',
        'medication',
        'dosage',
        'frequency',
        'duration',
        'guidelines'
    ];

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class);
    }
}
