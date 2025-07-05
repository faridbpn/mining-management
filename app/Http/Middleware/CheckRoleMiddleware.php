<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Check if user has role in database column
        if (in_array($user->role, $roles)) {
            return $next($request);
        }
        
        // Check if user has role via Spatie Permission
        if ($user->hasAnyRole($roles)) {
            return $next($request);
        }

        // If user doesn't have any of the required roles
        abort(403, 'Role does not exist or you do not have permission to access this page.');
    }
} 