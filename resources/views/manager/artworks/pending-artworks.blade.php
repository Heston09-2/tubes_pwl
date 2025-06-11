@extends('manager.layout.layout_manager')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Persetujuan Koleksi</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
    @endif

    @if($pendingArtworks->isEmpty())
        <p class="text-gray-600">Tidak ada data yang perlu disetujui.</p>
    @else

    <div class="flex items-center gap-4 mb-6">
        <form action="{{ route('manager.approveAll') }}" method="POST" onsubmit="return confirm('Setujui semua data pending?')">
            @csrf
            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded shadow">Setujui Semua</button>
        </form>

        <form action="{{ route('manager.deleteAllPending') }}" method="POST" onsubmit="return confirm('Hapus semua data pending?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-gray-900 hover:bg-black text-white px-4 py-2 rounded shadow">Hapus dan Tolak Semua</button>
        </form>
    </div>

    <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-800">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold">Nama</th>
                    <th class="px-4 py-3 text-left font-semibold">Kategori</th>
                    <th class="px-4 py-3 text-left font-semibold">Pembuat</th>
                    <th class="px-4 py-3 text-left font-semibold">Tahun</th>
                    <th class="px-4 py-3 text-left font-semibold">Asal</th>
                    <th class="px-4 py-3 text-left font-semibold">Deskripsi</th>
                    <th class="px-4 py-3 text-left font-semibold">Gambar</th>
                    <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($pendingArtworks as $artwork)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $artwork->name }}</td>
                    <td class="px-4 py-3">{{ $artwork->category }}</td>
                    <td class="px-4 py-3">{{ $artwork->creator }}</td>
                    <td class="px-4 py-3">{{ $artwork->year }}</td>
                    <td class="px-4 py-3">{{ $artwork->origin }}</td>
                    <td class="px-4 py-3">{{ Str::limit($artwork->description, 50) }}</td>
                    <td class="px-4 py-3">
                        @if($artwork->image)
                            <img src="{{ asset('storage/images/' . $artwork->image) }}" alt="{{ $artwork->name }}" class="w-24 h-auto rounded shadow">
                        @else
                            <span class="text-gray-500 italic">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 flex flex-col space-y-2">
                        <form action="{{ route('manager.approve', $artwork->id) }}" method="POST" onsubmit="return confirm('Setujui data ini?')">
                            @csrf
                            <button type="submit" class="w-full bg-gray-800 hover:bg-gray-900 text-white px-3 py-1 rounded text-sm shadow">Setuju</button>
                        </form>
                        <form action="{{ route('manager.reject', $artwork->id) }}" method="POST" onsubmit="return confirm('Tolak data ini?')">
                            @csrf
                            <button type="submit" class="w-full bg-gray-900 hover:bg-black text-white px-3 py-1 rounded text-sm shadow">Tolak</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @endif
</div>
@endsection
