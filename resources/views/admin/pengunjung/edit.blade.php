@extends('admin.layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Data Pengunjung</h2>

    <form action="{{ route('admin.pengunjung.update', $data->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-medium mb-1">Tanggal:</label>
            <input type="date" name="tanggal" value="{{ $data->tanggal }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Jumlah Pengunjung:</label>
            <input type="number" name="jumlah" value="{{ $data->jumlah }}" min="1"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Catatan:</label>
            <textarea name="catatan" rows="4"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $data->catatan }}</textarea>
        </div>

        <div class="text-right">
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-all duration-200">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
