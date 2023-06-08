<?php

// Модель Medicalestablishment
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicalestablishment extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions, SoftDeletes;
    protected $fillable = ['name', 'address'];

    protected $dates = [
        'deleted_at'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}