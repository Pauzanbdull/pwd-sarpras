<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class LaporanController extends Controller
{
    // Menampilkan laporan stok barang
    public function stok()
    {
        $dataStok = Barang::with('kategori')->get(); // eager load relasi
        return view('laporan.stok-barang', compact('dataStok'));
    }
}
