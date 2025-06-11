<nav class="bg-[#50675d] shadow-md text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 relative">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <img src="{{ asset('image/logos.png') }}" alt="Logo" class="h-10 w-10 rounded-full border-2 border-[#7abf8f] shadow-md shadow-[#7abf8f]/50" />
                <a href="{{ route('welcome') }}" class="text-white text-2xl font-semibold tracking-wide drop-shadow-md hover:text-[#a3c6a8] transition">
                    Flows Arcive
                </a>
            </div>

            <!-- Nav Links -->
            <div class="hidden md:flex space-x-8">
                @php $active = 'text-[#a3c6a8]'; @endphp

                <a href="{{ route('dashboard') }}"
                   class="relative inline-block px-1 py-2 font-medium hover:text-[#a3c6a8] {{ request()->routeIs('dashboard') ? $active : '' }}">
                    Dashboard
                    <span class="absolute bottom-0 left-0 w-full h-1 rounded bg-[#a3c6a8] {{ request()->routeIs('dashboard') ? 'block' : 'hidden' }}"></span>
                </a>
                <a href="{{ route('gallery') }}"
                   class="relative inline-block px-1 py-2 font-medium hover:text-[#a3c6a8] {{ request()->routeIs('gallery') ? $active : '' }}">
                    Gallery
                    <span class="absolute bottom-0 left-0 w-full h-1 rounded bg-[#a3c6a8] {{ request()->routeIs('gallery') ? 'block' : 'hidden' }}"></span>
                </a>
                <a href="{{ route('favorites.index') }}"
                   class="relative inline-block px-1 py-2 font-medium hover:text-[#a3c6a8] {{ request()->routeIs('favorites') ? $active : '' }}">
                    Favorit saya
                    <span class="absolute bottom-0 left-0 w-full h-1 rounded bg-[#a3c6a8] {{ request()->routeIs('favorites') ? 'block' : 'hidden' }}"></span>
                </a>
                <a href="{{ route('favorites.popular') }}"
                   class="relative inline-block px-1 py-2 font-medium hover:text-[#a3c6a8] {{ request()->routeIs('popular') ? $active : '' }}">
                    Paling Populer
                    <span class="absolute bottom-0 left-0 w-full h-1 rounded bg-[#a3c6a8] {{ request()->routeIs('popular') ? 'block' : 'hidden' }}"></span>
                </a>
                <a href="{{ route('aboutus') }}"
                   class="relative inline-block px-1 py-2 font-medium hover:text-[#a3c6a8] {{ request()->routeIs('aboutus') ? $active : '' }}">
                    About Us
                    <span class="absolute bottom-0 left-0 w-full h-1 rounded bg-[#a3c6a8] {{ request()->routeIs('aboutus') ? 'block' : 'hidden' }}"></span>
                </a>
                <a href="{{ route('tickets.create') }}"
                   class="relative inline-block px-1 py-2 font-medium hover:text-[#a3c6a8] {{ request()->routeIs('tickets.create') ? $active : '' }}">
                    Pesan Tiket
                    <span class="absolute bottom-0 left-0 w-full h-1 rounded bg-[#a3c6a8] {{ request()->routeIs('tickets.create') ? 'block' : 'hidden' }}"></span>
                </a>
            </div>

            <!-- Dropdown -->
            <div class="relative ml-4">
                <button id="dropdownButton" onclick="toggleDropdown()" class="flex items-center gap-2 bg-[#496c55] hover:bg-[#3c5947] text-white text-sm font-medium rounded-full px-4 py-2 shadow-md shadow-[#3a523d]/50 transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-[#7abf8f]">
                    @auth
                        {{ Auth::user()->name }}
                    @endauth
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-100 hover:text-green-800 transition">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 text-gray-700 hover:bg-green-100 hover:text-green-800 transition">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- JavaScript for Dropdown -->
<script>
    function toggleDropdown() {
        const menu = document.getElementById('dropdownMenu');
        menu.classList.toggle('hidden');
    }

    window.addEventListener('click', function(e) {
        const button = document.getElementById('dropdownButton');
        const menu = document.getElementById('dropdownMenu');
        if (!button.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
