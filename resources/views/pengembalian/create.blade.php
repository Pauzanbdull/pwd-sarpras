<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pengembalian Barang - SARPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen font-sans bg-gradient-to-br from-[#005f73] to-[#0a9396] text-white relative overflow-hidden">

    <!-- NAVBAR -->
    <nav class="bg-[#004d4d]/80 backdrop-blur-md px-10 py-4 shadow-lg z-10 relative flex justify-between items-center">
        <h1 class="text-3xl font-semibold">Pengembalian Barang</h1>

        <div class="flex items-center gap-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-white hover:text-[#6aa6ff] transition duration-200">Log out</button>
            </form>
            <div class="relative group">
                <img src="{{ asset('assets/ojan.jpg') }}" alt="Profile" class="w-12 h-12 rounded-full object-cover border-2 border-yellow-400 shadow-md">
                <span class="absolute -bottom-1 -right-1 bg-yellow-500 text-xs px-2 py-0.5 rounded-full font-medium">ADMIN</span>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="flex justify-center mt-10 relative z-10">
        <main class="w-full max-w-md p-6 bg-[#001219]/80 rounded-2xl shadow-xl border border-[#005f73]">
            <h2 class="text-xl font-bold mb-4">Form Pengembalian Barang</h2>

            @if ($errors->any())
                <div class="bg-red-600 text-white px-4 py-2 rounded mb-4">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pengembalian.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="nama_peminjam" class="block text-sm font-medium mb-1">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" id="nama_peminjam"
                        class="w-full px-4 py-2 rounded bg-[#003845] text-white focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                        required autocomplete="off" placeholder="Masukkan nama peminjam">
                </div>

                <div class="mb-4">
                    <label for="nama_barang" class="block text-sm font-medium mb-1">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang"
                        class="w-full px-4 py-2 rounded bg-[#003845] text-white focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                        required autocomplete="off" placeholder="Masukkan nama barang">
                </div>

                <div class="mb-4">
                    <label for="jumlah" class="block text-sm font-medium mb-1">Jumlah Dikembalikan</label>
                    <input type="number" name="jumlah" id="jumlah" min="1"
                        class="w-full px-4 py-2 rounded bg-[#003845] text-white focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                        required placeholder="Masukkan jumlah barang dikembalikan">
                </div>

                <div class="mb-6">
                    <label for="tanggal_pengembalian" class="block text-sm font-medium mb-1">Tanggal Pengembalian</label>
                    <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian"
                        class="w-full px-4 py-2 rounded bg-[#003845] text-white focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                        required>
                </div>

                <button type="submit"
                    class="bg-yellow-600 hover:bg-yellow-700 px-4 py-2 w-full rounded transition-transform hover:scale-105 font-semibold">
                    Simpan Pengembalian
                </button>
            </form>

            <div class="mt-4 text-center">
                <a href="{{ route('pengembalian.index') }}" class="text-yellow-300 hover:underline">← Kembali ke daftar pengembalian</a>
            </div>
        </main>
    </div>

</body>
</html>
