@extends('pelajar.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-8 p-6 bg-white shadow-xl rounded-3xl">
     <div class="mb-4">
        <a href="{{ route('pelajar.forum.index') }}" class="inline-flex items-center text-sm text-blue-600 hover:underline">
            ← Kembali ke Forum
        </a>
    </div>
    {{-- Judul Forum --}}
    <h1 class="text-3xl font-bold text-slate-800 mb-2">{{ $forum->title }}</h1>
    <p class="text-gray-500 text-sm mb-4">Oleh <span class="font-medium">{{ $forum->pelajar->name ?? 'Anonim' }}</span> · {{ $forum->created_at->diffForHumans() }}</p>
    
    <p class="text-gray-700 leading-relaxed mb-4">{{ $forum->description }}</p>

    @if ($forum->image)
        <img src="{{ asset('storage/' . $forum->image) }}" class="mb-6 rounded-xl shadow max-h-96 object-cover w-full">
    @endif

    {{-- Komentar Form --}}
    <div class="mt-8 pt-6 border-t">
        <h2 class="text-xl font-semibold mb-2 text-slate-800">Tulis Komentar</h2>

        <form action="{{ route('pelajar.forum.comment', $forum) }}" method="POST" class="space-y-2">
            @csrf
            <textarea name="content" rows="3" class="w-full p-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Tulis komentar kamu..." required></textarea>
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition shadow-md">
                Kirim Komentar
            </button>
        </form>
    </div>

   
<div class="mt-10">
    <h2 class="text-xl font-semibold mb-4 text-slate-800">Komentar</h2>

    <div id="comment-container">
       @forelse ($comments as $index => $comment)
<div class="border-t py-5 flex items-start gap-4 comment-item {{ $index >= 3 ? 'hidden' : '' }}" id="comment-{{ $comment->id }}">
    {{-- Avatar --}}
    <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">
        {{ strtoupper(substr($comment->pelajar->name ?? 'P', 0, 1)) }}
    </div>

    {{-- Isi Komentar --}}
    <div class="flex-1">
        <div class="text-sm font-semibold text-gray-800">{{ $comment->pelajar->name ?? 'Anonim' }}</div>
        
        {{-- Tampilan komentar --}}
        <p id="comment-text-{{ $comment->id }}" class="mt-1 text-gray-700">{{ $comment->content }}</p>

        {{-- Form Edit --}}
        <div id="edit-form-{{ $comment->id }}" class="hidden mt-2">
            <textarea id="edit-content-{{ $comment->id }}" class="w-full p-2 border rounded">{{ $comment->content }}</textarea>
            <div class="flex gap-3 mt-1">
                <button onclick="submitEdit({{ $comment->id }}, {{ $forum->id }})" class="text-green-600 text-sm hover:underline">Simpan</button>
                <button onclick="cancelEdit({{ $comment->id }})" class="text-gray-500 text-sm hover:underline">Batal</button>
            </div>
        </div>

        <p class="text-xs text-gray-500 mt-1">{{ $comment->created_at->diffForHumans() }}</p>

        {{-- Tombol jika milik sendiri --}}
        @if ($comment->pelajar_id === auth('pelajar')->id())
        <div class="mt-1 text-sm flex gap-4">
            <button onclick="startEdit({{ $comment->id }})" class="text-blue-600 hover:underline">Edit</button>
            <form action="{{ route('pelajar.forum.comments.destroy', [$forum->id, $comment->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
            </form>
        </div>
        @endif
    </div>
</div>
@empty
<p class="text-gray-500">Belum ada komentar.</p>
@endforelse

    </div>

    @if ($comments->count() > 3)
    <div class="text-center mt-4">
        <button id="show-more-btn" onclick="showMoreComments()" class="text-blue-600 hover:underline flex items-center gap-1 mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            Tampilkan lebih banyak komentar
        </button>
    </div>
    @endif
</div>

</div>
@endsection

@push('scripts')
<script>
function startEdit(id) {
    document.getElementById('comment-text-' + id).style.display = 'none';
    document.getElementById('edit-form-' + id).style.display = 'block';
}

function cancelEdit(id) {
    document.getElementById('comment-text-' + id).style.display = 'block';
    document.getElementById('edit-form-' + id).style.display = 'none';
}

function submitEdit(id, forumId) {
    const content = document.getElementById('edit-content-' + id).value;

    fetch(`/pelajar/forum/${forumId}/comments/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        body: JSON.stringify({ content })
    })
    .then(response => {
        if (!response.ok) throw new Error("Gagal menyimpan komentar");
        return response.json();
    })
    .then(data => {
        document.getElementById('comment-text-' + id).innerText = data.content;
        cancelEdit(id);
    })
    .catch(error => alert(error.message));
}

let shownComments = 3;
const totalComments = document.querySelectorAll('.comment-item').length;

function showMoreComments() {
    const items = document.querySelectorAll('.comment-item');
    const next = shownComments + 3;

    for (let i = shownComments; i < next && i < totalComments; i++) {
        items[i].classList.remove('hidden');
    }

    shownComments = next;

    if (shownComments >= totalComments) {
        document.getElementById('show-more-btn').style.display = 'none';
    }
}

</script>
@endpush
