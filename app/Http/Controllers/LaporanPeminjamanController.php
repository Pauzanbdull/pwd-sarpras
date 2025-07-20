<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PeminjamanExport;
use Illuminate\Support\Facades\Log;

class LaporanPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        try {
            $validated = $request->validate([
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
            ]);

            $query = Peminjaman::with(['user', 'barang.kategori', 'approvedByUser'])
                ->latest();

            if (!empty($validated['start_date']) && !empty($validated['end_date'])) {
                $query->whereBetween('tanggal_pinjam', [
                    $validated['start_date'], 
                    $validated['end_date']
                ]);
            }

            $peminjamans = $query->paginate(10);

            return view('laporan.peminjaman', compact('peminjamans'));

        } catch (\Exception $e) {
            Log::error('Error in LaporanPeminjamanController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data peminjaman.');
        }
    }

    public function exportExcel(Request $request)
    {
        try {
            $validated = $request->validate([
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
            ]);

            $fileName = 'Laporan_Peminjaman_' . now()->format('Ymd_His') . '.xlsx';

            return Excel::download(
                new PeminjamanExport(
                    $validated['start_date'] ?? null,
                    $validated['end_date'] ?? null
                ),
                $fileName
            );

        } catch (\Exception $e) {
            Log::error('Error in LaporanPeminjamanController@exportExcel: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengekspor data.');
        }
    }
}