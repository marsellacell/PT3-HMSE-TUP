<x-layouts.public title="About Us">

    {{-- Hero Section --}}
    <section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden pt-16">

        {{-- Background --}}
        <div class="absolute inset-0 bg-[#1e3a5f]">
            <div class="absolute inset-0 bg-[url('/images/about-hero-bg.jpg')] bg-cover bg-center opacity-20"></div>
            <div class="absolute inset-0 backdrop-blur-sm bg-[#1e3a5f]/60"></div>
        </div>

        {{-- Decorative circles --}}
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-[#2e86ab]/20 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-[#f4a261]/10 blur-3xl"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <span class="inline-block px-4 py-1.5 bg-[#f4a261]/20 text-[#f4a261] text-sm font-semibold rounded-full mb-6 tracking-wide uppercase">
                Mengenal Kami
            </span>
            <h1 class="text-4xl sm:text-5xl font-black text-white leading-tight mb-6">
                Tentang <span class="text-[#f4a261]">HMSE</span>
            </h1>
            <p class="text-white/80 text-lg leading-relaxed text-justify max-w-3xl mx-auto">
                Himpunan Mahasiswa Software Engineering (HMSE) adalah organisasi kemahasiswaan di bawah Program Studi
                Rekayasa Perangkat Lunak, Telkom University Purwokerto. HMSE hadir sebagai wadah pengembangan diri,
                kreativitas, dan profesionalisme bagi seluruh mahasiswa RPL dalam bidang teknologi, kepemimpinan,
                dan pengabdian kepada masyarakat.
            </p>
        </div>
    </section>

    {{-- Kabinet Zenith Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Header --}}
            <div class="text-center mb-14">
                <span class="inline-block px-4 py-1.5 bg-[#1e3a5f]/10 text-[#1e3a5f] text-sm font-semibold rounded-full mb-4 tracking-wide uppercase">
                    Periode 2025/2026
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#1e3a5f] mb-3">Kabinet <span class="text-[#f4a261]">Zenith</span></h2>
                <div class="w-16 h-1.5 bg-[#f4a261] rounded-full mx-auto mb-6"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                {{-- Logo & Filosofi --}}
                <div class="flex flex-col items-center lg:items-start text-center lg:text-left">
                    <div class="w-48 h-48 rounded-3xl bg-white flex items-center justify-center shadow-2xl mb-8 mx-auto lg:mx-0 p-4">
                        <img src="{{ asset('images/logo-zenit.png') }}" alt="Logo Zenith" class="w-full h-full object-contain">
                    </div>
                    <h3 class="text-2xl font-bold text-[#1e3a5f] mb-4">Filosofi Kabinet</h3>
                    <p class="text-gray-600 leading-relaxed text-justify">
                        Kabinet Zenith mengusung filosofi perjalanan kolektif menuju titik tertinggi potensi, dimana setiap individu dan elemen organisasi didorong untuk terus bertumbuh, berkembang, dan melampaui batas dirinya. Dengan menjunjing tinggi kolaborasi, progres berkelanjutan, serta visi yang jelas dan berdampak, Kabinet Zenith percaya bahwa setiap langkah kecil dalam proses pertumbuhan adalah fondasi menuju pencapaian yang lebih besar. Melalui semangat kebersamaan dan dedikasi untuk memberikan yang terbaik, kabinet ini hadir sebagai wadah yang tidak hanya mencetak perkembangan, tetapi juga melahirkan keunggulan. <strong class="text-[#1e3a5f]">From Growth to Greatness.</strong>
                    </p>
                </div>

                {{-- Visi & Misi --}}
                <div class="space-y-6">

                    {{-- Visi --}}
                    <div class="bg-gradient-to-br from-[#1e3a5f] to-[#2e86ab] rounded-2xl p-6 text-white shadow-lg">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-[#f4a261]" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-white">Visi</h4>
                        </div>
                        <p class="text-white/85 leading-relaxed text-justify text-sm">
                            Mewujudkan organisasi sebagai ruang bertumbuh yang progresif dan kolaboratif, hingga mencapai kebermanfaatan dan pencapaian yang unggul bersama.
                        </p>
                    </div>

                    {{-- Misi --}}
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 shadow-sm">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-[#1e3a5f]/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-[#1e3a5f]" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-[#1e3a5f]">Misi</h4>
                        </div>
                        <ul class="space-y-3">
                            @foreach([
                                'Menciptakan ruang pengembangan diri yang inklusif dan suportif.',
                                'Mengoptimalkan potensi menjadi prestasi nyata.',
                                'Membangun budaya disiplin dan kolaborasi.',
                                'Menghadirkan inovasi yang relevan dan solutif.',
                                'Menciptakan tata kelola yang profesional dan berintegritas.',
                            ] as $index => $misi)
                            <li class="flex items-start gap-3">
                                <span class="flex-shrink-0 w-6 h-6 rounded-full bg-[#f4a261] text-white text-xs font-bold flex items-center justify-center mt-0.5">
                                    {{ $index + 1 }}
                                </span>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $misi }}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- Struktur Organisasi --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14">
                <span class="inline-block px-4 py-1.5 bg-[#1e3a5f]/10 text-[#1e3a5f] text-sm font-semibold rounded-full mb-4 tracking-wide uppercase">
                    Organisasi
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#1e3a5f] mb-3">Struktur <span class="text-[#f4a261]">Organisasi</span></h2>
                <div class="w-16 h-1.5 bg-[#f4a261] rounded-full mx-auto"></div>
            </div>

            {{-- Bagan Organisasi --}}
            <div class="flex flex-col items-center gap-4 mb-16">

                {{-- Level 1: Pembina & Kaprodi --}}
                <div class="flex flex-wrap justify-center gap-4">
                    <div class="bg-white border-2 border-[#1e3a5f]/20 rounded-xl px-6 py-3 text-center shadow-sm">
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Pembina</p>
                    </div>
                    <div class="bg-white border-2 border-[#1e3a5f]/20 rounded-xl px-6 py-3 text-center shadow-sm">
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Kaprodi</p>
                    </div>
                </div>

                {{-- Connector --}}
                <div class="w-0.5 h-6 bg-[#1e3a5f]/30"></div>

                {{-- Level 2: Ketua --}}
                <div class="bg-gradient-to-br from-[#1e3a5f] to-[#2e86ab] text-white rounded-2xl px-8 py-4 text-center shadow-lg">
                    <p class="text-xs uppercase tracking-widest text-white/70 font-medium mb-1">Pimpinan Umum</p>
                    <p class="text-base font-bold">Ketua & Wakil Ketua</p>
                </div>

                {{-- Connector --}}
                <div class="w-0.5 h-6 bg-[#1e3a5f]/30"></div>

                {{-- Level 3: Sekretaris & Bendahara --}}
                <div class="flex flex-wrap justify-center gap-4">
                    @foreach(['Sekretaris', 'Bendahara'] as $jabatan)
                    <div class="bg-white border-2 border-[#2e86ab]/30 rounded-xl px-6 py-3 text-center shadow-sm">
                        <p class="text-xs text-[#2e86ab] uppercase tracking-wide font-semibold">{{ $jabatan }}</p>
                    </div>
                    @endforeach
                </div>

                {{-- Connector --}}
                <div class="w-0.5 h-6 bg-[#1e3a5f]/30"></div>

                {{-- Level 4: Divisi-Divisi --}}
                <div class="flex flex-wrap justify-center gap-3">
                    @foreach(['Divisi Akademik', 'Divisi Kreatif', 'Divisi Eksternal', 'Divisi Kewirausahaan', 'Divisi Olahraga & Seni'] as $divisi)
                    <div class="bg-[#f4a261]/10 border border-[#f4a261]/40 rounded-xl px-4 py-3 text-center shadow-sm">
                        <p class="text-xs text-[#1e3a5f] font-semibold leading-tight">{{ $divisi }}</p>
                    </div>
                    @endforeach
                </div>

            </div>

            {{-- Profil Pengurus per Divisi --}}
            <div class="space-y-14">

                {{-- Pimpinan Utama --}}
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-1 h-6 bg-[#f4a261] rounded-full"></div>
                        <h3 class="text-xl font-bold text-[#1e3a5f]">Pimpinan Utama</h3>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @foreach([
                            ['jabatan' => 'Ketua Umum', 'nama' => 'Nama Ketua'],
                            ['jabatan' => 'Wakil Ketua', 'nama' => 'Nama Wakil'],
                            ['jabatan' => 'Sekretaris I', 'nama' => 'Nama Sekretaris I'],
                            ['jabatan' => 'Sekretaris II', 'nama' => 'Nama Sekretaris II'],
                            ['jabatan' => 'Bendahara', 'nama' => 'Nama Bendahara'],
                        ] as $member)
                        <x-public.member-card
                            :nama="$member['nama']"
                            :jabatan="$member['jabatan']"
                        />
                        @endforeach
                    </div>
                </div>

                {{-- Divisi Akademik --}}
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-1 h-6 bg-[#2e86ab] rounded-full"></div>
                        <h3 class="text-xl font-bold text-[#1e3a5f]">Divisi Akademik</h3>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @foreach([
                            ['jabatan' => 'Kepala Divisi', 'nama' => 'Nama Kadiv'],
                            ['jabatan' => 'Anggota', 'nama' => 'Nama Anggota 1'],
                            ['jabatan' => 'Anggota', 'nama' => 'Nama Anggota 2'],
                        ] as $member)
                        <x-public.member-card
                            :nama="$member['nama']"
                            :jabatan="$member['jabatan']"
                        />
                        @endforeach
                    </div>
                </div>

                {{-- Divisi Kreatif --}}
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-1 h-6 bg-[#f4a261] rounded-full"></div>
                        <h3 class="text-xl font-bold text-[#1e3a5f]">Divisi Kreatif</h3>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @foreach([
                            ['jabatan' => 'Kepala Divisi', 'nama' => 'Nama Kadiv'],
                            ['jabatan' => 'Anggota', 'nama' => 'Nama Anggota 1'],
                            ['jabatan' => 'Anggota', 'nama' => 'Nama Anggota 2'],
                        ] as $member)
                        <x-public.member-card
                            :nama="$member['nama']"
                            :jabatan="$member['jabatan']"
                        />
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-layouts.public>
