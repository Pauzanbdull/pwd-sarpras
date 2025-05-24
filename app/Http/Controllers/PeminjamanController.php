<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Tampilkan daftar semua peminjaman.
     */
    public function index()
    {
        // Ambil peminjaman beserta relasi barang & user, urut terbaru
        $peminjamans = Peminjaman::with(['barang', 'user'])->latest()->get();

        return view('peminjaman.index', compact('peminjamans'));
    }

    /**
     * Tampilkan form pengajuan peminjaman.
     */
    public function create()
    {
        // Hanya barang yang stoknya masih ada
        $barangs = Barang::where('stock', '>', 0)->get();

        return view('peminjaman.create', compact('barangs'));
    }

    /**
     * Simpan pengajuan peminjaman baru.
     */
    public function store(Request $request)
    {
        // Pastikan user login
        $userId = Auth::id();
        if (!$userId) {
            return back()->with('error', 'User belum login.');
        }

        // Validasi input
        $request->validate([
            'nama_peminjam'    => 'required|string|max:255',
            'barang_id'        => 'required|exists:barangs,id',
            'tanggal_pinjam'   => 'required|date',
            'tanggal_kembali'  => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        // Simpan data
        Peminjaman::create([
            'user_id'         => $userId,
            'nama_peminjam'   => $request->nama_peminjam,
            'barang_id'       => $request->barang_id,
            'tanggal_pinjam'  => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status'          => 'pending',
        ]);

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Pengajuan peminjaman berhasil dikirim.');
    }

    /**
     * Setujui peminjaman.
     */
    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update(['status' => 'approved']);

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Peminjaman berhasil disetujui.');
    }

    /**
     * Tolak peminjaman.
     */
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update(['status' => 'rejected']);

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Peminjaman berhasil ditolak.');
    }
}
