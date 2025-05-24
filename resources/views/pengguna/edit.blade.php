<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Pengguna - SARPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .card-glass {
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
        }
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.3);
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#005f73] to-[#0a9396] text-white">

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold">Edit Data Pengguna</h1>
                <p class="text-[#a3e0e0]">Perbarui informasi pengguna</p>
            </div>
            <div class="flex items-center space-x-4">
            <div class="relative group">
                    <img src="{{ asset('assets/ojan.jpg') }}" alt="Profile" class="w-12 h-12 rounded-full object-cover border-2 border-yellow-400 shadow-md">
                    <span class="absolute -bottom-1 -right-1 bg-yellow-500 text-xs px-2 py-0.5 rounded-full font-medium">ADMIN</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-1 px-4 py-2 bg-[#027c7c] hover:bg-[#03a9a9] rounded-full transition-all duration-200 group">
                        <span>Logout</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-9">
                <div class="card-glass bg-[#001219]/80 p-8 rounded-2xl shadow-xl border border-[#005f73]">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Form Edit Pengguna</h2>
                        <a href="{{ route('pengguna') }}" class="flex items-center text-yellow-300 hover:text-yellow-200 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Kembali
                        </a>
                    </div>

                    <form action="{{ route('pengguna.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium mb-2">Nama Lengkap</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                    class="input-field w-full px-4 py-3 rounded-lg bg-[#003845] border border-[#005f73] focus:border-yellow-500 focus:outline-none"
                                    required>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium mb-2">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                    class="input-field w-full px-4 py-3 rounded-lg bg-[#003845] border border-[#005f73] focus:border-yellow-500 focus:outline-none"
                                    required>
                            </div>

                            <div>
                                <label for="role" class="block text-sm font-medium mb-2">Role</label>
                                <select name="role" id="role"
                                    class="input-field w-full px-4 py-3 rounded-lg bg-[#003845] border border-[#005f73] focus:border-yellow-500 focus:outline-none">
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="w-full flex justify-center items-center py-3 px-4 bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 rounded-lg font-semibold text-white shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-[1.02]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                                    </svg>
                                    Update Pengguna
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-40 h-40 rounded-full bg-[#0a9396]/20 blur-xl"></div>
        <div class="absolute bottom-10 right-20 w-60 h-60 rounded-full bg-[#005f73]/20 blur-xl"></div>
        <div class="absolute top-1/3 right-1/4 w-80 h-80 rounded-full bg-[#94d2bd]/10 blur-xl"></div>
    </div>

</body>

</html>
