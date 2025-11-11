<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class LaporanController extends Controller
{
    public function getTotalPemasukan()
    {
        $query = Pemasukan::query();
        if (request('id_cabang')) {
            $query->where('id_cabang', request('id_cabang'));
        }
        if (request('start_date')) {
            $query->whereDate('tgl', '>=', request('start_date'));
        }
        if (request('end_date')) {
            $query->whereDate('tgl', '<=', request('end_date'));
        }
        $total = (int) $query->sum('jumlah');
        return response()->json(['total_pemasukan' => $total]);
    }

    public function getTotalPengeluaran()
    {
        $query = Pengeluaran::query();
        if (request('id_cabang')) {
            $query->where('id_cabang', request('id_cabang'));
        }
        if (request('start_date')) {
            $query->whereDate('tgl', '>=', request('start_date'));
        }
        if (request('end_date')) {
            $query->whereDate('tgl', '<=', request('end_date'));
        }
        $total = (int) $query->sum('jumlah');
        return response()->json(['total_pengeluaran' => $total]);
    }

    public function getSelisih()
    {
        $pemasukanQuery = Pemasukan::query();
        $pengeluaranQuery = Pengeluaran::query();
        if (request('id_cabang')) {
            $pemasukanQuery->where('id_cabang', request('id_cabang'));
            $pengeluaranQuery->where('id_cabang', request('id_cabang'));
        }
        if (request('start_date')) {
            $pemasukanQuery->whereDate('tgl', '>=', request('start_date'));
            $pengeluaranQuery->whereDate('tgl', '>=', request('start_date'));
        }
        if (request('end_date')) {
            $pemasukanQuery->whereDate('tgl', '<=', request('end_date'));
            $pengeluaranQuery->whereDate('tgl', '<=', request('end_date'));
        }
        $totalPemasukan = (int) $pemasukanQuery->sum('jumlah');
        $totalPengeluaran = (int) $pengeluaranQuery->sum('jumlah');
        $selisih = $totalPemasukan - $totalPengeluaran;
        return response()->json([
            'total_pemasukan' => $totalPemasukan,
            'total_pengeluaran' => $totalPengeluaran,
            'selisih' => $selisih,
        ]);
    }
}
