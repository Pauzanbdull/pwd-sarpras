<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class ApiPeminjamanController extends Controller
{
    // Menampilkan semua peminjaman
    public function index()
{
    try {
        $peminjamans = Peminjaman::with([
            'user:id,name,email',
            'barang:id,nama_barang,stock' 
        ])
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json([
            'status' => true,
            'message' => 'Daftar semua peminjaman',
            'data' => $peminjamans
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Error: ' . $e->getMessage(),
        ], 500);
    }
}



    // Menampilkan status peminjaman berdasarkan ID
    public function show($id)
    {
        $peminjaman = Peminjaman::with(['user:id,name,email', 'barang:id,nama,stock'])->find($id);

        if ($peminjaman) {
            return response()->json([
                'status' => true,
                'message' => 'Detail peminjaman ditemukan',
                'data' => $peminjaman
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Peminjaman tidak ditemukan'
            ], 404);
        }
    }

    // Approve peminjaman
    public function approve($id)
    {
        $peminjaman = Peminjaman::with('barang')->findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return response()->json([
                'status' => false,
                'message' => 'Peminjaman sudah diproses.'
            ], 400);
        }

        $peminjaman->status = 'approved';
        $peminjaman->save();

        // Kurangi stok barang
        if ($peminjaman->barang && $peminjaman->barang->stock > 0) {
            $peminjaman->barang->decrement('stock');
        }

        return response()->json([
            'status' => true,
            'message' => 'Peminjaman disetujui.'
        ]);
    }

    // Reject peminjaman
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return response()->json([
                'status' => false,
                'message' => 'Peminjaman sudah diproses.'
            ], 400);
        }

        $peminjaman->status = 'rejected';
        $peminjaman->save();

        return response()->json([
            'status' => true,
            'message' => 'Peminjaman ditolak.'
        ]);
    }
}
