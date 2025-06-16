@extends('admin.layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Tambah Kategori</h1>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Alert error --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Tambah Kategori --}}
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div id="category-inputs">
            <div class="flex flex-col md:flex-row md:space-x-2 mb-2 space-y-2 md:space-y-0">
                <input type="text" name="name[]" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Nama Kategori" required>

                <input type="file" name="image[]" accept="image/*" class="w-full md:w-auto border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500">

                <button type="button" onclick="addCategoryInput()" class="bg-gray-300 px-3 rounded text-sm">+</button>
            </div>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
    </form>
</div>

{{-- JavaScript untuk tambah dan hapus input kategori --}}
<script>
    function addCategoryInput() {
        const container = document.getElementById('category-inputs');
        const inputGroup = document.createElement('div');
        inputGroup.className = 'flex flex-col md:flex-row md:space-x-2 mb-2 space-y-2 md:space-y-0';
        inputGroup.innerHTML = `
            <input type="text" name="name[]" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Nama Kategori" required>
            <input type="file" name="image[]" accept="image/*" class="w-full md:w-auto border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <button type="button" onclick="this.parentElement.remove()" class="bg-red-300 px-3 rounded text-sm">-</button>
        `;
        container.appendChild(inputGroup);
    }
</script>
@endsection
