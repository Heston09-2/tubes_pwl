<nav class="bg-blue-300 text-black shadow-md fixed w-full z-50">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Logo / Judul -->
        <div class="text-lg font-bold tracking-wide">
            <a href="{{ route('pelajar.welcome') }}" class="hover:text-blue-900">
                Flows Museum - Pelajar
            </a>
        </div>

        <!-- Navigasi -->
        <div class="space-x-6 hidden md:flex">
            <a href="{{ route('pelajar.home') }}" class="text-black hover:text-blue-900">Home</a>
            <a href="{{ route('pelajar.materi') }}" class="hover:text-blue-900">Materi Belajar</a>
            <a href="{{ route('pelajar.quizzes.index') }}" class="hover:text-blue-900">Ikuti Kuis</a>
            <a href="{{ route('pelajar.contact.form') }}" class="hover:text-blue-900">Hubungi Kami</a>
            <a href="{{ route('pelajar.forum.index') }}" class="hover:text-blue-900">Forum Diskusi</a>
        </div>

        <!-- User Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center space-x-2 hover:text-blue-900 focus:outline-none">
                <span class="font-semibold text-sm">
                    {{ Auth::guard('pelajar')->user()->name ?? 'Pelajar' }}
                </span>
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                    <path d="M5.5 7l4.5 4.5L14.5 7z" />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white text-black rounded shadow-lg z-50">
                <a href="{{ route('pelajar.profile') }}" class="block px-4 py-2 hover:bg-blue-200">Profil</a>
                <a href="{{ route('pelajar.forum.mine') }}" class="block px-4 py-2 hover:bg-blue-200">Aktivitas Forum</a>
                <a href="{{ route('pelajar.saved') }}" class="block px-4 py-2 hover:bg-blue-200">Materi Disimpan</a>
                <form method="POST" action="{{ route('pelajar.logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-blue-200">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Spacer to push content down -->
<div class="h-16"></div>

<!-- Tambahkan Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
