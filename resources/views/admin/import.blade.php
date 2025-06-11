@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto max-w-lg p-6">
    <h2 class="text-2xl font-semibold mb-6">Upload Data</h2>

    {{-- Pesan Sukses --}}
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan Error --}}
    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- Form Upload File Excel --}}
    <form action="{{ route('artworks.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label for="file" class="block mb-2 font-medium text-gray-700">Pilih File Excel/CSV</label>
            <input type="file" name="file" id="file" accept=".xlsx, .csv" required
                class="block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-lg file:border-0
                file:text-sm file:font-semibold
                file:bg-blue-50 file:text-blue-700
                hover:file:bg-blue-100
                cursor-pointer
                "/>
        </div>
        <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded shadow-lg hover:bg-gray-900 transition">
    Upload
</button>
    </form>
</div>
@endsection
