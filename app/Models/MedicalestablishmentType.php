<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalestablishmentType extends Model
{
    protected $fillable = ['name'];

    public function establishments()
    {
        return $this->hasMany(Medicalestablishment::class);
    }
}