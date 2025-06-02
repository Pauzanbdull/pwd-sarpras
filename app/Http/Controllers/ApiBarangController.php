<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Validation\Rule;

class ApiBarangController extends Controller
{
    // Menampilkan semua barang
    public function index()
    {
        $barang = Barang::with('kategori')->get(); // include relasi
        return response()->json([
            'status' => true,
            'data' => $barang
        ]);
    }

    // Menampilkan barang berdasarkan ID
    public function show($id)
    {
        $barang = Barang::with('kategori')->find($id);

        if (!$barang) {
            return response()->json([
                'status' => false,
                'message' => 'Barang tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $barang
        ]);
    }

    // Menyimpan barang baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang'  => 'required|string|max:255',
            'kategori_id'  => 'required|exists:kategori_barang,id',
            'deskripsi'    => 'nullable|string',
            'gambar'       => 'nullable|string|max:255',
            'stock'        => 'required|integer|min:0',
        ]);

        $barang = Barang::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Barang berhasil ditambahkan',
            'data' => $barang
        ], 201);
    }

    // Memperbarui data barang
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'status' => false,
                'message' => 'Barang tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nama_barang'  => 'sometimes|required|string|max:255',
            'kategori_id'  => 'sometimes|required|exists:kategori_barang,id',
            'deskripsi'    => 'nullable|string',
            'gambar'       => 'nullable|string|max:255',
            'stock'        => 'sometimes|required|integer|min:0',
        ]);

        $barang->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Barang berhasil diperbarui',
            'data' => $barang
        ]);
    }

    // Menghapus barang
    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'status' => false,
                'message' => 'Barang tidak ditemukan'
            ], 404);
        }

        $barang->delete();

        return response()->json([
            'status' => true,
            'message' => 'Barang berhasil dihapus'
        ]);
    }
}
