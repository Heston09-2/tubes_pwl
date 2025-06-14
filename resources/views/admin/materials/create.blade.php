@extends('admin.layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Tambah Materi</h1>

    <a href="{{ route('admin.categories.create') }}" class="text-blue-600 hover:underline mr-4">+ Tambah Kategori</a>
    <a href="{{ route('admin.subcategories.create') }}" class="text-blue-600 hover:underline">+ Tambah Subkategori</a>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div id="material-inputs">
            <div class="material-item border p-4 rounded mb-4 bg-gray-50 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Materi</label>
                    <input type="text" name="title[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category_id[]" class="category-select mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Subkategori</label>
                    <select name="subcategory_id[]" class="subcategory-select mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">Pilih Subkategori</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Konten Materi</label>
                    <textarea name="content[]" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Gambar (opsional)</label>
                    <input type="file" name="image[]" class="mt-1 block w-full text-sm text-gray-700">
                </div>

                <button type="button" onclick="this.closest('.material-item').remove()" class="text-red-600 text-sm hover:underline">Hapus Materi Ini</button>
            </div>
        </div>

        <button type="button" onclick="addMaterialInput()" class="text-blue-600 hover:underline mb-6">+ Tambah Materi Lain</button>

        <div class="text-right">
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow">
                Simpan Semua Materi
            </button>
        </div>
    </form>
</div>

<script>
function addMaterialInput() {
    const container = document.getElementById('material-inputs');
    const item = document.createElement('div');
    item.className = "material-item border p-4 rounded mb-4 bg-gray-50 space-y-4";
    item.innerHTML = `
        <div>
            <label class="block text-sm font-medium text-gray-700">Judul Materi</label>
            <input type="text" name="title[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="category_id[]" class="category-select mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Subkategori</label>
            <select name="subcategory_id[]" class="subcategory-select mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">Pilih Subkategori</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Konten Materi</label>
            <textarea name="content[]" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Gambar (opsional)</label>
            <input type="file" name="image[]" class="mt-1 block w-full text-sm text-gray-700">
        </div>

        <button type="button" onclick="this.closest('.material-item').remove()" class="text-red-600 text-sm hover:underline">Hapus Materi Ini</button>
    `;
    container.appendChild(item);
}

// Dynamic load subcategories
document.addEventListener('change', function (e) {
    if (e.target && e.target.classList.contains('category-select')) {
        const categorySelect = e.target;
        const subcategorySelect = categorySelect.closest('.material-item').querySelector('.subcategory-select');
        const categoryId = categorySelect.value;

        subcategorySelect.innerHTML = '<option value="">Memuat subkategori...</option>';

        if (categoryId) {
            fetch(`/admin/categories/${categoryId}/subcategories`)
                .then(response => response.json())
                .then(data => {
                    let options = '<option value="">Pilih Subkategori</option>';
                    data.forEach(subcat => {
                        options += `<option value="${subcat.id}">${subcat.name}</option>`;
                    });
                    subcategorySelect.innerHTML = options;
                })
                .catch(() => {
                    subcategorySelect.innerHTML = '<option value="">Gagal memuat subkategori</option>';
                });
        } else {
            subcategorySelect.innerHTML = '<option value="">Pilih Subkategori</option>';
        }
    }
});
</script>
@endsection
