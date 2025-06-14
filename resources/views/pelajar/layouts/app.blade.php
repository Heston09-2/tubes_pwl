<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelajar Area - @yield('title', 'Flows Museum')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body class="bg-blue-50 min-h-screen font-sans">

    {{-- Navbar Pelajar --}}
    @include('pelajar.layouts.navbar')

    {{-- Konten --}}
    <main class="container mx-auto py-8 px-4">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
