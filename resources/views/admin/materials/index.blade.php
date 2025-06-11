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

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subkategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($materials as $material)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $material->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $material->category->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $material->subcategory->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $material->admin->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                            <a href="{{ route('admin.materials.edit', $material->id) }}" class="inline-block px-3 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600 transition">
                                Edit
                            </a>
                            <form action="{{ route('admin.materials.destroy', $material->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-block px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($materials->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">Data materi belum tersedia.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $materials->links() }}
    </div>
</div>
@endsection
