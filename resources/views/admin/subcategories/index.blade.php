@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Subkategori</h1>
        <a href="{{ route('admin.subcategories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow">+ Tambah Subkategori</a>
    </div>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('admin.subcategories.index') }}" class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="category_id" class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if(request('category_id') == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Cari Nama</label>
            <input type="text" name="search" value="{{ request('search') }}" class="mt-1 block w-full border-gray-300 rounded shadow-sm" placeholder="Cari subkategori...">
        </div>
        <div class="flex items-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow w-full">Terapkan</button>
        </div>
    </form>

    {{-- Success message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    {{-- Subcategory list --}}
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($subcategories as $subcategory)
        <div class="bg-white p-4 rounded shadow">
            @if($subcategory->image)
                <img src="{{ asset('storage/' . $subcategory->image) }}" class="w-full h-40 object-cover rounded mb-3" alt="gambar subkategori">
            @endif
            <h2 class="text-xl font-semibold">{{ $subcategory->name }}</h2>
            <p class="text-sm text-gray-500">Kategori: {{ $subcategory->category->name }}</p>
            <div class="mt-4 flex gap-2">
                <a href="{{ route('admin.subcategories.edit', $subcategory) }}" class="text-blue-600 hover:underline">Edit</a>
                <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600 hover:underline" type="submit">Hapus</button>
                </form>
            </div>
        </div>
        @empty
        <p class="text-gray-500 col-span-full">Tidak ada subkategori ditemukan.</p>
        @endforelse
    </div>
</div>
@endsection
