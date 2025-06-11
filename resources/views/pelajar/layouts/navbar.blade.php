<nav class="bg-gray-100 text-gray-800 shadow-md fixed w-full z-50">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Logo / Judul -->
        <div class="text-lg font-bold tracking-wide">
            <a href="#" class="hover:text-gray-600">
                Flows Museum - Pelajar
            </a>
        </div>

        <!-- Navigasi -->
        <div class="space-x-6 hidden md:flex">
            <a href="{{ route('pelajar.home') }}" class="text-gray-700">Home</a>
            <a href="{{ route('pelajar.materi') }}" class="hover:text-gray-600">Materi Belajar</a>
            <a href="{{ route('pelajar.saved') }}"class="  hover:text-gray-600">Materi Disimpan</a>
            <a href="{{ route('pelajar.quizzes.index') }}" class="hover:text-gray-600">Ikuti Kuis</a>
            <a href="{{ route('pelajar.contact.form') }}" class="hover:text-gray-600">Hubungi Kami</a>

          


            


            
            <a href="#" class="hover:text-gray-600">Tur Virtual</a>
        </div>

        <!-- User Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center space-x-2 hover:text-gray-600 focus:outline-none">
                <span class="font-semibold text-sm">
                    {{ Auth::guard('pelajar')->user()->name ?? 'Pelajar' }}
                </span>
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                    <path d="M5.5 7l4.5 4.5L14.5 7z" />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white text-black rounded shadow-lg z-50">
                <a href="{{ route('pelajar.profile') }}" class="block px-4 py-2 hover:bg-gray-100">Profil</a>

                <form method="POST" action="{{ route('pelajar.logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">
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
