<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Barang;
use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    public function index()
    {
        // Ambil semua data pengembalian beserta relasi peminjaman dan barang
        $pengembalians = Pengembalian::with(['peminjaman.user', 'barang'])->get();
        return view('pengembalian.index', compact('pengembalians'));
    }

    public function create()
    {
        // Ambil hanya peminjaman yang disetujui dan belum dikembalikan
        $peminjamans = Peminjaman::with('barang', 'user')
            ->where('status', 'approved')
            ->doesntHave('pengembalian') // pastikan belum ada pengembalian
            ->get();

        return view('pengembalian.create', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'tanggal_pengembalian' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
        ]);

        // Ambil data peminjaman terkait
        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);

        // Simpan data pengembalian
        Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'barang_id' => $peminjaman->barang_id,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'jumlah' => $request->jumlah,
        ]);

        // Perbarui status peminjaman agar tidak bisa dikembalikan dua kali
        $peminjaman->status = 'returned';
        $peminjaman->save();

        return redirect()->route('pengembalian.index')
            ->with('success', 'Data pengembalian berhasil disimpan.');
    }
}
