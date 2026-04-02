<x-layouts.dashboard title="Proposal">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-black text-gray-800">Daftar Proposal</h2>
            <p class="text-sm text-gray-400 mt-0.5">Kelola proposal kegiatan himpunan</p>
        </div>
        <a href="{{ route('dashboard.proposal.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2C3DA6] text-white text-sm font-semibold rounded-xl hover:bg-[#2C3DA6]/90 transition-all duration-200 shadow-md shadow-[#2C3DA6]/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Buat Proposal
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        <th class="px-6 py-4">Nama Proposal</th>
                        <th class="px-4 py-4">Program Kerja</th>
                        <th class="px-4 py-4">Status</th>
                        <th class="px-4 py-4">Tanggal</th>
                        <th class="px-4 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach([
                        ['name' => 'Proposal Workshop UI/UX Design 2026', 'proker' => 'Workshop UI/UX', 'status' => 'approved', 'status_label' => 'Disetujui', 'status_color' => 'emerald', 'date' => '10 Mar 2026'],
                        ['name' => 'Proposal Seminar Nasional Tech Week', 'proker' => 'Seminar Tech Week', 'status' => 'pending', 'status_label' => 'Menunggu TTD Pembina', 'status_color' => 'amber', 'date' => '18 Mar 2026'],
                        ['name' => 'Proposal Bootcamp Web Development', 'proker' => 'Bootcamp Web Dev', 'status' => 'approved', 'status_label' => 'Disetujui', 'status_color' => 'emerald', 'date' => '05 Feb 2026'],
                        ['name' => 'Proposal Turnamen E-Sport HMSE Cup', 'proker' => 'E-Sport HMSE Cup', 'status' => 'draft', 'status_label' => 'Draft', 'status_color' => 'gray', 'date' => '25 Mar 2026'],
                        ['name' => 'Proposal Bazaar Kewirausahaan', 'proker' => 'Bazaar Kewirausahaan', 'status' => 'reviewing', 'status_label' => 'Menunggu TTD Ketua', 'status_color' => 'blue', 'date' => '20 Mar 2026'],
                        ['name' => 'Proposal Creative Content Competition', 'proker' => 'Content Competition', 'status' => 'rejected', 'status_label' => 'Ditolak', 'status_color' => 'red', 'date' => '15 Mar 2026'],
                    ] as $i => $prop)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <a href="{{ route('dashboard.proposal.show', $i + 1) }}" class="font-semibold text-gray-700 hover:text-[#2C3DA6] transition-colors">
                                    {{ $prop['name'] }}
                                </a>
                            </td>
                            <td class="px-4 py-4 text-gray-500">{{ $prop['proker'] }}</td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-{{ $prop['status_color'] }}-50 text-{{ $prop['status_color'] }}-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-{{ $prop['status_color'] }}-500 {{ $prop['status'] === 'pending' || $prop['status'] === 'reviewing' ? 'animate-pulse' : '' }}"></span>
                                    {{ $prop['status_label'] }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-gray-400">{{ $prop['date'] }}</td>
                            <td class="px-4 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('dashboard.proposal.show', $i + 1) }}" class="p-2 rounded-lg hover:bg-blue-50 text-gray-400 hover:text-[#2C3DA6] transition-colors" title="Lihat">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <button class="p-2 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors" title="Download PDF">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-layouts.dashboard>
