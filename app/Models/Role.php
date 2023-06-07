<?php
/**
 * This is a PHP code that defines a Role model class in the Laravel framework. 
 * Here's a breakdown of what this code does: The first line declares the namespace for the Role class. 
 * The next two lines import the HasFactory and Model classes from Laravel's Eloquent ORM (Object-Relational Mapping) system. 
 * The Role class extends the Model class, which provides it with various database-related functionalities.
 * The use HasFactory statement indicates that this model uses the HasFactory trait to generate factory classes for it.
 * The $table property specifies the name of the database table associated with this model.
 * The permissions() method defines a many-to-many relationship between roles and permissions. 
 * It returns a BelongsToMany object that specifies the related Permission class and the intermediate table name (roles_permissions) that links them together.
 * The users() method defines a many-to-many relationship between roles and users. 
 * It returns a BelongsToMany object that specifies the related User class and the intermediate table name (users_roles) 
 * that links them together.
 * Overall, this code sets up a Role model that can be used to interact with a database table called roles, 
 * and defines relationships between roles, permissions, and users.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles');
    }
}
