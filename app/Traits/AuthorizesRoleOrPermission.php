<?php


namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

trait AuthorizesRoleOrPermission
{
    public function authorizeRoleOrPermission($roleOrPermission, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            abort(403);
        }

        // dd($roleOrPermission);

        $rolesOrPermissions = is_array($roleOrPermission)
            ? $roleOrPermission
            : explode('|', $roleOrPermission);

        if (!Auth::guard($guard)->user()->hasRole($rolesOrPermissions, true) && !Auth::guard($guard)->user()->hasPermission($rolesOrPermissions, true)) {
            abort(403);
        }
    }

    public function canAuthorizeRoleOrPermission($roleOrPermission, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            return false;
        }

        $rolesOrPermissions = is_array($roleOrPermission)
            ? $roleOrPermission
            : explode('|', $roleOrPermission);

        if (!Auth::guard($guard)->user()->hasRole($rolesOrPermissions) && !Auth::guard($guard)->user()->hasPermission($rolesOrPermissions, true)) {
            return false;
        }

        return true;
    }
}
