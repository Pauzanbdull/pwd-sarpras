<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pengembalian - SARPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .no-image-placeholder {
            background: linear-gradient(135deg, #004d4d 0%, #003845 100%);
        }

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

        <!-- Header -->
        <header class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold">Laporan Pengembalian</h1>
                <p class="text-[#a3e0e0] mt-2">Rekap data pengembalian barang</p>
            </div>
            <button onclick="window.print()" class="no-print bg-white text-[#005f73] px-4 py-2 rounded-full shadow hover:bg-gray-100 font-semibold">Cetak</button>
        </header>

        <!-- Navigation and Action Buttons -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6 no-print">
            <a href="{{ route('laporan') }}" class="flex items-center space-x-2 text-white bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>Kembali ke Laporan</span>
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto bg-white/10 backdrop-blur-lg rounded-xl border border-white/20">
            <table class="min-w-full text-sm text-white">
                <thead class="bg-[#005f73]/80 text-left text-xs font-semibold uppercase">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Nama Peminjam</th>
                        <th class="px-6 py-3">Barang</th>
                        <th class="px-6 py-3">Tanggal Pinjam</th>
                        <th class="px-6 py-3">Tanggal Kembali</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/20">
                    @forelse ($pengembalians as $index => $item)
                        <tr class="hover:bg-[#005f73]/30">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">{{ $item->user->name }}</td>
                            <td class="px-6 py-4">{{ $item->item->nama_barang }}</td>
                            <td class="px-6 py-4">{{ $item->tanggal_pinjam }}</td>
                            <td class="px-6 py-4">{{ $item->tanggal_kembali }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $item->status == 'dikembalikan' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-white/70 italic">Belum ada data pengembalian.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
