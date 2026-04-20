<x-layouts.dashboard title="Preview Proposal">

    {{-- Top Action Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard.proposal.create') }}" class="p-2 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-xl font-black text-gray-800">Preview Proposal</h2>
                <p class="text-sm text-gray-400">Periksa sebelum finalisasi</p>
            </div>
        </div>

        {{-- Download DOCX Button --}}
        <div class="flex gap-3">
            <form action="{{ route('dashboard.proposal.download-docx') }}" method="POST">
                @csrf
                @if(isset($formData))
                    @foreach($formData as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                @endif
                <button type="submit"
                    class="flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-white bg-[#2C3DA6] rounded-xl hover:bg-[#2C3DA6]/90 shadow-lg shadow-[#2C3DA6]/20 transition-all hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    📄 Download DOCX (Template HMSE)
                </button>
            </form>
        </div>
    </div>

    {{-- Info Banner --}}
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4 mb-6 flex items-start gap-3">
        <svg class="w-5 h-5 text-[#2C3DA6] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div>
            <p class="text-sm font-semibold text-[#2C3DA6]">Preview & Download Template</p>
            <p class="text-xs text-gray-500 mt-0.5">Ini adalah preview HTML dari data proposal. Klik tombol <strong>"Download DOCX"</strong> di atas untuk mengunduh dokumen proposal menggunakan template resmi HMSE ({{ ($proposal->risk_level ?? 'low') === 'high' ? 'Risiko Tinggi' : 'Risiko Sedang/Rendah' }}).</p>
        </div>
    </div>

    {{-- A4 Preview --}}
    <div class="flex justify-center">
        <div class="bg-white shadow-lg border border-gray-200 rounded-lg w-full max-w-[210mm] min-h-[297mm]"
             style="padding:25mm; font-family:'Times New Roman', serif; font-size:12pt;">

            {{-- HEADER --}}
            <div class="text-center border-b-2 border-black pb-3 mb-6">
                <p class="text-sm">UNIT KEGIATAN MAHASISWA</p>
                <p class="font-bold">Himpunan Mahasiswa Software Engineering</p>
                <p class="font-black text-lg">HMSE TEL-U PURWOKERTO</p>
            </div>

            {{-- TITLE --}}
            <div class="text-center my-8">
                <h1 class="font-bold text-base underline tracking-wide">PROPOSAL KEGIATAN</h1>
                <p class="font-bold text-base mt-3">
                    {{ strtoupper($proposal->title ?? 'NAMA KEGIATAN') }}
                </p>
            </div>

            {{-- Section A: Nama Kegiatan --}}
            <div class="mb-4">
                <p class="font-bold mb-1">A. Nama Kegiatan</p>
                <p class="ml-4 text-justify">Nama kegiatan ini adalah {{ $proposal->title ?? '-' }}.</p>
            </div>

            {{-- Section B: Latar Belakang --}}
            <div class="mb-4">
                <p class="font-bold mb-1">B. Latar Belakang</p>
                <p class="ml-4 text-justify">{{ $proposal->background ?? '-' }}</p>
            </div>

            {{-- Section C: Tujuan --}}
            <div class="mb-4">
                <p class="font-bold mb-1">C. Tujuan Kegiatan</p>
                <p class="ml-4 text-justify">Tujuan dari kegiatan ini adalah: {{ $proposal->objective ?? '-' }}</p>
            </div>

            @if(!empty($proposal->risk_description ?? null))
            {{-- Section D: Mitigasi Risiko --}}
            <div class="mb-4">
                <p class="font-bold mb-1">D. Mitigasi Risiko</p>
                <p class="ml-4 text-justify">{{ $proposal->risk_description }}</p>
            </div>
            @endif

            {{-- Section E: Waktu & Tempat --}}
            <div class="mb-4">
                <p class="font-bold mb-1">E. Waktu dan Tempat</p>
                <p class="ml-4 mb-2">Kegiatan ini akan dilaksanakan pada:</p>
                <table class="ml-4 text-sm">
                    <tr>
                        <td class="pr-4">Hari/Tanggal</td>
                        <td class="pr-2">:</td>
                        <td>{{ $proposal->timeline ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="pr-4">Tempat</td>
                        <td class="pr-2">:</td>
                        <td>-</td>
                    </tr>
                </table>
            </div>

            {{-- Section F: Anggaran --}}
            <div class="mb-4">
                <p class="font-bold mb-1">F. Rencana Anggaran Dana</p>
                <table class="ml-4 w-full border border-gray-400 text-sm mt-2">
                    <tr class="border-b border-gray-400 bg-gray-50">
                        <td class="border-r border-gray-400 p-2 font-bold text-center w-12">No</td>
                        <td class="border-r border-gray-400 p-2 font-bold">Uraian</td>
                        <td class="p-2 font-bold text-right">Jumlah (Rp)</td>
                    </tr>
                    <tr class="border-b border-gray-400">
                        <td class="border-r border-gray-400 p-2 text-center">1</td>
                        <td class="border-r border-gray-400 p-2">Total Anggaran</td>
                        <td class="p-2 text-right font-semibold">Rp {{ number_format($proposal->budget ?? 0, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>

            {{-- Section G: Risiko --}}
            <div class="mb-4">
                <p class="font-bold mb-1">G. Tingkat Risiko</p>
                <p class="ml-4">
                    {{ isset($proposal->risk_level)
                        ? ($proposal->risk_level == 'high' ? 'Tinggi' : 'Sedang / Rendah')
                        : '-'
                    }}
                </p>
            </div>

            {{-- Penutup --}}
            <div class="mb-8 mt-8">
                <p class="font-bold mb-2">H. Penutup</p>
                <p class="ml-4 text-justify">
                    Demikian proposal ini kami susun, besar harapan kami kegiatan ini dapat terlaksana dengan baik. Atas perhatian dan dukungannya kami ucapkan terima kasih.
                </p>
            </div>

            {{-- TTD --}}
            <div class="mt-16">
                <p class="text-right mb-12">Purwokerto, {{ now()->format('d F Y') }}</p>

                <table class="w-full text-center text-sm">
                    <tr>
                        <td class="w-1/2 pb-16">Ketua Panitia</td>
                        <td class="w-1/2 pb-16">Sekretaris</td>
                    </tr>
                    <tr>
                        <td class="underline font-semibold">{{ isset($proposal->user) ? $proposal->user->name : 'Nama Ketua' }}</td>
                        <td class="underline font-semibold">Nama Sekretaris</td>
                    </tr>
                </table>
            </div>

        </div>
    </div>

</x-layouts.dashboard>