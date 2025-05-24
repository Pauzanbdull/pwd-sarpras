<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Barang - SARPAS</title>
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
        .item-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }
        .no-image-placeholder {
            background: linear-gradient(135deg, #004d4d 0%, #003845 100%);
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
                <h1 class="text-3xl md:text-4xl font-bold">Pendataan Barang</h1>
                <p class="text-[#a3e0e0] mt-2">Kelola inventaris barang dengan mudah</p>
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
                    <img src="{{ asset('assets/ojan.jpg') }}" alt="Profile" class="w-12 h-12 rounded-full object-cover border-2 border-yellow-400 shadow-md">
                    <span class="absolute -bottom-1 -right-1 bg-yellow-500 text-xs px-2 py-0.5 rounded-full font-medium">ADMIN</span>
                </div>
            </div>
        </header>

        <!-- Success Message -->
        @if (session('success'))
            <div class="floating-alert fixed top-8 left-1/2 transform -translate-x-1/2 bg-green-600 text-white px-8 py-3 rounded-xl shadow-2xl z-50 flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Navigation and Action Buttons -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
            <a href="{{ route('pendataan') }}" class="flex items-center space-x-2 text-white bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>Kembali ke Pendataan</span>
            </a>

            <a href="{{ route('barang.create') }}" class="flex items-center space-x-2 text-white bg-gradient-to-r from-[#005f73] to-[#0a9396] hover:from-[#0a9396] hover:to-[#005f73] px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-110 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span>Tambah Barang Baru</span>
            </a>
        </div>

        <!-- Items Section -->
<section class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto w-full">
        <table class="w-full text-white whitespace-nowrap">
            <!-- ===== Head ===== -->
            <thead class="bg-[#005f73]/80 uppercase text-sm tracking-wider">
                <tr>
                    <th class="px-6 py-4 text-left">No</th>
                    <th class="px-6 py-4 text-left">Gambar</th>
                    <th class="px-6 py-4 text-left">Nama Barang</th>
                    <th class="px-6 py-4 text-left">Stok</th>
                    <th class="px-6 py-4 text-left">Kategori</th>
                    <th class="px-6 py-4 text-left">Aksi</th>
                </tr>
            </thead>

            <!-- ===== Body ===== -->
            <tbody class="divide-y divide-white/20">
                @forelse ($barangs as $barang)
                    <tr class="hover:bg-[#005f73]/30 transition-colors">
                        <!-- ID -->
                        <td class="px-6 py-4">{{ $barang->id }}</td>

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

                        <!-- Nama -->
                        <td class="px-6 py-4 font-medium">{{ $barang->nama_barang }}</td>

                        <!-- Stock -->
                        <td class="px-6 py-4">{{ $barang->stock }}</td>

                        <!-- Kategori -->
                        <td class="px-6 py-4">
                            {{ $barang->kategori?->nama_kategori ?? '-' }}
                        </td>

                        <!-- Aksi -->
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <!-- Edit -->
                                <a href="{{ route('barang.edit', $barang->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-500 hover:bg-blue-600 rounded-md text-sm transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>

                                <!-- Hapus -->
                                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-500 hover:bg-red-600 rounded-md text-sm transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 3v2m6-2v2M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center italic text-white/70">
                            Belum ada data barang.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
