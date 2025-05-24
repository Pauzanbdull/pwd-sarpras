<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pengembalian Barang - SARPAS</title>
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

        <!-- Header -->
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold">Pengembalian Barang</h1>
                <p class="text-[#a3e0e0] mt-2">Cek daftar barang yang telah dikembalikan</p>
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

        <!-- Tabel Data Pengembalian -->
        <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl shadow-2xl ring-1 ring-white/10">
            <h2 class="text-2xl font-semibold mb-6">Daftar Pengembalian</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse bg-white/5 text-white/90">
                    <thead>
                        <tr class="bg-[#027c7c]/80 text-left">
                            <th class="px-4 py-3 border-b border-white/10">#</th>
                            <th class="px-4 py-3 border-b border-white/10">Nama Peminjam</th>
                            <th class="px-4 py-3 border-b border-white/10">Barang</th>
                            <th class="px-4 py-3 border-b border-white/10">Tanggal Kembali</th>
                            <th class="px-4 py-3 border-b border-white/10">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengembalians as $index => $data)
                            <tr class="hover:bg-white/10 transition">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $data->nama_peminjam }}</td>
                                <td class="px-4 py-3">{{ $data->nama_barang }}</td>
                                <td class="px-4 py-3">{{ $data->tanggal_kembali }}</td>
                                <td class="px-4 py-3 text-green-300 font-medium">Sudah Kembali</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>

</html>
