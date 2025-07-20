<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\Auth;

class ApiPengembalianController extends Controller
{
    // Menampilkan semua data pengembalian
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman', 'user')->get();
        return response()->json($pengembalians);
    }

    // Menyimpan data pengembalian baru
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'tanggal_pengembalian' => 'required|date',
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);

        // Cek apakah sudah dikembalikan
        if ($peminjaman->status === 'dikembalikan') {
            return response()->json(['message' => 'Barang sudah dikembalikan.'], 400);
        }

        // Simpan data pengembalian
        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'user_id' => Auth::id(),
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
        ]);

        // Update status peminjaman
        $peminjaman->status = 'dikembalikan';
        $peminjaman->save();

        return response()->json([
            'message' => 'Pengembalian berhasil dicatat.',
            'data' => $pengembalian
        ]);
    }

    // Menampilkan detail pengembalian tertentu
    public function show($id)
    {
        $pengembalian = Pengembalian::with('peminjaman', 'user')->find($id);

        if (!$pengembalian) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($pengembalian);
    }

    // Menghapus data pengembalian
    public function destroy($id)
    {
        $pengembalian = Pengembalian::find($id);

        if (!$pengembalian) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $pengembalian->delete();

        return response()->json(['message' => 'Data pengembalian berhasil dihapus.']);
    }
}
