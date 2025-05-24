<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Laporan - SARPAS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

    .report-card {
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
      backdrop-filter: blur(8px);
    }

    .report-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .report-card-icon {
      transition: all 0.3s ease;
    }

    .report-card:hover .report-card-icon {
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
  <nav class="bg-[#004d4d]/90 backdrop-blur-md px-6 lg:px-12 py-4 shadow-xl z-10 flex flex-col md:flex-row justify-between items-center border-b border-white/10">
    <div class="flex items-center mb-4 md:mb-0">
      <h1 class="text-3xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white to-cyan-100">
      SARPRAS
      </h1>
    </div>
    
    <div class="flex items-center space-x-1 md:space-x-6">
      <div class="hidden md:flex items-center space-x-4">
        <a href="{{ route('dashboard') }}" class="nav-link px-3 py-2 text-sm font-medium">Dashboard</a>
        <a href="{{ route('pengguna') }}" class="nav-link px-3 py-2 text-sm font-medium">Pengguna</a>
        <a href="{{ route('pendataan') }}" class="nav-link px-3 py-2 text-sm font-medium">Pendataan</a>
        <a href="{{ route('laporan') }}" class="nav-link active px-3 py-2 text-sm font-medium bg-[#027c7c]/50 rounded-lg">Laporan</a>
      </div>
      
      <div class="flex items-center space-x-4 ml-4">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="flex items-center space-x-2 px-5 py-2.5 bg-[#027c7c] hover:bg-[#03a9a9] rounded-full transition-all duration-200 group shadow-lg hover:shadow-xl">
                        <span>Logout</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
        </form>
        
        <div class="relative group flex items-center">
          <img src="{{ asset('assets/ojan.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400 shadow-md">
          <span class="absolute -bottom-1 -right-1 bg-yellow-500 text-xs px-2 py-0.5 rounded-full font-medium shadow">ADMIN</span>
        </div>
      </div>
    </div>
  </nav>

  <!-- CONTENT -->
  <main class="relative z-10 px-6 py-8 md:px-12 md:py-10 max-w-7xl mx-auto">
    <div class="mb-8 animate-fade-in-up">
      <h2 class="text-3xl font-bold mb-2">Laporan Sistem</h2>
      <p class="text-white/80 max-w-2xl">Akses berbagai laporan terkait inventaris, peminjaman, dan pengembalian barang</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
      <!-- Laporan Stok Barang -->
      <a href="{{ route('laporan.index') }}" class="report-card animate-fade-in-up animate-delay-1 bg-[#006d6d]/70 p-6 rounded-xl shadow-lg border border-[#1fa5a5]/50 hover:border-[#1fa5a5] overflow-hidden relative group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-[#04a5a5]/10 rounded-full transition-all duration-300 group-hover:scale-150"></div>
        <div class="relative z-10 flex items-start">
          <div class="report-card-icon mr-4 p-3 bg-[#04a5a5]/20 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
          </div>
          <div>
            <h3 class="text-xl font-semibold mb-2">Laporan Stok Barang</h3>
            <p class="text-sm text-white/80 leading-relaxed">Informasi lengkap tentang jumlah, kondisi, dan status stok barang</p>
          </div>
        </div>
      </a>

      <!-- Laporan Peminjaman -->
      <a href="#" class="report-card animate-fade-in-up animate-delay-2 bg-[#006d6d]/70 p-6 rounded-xl shadow-lg border border-[#1fa5a5]/50 hover:border-[#1fa5a5] overflow-hidden relative group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-[#04a5a5]/10 rounded-full transition-all duration-300 group-hover:scale-150"></div>
        <div class="relative z-10 flex items-start">
          <div class="report-card-icon mr-4 p-3 bg-[#04a5a5]/20 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
            </svg>
          </div>
          <div>
            <h3 class="text-xl font-semibold mb-2">Laporan Peminjaman</h3>
            <p class="text-sm text-white/80 leading-relaxed">Rekapitulasi data peminjaman barang oleh seluruh pengguna</p>
          </div>
        </div>
      </a>

      <!-- Laporan Pengembalian -->
      <a href="#" class="report-card animate-fade-in-up animate-delay-1 bg-[#006d6d]/70 p-6 rounded-xl shadow-lg border border-[#1fa5a5]/50 hover:border-[#1fa5a5] overflow-hidden relative group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-[#04a5a5]/10 rounded-full transition-all duration-300 group-hover:scale-150"></div>
        <div class="relative z-10 flex items-start">
          <div class="report-card-icon mr-4 p-3 bg-[#04a5a5]/20 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
            </svg>
          </div>
          <div>
            <h3 class="text-xl font-semibold mb-2">Laporan Pengembalian</h3>
            <p class="text-sm text-white/80 leading-relaxed">Data lengkap pengembalian barang beserta status kondisinya</p>
          </div>
        </div>
      </a>

      <!-- Laporan Riwayat -->
      <a href="#" class="report-card animate-fade-in-up animate-delay-2 bg-[#006d6d]/70 p-6 rounded-xl shadow-lg border border-[#1fa5a5]/50 hover:border-[#1fa5a5] overflow-hidden relative group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-[#04a5a5]/10 rounded-full transition-all duration-300 group-hover:scale-150"></div>
        <div class="relative z-10 flex items-start">
          <div class="report-card-icon mr-4 p-3 bg-[#04a5a5]/20 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
          </div>
          <div>
            <h3 class="text-xl font-semibold mb-2">Laporan Riwayat</h3>
            <p class="text-sm text-white/80 leading-relaxed">Histori lengkap semua transaksi yang pernah dilakukan</p>
          </div>
        </div>
      </a>
    </div>
  </main>

</body>

</html>