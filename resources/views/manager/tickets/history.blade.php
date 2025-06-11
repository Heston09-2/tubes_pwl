@extends('manager.layout.layout_manager')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Riwayat Pemesanan Tiket</h1>

    <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-6 py-3 font-semibold">ID Tiket</th>
                    <th class="px-6 py-3 font-semibold">Nama Pemesan</th>
                    <th class="px-6 py-3 font-semibold">Nama Pengunjung</th>
                    <th class="px-6 py-3 font-semibold">Jumlah Tiket</th>
                    <th class="px-6 py-3 font-semibold">Total Harga</th>
                    <th class="px-6 py-3 font-semibold">Tanggal Pemesanan</th>
                    <th class="px-6 py-3 font-semibold">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($tickets as $ticket)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $ticket->id }}</td>
                        <td class="px-6 py-3">{{ $ticket->user->name ?? 'User tidak ditemukan' }}</td>
                        <td class="px-6 py-3">
                            <ul class="list-disc list-inside space-y-1">
                                @if(is_array($ticket->names))
                                    @foreach ($ticket->names as $name)
                                        <li>{{ $name }}</li>
                                    @endforeach
                                @else
                                    <li>{{ $ticket->names }}</li> {{-- fallback kalau names string --}}
                                @endif
                            </ul>
                        </td>
                        <td class="px-6 py-3">{{ $ticket->quantity }}</td>
                        <td class="px-6 py-3">Rp {{ number_format($ticket->total_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-3">{{ $ticket->created_at->format('d-m-Y H:i') }}</td>
                        <td class="px-6 py-3">
                            @php
                                $statusColors = [
                                    'terkonfirmasi' => 'bg-green-100 text-green-700',
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'ditolak' => 'bg-red-100 text-red-700',
                                ];
                                $colorClass = $statusColors[$ticket->status] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded {{ $colorClass }}">
                                {{ ucfirst($ticket->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada pemesanan tiket.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
