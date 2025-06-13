<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Barang - SARPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #005f73 0%, #0a9396 100%);
        }
        .card-glass {
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(0, 40, 51, 0.8);
            border: 1px solid rgba(0, 95, 115, 0.5);
        }
        .input-highlight {
            transition: all 0.3s ease;
            box-shadow: 0 0 0 0 rgba(234, 179, 8, 0);
        }
        .input-highlight:focus {
            box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.3);
            border-color: rgba(234, 179, 8, 0.5);
        }
        .file-upload {
            position: relative;
            overflow: hidden;
            border-radius: 0.5rem;
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
        }
        .image-preview {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .image-preview:hover {
            transform: scale(1.05);
        }
        .nav-pill {
            position: relative;
            transition: all 0.3s ease;
        }
        .nav-pill::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background: #fbbf24;
            transition: width 0.3s ease;
        }
        .nav-pill:hover::after {
            width: 100%;
        }
        .bg-dots {
            background-image: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
</head>

<body class="min-h-screen text-white">

    <!-- Background -->
    <div class="fixed inset-0 overflow-hidden z-0 bg-dots">
        <div class="absolute top-0 left-0 w-full h-full opacity-10"
             style="background-image: radial-gradient(circle at 10% 20%, rgba(255,255,255,0.8) 0%, transparent 20%);"></div>
        <div class="absolute bottom-0 right-0 w-1/3 h-1/3 opacity-10"
             style="background-image: radial-gradient(circle at 90% 80%, rgba(255,255,255,0.8) 0%, transparent 30%);"></div>
    </div>

    <!-- Main Container -->
    <div class="ml-64 p-8 relative z-10">
        <!-- Header -->
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold flex items-center">
                    <i class="fas fa-edit text-yellow-300 mr-3"></i>
                    <span>Edit Data Barang</span>
                </h1>
                <p class="text-[#a3e0e0] mt-1">Perbarui informasi barang inventaris</p>
            </div>
            <div class="flex items-center space-x-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="flex items-center space-x-2 px-5 py-2.5 bg-[#027c7c] hover:bg-[#03a9a9] rounded-full transition-all duration-200 group shadow-lg hover:shadow-xl">
                        <span>Logout</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
                <div class="relative group">
                    <img src="{{ asset('assets/ojan.jpg') }}" alt="Profile"
                         class="w-12 h-12 rounded-full object-cover border-2 border-yellow-400 shadow-md">
                    <span class="absolute -bottom-1 -right-1 bg-yellow-500 text-xs px-2 py-0.5 rounded-full font-medium">ADMIN</span>
                </div>
            </div>
        </header>

        <!-- Flash Message -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-600/20 border border-green-600/30 rounded-lg flex items-center space-x-3 animate-fade-in">
                <i class="fas fa-check-circle text-green-400 text-xl"></i>
                <span>{{ session('success') }}</span>
                <button class="ml-auto text-green-300 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <!-- Form -->
        <div class="card-glass rounded-2xl shadow-2xl overflow-hidden">
            <div class="p-1 bg-gradient-to-r from-[#005f73] to-[#0a9396]"></div>
            <div class="p-8">
                <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama Barang -->
                    <div class="space-y-2">
                        <label for="nama_barang" class="block text-sm font-medium flex items-center">
                            <i class="fas fa-tag text-yellow-300 mr-2 text-sm"></i> Nama Barang
                        </label>
                        <input type="text" name="nama_barang" id="nama_barang" required
                               value="{{ old('nama_barang', $barang->nama_barang) }}"
                               placeholder="Masukkan nama barang"
                               class="input-highlight w-full px-4 py-3 rounded-lg bg-[#003845] border border-[#005f73] focus:outline-none placeholder-[#a3e0e0]/50">
                    </div>

                    <!-- Deskripsi -->
                    <div class="space-y-2">
                        <label for="deskripsi" class="block text-sm font-medium flex items-center">
                            <i class="fas fa-align-left text-yellow-300 mr-2 text-sm"></i> Deskripsi
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" required
                                  placeholder="Masukkan deskripsi barang"
                                  class="input-highlight w-full px-4 py-3 rounded-lg bg-[#003845] border border-[#005f73] focus:outline-none placeholder-[#a3e0e0]/50">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                    </div>

                    <!-- Stock & Kategori -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="stock" class="block text-sm font-medium flex items-center">
                                <i class="fas fa-boxes text-yellow-300 mr-2 text-sm"></i> Stock
                            </label>
                            <input type="number" name="stock" id="stock" required
                                   value="{{ old('stock', $barang->stock) }}"
                                   placeholder="Jumlah stock"
                                   class="input-highlight w-full px-4 py-3 rounded-lg bg-[#003845] border border-[#005f73] focus:outline-none placeholder-[#a3e0e0]/50">
                        </div>
                        <div class="space-y-2">
                            <label for="kategori_id" class="block text-sm font-medium flex items-center">
                                <i class="fas fa-tags text-yellow-300 mr-2 text-sm"></i> Kategori
                            </label>
                            <select name="kategori_id" id="kategori_id"
                                    class="input-highlight w-full px-4 py-3 rounded-lg bg-[#003845] border border-[#005f73] focus:outline-none">
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Gambar -->
                    <div class="space-y-4">
                        <label class="block text-sm font-medium flex items-center">
                            <i class="fas fa-image text-yellow-300 mr-2 text-sm"></i> Gambar Barang
                        </label>
                        <div class="file-upload w-full">
                            <label for="gambar" class="cursor-pointer">
                                <div class="input-highlight w-full px-4 py-8 rounded-lg bg-[#003845] border-2 border-dashed border-[#005f73] flex flex-col items-center justify-center hover:border-yellow-500 transition-colors">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-yellow-400 mb-2"></i>
                                    <span class="text-sm text-center">Klik untuk mengunggah gambar baru<br><span class="text-xs opacity-70">(Format: JPG, PNG, maks 2MB)</span></span>
                                    @if ($barang->gambar)
                                        <span class="text-xs text-[#a3e0e0] mt-2">Gambar saat ini: {{ basename($barang->gambar) }}</span>
                                    @endif
                                </div>
                            </label>
                            <input type="file" name="gambar" id="gambar" class="file-upload-input" accept="image/*">
                        </div>
                        @if ($barang->gambar)
                            <div class="mt-4 flex flex-col items-center">
                                <span class="text-sm mb-2 text-[#a3e0e0]">Preview Gambar:</span>
                                <img src="{{ asset('storage/' . $barang->gambar) }}"
                                     class="image-preview w-48 h-48 object-contain rounded-lg border-2 border-[#005f73] bg-[#002733] p-2">
                            </div>
                        @endif
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col-reverse sm:flex-row justify-between items-center gap-4 pt-8">
                        <a href="{{ route('barang.index') }}"
                           class="flex items-center space-x-2 text-yellow-300 hover:text-yellow-200 transition-colors w-full sm:w-auto justify-center px-6 py-3 rounded-lg hover:bg-[#005f73]/30">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali ke Daftar</span>
                        </a>
                        <button type="submit"
                                class="w-full sm:w-auto flex items-center justify-center space-x-2 bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 text-white px-8 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-[1.02]">
                            <i class="fas fa-save"></i>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript: Image preview -->
    <script>
        document.getElementById('gambar').addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const reader = new FileReader();

                reader.onload = function(event) {
                    const existing = document.querySelector('.image-preview-container');
                    if (existing) {
                        existing.querySelector('img').src = event.target.result;
                    } else {
                        const container = document.createElement('div');
                        container.className = 'mt-4 flex flex-col items-center image-preview-container';

                        const label = document.createElement('span');
                        label.className = 'text-sm mb-2 text-[#a3e0e0]';
                        label.textContent = 'Preview Gambar Baru:';

                        const img = document.createElement('img');
                        img.className = 'image-preview w-48 h-48 object-contain rounded-lg border-2 border-[#005f73] bg-[#002733] p-2';
                        img.src = event.target.result;

                        container.appendChild(label);
                        container.appendChild(img);

                        const uploadSection = document.querySelector('.file-upload');
                        uploadSection.parentNode.insertBefore(container, uploadSection.nextSibling);
                    }
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
