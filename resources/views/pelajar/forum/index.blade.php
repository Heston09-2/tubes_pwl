@extends('pelajar.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-slate-100">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                    Forum Diskusi Pelajar
                </h1>
                <p class="text-slate-600 mt-1">Berbagi ide dan diskusi bersama teman-teman</p>
            </div>
            <a href="{{ route('pelajar.forum.create') }}" 
               class="group px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center gap-2">
                <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                Buat Topik Baru
            </a>
        </div>

        @forelse ($forums as $forum)
            <div class="bg-white/70 backdrop-blur-sm border border-blue-100/50 rounded-2xl shadow-lg hover:shadow-xl mb-6 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                {{-- Header --}}
                <div class="flex items-center px-6 py-4 bg-gradient-to-r from-blue-50/50 to-transparent border-b border-blue-100/30">
                    <div class="relative">
                        <img src="{{ asset('images/avatar.png') }}" 
                             class="w-12 h-12 rounded-full object-cover ring-3 ring-blue-200/50 shadow-md" 
                             alt="Avatar">
                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-4">
                        <div class="font-semibold text-slate-800">{{ $forum->pelajar->name ?? 'Anonim' }}</div>
                        <div class="text-sm text-slate-500 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            {{ $forum->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>

                {{-- Body --}}
                <div class="px-6 py-5">
                    <h2 class="text-xl font-bold text-slate-900 mb-3 hover:text-blue-700 transition-colors cursor-pointer">
                        {{ $forum->title }}
                    </h2>
                    <p class="text-slate-700 mb-4 leading-relaxed">{{ $forum->description }}</p>

                    @if ($forum->image)
                        <div class="relative group mb-4">
                            <img src="{{ asset('storage/' . $forum->image) }}" 
                                 alt="Gambar Forum" 
                                 class="w-full max-h-80 object-cover rounded-xl shadow-md group-hover:shadow-lg transition-shadow">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-xl"></div>
                        </div>
                    @endif
                </div>

                {{-- Footer --}}
                <div class="flex items-center justify-between px-6 py-4 border-t border-blue-100/30 bg-slate-50/50">
                    <div class="flex items-center gap-8 text-slate-600 text-sm">
                        <button class="group flex items-center gap-2 hover:text-blue-600 transition-colors duration-200 py-1 px-2 rounded-lg hover:bg-blue-50">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 class="h-5 w-5 fill-current group-hover:scale-110 transition-transform" 
                                 viewBox="0 0 20 20">
                                <path d="M3 10a7 7 0 1014 0 7 7 0 10-14 0zm8-4v3h2l-3 3-3-3h2V6h2z"/>
                            </svg>
                            <span class="font-medium">Suka</span>
                        </button>

                        <a href="{{ route('pelajar.forum.show', $forum) }}" 
                           class="group flex items-center gap-2 hover:text-blue-600 transition-colors duration-200 py-1 px-2 rounded-lg hover:bg-blue-50">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 class="h-5 w-5 fill-current group-hover:scale-110 transition-transform" 
                                 viewBox="0 0 20 20">
                                <path d="M18 10c0 3.866-3.582 7-8 7a8.962 8.962 0 01-4.9-1.5L2 17l1.5-3.1A7.966 7.966 0 012 10c0-3.866 3.582-7 8-7s8 3.134 8 7z"/>
                            </svg>
                            <span class="font-medium">Komentar</span>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16">
                <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-700 mb-2">Belum ada diskusi</h3>
                <p class="text-slate-500 mb-6">Ayo buat topik pertama kamu dan mulai diskusi menarik!</p>
                <a href="{{ route('pelajar.forum.create') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Mulai Diskusi Pertama
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection