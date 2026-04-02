<x-layouts.public title="News">

    {{-- Page Header --}}
    <section class="pt-24 pb-10 bg-gradient-to-br from-[#1e3a5f] to-[#2e86ab]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl font-bold text-white mb-3">Berita & Informasi</h1>
            <p class="text-white/70 text-base max-w-xl mx-auto">
                Ikuti perkembangan terbaru seputar kegiatan dan program kerja HMSE
            </p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Search & Filter Bar --}}
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 mb-10">

                {{-- Total Info --}}
                <p class="text-sm text-gray-500">
                    Menampilkan <span class="font-semibold text-[#1e3a5f]">{{ $news->total() }}</span> berita
                </p>

                {{-- Search --}}
                <form method="GET" action="{{ route('news.index') }}" class="flex items-center gap-2">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                        </svg>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari berita..."
                            class="pl-10 pr-4 py-2.5 w-64 text-sm border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-[#2e86ab] focus:ring-2 focus:ring-[#2e86ab]/20 transition-all duration-200"
                        >
                    </div>
                    <button type="submit"
                        class="px-4 py-2.5 bg-[#1e3a5f] text-white text-sm font-semibold rounded-lg hover:bg-[#2a4f80] transition-colors duration-200">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('news.index') }}"
                           class="px-4 py-2.5 bg-gray-100 text-gray-600 text-sm font-semibold rounded-lg hover:bg-gray-200 transition-colors duration-200">
                            Reset
                        </a>
                    @endif
                </form>

            </div>

            {{-- Search Result Info --}}
            @if(request('search'))
                <div class="mb-6 px-4 py-3 bg-[#2e86ab]/10 border border-[#2e86ab]/20 rounded-lg text-sm text-[#1e3a5f]">
                    Hasil pencarian untuk: <span class="font-semibold">"{{ request('search') }}"</span>
                    — ditemukan <span class="font-semibold">{{ $news->total() }}</span> berita
                </div>
            @endif

            @if($news->isNotEmpty())

                {{-- News Grid (max 3 rows × 3 cols = 9 per page) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($news as $item)
                        <article class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col">

                            {{-- Thumbnail 16:9 --}}
                            <a href="{{ route('news.show', $item->slug) }}" class="block relative overflow-hidden">
                                <div class="aspect-video bg-gray-100">
                                    @if($item->thumbnail)
                                        <img
                                            src="{{ asset('storage/' . $item->thumbnail) }}"
                                            alt="{{ $item->title }}"
                                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                            loading="lazy"
                                        >
                                    @else
                                        {{-- Placeholder --}}
                                        <div class="w-full h-full bg-gradient-to-br from-[#1e3a5f]/10 to-[#2e86ab]/20 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-[#2e86ab]/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                {{-- Category Badge --}}
                                @if($item->category)
                                    <span class="absolute top-3 left-3 px-2.5 py-1 bg-[#f4a261] text-white text-xs font-bold rounded-full shadow-sm">
                                        {{ $item->category }}
                                    </span>
                                @endif
                            </a>

                            {{-- Content --}}
                            <div class="p-5 flex flex-col flex-1">

                                {{-- Meta --}}
                                <div class="flex items-center gap-3 mb-3">
                                    <time class="text-xs text-gray-400 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $item->created_at->translatedFormat('d M Y') }}
                                    </time>
                                    @if($item->author)
                                        <span class="text-gray-300">•</span>
                                        <span class="text-xs text-gray-400">{{ $item->author }}</span>
                                    @endif
                                </div>

                                {{-- Title --}}
                                <h2 class="text-base font-bold text-[#1e3a5f] leading-snug mb-2 line-clamp-2 flex-1">
                                    <a href="{{ route('news.show', $item->slug) }}" class="hover:text-[#2e86ab] transition-colors duration-200">
                                        {{ $item->title }}
                                    </a>
                                </h2>

                                {{-- Excerpt --}}
                                <p class="text-sm text-gray-500 leading-relaxed line-clamp-2 mb-4">
                                    {{ $item->excerpt ?? Str::limit(strip_tags($item->content ?? ''), 100) }}
                                </p>

                                {{-- Read More --}}
                                <a href="{{ route('news.show', $item->slug) }}"
                                   class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#2e86ab] hover:text-[#1e3a5f] transition-colors duration-200 mt-auto">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>

                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($news->hasPages())
                    <div class="mt-10 flex justify-center">
                        {{ $news->appends(request()->query())->links('vendor.pagination.custom') }}
                    </div>
                @endif

            @else
                {{-- Empty State --}}
                <div class="flex flex-col items-center justify-center py-24 text-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">
                        @if(request('search'))
                            Berita tidak ditemukan
                        @else
                            Belum ada berita
                        @endif
                    </h3>
                    <p class="text-sm text-gray-400">
                        @if(request('search'))
                            Coba gunakan kata kunci yang berbeda
                        @else
                            Berita akan segera ditambahkan
                        @endif
                    </p>
                    @if(request('search'))
                        <a href="{{ route('news.index') }}"
                           class="mt-4 px-4 py-2 bg-[#1e3a5f] text-white text-sm font-semibold rounded-lg hover:bg-[#2a4f80] transition-colors duration-200">
                            Lihat Semua Berita
                        </a>
                    @endif
                </div>
            @endif

        </div>
    </section>

</x-layouts.public>
