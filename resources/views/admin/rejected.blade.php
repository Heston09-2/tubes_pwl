@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-semibold mb-6">Data yang Ditolak Manager</h1>

    @if($artworks->isEmpty())
        <p class="text-gray-600">Tidak ada data yang ditolak.</p>
    @else
        {{-- Tombol Bersihkan Semua --}}
        <form action="{{ route('admin.artworks.cleanAll') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua data yang ditolak?');" class="mb-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md font-semibold">
                Bersihkan Semua
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Kategori</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Pembuat</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Tahun</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Asal</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Deskripsi</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($artworks as $artwork)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $artwork->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $artwork->category }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $artwork->creator }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $artwork->year }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $artwork->origin }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($artwork->description, 50) }}</td>
                        <td class="px-4 py-3">
                            @if($artwork->image)
                                <img src="{{ asset('storage/images/' . $artwork->image) }}" alt="{{ $artwork->name }}" class="w-24 rounded-md border border-gray-300">
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
