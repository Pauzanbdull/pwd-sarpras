<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - SARPRAS</title>

  <!-- External Resources -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    /* Base Styles */
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #005f73 0%, #0a9396 100%);
    }

    /* Navigation Styles */
    .nav-link {
      position: relative;
      transition: all 0.3s ease;
    }

    .nav-link::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 0;
      background: white;
      transition: width 0.3s ease;
    }

    .nav-link:hover::after,
    .nav-link.active::after {
      width: 100%;
    }

    .nav-link.active {
      color: white;
    }

    /* Card Styles */
    .card-hover {
      transition: box-shadow 0.3s ease;
    }

    .card-hover:hover {
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
  </style>
</head>

<body class="min-h-screen text-white flex flex-col md:flex-row">
  <!-- ==================== SIDEBAR ==================== -->
  <aside class="w-64 bg-[#004d4d] fixed inset-y-0 left-0 flex flex-col z-20">
    <!-- Logo Section -->
    <div class="flex items-center px-6 py-5 border-b border-white/20">
      <img src="{{ asset('assets/logotb.jpg') }}" alt="Logo SARPRAS" class="w-10 h-10 rounded-full mr-3" />
      <h1 class="text-2xl font-bold text-white">SARPRAS</h1>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-2" aria-label="Sidebar Navigation">
      <a href="{{ route('dashboard') }}" class="nav-link active block px-4 py-3 rounded-lg bg-[#027c7c]/50 hover:bg-[#027c7c]/70 font-medium">
        Dashboard
      </a>
      <a href="{{ route('pengguna') }}" class="nav-link block px-4 py-3 rounded-lg hover:bg-[#027c7c]/20 font-medium">
        Pengguna
      </a>
      <a href="{{ route('pendataan') }}" class="nav-link block px-4 py-3 rounded-lg hover:bg-[#027c7c]/20 font-medium">
        Pendataan
      </a>
      <a href="{{ route('laporan') }}" class="nav-link block px-4 py-3 rounded-lg hover:bg-[#027c7c]/20 font-medium">
        Laporan
      </a>
    </nav>

    <!-- Logout Button -->
    <div class="px-6 py-4 border-t border-white/20">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full flex items-center justify-center space-x-2 px-5 py-2.5 bg-[#027c7c] hover:bg-[#03a9a9] rounded-full transition duration-300">
          <span>Logout</span>
          <i class="fas fa-sign-out-alt"></i>
        </button>
      </form>
    </div>
  </aside>

  <!-- ==================== MAIN CONTENT ==================== -->
  <main class="flex-1 md:ml-64 mt-20 md:mt-0">
    <!-- Top Navigation Bar -->
    <header class="bg-[#004d4d] px-6 py-3 flex justify-between items-center sticky top-0 z-10 border-b border-white/10">
      <h2 class="text-lg font-medium">Dashboard</h2>
      <div class="relative group flex items-center">
        <img src="{{ asset('assets/ojan.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400 shadow-md transition-transform duration-300 group-hover:scale-110">
        <span class="absolute -bottom-1 -right-1 bg-yellow-500 text-xs px-2 py-0.5 rounded-full font-medium shadow">ADMIN</span>
      </div>
    </header> 

    <!-- Statistics Cards Section -->
    <section class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- User Count Card -->
      <div class="card-hover bg-gradient-to-br from-[#00b4d8] to-[#48cae4] p-6 rounded-xl shadow-lg">
        <div class="flex items-center justify-between mb-4">
          <div>
            <h3 class="font-semibold text-lg">Jumlah Pengguna</h3>
            <p class="text-3xl font-bold">{{ $userCount }}</p>
          </div>
          <div class="text-3xl bg-white/20 p-3 rounded-full">
            <i class="fas fa-users"></i>
          </div>
        </div>
        <div class="flex items-center justify-between">
          <p class="text-sm text-white/90">Total pengguna saat ini.</p>
          <a href="{{ route('pengguna') }}" class="text-xs font-medium hover:underline">Lihat semua →</a>
        </div>
      </div>

      <!-- Item Count Card -->
      <div class="card-hover bg-gradient-to-br from-[#90be6d] to-[#43aa8b] p-6 rounded-xl shadow-lg">
        <div class="flex items-center justify-between mb-4">
          <div>
            <h3 class="font-semibold text-lg">Data Barang</h3>
            <p class="text-3xl font-bold">{{ $barangCount }}</p>
          </div>
          <div class="text-3xl bg-white/20 p-3 rounded-full">
            <i class="fas fa-boxes"></i>
          </div>
        </div>
        <div class="flex items-center justify-between">
          <p class="text-sm text-white/90">Jumlah barang terdaftar.</p>
          <a href="{{ route('barang.index') }}" class="text-xs font-medium hover:underline">Lihat semua →</a>
        </div>
      </div>

      <!-- Category Count Card -->
      <div class="card-hover bg-gradient-to-br from-[#7209b7] to-[#b5179e] p-6 rounded-xl shadow-lg">
        <div class="flex items-center justify-between mb-4">
          <div>
            <h3 class="font-semibold text-lg">Kategori</h3>
            <p class="text-3xl font-bold">{{ $kategoriCount }}</p>
          </div>
          <div class="text-3xl bg-white/20 p-3 rounded-full">
            <i class="fas fa-tags"></i>
          </div>
        </div>
        <div class="flex items-center justify-between">
          <p class="text-sm text-white/90">Jumlah kategori barang.</p>
         <a href="{{ route('kategori.index') }}" class="text-xs font-medium hover:underline">Lihat semua →</a>
        </div>
      </div>
    </section>
  </main>
</body>
</html> 