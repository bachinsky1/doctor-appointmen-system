<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VitalSign extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vital_signs';

    protected $fillable = [
        'data',
        'user_id',
        'patient_id',
        'consultation_id',
    ];
}
