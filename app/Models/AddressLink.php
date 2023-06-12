<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\Medicalestablishment;
use App\Models\User;

class AddressLink extends Model
{
    use HasFactory;

    protected $table = 'address_links';
    
    protected $fillable = [
        'address_id',
        'user_id',
        'medicalestablishment_id',
        'is_main', 
    ];
    /**
     * Get the user who owns the given link.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function medicalestablishment()
    {
        return $this->belongsTo(Medicalestablishment::class);
    }


}
