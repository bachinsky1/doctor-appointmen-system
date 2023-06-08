<?php

  /**
   * This code defines a User model class in the App\Models namespace. The class extends the Authenticatable class, 
   * which provides basic authentication functionality, and uses several Laravel traits to add additional features. 
   * The HasApiTokens trait adds support for API token authentication using Laravel Sanctum. 
   * The HasFactory trait provides a factory method for generating fake user data during testing. 
   * The Notifiable trait adds support for sending notifications to users via various channels, such as email and SMS. 
   * The SoftDeletes trait enables soft deletion of user records, allowing them to be restored later if needed. 
   * The $fillable property is an array that specifies which attributes can be mass assigned when creating 
   * or updating a user record. In this case, the 'name', 'email', and 'password' attributes are allowed to be mass assigned. 
   * The $dates property is an array that specifies which attributes should be treated as dates by Laravel. 
   * In this case, the 'deleted_at' attribute is included, indicating that it should be treated as a date and used 
   * for soft deletion. The $hidden property is an array that specifies which attributes should be hidden 
   * when serializing the user model to an array or JSON format. In this case, the 'password' and 'remember_token' attributes are hidden. 
   * The $casts property is an array that specifies how certain attributes should be cast to specific data types. In this case, the 'email_verified_at' attribute is cast to a datetime type.
   */

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
