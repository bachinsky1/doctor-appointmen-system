<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMedicalestablishment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_medicalestablishments';

    public function position()
    {
        return $this->belongsTo(UserPosition::class);
    }

    public function speciality()
    {
        return $this->belongsTo(UserSpeciality::class);
    }

    public function medicalestablishment()
    {
        return $this->belongsTo(Medicalestablishment::class);
    }
}
