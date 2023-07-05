<?php

namespace App\Models;

use Carbon\Carbon;
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
        'created_at',
        'updated_at',
    ];

    protected $dateFormat = 'd.m.Y H:i';

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y H:i');
    }
}
