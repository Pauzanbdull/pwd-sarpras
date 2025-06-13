<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Pendataan - SARPAS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Add Font Awesome for more icon options -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @keyframes fade-in-up {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in-up {
      animation: fade-in-up 0.8s ease-out both;
    }

    .animate-delay-1 { animation-delay: 0.2s; }
    .animate-delay-2 { animation-delay: 0.4s; }
    .animate-delay-3 { animation-delay: 0.6s; }

    .stat-card {
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
      backdrop-filter: blur(8px);
    }

    .stat-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .stat-card-icon {
      transition: all 0.3s ease;
    }

    .stat-card:hover .stat-card-icon {
      transform: scale(1.1);
    }

    .nav-link {
      position: relative;
    }

    .nav-link:after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: white;
      transition: width 0.3s ease;
    }

    .nav-link:hover:after {
      width: 100%;
    }

    .nav-link.active:after {
      width: 100%;
    }

    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#005f73] to-[#0a9396] text-white relative overflow-x-hidden">

  <!-- Background Pattern -->
  <div class="absolute inset-0 z-0 opacity-5"
    style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.3) 1px, transparent 0);
           background-size: 40px 40px;">
  </div>

  <!-- Decorative Elements -->
  <div class="absolute w-64 h-64 bg-[#048a8a] rounded-full opacity-10 -bottom-32 -left-32 blur-3xl z-0"></div>
  <div class="absolute w-80 h-80 bg-[#027f84] rounded-full opacity-10 -bottom-40 -right-40 blur-3xl z-0"></div>
  <div class="absolute w-48 h-48 bg-[#04a5a5] rounded-full opacity-15 -top-24 -right-24 blur-2xl z-0"></div>

  <!-- NAVBAR -->
<aside class="w-64 bg-[#004d4d]/95 backdrop-blur-lg border-r border-white/10 fixed inset-y-0 left-0 flex flex-col z-20">
  <div class="flex items-center px-6 py-5 border-b border-white/20">
    <img src="{{ asset('assets/logotb.jpg') }}" alt="SARPRAS Logo" class="w-10 h-10 rounded-full object-cover mr-3 shadow-lg" loading="lazy" />
    <h1 class="text-2xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white to-cyan-100">
      SARPRAS
    </h1>
  </div>

  <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-2">
    <a href="{{ route('dashboard') }}"
      class="nav-link block px-4 py-3 rounded-lg hover:bg-[#027c7c]/20 font-medium transition-all">
      Dashboard
    </a>
     <a href="{{ route('pengguna') }}"
      class="nav-link block px-4 py-3 rounded-lg hover:bg-[#027c7c]/20 font-medium transition-all">
      Pengguna
    </a>
     <a href="{{ route('pendataan') }}"
      class="nav-link active block px-4 py-3 rounded-lg bg-[#027c7c]/50 hover:bg-[#027c7c]/70 font-medium transition-all">
      Pendataan
    </a>
    <a href="{{ route('laporan') }}"
      class="nav-link block px-4 py-3 rounded-lg hover:bg-[#027c7c]/20 font-medium transition-all">
      Laporan
    </a>
  </nav>

  <div class="px-6 py-4 border-t border-white/20">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit"
        class="w-full flex items-center justify-center space-x-2 px-5 py-2.5 bg-[#027c7c] hover:bg-[#03a9a9] rounded-full transition duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-cyan-300 focus:ring-opacity-50 hover:scale-105">
        <span>Logout</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
          aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
        </svg>
      </button>
    </form>
  </div>
