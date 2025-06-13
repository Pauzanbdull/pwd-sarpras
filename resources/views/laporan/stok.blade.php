<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Stok Barang - SARPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .card-glass {
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
        }
        .floating-alert {
            animation: floatIn 0.5s ease-out forwards, floatOut 0.5s ease-in 2.5s forwards;
        }
        @keyframes floatIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes floatOut {
            from { transform: translateY(0); opacity: 1; }
            to { transform: translateY(-20px); opacity: 0; }
        }
        .no-image-placeholder {
            background: linear-gradient(135deg, #004d4d 0%, #003845 100%);
        }
        @media print {
            body {
                background: white !important;
                color: black !important;
            }
            .no-print {
                display: none !important;
            }
            .print-table {
                width: 100%;
                border-collapse: collapse;
            }
            .print-table th, .print-table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            .print-table th {
                background-color: #f2f2f2;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#005f73] to-[#0a9396] text-white">

    <!-- Background Elements -->
    <div class="fixed inset-0 overflow-hidden z-0">
        <div class="absolute top-0 left-0 w-full h-full opacity-10"
            style="background-image: radial-gradient(circle at 10% 20%, rgba(255,255,255,0.8) 0%, transparent 20%);">
        </div>
        <div class="absolute bottom-0 right-0 w-1/3 h-1/3 opacity-10"
            style="background-image: radial-gradient(circle at 90% 80%, rgba(255,255,255,0.8) 0%, transparent 30%);">
        </div>
    </div>

    <!-- Main Container -->
    <div class="container mx-auto px-4 py-8 max-w-7xl relative z-10">
        <!-- Header Section -->
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold">Laporan Stok Barang</h1>
                <p class="text-[#a3e0e0] mt-2">Rekapitulasi stok barang inventaris</p>
            </div>
            
            <div class="flex items-center space-x-6 no-print">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2 px-5 py-2.5 bg-[#027c7c] hover:bg-[#03a9a9] rounded-full transition-all duration-200 group shadow-lg hover:shadow-xl">
                        <span>Logout</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
                <div class="relative group">
                    <img src="{{ asset('assets/ojan.jpg') }}" alt="Profile" class="w-12 h-12 rounded-full object-cover border-2 border-yellow-400 shadow-md">
                    <span class="absolute -bottom-1 -right-1 bg-yellow-500 text-xs px-2 py-0.5 rounded-full font-medium">ADMIN</span>
                </div>
            </div>
        </header>

        <!-- Success Message -->
        @if (session('success'))
            <div class="floating-alert fixed top-8 left-1/2 transform -translate-x-1/2 bg-green-600 text-white px-8 py-3 rounded-xl shadow-2xl z-50 flex items-center space-x-3 no-print">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Navigation and Action Buttons -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6 no-print">
            <a href="{{ route('laporan') }}" class="flex items-center space-x-2 text-white bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>Kembali ke Laporan</span>
            </a>

            <div class="flex gap-4">
                <button onclick="window.print()" class="flex items-center space-x-2 text-white bg-gradient-to-r from-[#005f73] to-[#0a9396] hover:from-[#0a9396] hover:to-[#005f73] px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-110 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    <span>Cetak Laporan</span>
                </button>

                <button onclick="exportToExcel()" class="flex items-center space-x-2 text-white bg-gradient-to-r from-green-600 to-green-500 hover:from-green-500 hover:to-green-600 px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-110 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Export Excel</span>
                </button>
            </div>
        </div>

        <!-- Laporan Section -->
        <section class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl shadow-lg overflow-hidden no-print">
            <div class="overflow-x-auto w-full">
                <table class="w-full text-white whitespace-nowrap" id="stokTable">
                    <!-- ===== Head ===== -->
                    <thead class="bg-[#005f73]/80 uppercase text-sm tracking-wider">
                        <tr>
                            <th class="px-6 py-4 text-left">No</th>
                            <th class="px-6 py-4 text-left">Gambar</th>
                            <th class="px-6 py-4 text-left">Nama Barang</th>
                            <th class="px-6 py-4 text-left">Kategori</th>
                            <th class="px-6 py-4 text-left">Jumlah Stok</th>
                            <th class="px-6 py-4 text-left">Kondisi</th>
                        </tr>
                    </thead>

                    <!-- ===== Body ===== -->
                    <tbody class="divide-y divide-white/20">
                        @forelse ($dataStok as $index => $barang)
                            <tr class="hover:bg-[#005f73]/30 transition-colors">
                                <!-- Nomor -->
                                <td class="px-6 py-4">{{ $index + 1 }}</td>

                                <!-- Gambar -->
                                <td class="px-6 py-4">
                                    @if ($barang->gambar)
                                        <img src="{{ asset('storage/'.$barang->gambar) }}"
                                             alt="{{ $barang->nama_barang }}"
                                             class="w-16 h-16 object-cover rounded-md ring-1 ring-white/20">
                                    @else
                                        <div class="no-image-placeholder w-16 h-16 rounded-md flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-300" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16M14 14l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </td>

                                <!-- Nama Barang -->
                                <td class="px-6 py-4 font-medium">{{ $barang->nama_barang }}</td>

                                <!-- Kategori -->
                                <td class="px-6 py-4">
                                    {{ $barang->kategori?->nama_kategori ?? '-' }}
                                </td>

                                <!-- Jumlah Stok -->
                                <td class="py-4 px-6 text-center">
    <span class="quantity-badge">
        {{ $barang->stock ?? '0' }}
    </span>
</td>

                                <!-- Kondisi -->
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $barang->kondisi == 'Baik' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $barang->kondisi }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center italic text-white/70">
                                    Belum ada data stok barang.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Printable Version (Hidden on Screen) -->
        <div class="hidden print:block">
            <h1 class="text-2xl font-bold mb-4 text-black">Laporan Stok Barang</h1>
            <p class="text-gray-700 mb-6">Tanggal: {{ date('d F Y') }}</p>
            
            <table class="print-table w-full mb-6">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah Stok</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataStok as $index => $barang)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori?->nama_kategori ?? '-' }}</td>
                        <td>{{ $barang->jumlah_stok }}</td>
                        <td>{{ $barang->kondisi }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

           

        

    <script>
        // Fungsi untuk export ke Excel
        function exportToExcel() {
            // Mengambil data dari tabel
            const table = document.getElementById('stokTable');
            const rows = table.querySelectorAll('tr');
            
            // Membuat array data
            const data = [];
            
            // Header
            const headers = [];
            table.querySelectorAll('thead th').forEach(header => {
                headers.push(header.textContent.trim());
            });
            data.push(headers);
            
            // Isi tabel
            table.querySelectorAll('tbody tr').forEach(row => {
                const rowData = [];
                row.querySelectorAll('td').forEach((cell, index) => {
                    // Skip kolom gambar (index 1)
                    if (index !== 1) {
                        // Untuk kolom dengan span (stok dan kondisi)
                        const span = cell.querySelector('span');
                        rowData.push(span ? span.textContent.trim() : cell.textContent.trim());
                    }
                });
                data.push(rowData);
            });
            
            // Membuat workbook Excel
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet(data);
            XLSX.utils.book_append_sheet(wb, ws, "Laporan Stok");
            
            // Export ke file Excel
            const date = new Date().toISOString().slice(0, 10);
            XLSX.writeFile(wb, `Laporan_Stok_${date}.xlsx`);
        }

        // Fungsi untuk menangani tampilan saat mencetak
        window.addEventListener('beforeprint', () => {
            document.body.classList.add('printing');
        });

        window.addEventListener('afterprint', () => {
            document.body.classList.remove('printing');
        });
    </script>
</body>
</html>