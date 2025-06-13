<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Barang;

class LaporanController extends Controller
{
    // Menampilkan laporan stok barang
    public function stok()
    {
        $dataStok = Barang::with('kategori')->get();
        return view('laporan.stok', compact('dataStok'));
    }

    // Menampilkan laporan peminjaman barang
    public function peminjaman()
    {
        $peminjaman = Peminjaman::with(['user', 'barang', 'approver'])->get();
        return view('laporan.peminjaman', compact('peminjaman'));
    }
   public function pengembalian()
{
    $pengembalians = Peminjaman::where('status', 'Dikembalikan')
                        ->with(['barang', 'user'])
                        ->get();

    return view('laporan.pengembalian', compact('pengembalians'));
}


}
