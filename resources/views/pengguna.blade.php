<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Pengguna - SARPAS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    @keyframes fade-in-up {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.5; }
    }

    .animate-fade-in-up {
      animation: fade-in-up 0.8s ease-out both;
    }

    .animate-pulse {
      animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    .animate-delay-1 { animation-delay: 0.2s; }
    .animate-delay-2 { animation-delay: 0.4s; }

    .user-card {
      transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
      backdrop-filter: blur(8px);
      border-top: 2px solid rgba(255, 255, 255, 0.1);
    }

    .user-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
      border-top-color: #04a5a5;
    }

    .user-card-icon {
      transition: all 0.4s cubic-bezier(0.68, -0.6, 0.32, 1.6);
    }

    .user-card:hover .user-card-icon {
      transform: scale(1.2) rotate(5deg);
    }

    .nav-link {
      position: relative;
      transition: all 0.3s ease;
    }

    .nav-link:after {
      content: '';
      position: absolute;
      width: 0;
      height: 3px;
      bottom: 0;
      left: 0;
      background-color: #04a5a5;
      transition: width 0.4s cubic-bezier(0.65, 0, 0.35, 1);
    }

    .nav-link:hover:after {
      width: 100%;
    }

    .nav-link.active:after {
      width: 100%;
      background-color: white;
    }

    body {
      font-family: 'Poppins', sans-serif;
    }

    .floating-btn {
      box-shadow: 0 8px 25px rgba(0, 180, 216, 0.4);
      transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .floating-btn:hover {
      box-shadow: 0 12px 30px rgba(0, 180, 216, 0.5);
      transform: translateY(-5px) scale(1.05);
    }

    .table-row {
      transition: all 0.25s ease;
    }

    .table-row:hover {
      background: rgba(255, 255, 255, 0.08) !important;
    }

    .role-badge {
      transition: all 0.3s ease;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .role-badge:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .action-btn {
      transition: all 0.2s ease;
    }

    .action-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .glow-effect {
      position: relative;
      overflow: hidden;
    }

    .glow-effect::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
      transition: all 0.6s ease;
    }

    .glow-effect:hover::before {
      left: 100%;
    }
  </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#005f73] to-[#0a9396] text-white relative overflow-x-hidden">

  <!-- Background Pattern -->
  <div class="absolute inset-0 z-0 opacity-10"
    style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.4) 1px, transparent 0);
           background-size: 30px 30px;">
  </div>

  <!-- Decorative Elements -->
  <div class="absolute w-64 h-64 bg-[#048a8a] rounded-full opacity-10 -bottom-32 -left-32 blur-3xl z-0 animate-pulse"></div>
  <div class="absolute w-80 h-80 bg-[#027f84] rounded-full opacity-10 -bottom-40 -right-40 blur-3xl z-0 animate-pulse" style="animation-delay: 0.5s;"></div>
  <div class="absolute w-48 h-48 bg-[#04a5a5] rounded-full opacity-15 -top-24 -right-24 blur-2xl z-0"></div>

  <!-- NAVBAR -->
  <nav class="bg-[#004d4d]/90 backdrop-blur-md px-6 lg:px-12 py-4 shadow-xl z-10 flex flex-col md:flex-row justify-between items-center border-b border-white/10 sticky top-0">
    <div class="flex items-center mb-4 md:mb-0">
      <h1 class="text-3xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white to-cyan-100 glow-effect">
        SARPRAS
      </h1>
    </div>
    
    <div class="flex items-center space-x-1 md:space-x-6">
      <div class="hidden md:flex items-center space-x-4">
        <a href="{{ route('dashboard') }}" class="nav-link px-3 py-2 text-sm font-medium hover:text-white">Dashboard</a>
        <a href="{{ route('pengguna') }}" class="nav-link active px-3 py-2 text-sm font-medium bg-[#027c7c]/50 rounded-lg">Pengguna</a>
        <a href="{{ route('pendataan') }}" class="nav-link px-3 py-2 text-sm font-medium hover:text-white">Pendataan</a>
        <a href="{{ route('laporan') }}" class="nav-link px-3 py-2 text-sm font-medium hover:text-white">Laporan</a>
      </div>
      
      <div class="flex items-center space-x-4 ml-4">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="flex items-center space-x-2 px-5 py-2.5 bg-[#027c7c] hover:bg-[#03a9a9] rounded-full transition-all duration-200 group shadow-lg hover:shadow-xl glow-effect">
            <span>Logout</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
          </button>
        </form>
        
        <div class="relative group flex items-center">
          <img src="{{ asset('assets/ojan.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400 shadow-md transition-transform duration-300 group-hover:scale-110">
          <span class="absolute -bottom-1 -right-1 bg-yellow-500 text-xs px-2 py-0.5 rounded-full font-medium shadow">ADMIN</span>
        </div>
      </div>
    </div>
  </nav>

  <!-- CONTENT -->
  <main class="relative z-10 px-6 py-8 md:px-12 md:py-10 max-w-7xl mx-auto">
    <div class="mb-8 animate-fade-in-up">
      <h2 class="text-3xl font-bold mb-2 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-cyan-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        Manajemen Pengguna
      </h2>
      <div class="w-16 h-1 bg-cyan-400 mb-3 rounded-full"></div>
      <p class="text-white/80 max-w-2xl">Kelola data pengguna sistem termasuk admin dan user biasa dengan hak akses berbeda</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
      <!-- Admin Card -->
      <div class="user-card animate-fade-in-up animate-delay-1 bg-[#006d6d]/70 p-6 rounded-xl shadow-lg border border-[#1fa5a5]/30 hover:border-[#1fa5a5] overflow-hidden relative group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-[#04a5a5]/10 rounded-full transition-all duration-500 group-hover:scale-150"></div>
        <div class="relative z-10 flex items-start">
          <div class="user-card-icon mr-4 p-3 bg-gradient-to-br from-[#04a5a5]/30 to-[#04a5a5]/10 rounded-lg shadow-inner">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </div>
          <div>
            <h3 class="text-xl font-semibold mb-2 flex items-center">
              Admin
              <span class="ml-2 text-xs px-2 py-0.5 bg-yellow-500/20 text-yellow-300 rounded-full">Full Access</span>
            </h3>
            <p class="text-3xl font-bold text-white mb-1">{{ $adminCount }}</p>
            <p class="text-sm text-white/80 leading-relaxed">Pengguna dengan akses penuh ke seluruh fitur sistem</p>
          </div>
        </div>
      </div>

      <!-- User Card -->
      <div class="user-card animate-fade-in-up animate-delay-2 bg-[#006d6d]/70 p-6 rounded-xl shadow-lg border border-[#1fa5a5]/30 hover:border-[#1fa5a5] overflow-hidden relative group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-[#04a5a5]/10 rounded-full transition-all duration-500 group-hover:scale-150"></div>
        <div class="relative z-10 flex items-start">
          <div class="user-card-icon mr-4 p-3 bg-gradient-to-br from-[#04a5a5]/30 to-[#04a5a5]/10 rounded-lg shadow-inner">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-cyan-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
          </div>
          <div>
            <h3 class="text-xl font-semibold mb-2 flex items-center">
              User
              <span class="ml-2 text-xs px-2 py-0.5 bg-cyan-500/20 text-cyan-300 rounded-full">Limited</span>
            </h3>
            <p class="text-3xl font-bold text-white mb-1">{{ $userCount }}</p>
            <p class="text-sm text-white/80 leading-relaxed">Pengguna dengan akses terbatas sesuai kebutuhan</p>
          </div>
        </div>
      </div>

      <!-- Stats Card -->
      <div class="user-card animate-fade-in-up bg-[#006d6d]/70 p-6 rounded-xl shadow-lg border border-[#1fa5a5]/30 hover:border-[#1fa5a5] overflow-hidden relative group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-[#04a5a5]/10 rounded-full transition-all duration-500 group-hover:scale-150"></div>
        <div class="relative z-10 flex items-start">
          <div class="user-card-icon mr-4 p-3 bg-gradient-to-br from-[#04a5a5]/30 to-[#04a5a5]/10 rounded-lg shadow-inner">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
          </div>
          <div>
            <h3 class="text-xl font-semibold mb-2">Total Pengguna</h3>
            <p class="text-3xl font-bold text-white mb-1">{{ $adminCount + $userCount }}</p>
            <p class="text-sm text-white/80 leading-relaxed">Jumlah total pengguna terdaftar dalam sistem</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Tabel Daftar Pengguna -->
    <div class="mt-6 bg-white/10 backdrop-blur-lg rounded-xl shadow-xl overflow-hidden animate-fade-in-up border border-white/10">
      <div class="px-6 py-4 border-b border-white/10 flex justify-between items-center">
        <h3 class="text-lg font-semibold flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-cyan-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
          Daftar Pengguna
        </h3>
        <div class="relative">
          <input type="text" placeholder="Cari pengguna..." class="bg-white/10 border border-white/20 rounded-full py-2 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent placeholder-white/50">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute right-3 top-3 text-white/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </div>
      </div>
      
      <div class="overflow-x-auto">
        <table class="min-w-full table-auto text-left text-white text-sm">
          <thead class="bg-[#006666]/80">
            <tr>
              <th class="px-6 py-4 font-semibold">No</th>
              <th class="px-6 py-4 font-semibold">Nama</th>
              <th class="px-6 py-4 font-semibold">Email</th>
              <th class="px-6 py-4 font-semibold">Role</th>
              <th class="px-6 py-4 font-semibold text-right">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-white/10">
            @foreach($users as $index => $user)
            <tr class="table-row">
              <td class="px-6 py-4 font-medium">{{ $index + 1 }}</td>
              <td class="px-6 py-4 font-medium flex items-center">
                <div class="w-8 h-8 rounded-full bg-cyan-500/20 flex items-center justify-center mr-3">
                  <span class="text-xs font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                </div>
                {{ $user->name }}
              </td>
              <td class="px-6 py-4">{{ $user->email }}</td>
              <td class="px-6 py-4">
                <span class="role-badge px-3 py-1 rounded-full text-xs font-semibold inline-flex items-center 
                           {{ $user->role == 'admin' ? 'bg-yellow-500/20 text-yellow-300' : 'bg-cyan-500/20 text-cyan-300' }}">
                  {{ ucfirst($user->role) }}
                  @if($user->role == 'admin')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                  @endif
                </span>
              </td>
              <td class="px-6 py-4 space-x-2 text-right">
                <a href="{{ route('pengguna.edit', $user->id) }}" class="action-btn px-3 py-1.5 bg-blue-500/90 hover:bg-blue-600 rounded-full text-white text-xs font-medium inline-flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                  Edit
                </a>
                <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Yakin ingin menghapus pengguna ini?')" class="action-btn px-3 py-1.5 bg-red-500/90 hover:bg-red-600 rounded-full text-white text-xs font-medium inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Hapus
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
      <div class="px-6 py-4 border-t border-white/10 flex items-center justify-between">
        <div class="text-sm text-white/70">
          Menampilkan {{ $users->count() }} dari {{ $adminCount + $userCount }} pengguna
        </div>
        <div class="flex space-x-2">
          <button class="px-3 py-1 rounded-md bg-white/10 hover:bg-white/20 text-sm">Sebelumnya</button>
          <button class="px-3 py-1 rounded-md bg-cyan-500 text-white text-sm">1</button>
          <button class="px-3 py-1 rounded-md bg-white/10 hover:bg-white/20 text-sm">2</button>
          <button class="px-3 py-1 rounded-md bg-white/10 hover:bg-white/20 text-sm">Berikutnya</button>
        </div>
      </div>
    </div>

    <!-- Tambah User Floating Button -->
    <a href="{{ route('register.user') }}" 
       class="floating-btn fixed bottom-8 right-8 flex items-center justify-center w-14 h-14 md:w-auto md:h-auto md:px-5 md:py-3 bg-gradient-to-r from-[#66aaff] to-[#00bcd4] text-white font-semibold rounded-full shadow-lg z-50 glow-effect">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-5 md:w-5" viewBox="0 0 24 24" stroke="currentColor" fill="none">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      <span class="hidden md:inline ml-2">Tambah User</span>
    </a>
  </main>

</body>

</html>