<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiPeminjamanController extends Controller
{
    // Ambil semua peminjaman milik user yang sedang login
    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $peminjamans = Peminjaman::with(['barang:id,nama_barang,stock'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Daftar peminjaman',
            'data' => $peminjamans
        ]);
    }

    // Menyimpan peminjaman baru
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_kembali' => 'required|date|after_or_equal:today',
        ]);

        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $barang = Barang::find($request->barang_id);

        if ($barang->stock < $request->jumlah) {
            return response()->json([
                'status' => false,
                'message' => 'Stok barang tidak mencukupi'
            ], 400);
        }

        $peminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'pending',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Peminjaman berhasil diajukan',
            'data' => $peminjaman
        ], 201);
    }

    // Menyetujui peminjaman
    public function approve($id)
    {
        $peminjaman = Peminjaman::with('barang')->findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return response()->json([
                'status' => false,
                'message' => 'Peminjaman sudah diproses'
            ], 400);
        }

        if ($peminjaman->barang->stock < $peminjaman->jumlah) {
            return response()->json([
                'status' => false,
                'message' => 'Stok barang tidak cukup'
            ], 400);
        }

        DB::transaction(function () use ($peminjaman) {
            $peminjaman->update([
                'status' => 'approved',
                'approved_by' => auth()->id()
            ]);
            $peminjaman->barang->decrement('stock', $peminjaman->jumlah);
        });

        return response()->json([
            'status' => true,
            'message' => 'Peminjaman disetujui'
        ]);
    }

    // Menolak peminjaman
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return response()->json([
                'status' => false,
                'message' => 'Peminjaman sudah diproses'
            ], 400);
        }

        $peminjaman->update([
            'status' => 'rejected',
            'approved_by' => auth()->id()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Peminjaman ditolak'
        ]);
    }
}
