<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use App\Exports\BarangExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LaporanStokController extends Controller
{
    /**
     * Tampilkan laporan stok barang dengan filter kategori.
     *
     * @param Request $request
     * @return View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
{
    try {
        $request->validate([
            'kategori' => 'nullable|exists:kategori_barangs,id',
        ]);

        $barangs = Barang::with('kategori')
            ->when($request->kategori, fn($query, $kategori) => $query->where('kategori_id', $kategori))
            ->orderBy('nama')
            ->paginate(10);

        $kategoris = KategoriBarang::all();

        return view('laporan.index', compact('barangs', 'kategoris'));
    } catch (\Throwable $e) {
        Log::error('Gagal memuat laporan stok: ' . $e->getMessage());

        return redirect()
            ->back()
            ->with('error', 'Terjadi kesalahan saat memuat data stok. Silakan coba lagi.');
    }
}


    /**
     * Export data stok ke file Excel.
     *
     * @param Request $request
     * @return BinaryFileResponse|\Illuminate\Http\RedirectResponse
     */
    public function exportExcel(Request $request)
    {
        try {
            $request->validate([
                'kategori' => 'nullable|exists:kategori_barangs,id',
            ]);

            $fileName = 'Laporan_Stok_' . now()->format('Ymd_His') . '.xlsx';
            $kategoriId = $request->kategori ?? null;

            return Excel::download(new BarangExport($kategoriId), $fileName);
        } catch (\Throwable $e) {
            Log::error('Gagal ekspor laporan stok: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat mengekspor data stok.');
        }
    }
}
