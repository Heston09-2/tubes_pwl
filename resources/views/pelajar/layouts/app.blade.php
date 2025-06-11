<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelajar Area - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen font-sans">

    {{-- Navbar Pelajar --}}
    @include('pelajar.layouts.navbar')

    {{-- Konten --}}
    <main class="container mx-auto py-8 px-4">
        @yield('content')
    </main>

</body>
</html>
