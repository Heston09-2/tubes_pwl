<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-sm border-b">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Footer -->
<footer class="bg-gray-700 text-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Tentang Museum -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-white">
                    Tentang Museum
                </h3>
                <div class="space-y-3 text-sm leading-relaxed">
                    <p>
                        Flows Arcive adalah ruang eksplorasi yang menghubungkan beragam kategori ilmu pengetahuan, seni, sejarah, dan budaya dalam satu aliran yang harmonis.
                    </p>
                    <p>
                        Dengan koleksi yang kaya dan beragam, museum ini mengajak pengunjung untuk menjelajahi warisan budaya dan pengetahuan yang telah membentuk dunia kita.
                    </p>
                </div>
            </div>

            <!-- Kontak -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-white">
                    Hubungi Kami
                </h3>
                <div class="space-y-2 text-sm">
                    <div class="flex items-center space-x-2">
                        <span class="text-green-400">📞</span>
                        <span>+62 21 8765 4321</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-green-400">✉️</span>
                        <span>arciveMUSEUM@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Bawah Footer -->
    <div class="bg-gray-800 py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-300 text-xs">
                &copy; 2025 Arcive Museum. Hak Cipta Dilindungi Undang-Undang.
            </p>
        </div>
    </div>
</footer>




    <style>
        /* Navigation Styles */
        nav {
            @apply bg-white shadow-sm border-b px-4 py-3;
        }

        nav a {
            @apply text-gray-700 hover:text-green-600 transition-colors mr-6;
        }

        /* Page Heading Styles */
        header h1 {
            @apply text-2xl font-semibold text-gray-800;
        }

        /* Alert Styles */
        .alert {
            @apply px-4 py-3 rounded mb-4;
        }

        .alert-success {
            @apply bg-green-50 text-green-800 border border-green-200;
        }

        .alert-error {
            @apply bg-red-50 text-red-800 border border-red-200;
        }

        /* Artwork Grid */
        .artwork-grid {
            @apply grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-6;
        }

        .artwork-card {
            @apply bg-white rounded-lg overflow-hidden shadow hover:shadow-md transition-shadow border;
        }

        .artwork-image {
            @apply w-full h-48 object-cover;
        }

        .artwork-info {
            @apply p-4;
        }

        .artwork-title {
            @apply text-lg font-semibold mb-2 text-gray-800;
        }

        .artwork-creator, .artwork-category, .artwork-year {
            @apply text-sm text-gray-600 mb-1;
        }

        .artwork-description {
            @apply text-sm text-gray-500 mt-2;
        }

        /* No Artwork Message */
        .no-artwork {
            @apply text-center text-lg text-gray-500 py-8;
        }
    </style>
</body>
</html>