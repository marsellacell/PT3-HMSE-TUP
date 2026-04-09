<x-layouts.dashboard title="Preview Proposal">

    {{-- Top Action Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard.proposal.create') }}" class="p-2 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-xl font-black text-gray-800">Preview Proposal</h2>
                <p class="text-sm text-gray-400">Periksa tampilan proposal sebelum difinalisasi</p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('dashboard.proposal.create') }}"
               class="px-4 py-2.5 text-sm font-semibold text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit
            </a>
            <button class="px-4 py-2.5 text-sm font-semibold text-white bg-red-600 rounded-xl hover:bg-red-700 transition-colors flex items-center gap-2 shadow-md shadow-red-600/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Download PDF
            </button>
            <button class="px-4 py-2.5 text-sm font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-xl hover:bg-emerald-100 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Finalisasi & Ajukan TTD
            </button>
        </div>
    </div>

    {{-- A4 Paper Preview --}}
    <div class="flex justify-center">
        <div class="bg-white shadow-2xl rounded-sm w-full max-w-[210mm] min-h-[297mm] relative"
             style="padding: 25mm 30mm; font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.8; color: #1a1a1a;">

            {{-- Page Border Decoration --}}
            <div class="absolute inset-[8mm] border-2 border-gray-800 pointer-events-none"></div>
            <div class="absolute inset-[10mm] border border-gray-400 pointer-events-none"></div>

            {{-- Header / Kop Surat --}}
            <div class="text-center mb-6 pb-4 border-b-[3px] border-gray-800 relative">
                <div class="absolute left-0 top-0 w-16 h-16 opacity-80">
                    <svg viewBox="0 0 60 60" fill="none" class="w-full h-full">
                        <rect width="60" height="60" rx="8" fill="#2C3DA6"/>
                        <path d="M30 10L34 24L48 28L34 32L30 46L26 32L12 28L26 24L30 10Z" fill="white"/>
                    </svg>
                </div>
                <div class="ml-20">
                    <p class="text-[10pt] font-bold tracking-wider uppercase" style="letter-spacing: 3px;">Himpunan Mahasiswa Software Engineering</p>
                    <p class="text-[16pt] font-black mt-0.5" style="letter-spacing: 1px;">HMSE TELKOM UNIVERSITY PURWOKERTO</p>
                    <p class="text-[9pt] text-gray-600 mt-0.5">Sekretariat: Gedung Rektorat Lt.2, Jl. D.I. Panjaitan No.128 Purwokerto 53147</p>
                    <p class="text-[9pt] text-gray-600">Email: hmse@telkomuniversity.ac.id | Website: hmse.telkomuniversity.ac.id</p>
                </div>
            </div>

            {{-- Title --}}
            <div class="text-center my-8">
                <h1 class="text-[14pt] font-black uppercase underline decoration-2 underline-offset-4">PROPOSAL KEGIATAN</h1>
                <p class="text-[13pt] font-bold mt-2 uppercase">{{ $proposal?->title ?? '"WORKSHOP UI/UX DESIGN 2026"' }}</p>
            </div>

            {{-- BAB I: PENDAHULUAN --}}
            <div class="mb-8">
                <h2 class="text-[13pt] font-bold mb-4">BAB I — PENDAHULUAN</h2>

                <h3 class="text-[12pt] font-bold mb-2">1.1 Latar Belakang</h3>
                <p class="text-justify indent-[1.27cm] mb-4">
                    {{ $proposal?->background ?? 'Perkembangan teknologi informasi yang semakin pesat menuntut mahasiswa untuk memiliki kompetensi yang relevan dengan kebutuhan industri.' }}
                </p>

                <h3 class="text-[12pt] font-bold mb-2">1.2 Tujuan</h3>
                <p class="text-justify indent-[1.27cm] mb-4">
                    {{ $proposal?->objective ?? 'Kegiatan ini bertujuan untuk meningkatkan kemampuan mahasiswa.' }}
                </p>

                @if($proposal?->risk_description)
                <h3 class="text-[12pt] font-bold mb-2">1.3 Catatan Risiko</h3>
                <p class="text-justify indent-[1.27cm] mb-4">
                    {{ $proposal->risk_description }}
                </p>
                @endif
            </div>

            {{-- BAB II: DETAIL KEGIATAN --}}
            <div class="mb-8">
                <h2 class="text-[13pt] font-bold mb-4">BAB II — RINCIAN KEGIATAN</h2>

                <h3 class="text-[12pt] font-bold mb-2">2.1 Informasi Umum</h3>
                <table class="w-full mb-4 text-[11pt]">
                    <tbody>
                        <tr>
                            <td class="w-1/3 font-bold">Nama Kegiatan</td>
                            <td>: {{ $proposal?->title ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold">Tingkat Risiko</td>
                            <td>: {{ $proposal?->risk_level === 'high' ? 'Tinggi' : 'Rendah' ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold">Timeline</td>
                            <td>: {{ $proposal?->timeline ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold">Anggaran</td>
                            <td>: Rp {{ $proposal ? number_format($proposal->budget, 0, ',', '.') : '0' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @if($proposal?->objective)
                <h3 class="text-[12pt] font-bold mb-2">2.2 Deskripsi Rinci</h3>
                <p class="text-justify text-[11pt] mb-4">{{ $proposal->objective }}</p>
                @endif
            </div>

            {{-- BAB III: ANGGARAN --}}
            <div class="mb-8">
                <h2 class="text-[13pt] font-bold mb-4">BAB III — RENCANA ANGGARAN BIAYA</h2>

                <table class="w-full border border-gray-400 mb-4 text-[11pt]">
                    <tbody>
                        <tr>
                            <td class="border border-gray-400 px-3 py-2 font-bold w-1/2">Total Anggaran</td>
                            <td class="border border-gray-400 px-3 py-2 text-right font-bold">Rp {{ $proposal ? number_format($proposal->budget, 0, ',', '.') : '0' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- BAB IV: PENUTUP --}}
            <div class="mb-8">
                <h2 class="text-[13pt] font-bold mb-4">BAB IV — PENUTUP</h2>
                <p class="text-justify indent-[1.27cm] mb-4">
                    Demikian proposal kegiatan {{ $proposal?->title ?? 'ini' }} kami susun. Besar harapan kami
                    kegiatan ini dapat terlaksana dengan baik dan memberikan manfaat bagi seluruh peserta.
                    Atas perhatian dan dukungan Bapak/Ibu, kami ucapkan terima kasih.
                </p>
            </div>

            {{-- Signature Area --}}
            <div class="mt-16">
                <p class="text-right mb-8">Purwokerto, {{ now()->translatedFormat('d F Y') }}</p>

                <div class="grid grid-cols-2 gap-8 text-center text-[11pt]">
                    {{-- Left: Ketua Panitia --}}
                    <div>
                        <p class="font-bold mb-1">Pembuat Proposal,</p>
                        <div class="h-20 flex items-center justify-center">
                            <span class="text-gray-300 italic text-[10pt]">(tanda tangan)</span>
                        </div>
                        <p class="font-bold underline">{{ $proposal?->user?->name ?? 'Nama Pembuat' }}</p>
                        <p class="text-[10pt] text-gray-600">{{ $proposal?->user?->email ?? 'Email' }}</p>
                    </div>

                    {{-- Right: Tanggal Dibuat --}}
                    <div>
                        <p class="font-bold mb-1">Dibuat pada,</p>
                        <div class="h-20 flex items-center justify-center">
                            <span class="text-[10pt]">{{ $proposal?->created_at?->translatedFormat('d F Y') ?? 'Tanggal' }}</span>
                        </div>
                        <p class="font-bold underline">Purwokerto</p>
                        <p class="text-[10pt] text-gray-600">{{ $proposal?->status ?? 'Draft' }}</p>
                    </div>
                </div>

                {{-- Approval Signatures --}}
                <div class="mt-12 pt-6 border-t border-gray-300 text-center text-[11pt]">
                    <p class="font-bold mb-6 text-[12pt]">Mengetahui dan Menyetujui,</p>

                    <div class="grid grid-cols-3 gap-6">
                        <div>
                            <p class="font-bold mb-1">Sekretaris HMSE,</p>
                            <div class="h-20 flex items-center justify-center">
                                <span class="text-gray-300 italic text-[10pt]">(tanda tangan)</span>
                            </div>
                            <p class="font-bold underline">Siti Nurhaliza</p>
                            <p class="text-[10pt] text-gray-600">Sekretaris</p>
                        </div>
                        <div>
                            <p class="font-bold mb-1">Pembina HMSE,</p>
                            <div class="h-20 flex items-center justify-center border-2 border-dashed border-amber-300 rounded-lg bg-amber-50/50 mx-4">
                                <span class="text-amber-500 text-[9pt] font-semibold">⏳ Menunggu TTD</span>
                            </div>
                            <p class="font-bold underline">Dr. Ir. Dosen Pembina</p>
                            <p class="text-[10pt] text-gray-600">Pembina</p>
                        </div>
                        <div>
                            <p class="font-bold mb-1">Kaprodi RPL,</p>
                            <div class="h-20 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 mx-4">
                                <span class="text-gray-400 text-[9pt] font-semibold">— Belum</span>
                            </div>
                            <p class="font-bold underline">Dr. Kaprodi RPL</p>
                            <p class="text-[10pt] text-gray-600">Kaprodi</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-layouts.dashboard>
