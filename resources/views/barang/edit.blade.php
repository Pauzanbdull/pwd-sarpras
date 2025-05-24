<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Barang - SARPAS</title>
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
        .input-highlight {
            transition: all 0.3s ease;
            box-shadow: 0 0 0 0px rgba(234, 179, 8, 0);
        }
        .input-highlight:focus {
            box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.3);
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
        .image-preview {
            transition: all 0.3s ease;
        }
        .image-preview:hover {
            transform: scale(1.05);
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
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold">Edit Data Barang</h1>
                <p class="text-[#a3e0e0] mt-1">Perbarui informasi barang inventaris</p>
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
                    <img src="{{ asset('assets/ojan.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400">
                </div>
            </div>
        </header>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-600/20 border border-green-600/30 rounded-lg flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Form Section -->
        <div class="card-glass bg-[#001219]/80 p-8 rounded-2xl shadow-xl border border-[#005f73]">
            <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Barang -->
                <div class="space-y-2">
                    <label for="nama_barang" class="block text-sm font-medium">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" 
                        value="{{ old('nama_barang', $barang->nama_barang) }}"
                        class="input-highlight w-full px-4 py-3 rounded-lg bg-[#003845] border border-[#005f73] focus:border-yellow-500 focus:outline-none" required>
                </div>

                <!-- Deskripsi -->
                <div class="space-y-2">
                    <label for="deskripsi" class="block text-sm font-medium">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                        class="input-highlight w-full px-4 py-3 rounded-lg bg-[#003845] border border-[#005f73] focus:border-yellow-500 focus:outline-none" required>{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                </div>

                <!-- Grid Layout for Stock and Kategori -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Stock -->
                    <div class="space-y-2">
                        <label for="stock" class="block text-sm font-medium">Stock</label>
                        <input type="number" name="stock" id="stock" 
                            value="{{ old('stock', $barang->stock) }}"
                            class="input-highlight w-full px-4 py-3 rounded-lg bg-[#003845] border border-[#005f73] focus:border-yellow-500 focus:outline-none" required>
                    </div>

                    <!-- Kategori -->
                    <div class="space-y-2">
                        <label for="kategori_id" class="block text-sm font-medium">Kategori</label>
                        <select name="kategori_id" id="kategori_id"
                            class="input-highlight w-full px-4 py-3 rounded-lg bg-[#003845] border border-[#005f73] focus:border-yellow-500 focus:outline-none">
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Gambar -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium">Gambar Barang</label>
                    <div class="file-upload w-full">
                        <label for="gambar" class="cursor-pointer">
                            <div class="input-highlight w-full px-4 py-8 rounded-lg bg-[#003845] border-2 border-dashed border-[#005f73] flex flex-col items-center justify-center hover:border-yellow-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm">Klik untuk mengunggah gambar baru</span>
                                @if ($barang->gambar)
                                    <span class="text-xs text-gray-300 mt-2">Gambar saat ini: {{ basename($barang->gambar) }}</span>
                                @endif
                            </div>
                        </label>
                        <input type="file" name="gambar" id="gambar" class="file-upload-input">
                    </div>
                    @if ($barang->gambar)
                        <div class="mt-4 flex justify-center">
                            <img src="{{ asset('storage/' . $barang->gambar) }}" 
                                class="image-preview w-40 h-40 object-cover rounded-lg shadow-lg border border-[#005f73]">
                        </div>
                    @endif
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
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>