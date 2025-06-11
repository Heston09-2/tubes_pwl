@extends('manager.layout.layout_manager')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Data Museum</h2>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
    @endif

    <div class="mb-6 flex flex-wrap gap-4">
        <a href="{{ route('manager.artworks.create') }}" class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded shadow">Tambah Data</a>

        <!-- Form Import Excel -->
        <form action="{{ route('manager.artworks.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
            @csrf
            <label class="text-sm font-medium">Import Data:</label>
            <input type="file" name="file" required class="border rounded p-1">
            <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-3 py-1 rounded shadow">Import</button>
        </form>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('manager.artworks.show') }}" class="mb-6 flex flex-wrap items-center gap-4">
        <div>
            <label for="category" class="text-sm font-medium">Filter Kategori:</label>
            <select name="category" id="category" class="border rounded px-2 py-1">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                        {{ ucfirst($category) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="search" class="text-sm font-medium">Cari Nama:</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari..." class="border rounded px-2 py-1">
        </div>

        <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-3 py-1 rounded shadow">Filter</button>

        @if(request('category') || request('search'))
            <a href="{{ route('manager.artworks.show') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded shadow">Reset</a>
        @endif
    </form>

    <!-- Tabel -->
    <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg shadow mb-6">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-800">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold">Nama</th>
                    <th class="px-4 py-3 text-left font-semibold">Kategori</th>
                    <th class="px-4 py-3 text-left font-semibold">Pembuat</th>
                    <th class="px-4 py-3 text-left font-semibold">Tahun</th>
                    <th class="px-4 py-3 text-left font-semibold">Asal</th>
                    <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($artworks as $artwork)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $artwork->name }}</td>
                        <td class="px-4 py-3">{{ $artwork->category }}</td>
                        <td class="px-4 py-3">{{ $artwork->creator }}</td>
                        <td class="px-4 py-3">{{ $artwork->year }}</td>
                        <td class="px-4 py-3">{{ $artwork->origin }}</td>
                        <td class="px-4 py-3 flex flex-col gap-2">
                            <a href="{{ route('manager.artworks.edit', $artwork->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-sm text-center">Edit</a>

                            <form action="{{ route('manager.artworks.destroy', $artwork->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm w-full">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-4">Tidak ada data tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Form Hapus Semua -->
    <form action="{{ route('manager.artworks.deleteAll') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua data?');" class="mb-6">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-800 hover:bg-red-900 text-white px-4 py-2 rounded shadow">Hapus Semua Data</button>
    </form>

    <!-- Form Hapus Berdasarkan Kategori -->
    <form action="{{ route('manager.artworks.deleteByCategory') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data dari kategori ini?');" class="mb-6 flex flex-wrap items-center gap-4">
        @csrf
        @method('DELETE')
        <div>
            <label for="category" class="text-sm font-medium">Pilih Kategori:</label>
            <select name="category" id="category" required class="border rounded px-2 py-1">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-yellow-700 hover:bg-yellow-800 text-white px-4 py-2 rounded shadow">Hapus Kategori Ini</button>
    </form>
</div>

@endsection
