<?php

// Модель Medicalestablishment
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicalestablishment extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}