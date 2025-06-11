<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome to Museum Hub</title>
    <link href="https://fonts.bunny.net/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-[#f0f2f1] text-[#444] leading-relaxed overflow-x-hidden" onload="window.scrollTo(0, 0)">
    <div class="max-w-[1200px] mx-auto px-5 pb-16">

        <section id="login-section" class="min-h-screen flex flex-col justify-center items-center text-center mb-10">
            <div class="flex flex-col md:flex-row items-center gap-10 w-full max-w-[1200px] mt-10 px-5">
                <!-- Text -->
                <div class="md:flex-1 max-w-md md:pr-8">
                    <h1 class="text-[#2c5c32] font-semibold text-4xl md:text-5xl mb-4">
                        Selamat Datang di Flows Archive
                    </h1>
                    <p class="text-[#4d5e4e] text-lg mb-6">
                        Eksplorasi sejarah dan budaya melalui koleksi terbaik.
                    </p>

                    @if (Route::has('login'))
                        <div class="flex flex-wrap justify-center gap-4">
                            @auth
                                @php
                                    if(auth()->user()->role === 'admin') {
                                        $dashboardRoute = route('admin.dashboard_admin');
                                    } elseif(auth()->user()->role === 'manager') {
                                        $dashboardRoute = route('manager.dashboard');
                                    } else {
                                        $dashboardRoute = route('dashboard');
                                    }
                                @endphp

                                <a href="{{ $dashboardRoute }}" class="bg-[#50675d] hover:bg-[#29462d] text-white font-medium py-3 px-7 rounded-md transition-transform transform hover:-translate-y-1">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="bg-[#50675d] hover:bg-[#29462d] text-white font-medium py-3 px-7 rounded-md transition-transform transform hover:-translate-y-1">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-[#50675d] hover:bg-[#29462d] text-white font-medium py-3 px-7 rounded-md transition-transform transform hover:-translate-y-1">
                                        Register
                                    </a>
                                @endif
                            @endauth
                            <a href="#artworks" class="bg-[#50675d] hover:bg-[#29462d] text-white font-medium py-3 px-7 rounded-md transition-transform transform hover:-translate-y-1">
                                Lihat Koleksi
                            </a>
                            <a href="{{ route('pelajar.welcome') }}" class="bg-[#50675d] hover:bg-[#29462d] text-white font-medium py-3 px-7 rounded-md transition-transform transform hover:-translate-y-1">
                                Masuk Ke Mode Pelajar
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Image -->
                <div class="md:flex-1 flex justify-center max-w-md">
                    <a href="/">
                        <x-application-logo width="400" height="400" />
                    </a>
                </div>
            </div>
        </section>

        <h2 class="text-[#2c5c32] font-semibold text-3xl text-center mb-10 relative pb-3 after:content-[''] after:absolute after:left-1/2 after:bottom-0 after:-translate-x-1/2 after:w-20 after:h-1 after:bg-[#3b7347]">
            Koleksi Karya Seni Kami
        </h2>

        <section id="artworks" class="flex flex-wrap justify-center gap-6">
            @foreach ($artworks as $artwork)
                <div class="w-[18%] min-w-[180px] rounded-lg bg-[#d5d9d6] shadow-md hover:shadow-lg transition-transform transform hover:-translate-y-1 relative overflow-hidden cursor-pointer">
                    <a href="{{ route('artworks.detail', $artwork['id']) }}" class="block">
                        @if(isset($artwork['image']))
                            <img src="{{ asset('storage/images/' . $artwork['image']) }}" alt="{{ $artwork['name'] }}" class="w-full h-44 object-cover" />
                        @else
                            <img src="https://via.placeholder.com/200x300" alt="{{ $artwork['name'] ?? 'Artwork' }}" class="w-full h-44 object-cover" />
                        @endif
                        <div class="absolute bottom-0 w-full bg-[#3b7347cc] text-white p-2 text-center translate-y-full hover:translate-y-0 transition-transform">
                            <h5 class="text-base font-semibold">{{ $artwork['name'] ?? 'Untitled' }}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
        </section>

    </div>

    <footer class="bg-[#5c635d] text-[#e0e0e0] py-6 text-center mt-14 border-t-4 border-[#3b7347] w-full">
        <p>&copy; 2025 Museum Hub. All rights reserved.</p>
    </footer>
</body>
</html>
