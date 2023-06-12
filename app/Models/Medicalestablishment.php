<?php

// Модель Medicalestablishment
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AddressLink;

class Medicalestablishment extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'medicalestablishments';
    
    protected $fillable = ['name'];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * Get all users
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get all address links.
     */
    public function AddressLink()
    {
        return $this->hasMany(AddressLink::class);
    }
}