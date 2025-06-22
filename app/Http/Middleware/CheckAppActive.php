<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class CheckAppActive
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $isActive = Setting::getValue('app_active', 'true') === 'true';

        // ❗️Kalau bukan SuperAdmin DAN web dinonaktifkan, blokir
        if (!$isActive && (!$user || $user->role !== 'SuperAdmin')) {
            return response(view('maintenance'));
        }

        return $next($request);
    }
}
