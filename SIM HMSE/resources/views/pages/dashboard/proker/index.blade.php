<x-layouts.dashboard title="Program Kerja">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-black text-gray-800">Daftar Program Kerja</h2>
            <p class="text-sm text-gray-400 mt-0.5">Kelola semua program kerja himpunan</p>
        </div>
        <a href="{{ route('dashboard.proker.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2C3DA6] text-white text-sm font-semibold rounded-xl hover:bg-[#2C3DA6]/90 transition-all duration-200 shadow-md shadow-[#2C3DA6]/20 hover:shadow-lg">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Proker
        </a>
    </div>

    {{-- Filter Bar --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-6">
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            {{-- Search --}}
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" placeholder="Cari program kerja..."
                       class="w-full pl-10 pr-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-[#2C3DA6] focus:ring-2 focus:ring-[#2C3DA6]/20 transition-all">
            </div>

            {{-- Status Filter --}}
            <select class="px-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-[#2C3DA6] text-gray-600">
                <option value="">Semua Status</option>
                <option value="draft">Draft</option>
                <option value="preparation">Persiapan</option>
                <option value="on-progress">On Progress</option>
                <option value="completed">Selesai</option>
            </select>

            {{-- Divisi Filter --}}
            <select class="px-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-[#2C3DA6] text-gray-600">
                <option value="">Semua Divisi</option>
                <option>Divisi Akademik</option>
                <option>Divisi Kreatif</option>
                <option>Divisi Eksternal</option>
                <option>Divisi Kewirausahaan</option>
                <option>Divisi Olahraga & Seni</option>
            </select>
        </div>
    </div>

    {{-- Proker Cards Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @foreach([
            ['name' => 'Workshop UI/UX Design', 'divisi' => 'Divisi Akademik', 'status' => 'on-progress', 'date_start' => '15 Apr 2026', 'date_end' => '15 Apr 2026', 'pj' => 'Ahmad Fauzi', 'progress' => 65, 'color' => '#2C3DA6'],
            ['name' => 'Seminar Nasional Tech Week', 'divisi' => 'Divisi Eksternal', 'status' => 'preparation', 'date_start' => '22 Apr 2026', 'date_end' => '23 Apr 2026', 'pj' => 'Siti Nurhaliza', 'progress' => 30, 'color' => '#00C4D8'],
            ['name' => 'Bootcamp Web Development', 'divisi' => 'Divisi Akademik', 'status' => 'completed', 'date_start' => '01 Mar 2026', 'date_end' => '01 Mar 2026', 'pj' => 'Budi Hartono', 'progress' => 100, 'color' => '#22c55e'],
            ['name' => 'Turnamen E-Sport HMSE Cup', 'divisi' => 'Divisi Olahraga & Seni', 'status' => 'draft', 'date_start' => '10 Mei 2026', 'date_end' => '12 Mei 2026', 'pj' => 'Rizky Pratama', 'progress' => 0, 'color' => '#6b7280'],
            ['name' => 'Bazaar Kewirausahaan', 'divisi' => 'Divisi Kewirausahaan', 'status' => 'preparation', 'date_start' => '05 Mei 2026', 'date_end' => '06 Mei 2026', 'pj' => 'Diana Putri', 'progress' => 20, 'color' => '#f59e0b'],
            ['name' => 'Creative Content Competition', 'divisi' => 'Divisi Kreatif', 'status' => 'draft', 'date_start' => '20 Mei 2026', 'date_end' => '25 Mei 2026', 'pj' => 'Rony Setiawan', 'progress' => 0, 'color' => '#ec4899'],
        ] as $i => $proker)
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 overflow-hidden group">
                {{-- Color Bar --}}
                <div class="h-1" style="background: {{ $proker['color'] }};"></div>

                <div class="p-5">
                    {{-- Header --}}
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('dashboard.proker.show', $i + 1) }}" class="text-sm font-bold text-gray-800 hover:text-[#2C3DA6] transition-colors line-clamp-2">
                                {{ $proker['name'] }}
                            </a>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $proker['divisi'] }}</p>
                        </div>
                        <x-dashboard.status-badge :status="$proker['status']" />
                    </div>

                    {{-- Info --}}
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $proker['date_start'] }} — {{ $proker['date_end'] }}
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            PJ: {{ $proker['pj'] }}
                        </div>
                    </div>

                    {{-- Progress Bar --}}
                    <div class="mb-3">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-[11px] font-semibold text-gray-500">Progress</span>
                            <span class="text-[11px] font-bold" style="color: {{ $proker['color'] }}">{{ $proker['progress'] }}%</span>
                        </div>
                        <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-500" style="width: {{ $proker['progress'] }}%; background: {{ $proker['color'] }};"></div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-2 pt-3 border-t border-gray-100">
                        <a href="{{ route('dashboard.proker.show', $i + 1) }}"
                           class="flex-1 text-center text-xs font-semibold text-[#2C3DA6] py-2 rounded-lg hover:bg-blue-50 transition-colors">
                            Detail
                        </a>
                        <button class="flex-1 text-center text-xs font-semibold text-gray-500 py-2 rounded-lg hover:bg-gray-50 transition-colors">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</x-layouts.dashboard>
