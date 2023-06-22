<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SymptomSpeciality extends Model
{
    use HasFactory;

    public function speciality()
    {
        return $this->belongsToMany(Speciality::class);
    }

    public function symptom()
    {
        return $this->belongsToMany(Symptom::class);
    }
}

