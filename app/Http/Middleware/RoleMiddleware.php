<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Obsługuje role użytkownika.
     *
     * Przykład użycia w trasie:
     *  ->middleware('role:admin')
     *  ->middleware('role:admin,owner')
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role, $roles)) {
            abort(403, 'Brak dostępu');
        }

        return $next($request);
    }
}
