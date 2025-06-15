@extends('admin.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Daftar Materi</h1>
        <a href="{{ route('admin.materials.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">
            Tambah Materi
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif
<form method="GET" action="{{ route('admin.materials.index') }}" class="mb-6 flex flex-wrap gap-4 items-end">
    {{-- Kategori --}}
    <div>
        <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
        <select name="category_id" id="category_id"
                class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Subkategori --}}
    <div>
        <label for="subcategory_id" class="block text-sm font-medium text-gray-700">Subkategori</label>
        <select name="subcategory_id" id="subcategory_id"
                class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            <option value="">Semua Subkategori</option>
            {{-- Jika ada category yang dipilih, tampilkan subkategori terkait --}}
            @if (request('category_id'))
                @foreach ($subcategories->where('category_id', request('category_id')) as $subcategory)
                    <option value="{{ $subcategory->id }}"
                        {{ request('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                        {{ $subcategory->name }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>

    <div>
        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Filter
        </button>
        <a href="{{ route('admin.materials.index') }}"
           class="ml-2 text-sm text-gray-500 hover:underline">Reset</a>
    </div>
</form>




    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Judul</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Kategori</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Subkategori</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Admin</th>
                    <th class="px-6 py-3 text-center font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($materials as $index => $material)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap text-gray-800">{{ $loop->iteration + ($materials->currentPage() - 1) * $materials->perPage() }}</td>
                        <td class="px-6 py-3 whitespace-normal text-gray-900">{{ $material->title }}</td>
                        <td class="px-6 py-3 whitespace-nowrap text-gray-700">{{ $material->category->name ?? '-' }}</td>
                        <td class="px-6 py-3 whitespace-nowrap text-gray-700">{{ $material->subcategory->name ?? '-' }}</td>
                        <td class="px-6 py-3 whitespace-nowrap text-gray-700">{{ $material->admin->name ?? '-' }}</td>
                        <td class="px-6 py-3 text-center">
    <div class="flex justify-center space-x-2">
        <a href="{{ route('admin.materials.edit', $material->id) }}"
           class="px-4 py-2 text-sm font-medium text-white bg-yellow-500 rounded hover:bg-yellow-600 transition duration-150">
            Edit
        </a>
        <form action="{{ route('admin.materials.destroy', $material->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700 transition duration-150">
                Hapus
            </button>
        </form>
    </div>
</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500">Data materi belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $materials->links() }}
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('category_id');
        const subcategorySelect = document.getElementById('subcategory_id');

        categorySelect.addEventListener('change', function () {
            const categoryId = this.value;

            // Hapus isi dropdown subkategori
            subcategorySelect.innerHTML = '<option value="">Memuat subkategori...</option>';

            if (!categoryId) {
                subcategorySelect.innerHTML = '<option value="">Semua Subkategori</option>';
                return;
            }

            fetch(`/admin/get-subcategories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    let options = '<option value="">Semua Subkategori</option>';
                    data.forEach(sub => {
                        options += `<option value="${sub.id}">${sub.name}</option>`;
                    });
                    subcategorySelect.innerHTML = options;
                })
                .catch(error => {
                    console.error('Gagal memuat subkategori:', error);
                    subcategorySelect.innerHTML = '<option value="">Terjadi kesalahan</option>';
                });
        });
    });
</script>

@endsection
