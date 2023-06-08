<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @param $role
     * @param null $permission
     * @return mixed
     */
    public function handle($request, Closure $next, ...$rolesAndPermissions)
    {
        $roles = [];
        $permissions = [];

        foreach ($rolesAndPermissions as $roleOrPermission) {
            if (auth()->user()->hasRole($roleOrPermission)) {
                $roles[] = $roleOrPermission;
            } elseif (auth()->user()->can($roleOrPermission)) {
                $permissions[] = $roleOrPermission;
            }
        }

        // dd($roles, $permissions);

        if (count($roles) === 0) {
            abort(404);
        }

        return $next($request);
    }
}