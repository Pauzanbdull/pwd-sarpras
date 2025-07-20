<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiPeminjamanController extends Controller
{
    /**
     * Get all peminjaman
     */
    public function index(Request $request)
    {
        try {
            $query = Peminjaman::with(['barang', 'user'])
                ->latest();

            // Filter by user if not admin
            if (!$request->user()->isAdmin()) {
                $query->where('user_id', $request->user()->id);
            }

            // Filter by status if provided
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            $peminjaman = $query->get();

            return response()->json([
                'status' => true,
                'data' => $peminjaman,
                'message' => 'Data peminjaman berhasil diambil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengambil data peminjaman',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create new peminjaman
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_kembali' => 'required|date|after_or_equal:today',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = $request->user();
            $barang = Barang::findOrFail($request->barang_id);

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
                'data' => $peminjaman->load('barang')
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal membuat peminjaman',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get peminjaman detail
     */
    public function show(Request $request, $id)
    {
        try {
            $peminjaman = Peminjaman::with(['barang', 'user'])
                ->where('id', $id);

            // Non-admin can only see their own peminjaman
            if (!$request->user()->isAdmin()) {
                $peminjaman->where('user_id', $request->user()->id);
            }

            $peminjaman = $peminjaman->firstOrFail();

            return response()->json([
                'status' => true,
                'data' => $peminjaman,
                'message' => 'Detail peminjaman'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Peminjaman tidak ditemukan',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Approve peminjaman
     */
    public function approve(Request $request, $id)
    {
        try {
            DB::beginTransaction();

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

            $peminjaman->update([
                'status' => 'approved',
                'approved_by' => $request->user()->id
            ]);

            $peminjaman->barang->decrement('stock', $peminjaman->jumlah);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Peminjaman disetujui',
                'data' => $peminjaman
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyetujui peminjaman',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reject peminjaman
     */
    public function reject(Request $request, $id)
    {
        try {
            $peminjaman = Peminjaman::findOrFail($id);

            if ($peminjaman->status !== 'pending') {
                return response()->json([
                    'status' => false,
                    'message' => 'Peminjaman sudah diproses'
                ], 400);
            }

            $peminjaman->update([
                'status' => 'rejected',
                'approved_by' => $request->user()->id,
                'alasan_penolakan' => $request->alasan_penolakan ?? null
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Peminjaman ditolak',
                'data' => $peminjaman
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menolak peminjaman',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Return peminjaman (pengembalian barang)
     */
    public function return(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $peminjaman = Peminjaman::with('barang')->findOrFail($id);

            if ($peminjaman->status !== 'approved') {
                return response()->json([
                    'status' => false,
                    'message' => 'Hanya peminjaman yang disetujui yang bisa dikembalikan'
                ], 400);
            }

            $peminjaman->update([
                'status' => 'returned',
                'tanggal_dikembalikan' => now()->toDateString()
            ]);

            $peminjaman->barang->increment('stock', $peminjaman->jumlah);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Barang berhasil dikembalikan',
                'data' => $peminjaman
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengembalikan barang',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}