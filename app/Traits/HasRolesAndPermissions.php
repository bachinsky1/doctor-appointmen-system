<?php

/**
 * This code defines a HasRolesAndPermissions trait that can be used in Laravel models to add role and permission management functionality. 
 * The trait provides several methods that can be used to check if a model has certain roles or permissions, 
 * give or remove permissions from a model, and refresh a model's permissions.
 * The roles() and permissions() methods define relationships between the model and the Role and Permission models, respectively. 
 * These relationships allow us to easily retrieve all roles and permissions associated with a model.
 * The hasRole(), hasPermission(), and hasPermissionThroughRole() methods are used to check if a model has certain roles or permissions. 
 * These methods use the contains() and where() methods provided by Laravel's collection class to search for roles or permissions with a certain slug.
 * The hasPermissionTo() method is used to check if a model has a certain permission either directly or through a role. 
 * This method calls the hasPermission() and hasPermissionThroughRole() methods to determine if the model has the permission.
 * The getAllPermissions(), givePermissionsTo(), deletePermissions(), and refreshPermissions() methods are used to manage a model's permissions. 
 * These methods use the whereIn(), saveMany(), and detach() methods provided by Laravel's query builder to add or remove permissions from a model.
 * Overall, this code provides a convenient way to manage roles and permissions in Laravel models using a trait.
 */

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;

trait HasRolesAndPermissions
{
    /**
     * Get all roles associated with this model.
     *
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    /**
     * Get all permissions associated with this model.
     *
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    /**
     * Check if this model has any of the given roles.
     *
     * @param mixed ...$roles
     * @return bool
     */
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if this model has the given permission.
     *
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('slug', $permission)->count();
    }

    /**
     * Check if this model has the given permission through a role.
     *
     * @param $permission
     * @return bool
     */
    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if this model has the given permission directly or through a role.
     *
     * @param $permission
     * @return bool
     */
    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission->slug);
    }

    /**
     * Get all permissions with the given slugs.
     *
     * @param array $permissions
     * @return mixed
     */
    public function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('slug', $permissions)->get();
    }

    /**
     * Give this model the given permissions.
     *
     * @param mixed ...$permissions
     * @return $this
     */
    public function givePermissionsTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if ($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    /**
     * Remove the given permissions from this model.
     *
     * @param mixed ...$permissions
     * @return $this
     */
    public function deletePermissions(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    /**
     * Refresh this model's permissions to only include the given permissions.
     *
     * @param mixed ...$permissions
     * @return HasRolesAndPermissions
     */
    public function refreshPermissions(...$permissions)
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

}