<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSymptom extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsToMany(Symptom::class);
    }

    public function symptom()
    {
        return $this->belongsToMany(User::class);
    }
}
