<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';
    
    protected $fillable = [
        'street',
        'house_number',
        'city',
        'state',
        'zip_code',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'address_links', 'address_id', 'user_id')
            ->withPivot('is_main')
            ->whereNull('address_links.deleted_at');
    }
}
