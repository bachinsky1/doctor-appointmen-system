<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AppointmentTypes;

class Appointments extends Model
{
    use HasFactory;

    protected $table = 'appointments';
    
    protected $fillable = [
        'name',
    ];

    public function medicalestablishment()
    {
        return $this->belongsTo(AppointmentTypes::class);
    }
}
