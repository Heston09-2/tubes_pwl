<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="min-h-screen bg-gray-100 flex">
        <!-- Sidebar -->
        @include('admin.layouts.navbar')

        <!-- Content -->
        <main class="flex-1 ml-64 py-4 px-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
