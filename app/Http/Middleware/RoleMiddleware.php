<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{

    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check whether the user is authenticated
        if (!Auth::check()) {
            return redirect('/');
        }

        // Get authenticated user
        $user = Auth::user();

        // Get roles assigned to the user from the SSO token
        $userRoles = $user->roles ?? [];

        // Convert roles to a simple array if they are a collection
        if ($userRoles instanceof \Illuminate\Support\Collection) {
            $userRoles = $userRoles->all();
        }

        // Normalize roles for comparison
        $userRoles = array_map(
            fn($role) => strtolower(trim(
                is_object($role) ? $role->name : $role
            )),
            $userRoles
        );

        $allowedRoles = array_map(
            fn($role) => strtolower(trim($role)),
            $roles
        );

        // Check whether the user has at least one allowed role
        if (count(array_intersect($userRoles, $allowedRoles)) > 0) {
            return $next($request);
        }

        return redirect()->back();
    }
}
