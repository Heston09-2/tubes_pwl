@extends('manager.layout.layout_manager')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Pelajar</h1>
        <a href="{{ route('manager.pelajar.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Tambah Pelajar Baru
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="py-3 px-4 border-b text-left">ID</th>
                    <th class="py-3 px-4 border-b text-left">Nama</th>
                    <th class="py-3 px-4 border-b text-left">Email</th>
                    <th class="py-3 px-4 border-b text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @forelse($pelajars as $pelajar)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">{{ $pelajar->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $pelajar->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $pelajar->email }}</td>
                        <td class="py-2 px-4 border-b flex space-x-2">
                            <a href="{{ route('manager.pelajar.edit', $pelajar->id) }}"
                               class="text-blue-600 hover:underline">Edit</a>

                            <form action="{{ route('manager.pelajar.destroy', $pelajar->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">Belum ada data pelajar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
