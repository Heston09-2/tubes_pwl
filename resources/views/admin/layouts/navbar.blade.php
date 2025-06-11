{{-- resources/views/admin/layouts/navbar.blade.php --}}
<nav class="fixed top-0 left-0 h-full w-64 bg-gray-800 text-white shadow-lg flex flex-col z-50">
    <div class="p-6 border-b border-gray-700">
        <h1 class="text-2xl font-bold mb-4">Admin Panel</h1>
    </div>

    <div class="flex-grow overflow-y-auto px-4 py-6 space-y-3" x-data="{ open: false }">
        <a href="{{ route('admin.dashboard_admin') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Dashboard Admin</a>

        <!-- Collapsible Dropdown -->
        <div>
            <button @click="open = !open" class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-700 focus:outline-none">
                <span>Kelola Data Museum</span>
                <svg :class="{'transform rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" class="mt-2 space-y-2 pl-4" x-cloak>
                <a href="{{ route('admin.show') }}" class="block px-4 py-1 rounded hover:bg-gray-700">Data Disetujui</a>
                <a href="{{ route('admin.pending') }}" class="block px-4 py-1 rounded hover:bg-gray-700">Data Menunggu</a>
                <a href="{{ route('admin.rejected') }}" class="block px-4 py-1 rounded hover:bg-gray-700">Data Ditolak</a>
                <a href="{{ route('admin.pengunjung.index') }}" class="block px-4 py-1 rounded hover:bg-gray-700">Laporan Pengunjung</a>
                <a href="{{ route('admin.import') }}" class="block px-4 py-1 rounded hover:bg-gray-700">Tambah (via Excel)</a>
                <a href="{{ route('admin.create') }}" class="block px-4 py-1 rounded hover:bg-gray-700">Tambah (Manual)</a>
            </div>
        </div>

        <a href="{{ route('admin.materials.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Tambahkan Materi Pelajar</a>
         <a href="{{ route('admin.quizzes.index') }}"  class="block px-4 py-2 rounded hover:bg-gray-700">Kuis & Soal</a>
         <a href="{{ route('admin.contacts.index') }}"  class="block px-4 py-2 rounded hover:bg-gray-700">Pertanyaan</a>

      


    </div>

    <div class="p-6 border-t border-gray-700">
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="block text-red-400 hover:text-red-600 px-4 py-2 rounded">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</nav>
