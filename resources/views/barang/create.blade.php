<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Barang - SARPAS</title>
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
        .file-upload {
            position: relative;
            overflow: hidden;
        }
        .file-upload-input {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
        .input-highlight {
            transition: all 0.3s ease;
            box-shadow: 0 0 0 0px rgba(234, 179, 8, 0);
        }
        .input-highlight:focus {
            box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.3);
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
    <div class="container mx-auto px-4 py-8 max-w-4xl relative z-10">
        <!-- Header Section -->
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold">Tambah Barang Baru</h1>
                <p class="text-[#a3e0e0] mt-2">Isi formulir untuk menambahkan barang ke inventaris</p>
            </div>
            
            <div class="flex items-center space-x-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2 text-white hover:text-[#6aa6ff] transition duration-200 group">
                        <span>Logout</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
                <div class="relative group">
                    <img src="/assets/ojan.jpg" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400">
                </div>
            </div>
        </header>

        <!-- Form Section -->
        <div class="card-glass bg-[#001219]/80 p-8 rounded-2xl shadow-xl border border-[#005f73]">
            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Grid Layout for Form Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Nama Barang -->
                    <div class="space-y-2">
                        <label for="nama_barang" class="block text-sm font-medium">Nama Barang</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <input type="text" name="nama_barang" id="nama_barang" required
                                class="input-highlight w-full pl-10 pr-4 py-3 rounded-lg bg-[#003845] border border-[#005f73] focus:border-yellow-500 focus:outline-none">
                        </div>
                    </div>

                    <!-- Stock -->
                    <div class="space-y-2">
                        <label for="stock" class="block text-sm font-medium">Stock</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <input type="number" name="stock" id="stock" required min="1"
                                class="input-highlight w-full pl-10 pr-4 py-3 rounded-lg bg-[#003845] border border-[#005f73] focus:border-yellow-500 focus:outline-none">
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="space-y-2">
                        <label for="kategori_id" class="block text-sm font-medium">Kategori</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <select name="kategori_id" id="kategori_id" required
                                class="input-highlight w-full pl-10 pr-4 py-3 rounded-lg bg-[#003845] border border-[#005f73] focus:border-yellow-500 focus:outline-none appearance-none">
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Gambar Upload -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium">Gambar Barang</label>
                        <div class="file-upload w-full">
                            <label for="gambar" class="cursor-pointer">
                                <div class="input-highlight w-full px-4 py-12 rounded-lg bg-[#003845] border-2 border-dashed border-[#005f73] flex flex-col items-center justify-center hover:border-yellow-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm">Klik untuk mengunggah gambar</span>
                                    <span id="file-name-display" class="text-xs text-gray-300 mt-2">Belum ada file yang dipilih</span>
                                </div>
                            </label>
                            <input type="file" name="gambar" id="gambar" class="file-upload-input">
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="space-y-2">
                    <label for="deskripsi" class="block text-sm font-medium">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                        class="input-highlight w-full px-4 py-3 rounded-lg bg-[#003845] border border-[#005f73] focus:border-yellow-500 focus:outline-none"></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col-reverse sm:flex-row justify-between items-center gap-4 pt-6">
                    <a href="{{ route('barang.index') }}" class="flex items-center space-x-2 text-yellow-300 hover:text-yellow-200 transition-colors w-full sm:w-auto justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        <span>Kembali ke Daftar</span>
                    </a>
                    <button type="submit" class="w-full sm:w-auto flex items-center justify-center space-x-2 bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 text-white px-8 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-[1.02]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span>Simpan Barang</span>
                    </button>
                </div>

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="mt-6 p-4 bg-red-500/20 rounded-lg border border-red-500/50">
                        <h3 class="text-sm font-medium text-red-300 mb-2">Perbaiki kesalahan berikut:</h3>
                        <ul class="text-sm text-red-200 space-y-1">
                            @error('gambar')
                                <li>{{ $message }}</li>
                            @enderror
                            @error('stock')
                                <li>Stok harus lebih besar dari 0</li>
                            @enderror
                            @error('nama_barang')
                                <li>Nama barang wajib diisi</li>
                            @enderror
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <script>
        // File upload name display
        document.getElementById('gambar').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Belum ada file yang dipilih';
            document.getElementById('file-name-display').textContent = fileName;
        });
    </script>

</body>
</html>