</aside>
        
        <!-- Main Content Area -->
  <div class="ml-64">
    <nav class="bg-[#004d4d]/80 backdrop-blur-md border-b border-white/10 px-6 py-3 flex justify-between items-center sticky top-0 z-10">
      <div class="text-lg font-medium">Pendataan</div>
      <div class="relative group flex items-center">
        <img src="{{ asset('assets/ojan.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400 shadow-md transition-transform duration-300 group-hover:scale-110">
        <span class="absolute -bottom-1 -right-1 bg-yellow-500 text-xs px-2 py-0.5 rounded-full font-medium shadow">ADMIN</span>
      </div>
    </nav>


  <!-- CONTENT -->
  <main class="relative z-10 px-6 py-8 md:px-12 md:py-10 max-w-7xl mx-auto">
    <div class="mb-8 animate-fade-in-up">
      <h2 class="text-3xl font-bold mb-2">Pendataan Barang</h2>
      <p class="text-white/80 max-w-2xl">Kelola semua data terkait inventaris barang, peminjaman, dan pengembalian</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
      <!-- Kategori Barang -->
      <a href="{{ route('kategori.index') }}" class="stat-card animate-fade-in-up animate-delay-1 bg-[#006d6d]/70 p-6 rounded-xl shadow-lg border border-[#1fa5a5]/50 hover:border-[#1fa5a5] overflow-hidden relative group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-[#04a5a5]/10 rounded-full transition-all duration-300 group-hover:scale-150"></div>
        <div class="relative z-10 flex items-start">
          <div class="stat-card-icon mr-4 p-3 bg-[#04a5a5]/20 rounded-lg">
            <i class="fas fa-tags text-2xl text-white"></i>
          </div>
          <div>
            <h3 class="text-xl font-semibold mb-2">Kategori Barang</h3>
            <p class="text-sm text-white/80 leading-relaxed">Kelola kategori data barang untuk pengelompokan yang lebih terstruktur</p>
          </div>
        </div>
      </a>

      <!-- Pendataan Barang -->
      <a href="{{ route('barang.index') }}" class="stat-card animate-fade-in-up animate-delay-2 bg-[#006d6d]/70 p-6 rounded-xl shadow-lg border border-[#1fa5a5]/50 hover:border-[#1fa5a5] overflow-hidden relative group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-[#04a5a5]/10 rounded-full transition-all duration-300 group-hover:scale-150"></div>
        <div class="relative z-10 flex items-start">
          <div class="stat-card-icon mr-4 p-3 bg-[#04a5a5]/20 rounded-lg">
            <i class="fas fa-boxes text-2xl text-white"></i>
          </div>
          <div>
            <h3 class="text-xl font-semibold mb-2">Data Barang</h3>
            <p class="text-sm text-white/80 leading-relaxed">Kelola inventaris barang dengan detail lengkap dan terperinci</p>
          </div>
        </div>
      </a>

      <!-- Peminjaman -->
      <a href="{{ route('peminjaman.index') }}" class="stat-card animate-fade-in-up animate-delay-1 bg-[#006d6d]/70 p-6 rounded-xl shadow-lg border border-[#1fa5a5]/50 hover:border-[#1fa5a5] overflow-hidden relative group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-[#04a5a5]/10 rounded-full transition-all duration-300 group-hover:scale-150"></div>
        <div class="relative z-10 flex items-start">
          <div class="stat-card-icon mr-4 p-3 bg-[#04a5a5]/20 rounded-lg">
            <i class="fas fa-hand-holding text-2xl text-white"></i>
          </div>
          <div>
            <h3 class="text-xl font-semibold mb-2">Peminjaman Barang</h3>
            <p class="text-sm text-white/80 leading-relaxed">Kelola proses peminjaman barang dengan pencatatan yang lengkap</p>
          </div>
        </div>
      </a>

      <!-- Pengembalian -->
      <a href="{{ route('pengembalian.index') }}" class="stat-card animate-fade-in-up animate-delay-2 bg-[#006d6d]/70 p-6 rounded-xl shadow-lg border border-[#1fa5a5]/50 hover:border-[#1fa5a5] overflow-hidden relative group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-[#04a5a5]/10 rounded-full transition-all duration-300 group-hover:scale-150"></div>
        <div class="relative z-10 flex items-start">
          <div class="stat-card-icon mr-4 p-3 bg-[#04a5a5]/20 rounded-lg">
            <i class="fas fa-undo-alt text-2xl text-white"></i>
          </div>
          <div>
            <h3 class="text-xl font-semibold mb-2">Pengembalian Barang</h3>
            <p class="text-sm text-white/80 leading-relaxed">Kelola proses pengembalian barang dan status kondisi barang</p>
          </div>
        </div>
      </a>

    </div>
  </main>

</body>

</html>