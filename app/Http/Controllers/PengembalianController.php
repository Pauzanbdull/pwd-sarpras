<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Barang;
use App\Models\Peminjaman; // Tambahkan jika model Peminjam digunakan

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with(['peminjam', 'barang'])->get();
        return view('pengembalian.index', compact('pengembalians'));
    }

    public function create()
    {
        $barangs = Barang::all();
        $peminjams = Peminjaman::all(); 
        return view('pengembalian.create', compact('barangs', 'peminjams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'peminjam_id' => 'required|exists:peminjams,id',
            'tanggal_pengembalian' => 'required|date',
        ]);

        Pengembalian::create([
            'barang_id' => $request->barang_id,
            'peminjam_id' => $request->peminjam_id,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
        ]);

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil disimpan.');
    }
}
