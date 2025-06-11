@extends('manager.layout.layout_manager')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<h1 class="text-2xl font-bold mb-6">Statistik Manager</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

    <!-- Total Koleksi Museum -->
    <div class="p-4 bg-white rounded-xl shadow-md border border-gray-200 md:col-span-2">
        <h2 class="text-xl font-semibold mb-4">Total Koleksi Museum</h2>
        <p class="text-lg font-medium">{{ $totalArtworks }}</p>
    </div>

    <!-- Koleksi per Kategori -->
    <div class="p-4 bg-white rounded-xl shadow-md border border-gray-200">
        <h2 class="text-xl font-semibold mb-4">Koleksi per Kategori</h2>
        <canvas id="categoryChart" height="150"></canvas>
        <table class="w-full text-sm mt-4 border text-gray-700">
            <thead class="bg-gray-100">
                <tr><th class="px-2 py-1 border">Kategori</th><th class="px-2 py-1 border">Jumlah</th></tr>
            </thead>
            <tbody>
                @foreach ($artworksByCategory as $item)
                <tr class="border-t">
                    <td class="px-2 py-1 border">{{ $item->category ?? 'Uncategorized' }}</td>
                    <td class="px-2 py-1 border">{{ $item->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Koleksi per Status -->
    <div class="p-4 bg-white rounded-xl shadow-md border border-gray-200">
        <h2 class="text-xl font-semibold mb-4">Koleksi per Status</h2>
        <canvas id="statusChart" height="150"></canvas>
        <table class="w-full text-sm mt-4 border text-gray-700">
            <thead class="bg-gray-100">
                <tr><th class="px-2 py-1 border">Status</th><th class="px-2 py-1 border">Jumlah</th></tr>
            </thead>
            <tbody>
                @foreach ($artworksByStatus as $item)
                <tr class="border-t">
                    <td class="px-2 py-1 border">{{ $item->status ?? 'Unknown' }}</td>
                    <td class="px-2 py-1 border">{{ $item->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tiket & Penghasilan -->
    <div class="p-4 bg-white rounded-xl shadow-md border border-gray-200">
        <h2 class="text-xl font-semibold mb-4">Tiket & Penghasilan</h2>
        <table class="w-full text-sm border text-gray-700">
            <thead class="bg-gray-100">
                <tr><th class="px-3 py-2 border">Kategori</th><th class="px-3 py-2 border">Jumlah</th></tr>
            </thead>
            <tbody>
                <tr><td class="px-3 py-2 border">Total Tiket Terjual</td><td class="px-3 py-2 border">{{ $totalTicketsSold }}</td></tr>
                <tr><td class="px-3 py-2 border">Total Penghasilan</td><td class="px-3 py-2 border">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td></tr>
            </tbody>
        </table>
    </div>

    <!-- Statistik Pengguna -->
    <div class="p-4 bg-white rounded-xl shadow-md border border-gray-200">
        <h2 class="text-xl font-semibold mb-4">Statistik Pengguna</h2>
        <canvas id="userRoleChart" height="150"></canvas>
        <table class="w-full text-sm mt-4 border text-gray-700">
            <thead class="bg-gray-100">
                <tr><th class="px-2 py-1 border">Peran</th><th class="px-2 py-1 border">Jumlah</th></tr>
            </thead>
            <tbody>
                <tr><td class="px-2 py-1 border">User</td><td class="px-2 py-1 border">{{ $totalUsers }}</td></tr>
                <tr><td class="px-2 py-1 border">Admin</td><td class="px-2 py-1 border">{{ $totalAdmins }}</td></tr>
                <tr><td class="px-2 py-1 border">Manager</td><td class="px-2 py-1 border">{{ $totalManagers }}</td></tr>
            </tbody>
        </table>
    </div>

    <!-- Top 10 Negara/Asal -->
    <div class="p-4 bg-white rounded-xl shadow-md border border-gray-200">
        <h2 class="text-xl font-semibold mb-4">Top 10 Negara/Asal</h2>
        <canvas id="topOriginsChart" height="150"></canvas>
        <table class="w-full text-sm mt-4 border text-gray-700">
            <thead class="bg-gray-100">
                <tr><th class="px-2 py-1 border">Negara</th><th class="px-2 py-1 border">Jumlah</th></tr>
            </thead>
            <tbody>
                @foreach ($topOrigins as $item)
                <tr><td class="px-2 py-1 border">{{ $item->origin ?? 'Unknown' }}</td><td class="px-2 py-1 border">{{ $item->total }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Top 10 Kontributor -->
    <div class="p-4 bg-white rounded-xl shadow-md border border-gray-200">
        <h2 class="text-xl font-semibold mb-4">Top 10 Kontributor</h2>
        <canvas id="topCreatorsChart" height="150"></canvas>
        <table class="w-full text-sm mt-4 border text-gray-700">
            <thead class="bg-gray-100">
                <tr><th class="px-2 py-1 border">Pembuat</th><th class="px-2 py-1 border">Jumlah</th></tr>
            </thead>
            <tbody>
                @foreach ($artworksByCreator as $item)
                <tr><td class="px-2 py-1 border">{{ $item->creator ?? 'Unknown' }}</td><td class="px-2 py-1 border">{{ $item->total }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Top 10 View Terbanyak -->
    <div class="p-4 bg-white rounded-xl shadow-md border border-gray-200">
        <h2 class="text-xl font-semibold mb-4">Top 10 View Terbanyak</h2>
        <canvas id="topViewedChart" height="150"></canvas>
        <table class="w-full text-sm mt-4 border text-gray-700">
            <thead class="bg-gray-100">
                <tr><th class="px-2 py-1 border">Karya</th><th class="px-2 py-1 border">Jumlah View</th></tr>
            </thead>
            <tbody>
                @foreach ($topViewedArtworks as $item)
                <tr><td class="px-2 py-1 border">{{ $item->name }}</td><td class="px-2 py-1 border">{{ $item->views_count }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Top 10 Favorit -->
    <div class="p-4 bg-white rounded-xl shadow-md border border-gray-200">
        <h2 class="text-xl font-semibold mb-4">Top 10 Karya Favorit</h2>
        <canvas id="topFavoritedChart" height="150"></canvas>
        <table class="w-full text-sm mt-4 border text-gray-700">
            <thead class="bg-gray-100">
                <tr><th class="px-2 py-1 border">Karya</th><th class="px-2 py-1 border">Jumlah Favorit</th></tr>
            </thead>
            <tbody>
                @foreach ($topFavoritedArtworks as $item)
                <tr><td class="px-2 py-1 border">{{ $item->name }}</td><td class="px-2 py-1 border">{{ $item->favorites_count }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Fungsi Chart Bar dengan warna batang berbeda-beda
    function createBarChart(canvasId, labels, data, label) {
        const colors = labels.map((_, i) => `hsl(${i * 30 % 360}, 70%, 60%)`);
        const borderColors = labels.map((_, i) => `hsl(${i * 30 % 360}, 70%, 40%)`);

        const ctx = document.getElementById(canvasId).getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    backgroundColor: colors,
                    borderColor: borderColors,
                    borderWidth: 1,
                    borderRadius: 4,
                    maxBarThickness: 40,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false }},
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, precision: 0 }
                    }
                }
            }
        });
    }

    // Panggil semua chart dengan data dinamis
    createBarChart('categoryChart', @json($artworksByCategory->pluck('category')), @json($artworksByCategory->pluck('total')), 'Jumlah Karya');
    createBarChart('statusChart', @json($artworksByStatus->pluck('status')), @json($artworksByStatus->pluck('total')), 'Jumlah Karya');
    createBarChart('userRoleChart', ['User', 'Admin', 'Manager'], [{{ $totalUsers }}, {{ $totalAdmins }}, {{ $totalManagers }}], 'Jumlah Pengguna');
    createBarChart('topOriginsChart', @json($topOrigins->pluck('origin')), @json($topOrigins->pluck('total')), 'Jumlah Karya');
    createBarChart('topCreatorsChart', @json($artworksByCreator->pluck('creator')), @json($artworksByCreator->pluck('total')), 'Jumlah Karya');
    createBarChart('topViewedChart', @json($topViewedArtworks->pluck('name')), @json($topViewedArtworks->pluck('views_count')), 'Jumlah View');
    createBarChart('topFavoritedChart', @json($topFavoritedArtworks->pluck('name')), @json($topFavoritedArtworks->pluck('favorites_count')), 'Jumlah Favorit');
</script>
@endsection
