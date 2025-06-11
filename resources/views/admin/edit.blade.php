@extends('admin.layouts.app')

@section('title', 'Edit Data')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto max-w-2xl px-4">

        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Edit Data</h2>
            <p class="text-gray-600">Silakan ubah data di bawah ini</p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg mb-6 shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <form action="{{ route('admin.update', $artwork->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                <!-- Nama -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('name', $artwork->name) }}">
                </div>

                <!-- Kategori -->
                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <input type="text" name="category" id="category" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('category', $artwork->category) }}">
                </div>

                <!-- Pembuat -->
                <div>
                    <label for="creator" class="block text-sm font-semibold text-gray-700 mb-2">Pembuat <span class="text-red-500">*</span></label>
                    <input type="text" name="creator" id="creator" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('creator', $artwork->creator) }}">
                </div>

                <!-- Tahun (nullable, tidak wajib) -->
                <div>
                    <label for="year" class="block text-sm font-semibold text-gray-700 mb-2">Tahun (Kosongkan jika tidak ingin diubah)</label>
                    <input type="number" name="year" id="year" min="1000" max="{{ date('Y') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('year', $artwork->year) }}">
                </div>

                <!-- Asal -->
                <div>
                    <label for="origin" class="block text-sm font-semibold text-gray-700 mb-2">Asal <span class="text-red-500">*</span></label>
                    <input type="text" name="origin" id="origin" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('origin', $artwork->origin) }}">
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-vertical">{{ old('description', $artwork->description) }}</textarea>
                </div>

                <!-- Gambar -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Gambar</label>
                    <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)"
                        class="block w-full text-sm text-gray-600">
                    @if($artwork->image)
                        <img src="{{ asset('storage/images/' . $artwork->image) }}" alt="Gambar lama" class="mt-4 h-32 w-32 object-cover rounded-lg border border-gray-300">
                    @endif
                    <div id="imagePreview" class="mt-4 hidden">
                        <img id="preview" class="h-32 w-32 object-cover rounded-lg border border-gray-300" alt="Preview Gambar">
                    </div>
                </div>

                <!-- Tombol aksi -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.show') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 font-medium">Batal</a>
                    <form action="{{ route('admin.update', $artwork->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <!-- input fields -->
    <button type="submit">Update</button>
</form>

                </div>
            </form>
        </div>

    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');

    const file = event.target.files[0];
    if (!file) {
        previewContainer.classList.add('hidden');
        preview.src = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        preview.src = e.target.result;
        previewContainer.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}
</script>
@endsection
