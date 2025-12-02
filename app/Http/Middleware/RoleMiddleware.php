<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
{
    if (!Auth::check()) {
        abort(403, 'Silakan login terlebih dahulu.');
    }

    $user = Auth::user();

    // Jika user tidak punya role → tolak dengan pesan jelas
    if (!$user->role) {
        abort(403, 'Role tidak ditemukan. Hubungi admin.');
    }

    if (strtolower($user->role->name) !== strtolower($role)) {
        abort(403, 'Akses ditolak. Anda tidak memiliki izin.');
    }

    return $next($request);
}


}
