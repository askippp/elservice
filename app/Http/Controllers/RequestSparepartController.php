<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operator;
use App\Models\RequestSparepart;

class RequestSparepartController extends Controller
{
    public function setRequestSparepartToOperator(Request $request) 
    {
        $data = $request->validate([
            'id_teknisi' => 'required|integer',
            'id_sparepart' => 'required|integer',
            'jumlah' => 'required|integer|min:1',
            'catatan' => 'nullable|string'
        ]);

        $requestSparepart = RequestSparepart::create([
            'id_teknisi' => $data['id_teknisi'],
            'id_sparepart' => $data['id_sparepart'],
            'jumlah' => $data['jumlah'],
            'status' => 'pending',
            'catatan' => $data['catatan'] ?? null,
        ]);

        return response()->json([
            'message' => 'Request sparepart dari teknisi ke operator berhasil dibuat',
            'data' => $requestSparepart
        ]);
    }

    public function getRequestSparepartFromTechnician($id_operator) 
    {
        $operator = Operator::findOrFail($id_operator);

        $requests = RequestSparepart::with(['teknisi', 'sparepart'])
            ->whereHas('teknisi', function ($query) use ($operator) {
                $query->where('id_cabang', $operator->id_cabang);
            })
            ->whereNull('id_operator')
            ->where('status', 'pending')
            ->get();

        return response()->json([
            'message' => 'Request spareparts retrieved successfully',
            'data' => $requests
        ]);
    }

    public function setRequestSparepartToAdmin(Request $request)
    {
        $data = $request->validate([
            'id_request' => 'required|integer|exists:request_sparepart,id',
            'id_operator' => 'required|integer|exists:operator,id',
            'catatan' => 'nullable|string'
        ]);

        $req = RequestSparepart::findOrFail($data['id_request']);
        $req->id_operator = $data['id_operator'];
        if (array_key_exists('catatan', $data)) {
            $req->catatan = $data['catatan'];
        }
        // status tetap 'pending' hingga admin memutuskan
        $req->save();

        return response()->json([
            'message' => 'Request sparepart dari operator ke admin berhasil diajukan',
            'data' => $req
        ]);
    }

    public function getRequestSparepartFromOperator($id_admin)
    {
        $requests = RequestSparepart::with(['teknisi', 'sparepart', 'operator'])
            ->whereNotNull('id_operator')
            ->where('status', 'pending')
            ->get();

        return response()->json([
            'message' => 'Request spareparts for admin retrieved successfully',
            'data' => $requests
        ]);
    }

    public function approveRequestSparepart($id_request)
    {
        $req = RequestSparepart::findOrFail($id_request);
        $req->status = 'disetujui';
        // catatan opsional saat approve
        if (request()->has('catatan')) {
            $req->catatan = request()->input('catatan');
        }
        $req->save();

        return response()->json([
            'message' => 'Request sparepart disetujui',
            'data' => $req
        ]);
    }

    public function rejectRequestSparepart($id_request)
    {
        $data = request()->validate([
            'catatan' => 'required|string'
        ]);

        $req = RequestSparepart::findOrFail($id_request);
        $req->status = 'ditolak';
        $req->catatan = $data['catatan'];
        $req->save();

        return response()->json([
            'message' => 'Request sparepart ditolak',
            'data' => $req
        ]);
    }

    public function getRequestByTechnician($id_teknisi)
    {
        $requests = RequestSparepart::with(['sparepart', 'operator'])
            ->where('id_teknisi', $id_teknisi)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'message' => 'Request spareparts for this technician retrieved successfully',
            'data' => $requests
        ]);
    }

    public function getRequestByOperator($id_operator)
    {
        $requests = RequestSparepart::with(['teknisi', 'sparepart'])
            ->where('id_operator', $id_operator)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'message' => 'Request spareparts handled by this operator retrieved successfully',
            'data' => $requests
        ]);
    }
}
