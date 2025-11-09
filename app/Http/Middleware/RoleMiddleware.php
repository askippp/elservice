<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\Operator;
use App\Models\Teknisi;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        // Jika user belum login
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $userId = $user->id;
        $userRole = null;

        // Tentukan role berdasarkan relasi id_user
        if (Admin::where('id_user', $userId)->exists()) {
            $userRole = 'admin';
        } elseif (Operator::where('id_user', $userId)->exists()) {
            $userRole = 'operator';
        } elseif (Teknisi::where('id_user', $userId)->exists()) {
            $userRole = 'teknisi';
        } else {
            $userRole = 'unknown';
        }

        // Cek apakah role user termasuk role yang diperbolehkan
        if (!in_array($userRole, $roles)) {
            return response()->json(['message' => 'Forbidden access'], 403);
        }

        // Lolos, lanjut ke request berikutnya
        return $next($request);
    }
}
