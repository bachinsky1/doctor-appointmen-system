<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AppointmentType;
use App\Models\User;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';
    
    protected $fillable = [
        'name',
    ];

    public function type()
    {
        return $this->belongsTo(AppointmentType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
