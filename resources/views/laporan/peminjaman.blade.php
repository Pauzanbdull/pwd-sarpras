<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman Barang - SARPAS</title>
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
        .status-pending {
            background-color: #fef08a;
            color: #854d0e;
        }
        .status-approved {
            background-color: #bbf7d0;
            color: #166534;
        }
        .status-rejected {
            background-color: #fecaca;
            color: #991b1b;
        }
        .status-returned {
            background-color: #bfdbfe;
            color: #1e40af;
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
                <h1 class="text-3xl md:text-4xl font-bold">Laporan Peminjaman Barang</h1>
                <p class="text-[#a3e0e0] mt-2">Rekapitulasi peminjaman barang inventaris</p>
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
            <a href="{{ route('pendataan') }}" class="flex items-center space-x-2 text-white bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>Kembali ke Pendataan</span>
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

        <!-- Filter Section -->
        <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl p-6 mb-6 no-print">
            <h3 class="text-lg font-medium text-[#a3e0e0] mb-4">Filter Laporan</h3>
            <form method="GET" action="{{ route('laporan.peminjaman') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#a3e0e0] mb-1">Status</label>
                    <select name="status" class="w-full bg-white/20 border border-white/30 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0a9396]">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Dikembalikan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#a3e0e0] mb-1">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full bg-white/20 border border-white/30 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0a9396]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#a3e0e0] mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full bg-white/20 border border-white/30 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0a9396]">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-[#0a9396] hover:bg-[#027c7c] text-white px-4 py-2 rounded-lg transition-colors duration-200">
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Laporan Section -->
        <section class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl shadow-lg overflow-hidden no-print">
            <div class="overflow-x-auto w-full">
                <table class="w-full text-white whitespace-nowrap" id="peminjamanTable">
                    <!-- ===== Head ===== -->
                    <thead class="bg-[#005f73]/80 uppercase text-sm tracking-wider">
                        <tr>
                            <th class="px-6 py-4 text-left">No</th>
                            <th class="px-6 py-4 text-left">Peminjam</th>
                            <th class="px-6 py-4 text-left">Barang</th>
                            <th class="px-6 py-4 text-left">Tanggal Pinjam</th>
                            <th class="px-6 py-4 text-left">Tanggal Kembali</th>
                            <th class="px-6 py-4 text-left">Jumlah</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-left">Keterangan</th>
                        </tr>
                    </thead>

                    <!-- ===== Body ===== -->
                    <tbody class="divide-y divide-white/20">
                        @forelse ($peminjaman as $index => $item)
                            <tr class="hover:bg-[#005f73]/30 transition-colors">
                                <!-- Nomor -->
                                <td class="px-6 py-4">{{ $index + 1 }}</td>

                                <!-- Peminjam -->
                                <td class="px-6 py-4 font-medium">
                                    {{ $item->user->name ?? 'Unknown' }}
                                    <p class="text-sm text-[#a3e0e0]">{{ $item->user->email ?? '' }}</p>
                                </td>

                                <!-- Barang -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($item->barang->gambar)
                                            <img src="{{ asset('storage/'.$item->barang->gambar) }}"
                                                alt="{{ $item->barang->nama_barang }}"
                                                class="w-10 h-10 object-cover rounded-md ring-1 ring-white/20">
                                        @else
                                            <div class="no-image-placeholder w-10 h-10 rounded-md flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16M14 14l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-medium">{{ $item->barang->nama_barang }}</p>
                                            <p class="text-sm text-[#a3e0e0]">{{ $item->barang->kategori->nama_kategori ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Tanggal Pinjam -->
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                </td>

                                <!-- Tanggal Kembali -->
                                <td class="px-6 py-4">
                                    {{ $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') : '-' }}
                                </td>

                                <!-- Jumlah -->
                                <td class="px-6 py-4">
                                    {{ $item->jumlah }}
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    @php
                                        $statusClass = [
                                            'pending' => 'status-pending',
                                            'approved' => 'status-approved',
                                            'rejected' => 'status-rejected',
                                            'returned' => 'status-returned'
                                        ][$item->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>

                                <!-- Keterangan -->
                                <td class="px-6 py-4 text-sm">
                                    {{ $item->keterangan ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-8 text-center italic text-white/70">
                                    Belum ada data peminjaman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($peminjaman->hasPages())
                <div class="bg-[#005f73]/50 px-6 py-4 border-t border-white/20">
                    {{ $peminjaman->links() }}
                </div>
            @endif
        </section>

        <!-- Printable Version (Hidden on Screen) -->
        <div class="hidden print:block">
            <h1 class="text-2xl font-bold mb-4 text-black">Laporan Peminjaman Barang</h1>
            <p class="text-gray-700 mb-2">Tanggal: {{ date('d F Y') }}</p>
            
            @if(request('status') || request('start_date') || request('end_date'))
                <div class="mb-4">
                    <p class="text-gray-700 font-medium">Filter:</p>
                    <ul class="list-disc list-inside text-gray-700">
                        @if(request('status'))
                            <li>Status: {{ ucfirst(request('status')) }}</li>
                        @endif
                        @if(request('start_date'))
                            <li>Dari Tanggal: {{ \Carbon\Carbon::parse(request('start_date'))->format('d F Y') }}</li>
                        @endif
                        @if(request('end_date'))
                            <li>Sampai Tanggal: {{ \Carbon\Carbon::parse(request('end_date'))->format('d F Y') }}</li>
                        @endif
                    </ul>
                </div>
            @endif
            
            <table class="print-table w-full mb-6">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peminjam</th>
                        <th>Barang</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->user->name ?? 'Unknown' }}</td>
                        <td>{{ $item->barang->nama_barang }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                        <td>{{ $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') : '-' }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ ucfirst($item->status) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="grid grid-cols-4 gap-4 mt-8">
                <div class="border-t-2 border-gray-300 pt-4">
                    <p class="text-gray-700">Total Peminjaman:</p>
                    <p class="font-bold">{{ $peminjaman->total() }}</p>
                </div>
                <div class="border-t-2 border-gray-300 pt-4">
                    <p class="text-gray-700">Pending:</p>
                    <p class="font-bold">{{ $peminjaman->where('status', 'pending')->count() }}</p>
                </div>
                <div class="border-t-2 border-gray-300 pt-4">
                    <p class="text-gray-700">Disetujui:</p>
                    <p class="font-bold">{{ $peminjaman->where('status', 'approved')->count() }}</p>
                </div>
                <div class="border-t-2 border-gray-300 pt-4">
                    <p class="text-gray-700">Dikembalikan:</p>
                    <p class="font-bold">{{ $peminjaman->where('status', 'returned')->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-6 no-print">
            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl p-6 shadow-lg">
                <h3 class="text-lg font-medium text-[#a3e0e0] mb-2">Total Peminjaman</h3>
                <p class="text-3xl font-bold">{{ $peminjaman->total() }}</p>
            </div>
            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl p-6 shadow-lg">
                <h3 class="text-lg font-medium text-[#a3e0e0] mb-2">Pending</h3>
                <p class="text-3xl font-bold">{{ $peminjaman->where('status', 'pending')->count() }}</p>
            </div>
            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl p-6 shadow-lg">
                <h3 class="text-lg font-medium text-[#a3e0e0] mb-2">Disetujui</h3>
                <p class="text-3xl font-bold">{{ $peminjaman->where('status', 'approved')->count() }}</p>
            </div>
            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl p-6 shadow-lg">
                <h3 class="text-lg font-medium text-[#a3e0e0] mb-2">Dikembalikan</h3>
                <p class="text-3xl font-bold">{{ $peminjaman->where('status', 'returned')->count() }}</p>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk export ke Excel
        function exportToExcel() {
            // Mengambil data dari tabel
            const table = document.getElementById('peminjamanTable');
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
                    // Skip kolom gambar (index 2)
                    if (index !== 2) {
                        // Untuk kolom dengan span (status)
                        const span = cell.querySelector('span');
                        rowData.push(span ? span.textContent.trim() : cell.textContent.trim());
                    } else {
                        // Ambil hanya nama barang untuk kolom barang
                        const namaBarang = cell.querySelector('p.font-medium');
                        rowData.push(namaBarang ? namaBarang.textContent.trim() : '');
                    }
                });
                data.push(rowData);
            });
            
            // Membuat workbook Excel
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet(data);
            XLSX.utils.book_append_sheet(wb, ws, "Laporan Peminjaman");
            
            // Export ke file Excel
            const date = new Date().toISOString().slice(0, 10);
            XLSX.writeFile(wb, `Laporan_Peminjaman_${date}.xlsx`);
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