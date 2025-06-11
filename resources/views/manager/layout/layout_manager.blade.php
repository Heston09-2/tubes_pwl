<!-- resources/views/manager/layout/layout_manager.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manager Layout</title>
    @vite('resources/css/app.css')
</head>
<body class="h-screen font-sans bg-gray-100">

    <div class="flex h-full">

        <!-- Sidebar -->
        <nav class="w-56 bg-gray-800 text-white flex flex-col justify-between p-5">
            <div>
                <h2 class="text-2xl font-semibold mb-6">Manager Panel</h2>

                <div class="space-y-2">
                    <a href="{{ route('manager.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-700 transition">Dashboard</a>
                    <a href="{{ route('manager.users') }}" class="block px-3 py-2 rounded hover:bg-gray-700 transition">Kelola Pengguna</a>
                    <a href="{{ route('manager.artworks.show') }}" class="block px-3 py-2 rounded hover:bg-gray-700 transition">Kelola Data Museum</a>
                    <a href="{{ route('manager.artworks.create') }}" class="block px-3 py-2 rounded hover:bg-gray-700 transition">Tambah Data Baru</a>
                    <a href="{{ route('manager.pending') }}" class="block px-3 py-2 rounded hover:bg-gray-700 transition">Menunggu Persetujuan</a>
                    <a href="{{ route('manager.tickets.history') }}" class="block px-3 py-2 rounded hover:bg-gray-700 transition">Riwayat Tiket</a>
                    <a href="{{ route('manager.statistics') }}" class="block px-3 py-2 rounded hover:bg-gray-700 transition">Statistik</a>
                    <a href="{{ route('manager.laporan.pengunjung') }}" class="block px-3 py-2 rounded hover:bg-gray-700 transition">Laporan Pengunjung</a>
                    <a href="{{ route('manager.pelajar.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700 transition">Kelola Pelajar</a>


                </div>
            </div>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded text-sm font-medium transition">
                    Logout
                </button>
            </form>
        </nav>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto bg-gray-100">
            <header class="text-lg font-semibold mb-6">
                Selamat datang, {{ auth()->user()->name }}!
            </header>

            @yield('content')
        </main>
    </div>

</body>
</html>
