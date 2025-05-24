<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pengembalian Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .card-glass {
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
        }
        .table-row-hover:hover {
            background-color: rgba(0, 109, 109, 0.6);
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
                <h1 class="text-3xl md:text-4xl font-bold">Data Pengembalian Barang</h1>
                <p class="text-[#a3e0e0] mt-2">Daftar barang yang telah dikembalikan</p>
            </div>
            <div class="flex items-center space-x-6">
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
                    <img src="{{ asset('assets/ojan.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400 shadow-md">
                    <span class="absolute -bottom-1 -right-1 bg-yellow-500 text-xs px-2 py-0.5 rounded-full font-medium">ADMIN</span>
                </div>
            </div>
        </header>

        <!-- Kembali -->
        <div class="mb-10">
            <a href="{{ route('pendataan') }}" class="flex items-center space-x-2 text-white bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>Kembali ke Pendataan</span>
            </a>
        </div>

        <!-- Tabel Pengembalian -->
        <div class="card-glass bg-[#006d6d]/80 rounded-2xl shadow-xl border border-[#005f73] overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                    </svg>
                    Daftar Pengembalian Barang
                </h2>

                @if($pengembalians->isEmpty())
                    <div class="text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-300">Belum ada pengembalian</h3>
                        <p class="mt-1 text-gray-400">Tidak ada data pengembalian saat ini</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-[#005f73]">
                            <thead class="bg-[#005f73]/50 text-gray-100 text-xs uppercase tracking-wider">
                                <tr>
                                    <th class="px-6 py-3 text-left font-medium">ID</th>
                                    <th class="px-6 py-3 text-left font-medium">Nama Peminjam</th>
                                    <th class="px-6 py-3 text-left font-medium">Barang</th>
                                    <th class="px-6 py-3 text-left font-medium">Tanggal Pengembalian</th>
                                </tr>
                            </thead>
                            <tbody class="bg-[#006d6d]/50 divide-y divide-[#005f73]">
                                @foreach ($pengembalians as $pengembalian)
                                    <tr class="table-row-hover transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $pengembalian->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $pengembalian->peminjam->nama ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $pengembalian->barang->nama_barang ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

</body>
</html>
