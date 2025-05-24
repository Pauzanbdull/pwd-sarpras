<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pendataan - SARPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
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
                <h1 class="text-3xl md:text-4xl font-bold">Pendataan Kategori Barang</h1>
                <p class="text-[#a3e0e0] mt-2">Kelola kategori barang dengan mudah</p>
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

            <a href="{{ route('kategori.create') }}" class="flex items-center space-x-2 text-white bg-gradient-to-r from-[#005f73] to-[#0a9396] hover:from-[#0a9396] hover:to-[#005f73] px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-110 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span>Tambah Kategori Baru</span>
            </a>
        </div>

        <!-- Categories Table Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-6 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
                Daftar Kategori Barang
            </h2>

            <div class="overflow-x-auto bg-[#006d6d]/80 rounded-xl shadow-lg border border-[#005f73]">
                <table class="min-w-full text-white text-sm">
                    <thead>
                        <tr class="bg-[#005f73] text-left text-white uppercase text-xs">
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Nama Kategori</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $i => $k)
                        <tr class="border-t border-[#027373]/40 hover:bg-[#027373]/30 transition">
                            <td class="px-6 py-4">{{ $i + 1 }}</td>
                            <td class="px-6 py-4 font-medium">{{ $k->nama_kategori }}</td>
                            <td class="px-6 py-4 flex gap-3">

                                 <!-- Edit -->
                                <a href="{{ route('kategori.edit', $k->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-500 hover:bg-blue-600 rounded-md text-sm transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>

                                <!-- Hapus -->
                                <form action="{{ route('kategori.destroy', $k->id) }}" method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
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
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-white">Belum ada kategori.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
