<x-layouts.public title="Detail Berita">

    {{-- Page Header --}}
    <section class="pt-24 pb-10 bg-gradient-to-br from-[#1e3a5f] to-[#2e86ab]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-white/60 text-sm mb-4">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors duration-200">Home</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('news.index') }}" class="hover:text-white transition-colors duration-200">News</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white/90 line-clamp-1">Detail Berita</span>
            </div>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            @isset($item)

                {{-- Article Card --}}
                <article class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">

                    {{-- Thumbnail --}}
                    @if($item->thumbnail)
                        <div class="aspect-video w-full overflow-hidden">
                            <img
                                src="{{ asset('storage/' . $item->thumbnail) }}"
                                alt="{{ $item->title }}"
                                class="w-full h-full object-cover"
                            >
                        </div>
                    @else
                        <div class="aspect-video w-full bg-gradient-to-br from-[#1e3a5f]/10 to-[#2e86ab]/20 flex items-center justify-center">
                            <svg class="w-16 h-16 text-[#2e86ab]/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                    @endif

                    {{-- Article Body --}}
                    <div class="p-6 sm:p-10">

                        {{-- Meta --}}
                        <div class="flex flex-wrap items-center gap-3 mb-4">
                            @if($item->category)
                                <span class="px-3 py-1 bg-[#f4a261] text-white text-xs font-bold rounded-full">
                                    {{ $item->category }}
                                </span>
                            @endif
                            <time class="text-sm text-gray-400 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $item->created_at->translatedFormat('d F Y') }}
                            </time>
                            @if($item->author)
                                <span class="text-sm text-gray-400 flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    {{ $item->author }}
                                </span>
                            @endif
                        </div>

                        {{-- Title --}}
                        <h1 class="text-2xl sm:text-3xl font-black text-[#1e3a5f] leading-tight mb-6">
                            {{ $item->title }}
                        </h1>

                        {{-- Divider --}}
                        <div class="w-16 h-1 bg-[#f4a261] rounded-full mb-8"></div>

                        {{-- Content --}}
                        <div class="prose prose-lg max-w-none
                                    prose-headings:text-[#1e3a5f] prose-headings:font-bold
                                    prose-a:text-[#2e86ab] prose-a:no-underline hover:prose-a:underline
                                    prose-img:rounded-xl prose-img:shadow-md
                                    prose-strong:text-[#1e3a5f]
                                    text-gray-600 leading-relaxed">
                            {!! $item->content !!}
                        </div>

                    </div>
                </article>

            @else

                {{-- Placeholder saat belum ada data (sebelum model dibuat) --}}
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">

                    {{-- Placeholder Thumbnail --}}
                    <div class="aspect-video w-full bg-gradient-to-br from-[#1e3a5f]/10 to-[#2e86ab]/20 flex items-center justify-center">
                        <div class="text-center text-gray-400">
                            <svg class="w-14 h-14 mx-auto mb-2 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                            <p class="text-sm opacity-60">Thumbnail Berita</p>
                        </div>
                    </div>

                    <div class="p-6 sm:p-10">

                        {{-- Meta placeholder --}}
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-3 py-1 bg-[#f4a261] text-white text-xs font-bold rounded-full">
                                Berita
                            </span>
                            <span class="text-sm text-gray-400">
                                {{ now()->translatedFormat('d F Y') }}
                            </span>
                        </div>

                        {{-- Title placeholder --}}
                        <h1 class="text-2xl sm:text-3xl font-black text-[#1e3a5f] leading-tight mb-4">
                            Judul Berita
                            <span class="text-gray-300 font-normal text-base ml-2">(slug: {{ $slug ?? '-' }})</span>
                        </h1>

                        <div class="w-16 h-1 bg-[#f4a261] rounded-full mb-8"></div>

                        {{-- Info box --}}
                        <div class="flex items-start gap-3 p-4 bg-[#2e86ab]/5 border border-[#2e86ab]/20 rounded-xl mb-6">
                            <svg class="w-5 h-5 text-[#2e86ab] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-[#1e3a5f] mb-1">Halaman dalam pengembangan</p>
                                <p class="text-sm text-gray-500">
                                    Konten berita akan tampil di sini setelah model <code class="bg-gray-100 px-1.5 py-0.5 rounded text-xs font-mono text-[#1e3a5f]">News</code>
                                    dan database selesai dikonfigurasi.
                                </p>
                            </div>
                        </div>

                        {{-- Content placeholder lines --}}
                        <div class="space-y-3">
                            <div class="h-4 bg-gray-100 rounded-full animate-pulse"></div>
                            <div class="h-4 bg-gray-100 rounded-full animate-pulse w-11/12"></div>
                            <div class="h-4 bg-gray-100 rounded-full animate-pulse w-4/5"></div>
                            <div class="h-4 bg-gray-100 rounded-full animate-pulse"></div>
                            <div class="h-4 bg-gray-100 rounded-full animate-pulse w-3/4"></div>
                        </div>

                    </div>
                </div>

            @endisset

            {{-- Back Button --}}
            <div class="mt-8">
                <a href="{{ route('news.index') }}"
                   class="inline-flex items-center gap-2 text-sm font-semibold text-[#1e3a5f] hover:text-[#2e86ab] transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                    </svg>
                    Kembali ke Daftar Berita
                </a>
            </div>

        </div>
    </section>

</x-layouts.public>
