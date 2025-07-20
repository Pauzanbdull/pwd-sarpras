<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Laporan Peminjaman Barang - SARPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .no-image-placeholder {
            background: linear-gradient(135deg, #004d4d 0%, #003845 100%);
        }

        /* Kelas untuk menyembunyikan elemen saat dicetak (jika diperlukan di masa depan) */
        @media print {
            .no-print {
                display: none !important;
            }

            .print-table {
                width: 100%;
                border-collapse: collapse;
            }

            .print-table th,
            .print-table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#005f73] to-[#0a9396] text-white">
    <div class="container mx-auto px-4 py-8 max-w-7xl relative z-10">

        <header class="flex justify-between items-center mb-6 no-print">
            <div>
                <h1 class="text-3xl font-bold">Laporan Peminjaman Barang</h1>
                <p class="text-[#a3e0e0] mt-2">Rekap data peminjaman barang</p>
            </div>
            </header>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6 no-print">
            <a href="{{ route('laporan') }}" class="flex items-center space-x-2 text-white bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>Kembali ke Laporan</span>
            </a>
            <a href="{{ route('laporan.peminjaman.export') }}"
                class="inline-flex items-center space-x-2 text-white bg-green-500 hover:bg-green-600 px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                <i class="fas fa-file-excel"></i> <span>Export ke Excel</span>
            </a>
        </div>

        @if (session('success'))
            <div id="success-alert"
                class="fixed top-6 left-1/2 -translate-x-1/2 bg-green-600/90 text-white px-6 py-3 rounded-xl shadow-xl z-50 border border-green-500/30 flex items-center no-print">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
            <script>
                setTimeout(() => {
                    const alert = document.getElementById('success-alert');
                    if (alert) {
                        alert.style.transition = 'opacity 0.5s ease-out';
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500);
                    }
                }, 3000);
            </script>
        @endif

        <div class="overflow-x-auto bg-white/10 backdrop-blur-lg rounded-xl border border-white/20">
            <table class="min-w-full text-sm text-white">
                <thead class="bg-[#005f73]/80 text-left text-xs font-semibold uppercase">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Nama Peminjam</th>
                        <th class="px-6 py-3">Barang</th>
                        <th class="px-6 py-3">Jumlah</th>
                        <th class="px-6 py-3">Disetujui Oleh</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Tanggal Pinjam</th>
                        <th class="px-6 py-3">Tanggal Kembali</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/20">
                    @forelse ($peminjamans as $index => $peminjaman)
                        <tr class="hover:bg-[#005f73]/30">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">{{ $peminjaman->user->name }}</td>
                            <td class="px-6 py-4">{{ $peminjaman->barang->nama_barang }}</td>
                            <td class="px-6 py-4 font-semibold">{{ $peminjaman->jumlah }}</td>
                            <td class="px-6 py-4">
                                @if ($peminjaman->approved_by)
                                    {{ $peminjaman->approvedBy->name }}
                                @else
                                    <span class="text-white/70 italic">Belum disetujui</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($peminjaman->status == 'pending')
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-yellow-200 text-yellow-800">
                                        Pending
                                    </span>
                                @elseif($peminjaman->status == 'approved')
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-200 text-green-800">
                                        Disetujui
                                    </span>
                                @elseif($peminjaman->status == 'selesai')
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-200 text-blue-800">
                                        Selesai
                                    </span>
                                @else
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-red-200 text-red-800">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $peminjaman->created_at->translatedFormat('d F Y') }}</td>
                            <td class="px-6 py-4">
                                {{ $peminjaman->tanggal_kembali ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->translatedFormat('d F Y') : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-white/70 italic">Belum ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>