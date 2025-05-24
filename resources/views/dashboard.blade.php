<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - SARPRAS</title>
  <!-- Preload resources -->
  <link rel="preload" href="https://cdn.tailwindcss.com" as="script">
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" as="style">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  
  <!-- Load CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    /* Enhanced animations with will-change */
    @keyframes fade-in-up {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulsate-glow {
      0%, 100% { text-shadow: 0 0 8px rgba(128, 255, 234, 0.8), 0 0 2px rgba(255, 255, 255, 0.8); }
      50% { text-shadow: 0 0 16px rgba(128, 255, 234, 1), 0 0 4px rgba(255, 255, 255, 1); }
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    .animate-fade-in-up {
      animation: fade-in-up 0.8s ease-out both;
      will-change: opacity, transform;
    }

    .animate-delay-1 { animation-delay: 0.2s; }
    .animate-delay-2 { animation-delay: 0.4s; }
    .animate-delay-3 { animation-delay: 0.6s; }

    /* Enhanced hover effects */
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
      background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 50%, rgba(255,255,255,0) 100%);
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

    .animate-pulsate-glow {
      animation: pulsate-glow 2s ease-in-out infinite, float 4s ease-in-out infinite;
      will-change: text-shadow, transform;
    }

    /* Enhanced card design */
    .welcome-card {
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      background: rgba(0, 109, 109, 0.35);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      will-change: transform, box-shadow;
      box-shadow: 0 8px 32px rgba(0, 60, 60, 0.3);
      border: 1px solid rgba(31, 165, 165, 0.3);
    }

    .welcome-card:hover {
      transform: translateY(-8px) scale(1.01);
      box-shadow: 0 20px 40px rgba(0, 40, 40, 0.4);
      border-color: rgba(31, 165, 165, 0.6);
      background: rgba(0, 109, 109, 0.45);
    }

    /* Smooth scrolling */
    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
    }

    /* Enhanced decorative elements */
    .decorative-circle {
      position: absolute;
      border-radius: 50%;
      filter: blur(64px);
      opacity: 0.1;
      z-index: 0;
      animation: float 8s ease-in-out infinite;
    }

    .decorative-circle:nth-child(1) { animation-delay: 0s; }
    .decorative-circle:nth-child(2) { animation-delay: 2s; }
    .decorative-circle:nth-child(3) { animation-delay: 4s; }

    /* Improved notification styling */
    .notification {
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 10px 25px rgba(0, 80, 80, 0.3);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* New feature cards */
    .feature-card {
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      background: rgba(0, 109, 109, 0.3);
      transition: all 0.3s ease;
      border: 1px solid rgba(31, 165, 165, 0.2);
    }

    .feature-card:hover {
      transform: translateY(-5px);
      background: rgba(0, 109, 109, 0.4);
      box-shadow: 0 10px 25px rgba(0, 60, 60, 0.3);
      border-color: rgba(31, 165, 165, 0.4);
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
      .welcome-card {
        padding: 1.5rem;
      }
      
      .welcome-card h2 {
        font-size: 2.5rem;
      }
      
      .feature-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#005f73] to-[#0a9396] text-white relative overflow-x-hidden">

  <!-- Background Pattern - Enhanced -->
  <div class="absolute inset-0 z-0 opacity-10"
    style="background-image: 
           radial-gradient(circle at 25% 25%, rgba(255,255,255,0.2) 0%, transparent 50%),
           radial-gradient(circle at 75% 75%, rgba(255,255,255,0.2) 0%, transparent 50%);
           background-size: 60px 60px;">
  </div>

  <!-- Animated Decorative Elements -->
  <div class="decorative-circle w-64 h-64 bg-[#048a8a] -bottom-32 -left-32"></div>
  <div class="decorative-circle w-80 h-80 bg-[#027f84] -bottom-40 -right-40"></div>
  <div class="decorative-circle w-48 h-48 bg-[#04a5a5] -top-24 -right-24 opacity-15"></div>

  <!-- Enhanced NAVBAR -->
  <header class="bg-[#004d4d]/95 backdrop-blur-lg px-6 lg:px-12 py-4 shadow-2xl z-10 flex flex-col md:flex-row justify-between items-center border-b border-white/10 sticky top-0">
    <div class="flex items-center mb-4 md:mb-0">
      <div class="relative group">
        <img src="{{ asset('assets/logotb.jpg') }}" alt="SARPRAS Logo" class="w-10 h-10 rounded-full object-cover mr-3 shadow-lg transform transition-transform duration-300 group-hover:rotate-12" loading="lazy">
        <span class="absolute inset-0 border-2 border-transparent group-hover:border-cyan-300 rounded-full transition-all duration-300"></span>
      </div>
      <h1 class="text-3xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white to-cyan-100">
        SARPRAS
      </h1>
    </div>
    
    <nav class="flex items-center space-x-1 md:space-x-6">
      <div class="hidden md:flex items-center space-x-4">
        <a href="{{ route('dashboard') }}" class="nav-link active px-4 py-2 text-sm font-medium bg-[#027c7c]/50 rounded-lg hover:bg-[#027c7c]/70 transition-all" aria-current="page">
          <span class="relative z-10">Dashboard</span>
        </a>
        <a href="{{ route('pengguna') }}" class="nav-link px-4 py-2 text-sm font-medium hover:bg-[#027c7c]/20 rounded-lg transition-all">
          <span class="relative z-10">Pengguna</span>
        </a>
        <a href="{{ route('pendataan') }}" class="nav-link px-4 py-2 text-sm font-medium hover:bg-[#027c7c]/20 rounded-lg transition-all">
          <span class="relative z-10">Pendataan</span>
        </a>
        <a href="{{ route('pengguna') }}" class="nav-link px-4 py-2 text-sm font-medium hover:bg-[#027c7c]/20 rounded-lg transition-all">
          <span class="relative z-10">Laporan</span>
        </a>
      </div>
      
      <div class="flex items-center space-x-4 ml-4">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="flex items-center space-x-2 px-5 py-2.5 bg-[#027c7c] hover:bg-[#03a9a9] rounded-full transition-all duration-300 group shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-cyan-300 focus:ring-opacity-50 hover:scale-105">
            <span class="relative z-10">Logout</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
          </button>
        </form>
        
        <div class="relative group">
          <div class="relative flex items-center">
            <img src="{{ asset('assets/ojan.jpg') }}" alt="Admin Profile" class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400 shadow-md transition-transform duration-300 group-hover:scale-110" loading="lazy">
            <span class="absolute -bottom-1 -right-1 bg-yellow-500 text-xs px-2 py-0.5 rounded-full font-medium shadow transform transition-transform duration-300 group-hover:scale-110">ADMIN</span>
          </div>
          <div class="absolute right-0 mt-2 w-48 bg-[#004d4d]/95 backdrop-blur-lg rounded-md shadow-xl z-20 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
        </div>
      </div>
    </nav>
  </header>

  <!-- Enhanced CONTENT -->
  <main class="relative z-10 px-6 py-8 md:px-12 md:py-10 max-w-6xl mx-auto">
    <section class="welcome-card animate-fade-in-up p-8 md:p-12 rounded-2xl text-center mb-12">
      <h2 class="text-4xl md:text-6xl font-extrabold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-teal-200 leading-tight">
        Selamat Datang Di <br><span class="animate-pulsate-glow text-amber-300">SARPRAS</span>
      </h2>
      <p class="text-lg md:text-xl text-white/90 mb-8 max-w-2xl mx-auto leading-relaxed">
        Sistem manajemen sarana dan prasarana terintegrasi untuk pengelolaan yang lebih efisien
      </p>
      <div class="flex justify-center space-x-4 animate-delay-2 animate-fade-in-up">
        <a href="{{ route('pendataan') }}" class="px-6 py-3 bg-[#027c7c] hover:bg-[#03a9a9] rounded-full font-medium shadow-lg transition-all hover:scale-105 hover:shadow-xl">
          Mulai Pendataan
        </a>
      </div>
      <div class="h-1 w-32 bg-gradient-to-r from-transparent via-cyan-300/70 to-transparent mt-12 mx-auto rounded-full"></div>
    </section>

    <!-- New Features Section -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
      <div class="feature-card animate-fade-in-up animate-delay-1 p-6 rounded-xl">
        <div class="w-12 h-12 bg-[#027c7c]/30 rounded-lg flex items-center justify-center mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">Manajemen Pengguna</h3>
        <p class="text-white/80 text-sm">Kelola akses pengguna dengan sistem role-based yang fleksibel.</p>
      </div>
      
      <div class="feature-card animate-fade-in-up animate-delay-2 p-6 rounded-xl">
        <div class="w-12 h-12 bg-[#027c7c]/30 rounded-lg flex items-center justify-center mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">Inventaris Digital</h3>
        <p class="text-white/80 text-sm">Catat dan lacak semua aset dengan sistem katalog digital.</p>
      </div>
      
      <div class="feature-card animate-fade-in-up animate-delay-3 p-6 rounded-xl">
        <div class="w-12 h-12 bg-[#027c7c]/30 rounded-lg flex items-center justify-center mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">Laporan Real-time</h3>
        <p class="text-white/80 text-sm">Hasilkan laporan otomatis dengan visualisasi data interaktif.</p>
      </div>
    </section>

   
  <!-- Enhanced Notification -->
  @if(session('status'))
  <div class="fixed top-6 right-6 z-50 animate-fade-in-up notification bg-green-500/90 px-6 py-3 rounded-lg shadow-lg flex items-center" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
    </svg>
    <span>{{ session('status') }}</span>
    <button class="ml-4 text-white/70 hover:text-white focus:outline-none">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
      </svg>
    </button>
  </div>
  @endif

  <!-- Performance optimizations -->
  <script>
    // Load non-critical resources after page load
    window.addEventListener('load', function() {
      // Preload other pages if needed
      const links = document.querySelectorAll('a[rel="preload"]');
      links.forEach(link => {
        const href = link.getAttribute('href');
        if (href) {
          const prefetchLink = document.createElement('link');
          prefetchLink.rel = 'prefetch';
          prefetchLink.href = href;
          document.head.appendChild(prefetchLink);
        }
      });
      
      // Add interactive effects
      document.querySelectorAll('.feature-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
          const rect = card.getBoundingClientRect();
          const x = e.clientX - rect.left;
          const y = e.clientY - rect.top;
          card.style.setProperty('--mouse-x', `${x}px`);
          card.style.setProperty('--mouse-y', `${y}px`);
        });
      });
    });
  </script>
</body>

</html>