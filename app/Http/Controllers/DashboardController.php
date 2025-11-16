<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Service;
use App\Models\Operator;
use App\Models\Admin;

class DashboardController extends Controller
{
    public function serviceSummary(Request $request)
    {
        $user = $request->user();

        $isAdmin = Admin::where('id_user', $user->id)->exists();
        $operator = null;
        if (!$isAdmin) {
            $operator = Operator::where('id_user', $user->id)->first();
        }

        $baseQuery = Service::query();

        if ($operator) {
            $operatorIds = Operator::where('id_cabang', $operator->id_cabang)->pluck('id');
            $baseQuery->whereIn('id_operator', $operatorIds);
        }

        $today = Carbon::today();

        $totalHariIni = (clone $baseQuery)
            ->whereDate('tanggal_masuk', $today)
            ->count();

        $selesai = (clone $baseQuery)
            ->where('status', 'selesai')
            ->count();

        $aktif = (clone $baseQuery)
            ->whereIn('status', ['menunggu', 'dalam_proses'])
            ->count();

        return response()->json([
            'role' => $isAdmin ? 'admin' : 'operator',
            'scope' => $isAdmin ? 'all_branches' : [
                'id_cabang' => $operator ? $operator->id_cabang : null,
            ],
            'data' => [
                'total_hari_ini' => $totalHariIni,
                'selesai' => $selesai,
                'aktif' => $aktif,
            ],
        ]);
    }
}
