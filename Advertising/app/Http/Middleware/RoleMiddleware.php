<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            abort(403, 'Akses Ditolak.');
        }

        $userRole = Auth::user()->role;

        // Jika admin (opsional: jika kamu ingin admin bisa akses semua)
        if ($userRole === 'a') {
            return $next($request);
        }

        // Split string menjadi array role
        $allowedRoles = explode('|', $roles);

        // Jika role user cocok dengan salah satu yang diizinkan
        if (in_array($userRole, $allowedRoles)) {
            return $next($request);
        }

        // Jika tidak cocok, tolak akses
        abort(403, 'Akses Ditolak.');
    }
}