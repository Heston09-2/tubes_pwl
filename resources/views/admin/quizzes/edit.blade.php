@extends('admin.layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Edit Kuis</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.quizzes.update', $quiz->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 text-sm font-medium">Judul Kuis</label>
            <input type="text" name="title" value="{{ old('title', $quiz->title) }}" class="w-full border-gray-300 rounded shadow-sm" required>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium">Kategori</label>
            <select name="category_id" id="category" class="w-full border-gray-300 rounded" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $quiz->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

    

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Perbarui</button>
    </form>
</div>

<script>
    document.getElementById('category').addEventListener('change', function () {
        fetch(`/admin/categories/${this.value}/subcategories`)
            .then(response => response.json())
            .then(data => {
                const subcategory = document.getElementById('subcategory');
                subcategory.innerHTML = '';
                data.forEach(sub => {
                    const option = document.createElement('option');
                    option.value = sub.id;
                    option.textContent = sub.name;
                    subcategory.appendChild(option);
                });
            });
    });
</script>
@endsection
