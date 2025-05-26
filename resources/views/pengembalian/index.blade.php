<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>Pengembalian - SARPAS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <style>
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

    .animate-fade-in-up {
      animation: fade-in-up 0.8s ease-out both;
    }

    .nav-link {
      position: relative;
    }

    .nav-link:after {
      content: "";
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 0;
      background: #fff;
      transition: width 0.3s;
    }

    .nav-link:hover:after,
    .nav-link.active:after {
      width: 100%;
    }

    body {
      font-family: "Poppins", sans-serif;
    }

    .table-container {
      backdrop-filter: blur(8px);
    }

    .table-row:hover {
      background: rgba(0, 109, 109, 0.5);
    }

    .status-pending {
      background: rgba(234, 179, 8, 0.2);
      color: #eab308;
    }

    .status-approved {
      background: rgba(34, 197, 94, 0.2);
      color: #22c55e;
    }

    .status-rejected {
      background: rgba(239, 68, 68, 0.2);
      color: #ef4444;
    }
  </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#005f73] to-[#0a9396] text-white relative overflow-x-hidden">
  {{-- Background & dekorasi --}}
  <div class="absolute inset-0 z-0 opacity-5"
    style="background-image:radial-gradient(circle at 1px 1px,rgba(255,255,255,.3) 1px,transparent 0);background-size:40px 40px;">
  </div>
  <div class="absolute w-64 h-64 bg-[#048a8a] rounded-full opacity-10 -bottom-32 -left-32 blur-3xl z-0"></div>
  <div class="absolute w-80 h-80 bg-[#027f84] rounded-full opacity-10 -bottom-40 -right-40 blur-3xl z-0"></div>
  <div class="absolute w-48 h-48 bg-[#04a5a5] rounded-full opacity-15 -top-24 -right-24 blur-2xl z-0"></div>

  {{-- NAVBAR --}}
  <nav
    class="bg-[#004d4d]/90 backdrop-blur-md px-6 lg:px-12 py-4 shadow-xl z-10 flex flex-col md:flex-row justify-between items-center border-b border-white/10">
    <h1
      class="text-3xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white to-cyan-100">
      SARPAS</h1>

    <div class="flex items-center space-x-1 md:space-x-6">
      <div class="hidden md:flex items-center space-x-4">
        <a href="{{ route('dashboard') }}" class="nav-link px-3 py-2 text-sm font-medium">Dashboard</a>
        <a href="{{ route('pengguna') }}" class="nav-link px-3 py-2 text-sm font-medium">Pengguna</a>
        <a href="{{ route('pendataan') }}"
          class="nav-link active px-3 py-2 text-sm font-medium bg-[#027c7c]/50 rounded-lg">Pendataan</a>
        <a href="{{ route('laporan') }}" class="nav-link px-3 py-2 text-sm font-medium">Laporan</a>
      </div>

      <div class="flex items-center space-x-4 ml-4">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button
            class="flex items-center space-x-2 px-5 py-2.5 bg-[#027c7c] hover:bg-[#03a9a9] rounded-full transition-all duration-200 group shadow-lg hover:shadow-xl"
            type="submit">
            <span>Logout</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-0.5 transition-transform"
              viewBox="0 0 24 24" stroke="currentColor" fill="none">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
          </button>
        </form>

        {{-- Profil admin --}}
        <div class="relative group flex items-center">
          <img src="{{ asset('assets/ojan.jpg') }}" alt="Profile"
            class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400 shadow-md" />
          <span
            class="absolute -bottom-1 -right-1 bg-yellow-500 text-xs px-2 py-0.5 rounded-full font-medium shadow">ADMIN</span>
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
        <h2 class="text-3xl font-bold mb-2">Data Pengembalian</h2>
        <p class="text-white/80">Kelola semua data pengembalian barang</p>
      </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
      <a href="{{ route('pendataan') }}"
        class="flex items-center space-x-2 text-white bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
            clip-rule="evenodd" />
        </svg>
        <span>Kembali ke Pendataan</span>
      </a>

      <a href="{{ route('pengembalian.create') }}"
        class="flex items-center space-x-2 text-white bg-gradient-to-r from-[#005f73] to-[#0a9396] hover:from-[#0a9396] hover:to-[#005f73] px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-110 font-medium">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
            clip-rule="evenodd" />
        </svg>
        <span>Tambah Pengembalian</span>
      </a>
    </div>

    {{-- Table --}}
    <div
      class="overflow-x-auto rounded-xl border border-[#0a9396]/40 shadow-xl shadow-[#0a9396]/20 animate-fade-in-up table-container bg-[#004c4c]/60">
      <table class="w-full table-auto text-left">
        <thead
          class="text-white/80 bg-[#0a9396]/90 border-b border-[#0a9396]/50 rounded-lg font-semibold uppercase text-sm select-none">
          <tr>
            <th class="p-3">No</th>
            <th class="p-3">Nama Pengembali</th>
            <th class="p-3">Barang</th>
            <th class="p-3">Tanggal Pengembalian</th>
            <th class="p-3">Kondisi Barang</th>
            <th class="p-3">Catatan</th>
            <th class="p-3">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($pengembalians as $item)
            <tr class="table-row border-b border-[#0a9396]/20 hover:cursor-pointer hover:text-white/90">
              <td class="p-3">{{ $loop->iteration }}</td>
              <td class="p-3">{{ $item->nama_pengembali }}</td>
              <td class="p-3">{{ $item->barang->nama }}</td>
              <td class="p-3">{{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->translatedFormat('d F Y') }}</td>
              <td class="p-3">{{ $item->kondisi_barang }}</td>
              <td class="p-3">{{ $item->catatan ?? '-' }}</td>
              <td class="p-3 flex space-x-4">
                <a href="{{ route('pengembalian.edit', $item->id) }}"
                  class="text-yellow-300 hover:text-yellow-400" title="Edit">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z" />
                  </svg>
                </a>
                <form action="{{ route('pengembalian.destroy', $item->id) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus data pengembalian ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-500 hover:text-red-600" title="Hapus">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr class="table-row border-b border-[#0a9396]/20">
              <td colspan="7" class="p-3 text-center text-white/70">Tidak ada data pengembalian.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </main>
</body>

</html>
