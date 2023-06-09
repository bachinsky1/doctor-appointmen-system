<?php

/**
 * This is a PHP code that defines a `Permission` model class in the Laravel framework. Here's a breakdown of what this code does:
 * - The first line declares the namespace for the `Permission` class.
 * - The next two lines import the `HasFactory` and `Model` classes from Laravel's Eloquent ORM (Object-Relational Mapping) system.
 * - The `Permission` class extends the `Model` class, which provides it with various database-related functionalities.
 * - The `use HasFactory` statement indicates that this model uses the `HasFactory` trait to generate factory classes for it.
 * - The `roles()` method defines a many-to-many relationship between permissions and roles. It returns a `BelongsToMany` object that specifies the related `Role` class and the intermediate table name (`roles_permissions`) that links them together.
 * Overall, this code sets up a `Permission` model that can be used to interact with a database table, and defines a many-to-many relationship between permissions and roles.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';
    
    public function roles()
    {
        return $this->belongsToMany(Role::class,'roles_permissions');
    }
}
