<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class CheckUserAccess
{
    public function handle($request, Closure $next)
{
    $user = Auth::user();

    if (!$user) {
        return redirect('/login');
    }

    // Nonaktif? Tendang balik
    if (!$user->is_active && $user->role != 'SuperAdmin') {
        return abort(403, 'Akunmu dinonaktifkan oleh Super Admin.');
    }

    return $next($request);
}
}
