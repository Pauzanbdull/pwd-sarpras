<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    // Menampilkan daftar barang
    public function index()
    {
        $barangs = Barang::with('kategori')->get();
        return view('barang.index', compact('barangs'));
    }

    // Menampilkan halaman form tambah barang
    public function create()
    {
        $kategoris = KategoriBarang::all();
        return view('barang.create', compact('kategoris'));
    }

    // Menyimpan data barang baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'  => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kategori_id'  => 'required|exists:kategori_barang,id',
            'stock'        => 'required|integer|min:0',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('uploads', 'public');
        }

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $gambar,
            'kategori_id' => $request->kategori_id,
            'stock'       => $request->stock,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    // Menampilkan detail barang (jika digunakan)
    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    // Menampilkan form edit barang
    public function edit(Barang $barang)
    {
        $kategoris = KategoriBarang::all();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    // Menyimpan perubahan pada data barang
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|max:2048',
            'kategori_id' => 'required|exists:kategori_barang,id',
            'stock'       => 'required|integer|min:0',
        ]);

        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            $barang->gambar = $request->file('gambar')->store('uploads', 'public');
        }

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $barang->gambar,
            'kategori_id' => $request->kategori_id,
            'stock'       => $request->stock,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate');
    }

    // Menghapus data barang
    public function destroy(Barang $barang)
    {
        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }

    // ✅ Menampilkan halaman stok (laporan stok)
   public function stok()
{
    $dataStok = Barang::with('kategori')->get();
    return view('laporan.stok', compact('dataStok'));
}


}
