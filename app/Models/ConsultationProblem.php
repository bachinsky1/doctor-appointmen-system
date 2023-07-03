<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultationProblem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'consultation_patient_notes';
}
