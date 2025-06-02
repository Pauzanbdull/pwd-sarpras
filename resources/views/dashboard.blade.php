<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - SARPRAS</title>

  <!-- Preload critical resources -->
  <link rel="preload" href="https://cdn.tailwindcss.com" as="script">
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" as="style">
  <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">

  <!-- CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    :root {
      --primary-dark: #004d4d;
      --primary: #027c7c;
      --primary-light: #03a9a9;
      --accent-blue: #00b4d8;
      --accent-green: #90be6d;
      --accent-red: #f94144;
      --accent-purple: #7209b7;
    }

    body {
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
      background: linear-gradient(135deg, #005f73 0%, #0a9396 100%);
    }

    /* Animation Keyframes */
    @keyframes fade-in-up {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulsate-glow {
      0%, 100% { text-shadow: 0 0 8px rgba(128, 255, 234, 0.8), 0 0 2px rgba(255, 255, 255, 0.8); }
      50% { text-shadow: 0 0 16px rgba(128, 255, 234, 1), 0 0 4px rgba(255, 255, 255, 1); }
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    @keyframes gradient-shift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Utility Classes */
    .animate-fade-in-up {
      animation: fade-in-up 0.8s ease-out forwards;
    }

    .animate-pulsate-glow {
      animation: pulsate-glow 2s ease-in-out infinite, float 4s ease-in-out infinite;
    }

    .animate-gradient-shift {
      animation: gradient-shift 8s ease infinite;
      background-size: 200% 200%;
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
      background: linear-gradient(90deg, transparent 0%, white 50%, transparent 100%);
      transition: width 0.4s ease;
    }

    .nav-link:hover {
      color: rgba(255, 255, 255, 0.95);
      transform: translateY(-1px);
    }

    .nav-link:hover::after,
    .nav-link.active::after {
      width: 100%;
    }

    .nav-link.active {
      color: white;
    }

    /* Scrollbar */
    ::-webkit-scrollbar {
      width: 6px;
    }

    ::-webkit-scrollbar-thumb {
      background-color: rgba(2, 124, 124, 0.5);
      border-radius: 10px;
    }

    /* Card Effects */
    .card-hover {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .stats-card {
      position: relative;
      overflow: hidden;
    }

    .stats-card::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
      transform: rotate(45deg);
      transition: transform 0.6s ease;
    }

    .stats-card:hover::before {
      transform: translate(30%, 30%) rotate(45deg);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
      aside {
        width: 100%;
        position: relative;
        margin-left: 0;
      }
      
      .main-content {
        margin-left: 0;
      }
    }
  </style>
</head>

<body class="min-h-screen text-white relative flex flex-col md:flex-row">

  <!-- NAVBAR -->
  <aside class="w-64 bg-[#004d4d]/95 backdrop-blur-lg border-r border-white/10 fixed inset-y-0 left-0 flex flex-col z-20">
    <div class="flex items-center px-6 py-5 border-b border-white/20">
      <img src="{{ asset('assets/logotb.jpg') }}" alt="SARPRAS Logo" 
           class="w-10 h-10 rounded-full object-cover mr-3 shadow-lg" 
           loading="lazy" width="40" height="40" />
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
                class="w-full flex items-center justify-center space-x-2 px-5 py-2.5 bg-gradient-to-r from-[#027c7c] to-[#03a9a9] hover:from-[#03a9a9] hover:to-[#027c7c] rounded-full transition duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-cyan-300 focus:ring-opacity-50 hover:scale-105">
          <span>Logout</span>
          <i class="fas fa-sign-out-alt"></i>
        </button>
      </form>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 md:ml-64">

    <!-- Top Nav -->
    <header class="bg-[#004d4d]/80 backdrop-blur-md border-b border-white/10 px-6 py-3 flex justify-between items-center sticky top-0 z-10 shadow-sm">
      <h2 class="text-lg font-medium">Dashboard</h2>
      <div class="relative group flex items-center">
        <img src="{{ asset('assets/ojan.jpg') }}" alt="Profile" 
             class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400 shadow-md transition-transform duration-300 group-hover:scale-110"
             width="40" height="40" loading="lazy">
        <span class="absolute -bottom-1 -right-1 bg-yellow-500 text-xs px-2 py-0.5 rounded-full font-medium shadow">ADMIN</span>
      </div>
    </header>

    <!-- Stats Cards -->
    <section class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <!-- User Count Card -->
      <article class="stats-card card-hover bg-gradient-to-br from-[#00b4d8] to-[#48cae4] p-6 rounded-xl shadow-xl relative flex flex-col justify-between animate-fade-in-up">
        <div class="flex items-center justify-between mb-4">
          <div>
            <h3 class="text-white font-semibold text-lg">Jumlah Pengguna</h3>
            <p class="text-3xl font-bold text-white">{{ $userCount }}</p>
          </div>
          <div class="text-white text-4xl hover:scale-110 transition-transform duration-300">
            <i class="fas fa-users" aria-hidden="true"></i>
          </div>
        </div>
        <p class="text-white/90 text-sm">Total pengguna saat ini.</p>
      </article>

      <!-- Item Count Card -->
      <article class="stats-card card-hover bg-gradient-to-br from-[#90be6d] to-[#43aa8b] p-6 rounded-xl shadow-xl relative flex flex-col justify-between animate-fade-in-up" style="animation-delay: 0.1s;">
        <div class="flex items-center justify-between mb-4">
          <div>
            <h3 class="text-white font-semibold text-lg">Data Barang</h3>
            <p class="text-3xl font-bold text-white">{{ $barangCount }}</p>
          </div>
          <div class="text-white text-4xl hover:scale-110 transition-transform duration-300">
            <i class="fas fa-boxes" aria-hidden="true"></i>
          </div>
        </div>
        <p class="text-white/90 text-sm">Jumlah barang terdaftar saat ini.</p>
      </article>

      <!-- Reports Card -->
      <article class="stats-card card-hover bg-gradient-to-br from-[#f94144] to-[#f3722c] p-6 rounded-xl shadow-xl relative flex flex-col justify-between animate-fade-in-up" style="animation-delay: 0.2s;">
        <div class="flex items-center justify-between mb-4">
          <div>
            <h3 class="text-white font-semibold text-lg">Laporan Baru</h3>
            <p class="text-3xl font-bold text-white">0</p>
          </div>
          <div class="text-white text-4xl hover:scale-110 transition-transform duration-300">
            <i class="fas fa-file-alt" aria-hidden="true"></i>
          </div>
        </div>
        <p class="text-white/90 text-sm">Laporan yang masuk minggu ini.</p>
      </article>

      <!-- Categories Card -->
      <article class="stats-card card-hover bg-gradient-to-br from-[#7209b7] to-[#b5179e] p-6 rounded-xl shadow-xl relative flex flex-col justify-between animate-fade-in-up" style="animation-delay: 0.3s;">
        <div class="flex items-center justify-between mb-4">
          <div>
            <h3 class="text-white font-semibold text-lg">Kategori</h3>
            <p class="text-3xl font-bold text-white">{{ $kategoriCount }}</p>
          </div>
          <div class="text-white text-4xl hover:scale-110 transition-transform duration-300">
            <i class="fas fa-tags" aria-hidden="true"></i>
          </div>
        </div>
        <p class="text-white/90 text-sm">Jumlah kategori barang.</p>
      </article>
    </section>
  </main>

  <!-- Performance Optimization -->
  <script>
    // Load non-critical resources after page load
    window.addEventListener('load', function() {
      // Load any additional scripts here
    });

    // Add any interactive functionality here
    document.addEventListener('DOMContentLoaded', function() {
      // Animation triggers
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('animate-fade-in-up');
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.1 });

      document.querySelectorAll('.stats-card').forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        observer.observe(card);
      });
    });
  </script>
</body>

</html>