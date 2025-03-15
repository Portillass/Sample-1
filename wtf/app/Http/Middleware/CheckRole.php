<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();
        
        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        if (!$user->role) {
            abort(403, 'Role not assigned.');
        }

        if ($user->role->name !== $role) {
            abort(403, 'You do not have the required role to access this page.');
        }

        return $next($request);
    }
}
