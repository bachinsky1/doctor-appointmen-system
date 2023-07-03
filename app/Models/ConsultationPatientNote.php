<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultationPatientNote extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'consultation_patient_notes';

    protected $fillable = [
        'note',
        'user_id',
        'patient_id',
        'consultation_id',
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
}
