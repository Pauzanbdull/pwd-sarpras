<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Peminjaman - SARPAS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    @keyframes fade-in-up { 0% {opacity:0;transform:translateY(20px);} 100% {opacity:1;transform:translateY(0);} }
    .animate-fade-in-up { animation: fade-in-up .8s ease-out both; }
    .nav-link{position:relative}
    .nav-link:after{content:'';position:absolute;width:0;height:2px;bottom:0;left:0;background:#fff;transition:width .3s}
    .nav-link:hover:after,.nav-link.active:after{width:100%}
    body{font-family:'Poppins',sans-serif}
    .table-container{backdrop-filter:blur(8px)}
    .table-row:hover{background:rgba(0,109,109,.5)}
    .status-pending{background:rgba(234,179,8,.2);color:#eab308}
    .status-approved{background:rgba(34,197,94,.2);color:#22c55e}
    .status-rejected{background:rgba(239,68,68,.2);color:#ef4444}
  </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#005f73] to-[#0a9396] text-white relative overflow-x-hidden">
  {{-- Background & dekorasi --}}
  <div class="absolute inset-0 z-0 opacity-5" style="background-image:radial-gradient(circle at 1px 1px,rgba(255,255,255,.3) 1px,transparent 0);background-size:40px 40px;"></div>
  <div class="absolute w-64 h-64 bg-[#048a8a] rounded-full opacity-10 -bottom-32 -left-32 blur-3xl z-0"></div>
  <div class="absolute w-80 h-80 bg-[#027f84] rounded-full opacity-10 -bottom-40 -right-40 blur-3xl z-0"></div>
  <div class="absolute w-48 h-48 bg-[#04a5a5] rounded-full opacity-15 -top-24 -right-24 blur-2xl z-0"></div>

  {{-- NAVBAR --}}
  <nav class="bg-[#004d4d]/90 backdrop-blur-md px-6 lg:px-12 py-4 shadow-xl z-10 flex flex-col md:flex-row justify-between items-center border-b border-white/10">
    <h1 class="text-3xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white to-cyan-100">SARPAS</h1>

    <div class="flex items-center space-x-1 md:space-x-6">
      <div class="hidden md:flex items-center space-x-4">
        <a href="{{ route('dashboard') }}"   class="nav-link px-3 py-2 text-sm font-medium">Dashboard</a>
        <a href="{{ route('pengguna') }}"    class="nav-link px-3 py-2 text-sm font-medium">Pengguna</a>
        <a href="{{ route('pendataan') }}"   class="nav-link active px-3 py-2 text-sm font-medium bg-[#027c7c]/50 rounded-lg">Pendataan</a>
        <a href="{{ route('laporan') }}"     class="nav-link px-3 py-2 text-sm font-medium">Laporan</a>
      </div>

      <div class="flex items-center space-x-4 ml-4">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="flex items-center space-x-2 px-5 py-2.5 bg-[#027c7c] hover:bg-[#03a9a9] rounded-full transition-all duration-200 group shadow-lg hover:shadow-xl">
            <span>Logout</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-0.5 transition-transform" viewBox="0 0 24 24" stroke="currentColor" fill="none">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
          </button>
        </form>

        {{-- Profil admin --}}
        <div class="relative group flex items-center">
          <img src="{{ asset('assets/ojan.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400 shadow-md">
          <span class="absolute -bottom-1 -right-1 bg-yellow-500 text-xs px-2 py-0.5 rounded-full font-medium shadow">ADMIN</span>
        </div>
      </div>
    </div>
  </nav>

  {{-- CONTENT --}}
  <main class="relative z-10 px-6 py-8 md:px-12 md:py-10 max-w-7xl mx-auto">

    {{-- Flash sukses --}}
    @if (session('success'))
      <div class="mb-6 px-6 py-3 rounded-lg bg-green-600/80 shadow-lg animate-fade-in-up">
        {{ session('success') }}
      </div>
    @endif

    <div class="flex justify-between items-center mb-8 animate-fade-in-up">
      <div>
        <h2 class="text-3xl font-bold mb-2">Data Peminjaman</h2>
        <p class="text-white/80">Kelola semua data peminjaman barang</p>
      </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
      <a href="{{ route('pendataan') }}" class="flex items-center space-x-2 text-white bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
        </svg>
        <span>Kembali ke Pendataan</span>
      </a>

      <a href="{{ route('peminjaman.create') }}" class="flex items-center space-x-2 text-white bg-gradient-to-r from-[#005f73] to-[#0a9396] hover:from-[#0a9396] hover:to-[#005f73] px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-110 font-medium">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
        </svg>
        <span>Ajukan Peminjaman</span>
      </a>
    </div>

    {{-- Tabel --}}
    <div class="table-container animate-fade-in-up bg-[#006d6d]/70 rounded-xl shadow-lg border border-[#1fa5a5]/50 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-[#004d4d]/80">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">No</th>
              <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Nama Peminjam</th>
              <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Barang</th>
              <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Tanggal Pinjam</th>
              <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Tanggal Kembali</th>
              <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Status</th>
              <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($peminjamans as $index => $peminjaman)
              <tr class="table-row border-b border-white/10">
                <td class="px-6 py-4">{{ $index + 1 }}</td>
                <td class="px-6 py-4">{{ $peminjaman->user->name ?? 'proyektor' }}</td>
                <td class="px-6 py-4">{{ $peminjaman->barang->nama ?? 'proyektor' }}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') }}</td>
                <td class="px-6 py-4">
                  <span class="px-3 py-1 rounded-full text-sm font-semibold
                    {{ $peminjaman->status == 'pending' ? 'status-pending'
                       : ($peminjaman->status == 'approved' ? 'status-approved' : 'status-rejected') }}">
                    {{ ucfirst($peminjaman->status) }}
                  </span>
                </td>
                {{-- Tombol aksi --}}
                <td class="px-6 py-4">
                  @if ($peminjaman->status === 'pending')
                    <div class="flex space-x-2">
                      <!-- Terima -->
                      <form action="{{ route('peminjaman.approve', $peminjaman->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="px-4 py-1.5 rounded-full text-xs font-semibold bg-green-600/80 hover:bg-green-600 transition shadow hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-300">
                          Terima
                        </button>
                      </form>
                      <!-- Tolak -->
                      <form action="{{ route('peminjaman.reject', $peminjaman->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="px-4 py-1.5 rounded-full text-xs font-semibold bg-red-600/80 hover:bg-red-600 transition shadow hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-300">
                          Tolak
                        </button>
                      </form>
                    </div>
                  @else
                    <span class="italic text-white/80">—</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="px-6 py-4 text-center text-white/70">Tidak ada data peminjaman.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </main>
</body>
</html>
