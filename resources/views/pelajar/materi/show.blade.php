@extends('pelajar.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/20 overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-sky-600 to-blue-700 p-8 text-white relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-sky-600/90 to-blue-700/90"></div>
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
                
                <div class="relative z-10">
                    <h1 class="text-3xl sm:text-4xl font-bold mb-4 leading-tight">{{ $material->title }}</h1>
                    
                    <!-- Meta Information -->
                    <div class="flex flex-wrap items-center gap-4 text-blue-100">
                        <div class="flex items-center gap-2 bg-white/20 px-3 py-1 rounded-full">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                            </svg>
                            <span class="text-sm font-medium">{{ $material->category->name }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/20 px-3 py-1 rounded-full">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm font-medium">{{ $material->subcategory->name }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/20 px-3 py-1 rounded-full">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm font-medium">{{ $material->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <!-- Image Section -->
                @if ($material->image)
                <div class="mb-10 -mx-8">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('storage/' . $material->image) }}" alt="{{ $material->title }}"
                            class="w-full h-64 sm:h-80 lg:h-96 object-cover transition-transform duration-500 hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                </div>
                @endif

                <!-- Content Section -->
                <div class="mb-12">
                    <div class="prose prose-lg max-w-none prose-slate text-justify leading-relaxed">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-6 rounded-r-xl mb-8 shadow-sm">
                            <div class="text-gray-800 space-y-4">
                                {!! nl2br(e($material->content)) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Section -->
                <div class="flex items-center justify-between mb-10 p-6 bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl border border-gray-200">
                    <!-- Save Button -->
                    <form action="{{ route('pelajar.materi.like', $material->id) }}" method="POST" id="simpan">
                        @csrf
                        <button type="submit"
                            class="group flex items-center gap-3 px-6 py-3 rounded-full transition-all duration-300 {{ $material->likes->where('user_id', auth()->id())->count() ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/25' : 'bg-white text-blue-600 border-2 border-blue-200 hover:border-blue-400' }}">
                            <span class="text-xl group-hover:scale-110 transition-transform duration-200">
                                @if($material->likes->where('user_id', auth()->id())->count())
                                    💙
                                @else
                                    🤍
                                @endif
                            </span>
                            <span class="font-semibold">
                                @if($material->likes->where('user_id', auth()->id())->count())
                                    Disimpan
                                @else
                                    Simpan
                                @endif
                            </span>
                            <span class="bg-white/20 px-2 py-1 rounded-full text-sm font-medium">
                                {{ $material->likes->count() }}
                            </span>
                        </button>
                    </form>

                    <!-- Back Button -->
                    <a href="{{ session('previous_url', route('pelajar.home')) }}"
                        class="flex items-center gap-2 px-6 py-3 text-gray-600 hover:text-sky-600 transition-colors duration-300 font-medium">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Daftar Materi
                    </a>
                </div>

                <!-- Comments Section -->
                <div id="komentar" class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl p-8 border border-gray-200">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-8 h-8 bg-sky-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            Komentar 
                            <span class="text-sky-600">({{ $material->comments->count() }})</span>
                        </h2>
                    </div>

                    <!-- Comment Form -->
                    <form action="{{ route('pelajar.materi.komentar', $material->id) }}" method="POST" class="mb-8">
                        @csrf
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                            <textarea name="content" rows="4"
                                class="w-full border-2 border-gray-200 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent resize-none transition-all duration-300"
                                placeholder="Bagikan pemikiran atau pertanyaan Anda tentang materi ini..."></textarea>
                            <div class="flex justify-end mt-4">
                                <button type="submit"
                                    class="bg-gradient-to-r from-sky-500 to-blue-600 text-white px-8 py-3 rounded-xl font-semibold hover:from-sky-600 hover:to-blue-700 transition-all duration-300 shadow-lg shadow-sky-500/25 hover:shadow-xl hover:shadow-sky-500/30 transform hover:-translate-y-0.5">
                                    Kirim Komentar
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Comments List -->
                    <div class="space-y-6">
                        @forelse ($material->comments as $comment)
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-sky-400 to-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-semibold text-sm">
                                        {{ substr($comment->pelajar->name ?? 'P', 0, 1) }}
                                    </span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h4 class="font-semibold text-sky-700">{{ $comment->pelajar->name ?? 'Pelajar tidak ditemukan' }}</h4>
                                        <span class="text-gray-400 text-sm">•</span>
                                        <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed">{{ $comment->content }}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 text-lg">Belum ada komentar pada materi ini.</p>
                            <p class="text-gray-400 text-sm mt-1">Jadilah yang pertama berkomentar!</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection