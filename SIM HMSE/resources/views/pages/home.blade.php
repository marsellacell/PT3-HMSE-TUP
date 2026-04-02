<x-layouts.public title="Beranda">

    {{-- ===================== HERO SECTION ===================== --}}
    <section
        id="hero"
        class="relative min-h-screen flex items-center justify-center overflow-hidden bg-[#1e3a5f]"
    >
        {{-- Background Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-br from-[#1e3a5f] via-[#1e3a5f]/95 to-[#2e86ab]/80 z-10"></div>

        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-5 z-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

        {{-- Decorative circles --}}
        <div class="absolute top-20 right-10 w-72 h-72 bg-[#2e86ab]/20 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-[#f4a261]/10 rounded-full blur-3xl z-0"></div>

        {{-- Hero Content --}}
        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-16">

            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 text-xs font-semibold px-4 py-2 rounded-full mb-8 animate-pulse">
                <span class="w-2 h-2 bg-[#f4a261] rounded-full"></span>
                Kabinet Zenith · {{ date('Y') }}
            </div>

            {{-- Main Title --}}
            <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-black text-white leading-tight tracking-tight mb-4">
                Himpunan Mahasiswa<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f4a261] to-[#fcd34d]">
                    Software Engineering
                </span>
            </h1>

            {{-- Subtitle --}}
            <p class="text-lg sm:text-xl text-white/70 font-medium mb-6">
                Telkom University Purwokerto
            </p>

            {{-- Short Description --}}
            <p class="text-white/60 text-base sm:text-lg max-w-2xl mx-auto leading-relaxed mb-12">
                Wadah pengembangan diri, kreativitas, dan profesionalisme mahasiswa Rekayasa Perangkat Lunak.
                Bersama kami, wujudkan potensi terbaikmu.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
                <a href="{{ route('about') }}"
                   class="px-8 py-3.5 bg-[#f4a261] hover:bg-[#e07d3a] text-white font-bold rounded-full transition-all duration-200 hover:shadow-lg hover:shadow-[#f4a261]/30 hover:-translate-y-0.5 text-sm sm:text-base">
                    Tentang Kami
                </a>
                <a href="{{ route('news.index') }}"
                   class="px-8 py-3.5 bg-white/10 hover:bg-white/20 border border-white/30 text-white font-semibold rounded-full backdrop-blur-sm transition-all duration-200 hover:-translate-y-0.5 text-sm sm:text-base">
                    Lihat Berita
                </a>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-6 max-w-lg mx-auto mb-16">
                <div class="text-center">
                    <p class="text-3xl font-black text-white">100+</p>
                    <p class="text-white/50 text-xs sm:text-sm mt-1">Anggota Aktif</p>
                </div>
                <div class="text-center border-x border-white/10">
                    <p class="text-3xl font-black text-white">20+</p>
                    <p class="text-white/50 text-xs sm:text-sm mt-1">Program Kerja</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-black text-white">5+</p>
                    <p class="text-white/50 text-xs sm:text-sm mt-1">Divisi Aktif</p>
                </div>
            </div>

            {{-- Scroll Down Arrow --}}
            <a href="#about"
               class="inline-flex flex-col items-center gap-2 text-white/40 hover:text-white/70 transition-colors duration-200 group">
                <span class="text-xs uppercase tracking-widest">Scroll</span>
                <div class="w-8 h-8 rounded-full border border-white/30 flex items-center justify-center group-hover:border-white/60 transition-colors duration-200 animate-bounce">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </a>

        </div>
    </section>

    {{-- ===================== ABOUT US SECTION ===================== --}}
    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                {{-- Kiri: Foto Dokumentasi --}}
                <div class="relative order-2 lg:order-1" data-aos="fade-right">
                    <div class="relative">
                        {{-- Main Image --}}
                        <div class="aspect-[4/3] bg-gradient-to-br from-[#1e3a5f]/10 to-[#2e86ab]/10 rounded-2xl overflow-hidden border border-gray-100 shadow-xl">
                            @if(isset($heroImage) && $heroImage)
                                <img src="{{ $heroImage }}" alt="Dokumentasi HMSE" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-16 h-16 mb-3 opacity-30" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                    </svg>
                                    <p class="text-sm opacity-50">Foto Dokumentasi</p>
                                </div>
                            @endif
                        </div>

                        {{-- Floating Badge --}}
                        <div class="absolute -bottom-5 -right-5 bg-[#f4a261] text-white px-5 py-3 rounded-xl shadow-lg">
                            <p class="font-black text-xl">{{ date('Y') }}</p>
                            <p class="text-xs font-medium opacity-80">Kabinet Zenith</p>
                        </div>

                        {{-- Decorative --}}
                        <div class="absolute -top-4 -left-4 w-24 h-24 bg-[#1e3a5f]/5 rounded-2xl -z-10"></div>
                    </div>
                </div>

                {{-- Kanan: Teks About --}}
                <div class="order-1 lg:order-2" data-aos="fade-left">
                    <span class="text-[#2e86ab] text-sm font-bold uppercase tracking-widest">Tentang Kami</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-[#1e3a5f] mt-2 mb-6 leading-tight">
                        About Us
                    </h2>

                    <div class="w-12 h-1 bg-[#f4a261] rounded-full mb-6"></div>

                    <div class="space-y-4 text-gray-600 text-justify leading-relaxed">
                        <p>
                            Himpunan Mahasiswa Software Engineering (HMSE) adalah organisasi kemahasiswaan
                            yang bernaung di bawah Program Studi Rekayasa Perangkat Lunak, Telkom University Purwokerto.
                            HMSE hadir sebagai wadah bagi mahasiswa untuk mengembangkan potensi akademik, non-akademik,
                            serta jiwa kepemimpinan dan profesionalisme.
                        </p>
                        <p>
                            Dengan semangat kolaborasi dan inovasi, HMSE aktif menyelenggarakan berbagai program kerja
                            mulai dari kegiatan edukasi, pelatihan teknis, kompetisi, hingga pengabdian masyarakat.
                            Kami percaya bahwa pengembangan soft skill dan hard skill harus berjalan beriringan
                            untuk mencetak lulusan yang kompeten dan berdaya saing.
                        </p>
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('about') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 bg-[#1e3a5f] hover:bg-[#2a4f80] text-white font-semibold rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-md hover:shadow-lg text-sm">
                            Selengkapnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===================== NEWS SECTION ===================== --}}
    <section id="news" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Header --}}
            <div class="text-center mb-12">
                <span class="text-[#2e86ab] text-sm font-bold uppercase tracking-widest">Informasi Terkini</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#1e3a5f] mt-2 mb-3">Berita & Kegiatan</h2>
                <div class="w-12 h-1 bg-[#f4a261] rounded-full mx-auto mb-4"></div>
                <p class="text-gray-500 max-w-xl mx-auto text-sm sm:text-base">
                    Tetap update dengan informasi terbaru seputar kegiatan dan program kerja HMSE.
                </p>
            </div>

            {{-- News Grid --}}
            @if(isset($news) && $news->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                    @foreach($news->take(3) as $item)
                        <article class="card group cursor-pointer">
                            {{-- Thumbnail 16:9 --}}
                            <div class="aspect-video bg-gradient-to-br from-[#1e3a5f]/10 to-[#2e86ab]/10 overflow-hidden">
                                @if($item->thumbnail)
                                    <img src="{{ Storage::url($item->thumbnail) }}"
                                         alt="{{ $item->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div class="p-5">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="badge badge-info text-xs">{{ $item->category ?? 'Berita' }}</span>
                                    <span class="text-gray-400 text-xs">{{ $item->created_at->format('d M Y') }}</span>
                                </div>
                                <h3 class="font-bold text-[#1e3a5f] text-base leading-snug mb-2 group-hover:text-[#2e86ab] transition-colors duration-200 line-clamp-2">
                                    {{ $item->title }}
                                </h3>
                                <p class="text-gray-500 text-sm leading-relaxed line-clamp-3">
                                    {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 100) }}
                                </p>
                                <a href="{{ route('news.show', $item->slug) }}"
                                   class="inline-flex items-center gap-1 text-[#2e86ab] text-sm font-semibold mt-4 hover:gap-2 transition-all duration-200">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                {{-- Empty State --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                    @for($i = 0; $i < 3; $i++)
                        <div class="card">
                            <div class="aspect-video bg-gradient-to-br from-[#1e3a5f]/5 to-[#2e86ab]/5 animate-pulse"></div>
                            <div class="p-5 space-y-3">
                                <div class="h-3 bg-gray-200 rounded animate-pulse w-1/3"></div>
                                <div class="h-4 bg-gray-200 rounded animate-pulse"></div>
                                <div class="h-4 bg-gray-200 rounded animate-pulse w-4/5"></div>
                                <div class="h-3 bg-gray-100 rounded animate-pulse"></div>
                                <div class="h-3 bg-gray-100 rounded animate-pulse w-3/4"></div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif

            {{-- View All Button --}}
            <div class="text-center">
                <a href="{{ route('news.index') }}"
                   class="inline-flex items-center gap-2 px-8 py-3 border-2 border-[#1e3a5f] text-[#1e3a5f] font-semibold rounded-xl hover:bg-[#1e3a5f] hover:text-white transition-all duration-200 text-sm">
                    Lihat Semua Berita
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

        </div>
    </section>

    {{-- ===================== GALLERY SECTION ===================== --}}
    <section id="gallery" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Header --}}
            <div class="text-center mb-12">
                <span class="text-[#2e86ab] text-sm font-bold uppercase tracking-widest">Dokumentasi</span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#1e3a5f] mt-2 mb-3">Galeri Kegiatan</h2>
                <div class="w-12 h-1 bg-[#f4a261] rounded-full mx-auto"></div>
            </div>

            {{-- Gallery Grid --}}
            @if(isset($gallery) && $gallery->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                    @foreach($gallery->take(8) as $item)
                        <div class="group relative aspect-square overflow-hidden rounded-xl cursor-pointer bg-gray-100"
                             x-data="{ show: false }"
                             @click="show = true">
                            <img src="{{ Storage::url($item->image) }}"
                                 alt="{{ $item->caption ?? 'Dokumentasi HMSE' }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-[#1e3a5f]/0 group-hover:bg-[#1e3a5f]/50 transition-all duration-300 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Empty State Gallery --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                    @for($i = 0; $i < 8; $i++)
                        <div class="aspect-square rounded-xl bg-gradient-to-br from-[#1e3a5f]/5 to-[#2e86ab]/5 animate-pulse"></div>
                    @endfor
                </div>
            @endif

        </div>
    </section>

</x-layouts.public>
