<x-layouts.dashboard title="Events">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-black text-gray-800">Registrasi Event</h2>
            <p class="text-sm text-gray-400 mt-0.5">Kelola pendaftaran acara himpunan</p>
        </div>
        <button class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2C3DA6] text-white text-sm font-semibold rounded-xl hover:bg-[#2C3DA6]/90 transition-all shadow-md shadow-[#2C3DA6]/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Buat Event
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @foreach([
            ['name' => 'Workshop UI/UX Design', 'date' => '15 Apr 2026', 'location' => 'Lab Komputer Lt.3', 'capacity' => 50, 'registered' => 38, 'status' => 'open', 'color' => '#2C3DA6'],
            ['name' => 'Seminar Nasional Tech Week', 'date' => '22-23 Apr 2026', 'location' => 'Auditorium TelU', 'capacity' => 200, 'registered' => 145, 'status' => 'open', 'color' => '#00C4D8'],
            ['name' => 'Bootcamp Web Development', 'date' => '01 Mar 2026', 'location' => 'Lab Komputer Lt.2', 'capacity' => 40, 'registered' => 40, 'status' => 'closed', 'color' => '#22c55e'],
            ['name' => 'Turnamen E-Sport HMSE Cup', 'date' => '10-12 Mei 2026', 'location' => 'Online (Discord)', 'capacity' => 100, 'registered' => 12, 'status' => 'upcoming', 'color' => '#8b5cf6'],
        ] as $event)
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                <div class="h-1.5" style="background: {{ $event['color'] }};"></div>
                <div class="p-5">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-sm font-bold text-gray-800 line-clamp-2">{{ $event['name'] }}</h3>
                        @if($event['status'] === 'open')
                            <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full whitespace-nowrap">Buka</span>
                        @elseif($event['status'] === 'closed')
                            <span class="text-[10px] font-bold text-red-600 bg-red-50 px-2 py-0.5 rounded-full whitespace-nowrap">Ditutup</span>
                        @else
                            <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full whitespace-nowrap">Coming Soon</span>
                        @endif
                    </div>

                    <div class="space-y-2 mb-4">
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $event['date'] }}
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $event['location'] }}
                        </div>
                    </div>

                    {{-- Progress --}}
                    <div class="mb-4">
                        <div class="flex justify-between text-xs mb-1">
                            <span class="text-gray-400">Pendaftar</span>
                            <span class="font-bold" style="color: {{ $event['color'] }};">{{ $event['registered'] }}/{{ $event['capacity'] }}</span>
                        </div>
                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-500" style="width: {{ ($event['registered'] / $event['capacity']) * 100 }}%; background: {{ $event['color'] }};"></div>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button class="flex-1 py-2.5 text-xs font-semibold text-[#2C3DA6] bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">Lihat Detail</button>
                        <button class="flex-1 py-2.5 text-xs font-semibold text-gray-500 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">Peserta</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</x-layouts.dashboard>
