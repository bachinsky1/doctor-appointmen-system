<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'consultations';

    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'public_id',
        'type_id',
        'appointment_id',
        'user_id',
        'patient_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function type()
    {
        return $this->belongsTo(ConsultationType::class);
    }
}
