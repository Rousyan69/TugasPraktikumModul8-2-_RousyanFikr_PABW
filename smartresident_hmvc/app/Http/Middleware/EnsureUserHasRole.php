<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();
        if ($user === null || ! $user->hasRole(...$roles)) {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk Perangkat Desa (Admin).');
        }
        return $next($request);
    }
}