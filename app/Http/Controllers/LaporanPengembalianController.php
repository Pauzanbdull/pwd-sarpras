<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Exports\PengembalianExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class LaporanPengembalianController extends Controller
{
    public function index(Request $request)
    {
        try {
            $validated = $request->validate([
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
            ]);

            $query = Pengembalian::with(['user', 'approvedBy', 'barang'])
                ->orderBy('created_at', 'desc');

           if (!empty($validated['start_date'])) {
    $query->whereDate('created_at', '>=', $validated['start_date']);
}


            if (!empty($validated['end_date'])) {
                $query->whereDate('created_at', '<=', $validated['end_date']);
            }

            $pengembalians = $query->paginate(10);

            return view('laporan.pengembalian', compact('pengembalians'));

        } catch (\Exception $e) {
            Log::error('Error in LaporanPengembalianController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data pengembalian.');
        }
    }

    public function exportExcel(Request $request)
    {
        try {
            $validated = $request->validate([
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
            ]);

            $fileName = 'Laporan_Pengembalian_' . now()->format('Ymd_His') . '.xlsx';

            return Excel::download(
                new PengembalianExport(
                    $validated['start_date'] ?? null,
                    $validated['end_date'] ?? null
                ),
                $fileName
            );

        } catch (\Exception $e) {
            Log::error('Error in LaporanPengembalianController@exportExcel: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengekspor data.');
        }
    }
}