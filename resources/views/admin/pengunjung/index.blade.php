@extends('admin.layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Input & Laporan Pengunjung Harian</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.pengunjung.store') }}" method="POST" class="space-y-4 mb-10">
        @csrf
        <div>
            <label class="block text-gray-700 font-medium">Tanggal:</label>
            <input type="date" name="tanggal" required
                   class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Jumlah Pengunjung:</label>
            <input type="number" name="jumlah" required min="1"
                   class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Catatan (Opsional):</label>
            <textarea name="catatan" rows="3"
                      class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-all">
            Simpan
        </button>
    </form>

    <hr class="my-6">

    <h3 class="text-xl font-semibold text-gray-700 mb-4">Data Pengunjung yang Pernah Diinput</h3>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border border-gray-200">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="py-2 px-4 border">Tanggal</th>
                    <th class="py-2 px-4 border">Jumlah</th>
                    <th class="py-2 px-4 border">Total Pendapatan</th>
                    <th class="py-2 px-4 border">Final</th>
                    <th class="py-2 px-4 border">Catatan</th>
                    <th class="py-2 px-4 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border">{{ $item->tanggal }}</td>
                    <td class="py-2 px-4 border">{{ $item->jumlah }}</td>
                    <td class="py-2 px-4 border">Rp{{ number_format($item->total_pendapatan) }}</td>
                    <td class="py-2 px-4 border">
                        {{ $item->is_final ? 'Ya' : 'Belum' }}
                    </td>
                    <td class="py-2 px-4 border">{{ $item->catatan }}</td>
                    <td class="py-2 px-4 border space-x-2">
                        @if(!$item->is_final)
                            <a href="{{ route('admin.pengunjung.edit', $item->id) }}"
                               class="text-blue-600 hover:underline">Edit</a>

                            <form action="{{ route('admin.pengunjung.finalize', $item->id) }}"
                                  method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="text-green-600 hover:underline">Finalisasi</button>
                            </form>

                            <form action="{{ route('admin.pengunjung.destroy', $item->id) }}"
                                  method="POST" class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        @else
                            <span class="text-gray-500">Final</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
