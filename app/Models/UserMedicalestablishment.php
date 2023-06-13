<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMedicalestablishment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_medicalestablishments';

    protected $fillable = [
        'user_id',
        'medicalestablishment_id',
        'position_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function medicalEstablishment()
    {
        return $this->belongsTo(MedicalEstablishment::class);
    }
}
