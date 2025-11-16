<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Cabang;
use App\Models\Service;
use App\Models\Operator;
use App\Models\ServiceSparepart;
use App\Models\Pembayaran;
use App\Models\Teknisi;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServiceController extends Controller
{
    public function customerRequest(Request $request)
    {
        $data = $request->validate([
            'id_customer' => 'required|exists:customer,id',
            'keluhan' => 'required|string',
            'alamat_service' => 'required|string',
            'alat_ids' => 'required|array|min:1',
            'alat_ids.*' => 'integer|exists:alat,id',
        ]);

        $customer = Customer::findOrFail($data['id_customer']);

        $cabang = Cabang::where('provinsi', $customer->provinsi)
            ->where('kota', $customer->kota)
            ->first();

        if (!$cabang) {
            return response()->json([
                'message' => 'Layanan belum tersedia di wilayah Anda',
                'detail' => [
                    'provinsi' => $customer->provinsi,
                    'kota' => $customer->kota,
                ],
            ], 422);
        }

        $operator = Operator::where('id_cabang', $cabang->id)->first();
        if (!$operator) {
            return response()->json([
                'message' => 'Belum ada operator pada cabang tujuan',
            ], 422);
        }

        return DB::transaction(function () use ($data, $cabang, $operator) {
            $service = Service::create([
                'id_customer' => $data['id_customer'],
                'id_cabang' => $cabang->id,
                'id_operator' => $operator->id,
                'alamat_service' => $data['alamat_service'],
                'keluhan' => $data['keluhan'],
                'status' => 'menunggu',
                'tanggal_masuk' => Carbon::now(),
            ]);

            if (!empty($data['alat_ids'])) {
                $service->alats()->sync($data['alat_ids']);
            }

            return response()->json([
                'message' => 'Service berhasil dibuat dan dialokasikan ke cabang',
                'data' => $service->load(['alats'])
            ], 201);
        });
    }

    public function operatorList(Request $request)
    {
        $user = $request->user();
        $operator = Operator::where('id_user', $user->id)->firstOrFail();

        $services = Service::with(['customer', 'alats'])
            ->where('id_cabang', $operator->id_cabang)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'message' => 'Daftar service untuk cabang operator',
            'data' => $services
        ]);
    }

    public function technicianList(Request $request)
    {
        $user = $request->user();
        $teknisi = Teknisi::where('id_user', $user->id)->firstOrFail();

        $services = Service::with(['customer', 'alats', 'operator'])
            ->whereHas('teknisis', function ($q) use ($teknisi) {
                $q->where('teknisi.id', $teknisi->id);
            })
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'message' => 'Daftar service untuk teknisi',
            'data' => $services
        ]);
    }

    public function operatorDecision(Request $request, $id_service)
    {
        $data = $request->validate([
            'action' => 'required|in:approve,decline',
            'teknisi_ids' => 'required_if:action,approve|array',
            'teknisi_ids.*' => 'integer|exists:teknisi,id',
            'catatan' => 'required_if:action,decline|string',
        ]);

        $service = Service::findOrFail($id_service);

        if ($data['action'] === 'approve') {
            $service->teknisis()->sync($data['teknisi_ids'] ?? []);
            $service->status = 'dalam_proses';
            $service->save();
        } else {
            $service->status = 'batal';
            $service->catatan = $data['catatan'];
            $service->save();
        }

        return response()->json([
            'message' => 'Keputusan operator berhasil diproses',
            'data' => $service->load(['teknisis'])
        ]);
    }

    public function technicianDiagnose(Request $request, $id_service)
    {
        $data = $request->validate([
            'diagnosa' => 'required|string',
            'spareparts' => 'sometimes|array',
            'spareparts.*.id_sparepart' => 'required|integer|exists:sparepart,id',
            'spareparts.*.jumlah' => 'required|integer|min:1',
        ]);

        $service = Service::findOrFail($id_service);

        // Tambah diagnosa dan status
        $service->diagnosa = $data['diagnosa'];
        $service->save();

        // Insert sparepart tambahan jika ada
        if (!empty($data['spareparts'])) {
            foreach ($data['spareparts'] as $item) {
                $sparepart = Sparepart::findOrFail($item['id_sparepart']);
                $hargaSatuan = $sparepart->harga_jual; // gunakan harga jual untuk penagihan ke customer
                ServiceSparepart::create([
                    'id_service' => $service->id,
                    'id_sparepart' => $item['id_sparepart'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $hargaSatuan,
                    'subtotal' => $item['jumlah'] * $hargaSatuan,
                ]);
            }
        }

        return response()->json([
            'message' => 'Diagnosa dan sparepart diperbarui',
            'data' => $service->load(['spareparts'])
        ]);
    }

    public function operatorCalculateTotal(Request $request, $id_service)
    {
        $data = $request->validate([
            'biaya_service' => 'required|numeric|min:0',
            'biaya_kunjungan' => 'required|numeric|min:0',
        ]);

        $service = Service::with('spareparts')->findOrFail($id_service);

        $totalSparepart = $service->spareparts->sum(function ($sp) {
            return ($sp->pivot->subtotal) ?? ($sp->pivot->jumlah * $sp->pivot->harga_satuan);
        });

        $service->biaya_service = $data['biaya_service'];
        $service->biaya_kunjungan = $data['biaya_kunjungan'];
        $service->total_biaya = $data['biaya_service'] + $data['biaya_kunjungan'] + $totalSparepart;
        $service->save();

        return response()->json([
            'message' => 'Total biaya dihitung',
            'data' => $service
        ]);
    }

    public function customerPay(Request $request, $id_service)
    {
        $data = $request->validate([
            'metode' => 'required|in:cash,transfer,midtrans',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $service = Service::findOrFail($id_service);

        // Pastikan total biaya tersedia
        $total = $service->total_biaya;
        if ($total === null) {
            // fallback hitung manual jika belum dihitung operator
            $service->load('spareparts');
            $totalSparepart = $service->spareparts->sum(function ($sp) {
                return ($sp->pivot->subtotal) ?? ($sp->pivot->jumlah * $sp->pivot->harga_satuan);
            });
            $total = (float) (($service->biaya_service ?? 0) + ($service->biaya_kunjungan ?? 0) + $totalSparepart);
        }

        // Validasi kecukupan pembayaran (untuk metode non-midtrans)
        if ($data['metode'] !== 'midtrans' && $data['jumlah'] < $total) {
            return response()->json([
                'message' => 'Pembayaran kurang dari total biaya',
                'detail' => [
                    'total_biaya' => $total,
                    'dibayar' => (float) $data['jumlah'],
                    'kurang' => $total - (float) $data['jumlah'],
                ],
            ], 422);
        }

        $statusPembayaran = $data['metode'] === 'midtrans' ? 'pending' : 'berhasil';

        $payment = Pembayaran::create([
            'id_service' => $service->id,
            'metode' => $data['metode'],
            'status' => $statusPembayaran,
            'jumlah' => $data['jumlah'],
            'tanggal' => Carbon::now(),
        ]);

        // Hitung kembalian untuk metode non-midtrans
        $kembalian = null;
        if ($data['metode'] !== 'midtrans') {
            $kembalian = (float) max(0, $data['jumlah'] - $total);
            // Tandai service selesai hanya jika pembayaran berhasil
            $service->status = 'selesai';
            $service->tanggal_selesai = Carbon::now();
            $service->save();
        }

        return response()->json([
            'message' => 'Pembayaran diterima dan service diselesaikan',
            'data' => [
                'service' => $service,
                'pembayaran' => $payment,
                'kembalian' => $kembalian,
            ]
        ], 201);
    }
}
