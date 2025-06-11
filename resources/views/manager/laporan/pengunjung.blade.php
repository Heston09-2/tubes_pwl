@extends('manager.layout.layout_manager')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Laporan Pengunjung Harian</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left border-b">Tanggal</th>
                    <th class="px-4 py-3 text-left border-b">Admin</th>
                    <th class="px-4 py-3 text-left border-b">Jumlah</th>
                    <th class="px-4 py-3 text-left border-b">Total Pendapatan</th>
                    <th class="px-4 py-3 text-left border-b">Catatan</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach($data as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 border-b">{{ $item->tanggal }}</td>
                    <td class="px-4 py-3 border-b">{{ $item->admin->name }}</td>
                    <td class="px-4 py-3 border-b">{{ $item->jumlah }}</td>
                    <td class="px-4 py-3 border-b">Rp{{ number_format($item->total_pendapatan) }}</td>
                    <td class="px-4 py-3 border-b">{{ $item->catatan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
