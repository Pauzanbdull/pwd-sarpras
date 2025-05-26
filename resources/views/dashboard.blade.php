<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - SARPRAS</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <style>
    /* Animations */
    @keyframes fade-in-up {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes pulsate-glow {
      0%,
      100% {
        text-shadow: 0 0 8px rgba(128, 255, 234, 0.8), 0 0 2px rgba(255, 255, 255, 0.8);
      }

      50% {
        text-shadow: 0 0 16px rgba(128, 255, 234, 1), 0 0 4px rgba(255, 255, 255, 1);
      }
    }

    @keyframes float {
      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }
    }

    .animate-fade-in-up {
      animation: fade-in-up 0.8s ease-out both;
      will-change: opacity, transform;
    }

    .animate-pulsate-glow {
      animation: pulsate-glow 2s ease-in-out infinite, float 4s ease-in-out infinite;
      will-change: text-shadow, transform;
    }

    .nav-link {
      position: relative;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .nav-link:after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 0;
      background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 50%, rgba(255, 255, 255, 0) 100%);
      transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      will-change: width;
    }

    .nav-link:hover {
      color: rgba(255, 255, 255, 0.95);
      transform: translateY(-1px);
    }

    .nav-link:hover:after {
      width: 100%;
    }

    .nav-link.active {
      color: white;
    }

    .nav-link.active:after {
      width: 100%;
    }

    body {
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
    }

    /* Sidebar scrollbar style */
    ::-webkit-scrollbar {
      width: 6px;
    }

    ::-webkit-scrollbar-thumb {
      background-color: rgba(2, 124, 124, 0.5);
      border-radius: 10px;
    }
  </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#005f73] to-[#0a9396] text-white relative flex">

  <!-- Sidebar -->
  <aside class="w-64 bg-[#004d4d]/95 backdrop-blur-lg border-r border-white/10 fixed inset-y-0 left-0 flex flex-col z-20">
    <div class="flex items-center px-6 py-5 border-b border-white/20">
      <img src="{{ asset('assets/logotb.jpg') }}" alt="SARPRAS Logo" class="w-10 h-10 rounded-full object-cover mr-3 shadow-lg" loading="lazy" />
      <h1 class="text-2xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white to-cyan-100">
        SARPRAS
      </h1>
    </div>

    <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-2">
      <a href="{{ route('dashboard') }}"
        class="nav-link active block px-4 py-3 rounded-lg bg-[#027c7c]/50 hover:bg-[#027c7c]/70 font-medium transition-all">
        Dashboard
      </a>
      <a href="{{ route('pengguna') }}"
        class="nav-link block px-4 py-3 rounded-lg hover:bg-[#027c7c]/20 font-medium transition-all">
        Pengguna
      </a>
      <a href="{{ route('pendataan') }}"
        class="nav-link block px-4 py-3 rounded-lg hover:bg-[#027c7c]/20 font-medium transition-all">
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
  <div class="flex-1 ml-64">
    <nav class="bg-[#004d4d]/80 backdrop-blur-md border-b border-white/10 px-6 py-3 flex justify-between items-center sticky top-0 z-10">
      <div class="text-lg font-medium">Dashboard</div>
      <div class="relative group flex items-center">
        <img src="{{ asset('assets/ojan.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400 shadow-md transition-transform duration-300 group-hover:scale-110">
        <span class="absolute -bottom-1 -right-1 bg-yellow-500 text-xs px-2 py-0.5 rounded-full font-medium shadow">ADMIN</span>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="p-6 md:p-12 max-w-6xl mx-auto relative z-10">
      <section class="welcome-card animate-fade-in-up p-8 md:p-12 rounded-2xl text-center mb-12 bg-[#004d4d]/50 backdrop-blur-md border border-cyan-600 shadow-lg">
        <h2
          class="text-4xl md:text-6xl font-extrabold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-teal-200 leading-tight">
          Selamat Datang Di <br /><span
            class="animate-pulsate-glow text-amber-300">SARPRAS</span>
        </h2>
        <p class="text-lg md:text-xl text-white/90 mb-8 max-w-2xl mx-auto leading-relaxed">
          Sistem manajemen sarana dan prasarana terintegrasi untuk pengelolaan yang lebih efisien
        </p>
        <div class="flex justify-center space-x-4 animate-fade-in-up">
          <a href="{{ route('pendataan') }}"
            class="px-6 py-3 bg-[#027c7c] hover:bg-[#03a9a9] rounded-full font-medium shadow-lg transition-all hover:scale-105 hover:shadow-xl">
            Mulai Pendataan
          </a>
        </div>
        <div class="h-1 w-32 bg-gradient-to-r from-transparent via-cyan-300/70 to-transparent mt-12 mx-auto rounded-full"></div>
      </section>

      <!-- Features Section -->
      <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div
          class="feature-card animate-fade-in-up p-6 rounded-xl bg-[#004d4d]/40 backdrop-blur-md border border-cyan-500 transition hover:bg-[#004d4d]/60 hover:shadow-lg">
          <div
            class="w-12 h-12 bg-[#027c7c]/30 rounded-lg flex items-center justify-center mb-4 text-cyan-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
          </div>
          <a href="{{ route('pengguna') }}" class="block text-lg font-semibold mb-2 hover:underline">Pengguna</a>
          <p class="text-white/80 text-sm">Kelola akses pengguna dengan sistem role-based yang fleksibel.</p>
        </div>

        <div
          class="feature-card animate-fade-in-up p-6 rounded-xl bg-[#004d4d]/40 backdrop-blur-md border border-cyan-500 transition hover:bg-[#004d4d]/60 hover:shadow-lg">
          <div
            class="w-12 h-12 bg-[#027c7c]/30 rounded-lg flex items-center justify-center mb-4 text-cyan-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
          </div>
          <a href="{{ route('laporan') }}" class="block text-lg font-semibold mb-2 hover:underline">Laporan</a>
          <p class="text-white/80 text-sm">Hasilkan laporan otomatis dengan visualisasi data interaktif.</p>
        </div>
      </section>
    </div>
  </div>

</body>

</html>