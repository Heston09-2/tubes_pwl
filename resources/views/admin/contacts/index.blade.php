@extends('admin.layouts.app') {{-- Layout admin --}}

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Daftar Pertanyaan Pelajar</h1>

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="border px-4 py-2">Id Pelajar</th>
                <th class="border px-4 py-2">Nama Pelajar</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Pesan</th>
                <th class="border px-4 py-2">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td class="border px-4 py-2">{{ $loop->iteration + ($contacts->currentPage()-1)*$contacts->perPage() }}</td>
                <td class="border px-4 py-2">{{ $contact->name }}</td>
                <td class="border px-4 py-2">{{ $contact->email }}</td>
                <td class="border px-4 py-2">{{ $contact->message }}</td>
                <td class="border px-4 py-2">{{ $contact->created_at->format('d M Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $contacts->links() }}
    </div>
</div>
@endsection
