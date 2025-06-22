<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class CheckAppActive
{
    public function handle($request, Closure $next)
{
    $isActive = \App\Models\Setting::getValue('app_active', 'true') === 'true';
    $user = Auth::user();
    $path = $request->path();

    // Daftar path yang diizinkan meski nonaktif (login, logout, dll)
    $allowedPaths = ['login', 'logout'];

    // Cek jika user sudah login dan dia SuperAdmin → boleh masuk
    if ($user && $user->role === 'SuperAdmin') {
        return $next($request);
    }

    // Jika web nonaktif, user belum login, dan bukan halaman login → blokir
    if (!$isActive && !in_array($path, $allowedPaths)) {
        return response(view('maintenance'));
    }

    return $next($request);
}

}
