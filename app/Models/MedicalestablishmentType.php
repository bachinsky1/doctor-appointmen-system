<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalestablishmentType extends Model
{
    use HasFactory;

    protected $table = 'medicalestablishment_types';
    
    protected $fillable = ['name'];

    public function medicalestablishments()
    {
        return $this->hasMany(Medicalestablishment::class);
    }
}