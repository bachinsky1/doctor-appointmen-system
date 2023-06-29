<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultationMedicalNote extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'consultation_medical_notes';

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
