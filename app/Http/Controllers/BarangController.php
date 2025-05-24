<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang; // Pastikan menggunakan model yang benar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
{
    $barangs = Barang::with('kategori')->   get();  // Memuat relasi kategori
    return view('barang.index', compact('barangs'));
}

public function create()
{
    $kategoris = KategoriBarang::all();  // Mengambil semua kategori
    return view('barang.create', compact('kategoris'));
}

    public function store(Request $request)
{
    // Validasi data
    $request->validate([
        'nama_barang' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'kategori_id' => 'required|exists:kategori_barang,id',
        'stock' => 'required|integer|min:0',
    ]);

    // Simpan file gambar jika ada
    $gambar = null;
    if ($request->hasFile('gambar')) {
        $gambar = $request->file('gambar')->store('uploads', 'public');
    }

    // Simpan ke database
    Barang::create([
        'nama_barang' => $request->nama_barang,
        'deskripsi' => $request->deskripsi,
        'gambar' => $gambar,
        'kategori_id' => $request->kategori_id,
        'stock' => $request->stock,
    ]);

    return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
}


    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
{
    $kategoris = KategoriBarang::all();
    return view('barang.edit', compact('barang', 'kategoris'));
}

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            $barang->gambar = $request->file('gambar')->store('gambar_barang', 'public');
        }

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'gambar' => $barang->gambar,
            'kategori_id' => $request->kategori_id, // Pastikan kategori_id di-update
            'stock' => $request->stock, // Pastikan stock di-update
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
