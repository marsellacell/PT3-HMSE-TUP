<x-layouts.dashboard title="Detail Proposal">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('dashboard.proposal.index') }}" class="p-2 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h2 class="text-xl font-black text-gray-800">Proposal: Workshop UI/UX Design 2026</h2>
            <p class="text-sm text-gray-400">Tracking persetujuan & tanda tangan digital</p>
        </div>
    </div>

    <div x-data="{ activeTab: 'approval' }" class="space-y-6">

        {{-- Status Banner --}}
        <div class="bg-gradient-to-r from-amber-50 to-amber-100/50 border border-amber-200 rounded-xl p-5 flex flex-col sm:flex-row items-start sm:items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="flex-1">
                <p class="text-sm font-bold text-amber-800">Menunggu Tanda Tangan — Pembina HMSE</p>
                <p class="text-xs text-amber-600 mt-0.5">Proposal telah disetujui oleh Ketua Panitia, Sekretaris, dan Ketua HMSE. Menunggu tanda tangan Pembina.</p>
            </div>
            <a href="{{ route('dashboard.proposal.preview', $id) }}"
               class="px-4 py-2 text-xs font-semibold text-amber-700 bg-amber-200 rounded-lg hover:bg-amber-300 transition-colors flex items-center gap-1.5 flex-shrink-0">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                Lihat Preview
            </a>
        </div>

        {{-- Tabs --}}
        <div class="flex gap-2">
            <button @click="activeTab = 'approval'" :class="activeTab === 'approval' ? 'bg-[#2C3DA6] text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50'" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition-all">Alur Persetujuan</button>
            <button @click="activeTab = 'info'" :class="activeTab === 'info' ? 'bg-[#2C3DA6] text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50'" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition-all">Info Proposal</button>
            <button @click="activeTab = 'log'" :class="activeTab === 'log' ? 'bg-[#2C3DA6] text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50'" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition-all">Log Aktivitas</button>
        </div>

        {{-- Tab: Alur Persetujuan --}}
        <div x-show="activeTab === 'approval'">

            {{-- Approval Flow Steps --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-3 mb-6">
                @foreach([
                    ['role' => 'Ketua Panitia', 'name' => 'Ahmad Fauzi', 'status' => 'signed', 'date' => '28 Mar 2026, 10:30'],
                    ['role' => 'Sekretaris HMSE', 'name' => 'Siti Nurhaliza', 'status' => 'signed', 'date' => '29 Mar 2026, 14:22'],
                    ['role' => 'Ketua HMSE', 'name' => 'Budi Hartono', 'status' => 'signed', 'date' => '30 Mar 2026, 09:15'],
                    ['role' => 'Pembina HMSE', 'name' => 'Dr. Ir. Dosen Pembina', 'status' => 'active', 'date' => null],
                    ['role' => 'Kaprodi RPL', 'name' => 'Dr. Kaprodi RPL', 'status' => 'pending', 'date' => null],
                ] as $i => $step)
                    <div class="relative">
                        {{-- Connector arrow --}}
                        @if($i < 4)
                            <div class="hidden lg:block absolute top-1/2 -right-3 z-10 text-gray-300">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M10 17l5-5-5-5v10z"/></svg>
                            </div>
                        @endif

                        <div class="rounded-xl border-2 p-4 text-center transition-all duration-300
                            {{ $step['status'] === 'signed' ? 'border-emerald-300 bg-emerald-50/50' : '' }}
                            {{ $step['status'] === 'active' ? 'border-amber-300 bg-amber-50/50 ring-2 ring-amber-200 shadow-md' : '' }}
                            {{ $step['status'] === 'pending' ? 'border-gray-200 bg-gray-50/50' : '' }}
                        ">
                            {{-- Status Icon --}}
                            <div class="mx-auto mb-3 w-10 h-10 rounded-full flex items-center justify-center
                                {{ $step['status'] === 'signed' ? 'bg-emerald-100' : '' }}
                                {{ $step['status'] === 'active' ? 'bg-amber-100 animate-pulse' : '' }}
                                {{ $step['status'] === 'pending' ? 'bg-gray-100' : '' }}
                            ">
                                @if($step['status'] === 'signed')
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                @elseif($step['status'] === 'active')
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                @endif
                            </div>

                            <p class="text-xs font-bold mb-0.5
                                {{ $step['status'] === 'signed' ? 'text-emerald-700' : '' }}
                                {{ $step['status'] === 'active' ? 'text-amber-700' : '' }}
                                {{ $step['status'] === 'pending' ? 'text-gray-400' : '' }}
                            ">{{ $step['role'] }}</p>
                            <p class="text-[10px] text-gray-500 truncate">{{ $step['name'] }}</p>

                            @if($step['status'] === 'signed')
                                <p class="text-[9px] text-emerald-500 mt-1.5 font-medium">✓ {{ $step['date'] }}</p>
                            @elseif($step['status'] === 'active')
                                <p class="text-[9px] text-amber-500 mt-1.5 font-semibold">⏳ Menunggu TTD</p>
                            @else
                                <p class="text-[9px] text-gray-300 mt-1.5 font-medium">— Giliran berikutnya</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Signature Section (for active signer) --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-800">Tanda Tangan Digital — Pembina HMSE</h3>
                        <p class="text-xs text-gray-400">Dr. Ir. Dosen Pembina perlu login untuk menandatangani proposal ini.</p>
                    </div>
                </div>

                {{-- Info: this is what the signer sees after login --}}
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-5 flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div>
                        <p class="text-xs font-semibold text-blue-700">Alur Tanda Tangan</p>
                        <p class="text-xs text-blue-600 mt-0.5">Penanda tangan yang bersangkutan perlu <strong>login ke sistem</strong>, lalu membuka halaman proposal ini untuk memberikan tanda tangan digital. Setelah TTD divalidasi, proposal dilanjutkan ke penanda tangan berikutnya.</p>
                    </div>
                </div>

                {{-- Signature Pad (shows when the logged-in user is the active signer) --}}
                <div x-data="{
                    isSigner: false,
                    signed: false,
                    ctx: null,
                    canvas: null,
                    drawing: false,

                    initCanvas() {
                        this.canvas = this.$refs.sigCanvas;
                        this.ctx = this.canvas.getContext('2d');
                        this.ctx.strokeStyle = '#1a1a1a';
                        this.ctx.lineWidth = 2;
                        this.ctx.lineCap = 'round';
                    },
                    startDraw(e) { this.drawing = true; const r = this.canvas.getBoundingClientRect(); this.ctx.beginPath(); this.ctx.moveTo(e.clientX - r.left, e.clientY - r.top); },
                    draw(e) { if (!this.drawing) return; const r = this.canvas.getBoundingClientRect(); this.ctx.lineTo(e.clientX - r.left, e.clientY - r.top); this.ctx.stroke(); },
                    stopDraw() { this.drawing = false; },
                    clearCanvas() { this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height); },
                    submitSign() { this.signed = true; },
                }">
                    {{-- Toggle (for demo) --}}
                    <div class="flex items-center gap-3 mb-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" x-model="isSigner" @change="if(isSigner){$nextTick(() => initCanvas())}" class="w-4 h-4 rounded border-gray-300 text-[#2C3DA6]">
                            <span class="text-xs text-gray-500 font-medium">Simulasikan: Saya adalah Pembina (sudah login)</span>
                        </label>
                    </div>

                    {{-- Signature Pad Area --}}
                    <div x-show="isSigner && !signed" x-transition class="space-y-4">
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-2 bg-white">
                            <canvas x-ref="sigCanvas" width="600" height="180"
                                    @mousedown="startDraw($event)" @mousemove="draw($event)" @mouseup="stopDraw()"
                                    @touchstart.prevent="startDraw($event.touches[0])" @touchmove.prevent="draw($event.touches[0])" @touchend="stopDraw()"
                                    class="w-full cursor-crosshair rounded-lg bg-gray-50/50" style="touch-action: none;">
                            </canvas>
                        </div>
                        <div class="flex items-center gap-3">
                            <button @click="clearCanvas()" class="px-4 py-2 text-xs font-semibold text-gray-500 bg-gray-100 rounded-lg hover:bg-gray-200">Hapus & Ulangi</button>
                            <button @click="submitSign()" class="px-6 py-2.5 text-sm font-bold text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 shadow-lg shadow-emerald-600/20 transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Konfirmasi Tanda Tangan
                            </button>
                        </div>
                    </div>

                    {{-- Not the signer --}}
                    <div x-show="!isSigner" class="p-8 text-center bg-gray-50 rounded-xl">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <p class="text-sm font-semibold text-gray-500">Menunggu Pembina Login</p>
                        <p class="text-xs text-gray-400 mt-1">Dr. Ir. Dosen Pembina perlu login untuk menandatangani</p>
                    </div>

                    {{-- Signed Success --}}
                    <div x-show="signed" x-transition class="p-6 bg-emerald-50 border border-emerald-200 rounded-xl text-center">
                        <div class="w-14 h-14 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-3">
                            <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <p class="text-sm font-bold text-emerald-700">Tanda Tangan Berhasil!</p>
                        <p class="text-xs text-emerald-600 mt-1">Proposal telah ditandatangani. Dilanjutkan ke Kaprodi RPL.</p>
                    </div>
                </div>
            </div>

            {{-- Completed Signatures Gallery --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-sm font-bold text-gray-800 mb-4">Tanda Tangan yang Sudah Masuk</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach([
                        ['role' => 'Ketua Panitia', 'name' => 'Ahmad Fauzi', 'date' => '28 Mar 2026'],
                        ['role' => 'Sekretaris HMSE', 'name' => 'Siti Nurhaliza', 'date' => '29 Mar 2026'],
                        ['role' => 'Ketua HMSE', 'name' => 'Budi Hartono', 'date' => '30 Mar 2026'],
                    ] as $sig)
                        <div class="border border-emerald-200 rounded-xl p-4 bg-emerald-50/30">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider">{{ $sig['role'] }}</p>
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            {{-- Fake signature scribble --}}
                            <div class="h-12 mb-2 flex items-center justify-center">
                                <svg viewBox="0 0 200 50" class="w-32 h-10 text-gray-700 opacity-60">
                                    <path d="M10 35 Q30 5 50 30 T90 25 T130 30 T160 20 T190 35" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <p class="text-xs font-bold text-gray-700">{{ $sig['name'] }}</p>
                            <p class="text-[10px] text-gray-400">{{ $sig['date'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Tab: Info Proposal --}}
        <div x-show="activeTab === 'info'" style="display: none;">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-sm font-bold text-gray-800 mb-5">Informasi Proposal</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8 text-sm">
                    @foreach([
                        ['label' => 'Nama Kegiatan', 'value' => 'Workshop UI/UX Design 2026'],
                        ['label' => 'Tema', 'value' => 'Designing Digital Tomorrow'],
                        ['label' => 'Tanggal', 'value' => 'Selasa, 15 April 2026'],
                        ['label' => 'Waktu', 'value' => '08:00 — 16:00 WIB'],
                        ['label' => 'Tempat', 'value' => 'Lab Komputer Lt.3'],
                        ['label' => 'Ketua Panitia', 'value' => 'Ahmad Fauzi'],
                        ['label' => 'Divisi', 'value' => 'Divisi Akademik'],
                        ['label' => 'Target Peserta', 'value' => '50 Mahasiswa'],
                        ['label' => 'Total Anggaran', 'value' => 'Rp 3.200.000'],
                        ['label' => 'Status', 'value' => 'Menunggu TTD Pembina'],
                    ] as $info)
                        <div class="flex gap-2">
                            <span class="text-gray-400 w-36 flex-shrink-0">{{ $info['label'] }}</span>
                            <span class="font-semibold text-gray-700">: {{ $info['value'] }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 pt-4 border-t border-gray-100 flex gap-3">
                    <a href="{{ route('dashboard.proposal.preview', $id) }}" class="px-4 py-2.5 text-sm font-semibold text-[#2C3DA6] bg-blue-50 rounded-xl hover:bg-blue-100 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Preview Dokumen
                    </a>
                    <button class="px-4 py-2.5 text-sm font-semibold text-red-600 bg-red-50 rounded-xl hover:bg-red-100 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Download PDF
                    </button>
                </div>
            </div>
        </div>

        {{-- Tab: Log Aktivitas --}}
        <div x-show="activeTab === 'log'" style="display: none;">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-sm font-bold text-gray-800 mb-5">Log Aktivitas</h3>
                <div class="relative ml-4 space-y-0">
                    @foreach([
                        ['time' => '30 Mar 2026, 09:15', 'action' => 'Ditandatangani oleh Budi Hartono (Ketua HMSE)', 'type' => 'success'],
                        ['time' => '29 Mar 2026, 14:22', 'action' => 'Ditandatangani oleh Siti Nurhaliza (Sekretaris)', 'type' => 'success'],
                        ['time' => '28 Mar 2026, 10:30', 'action' => 'Ditandatangani oleh Ahmad Fauzi (Ketua Panitia)', 'type' => 'success'],
                        ['time' => '28 Mar 2026, 10:00', 'action' => 'Proposal disubmit untuk persetujuan', 'type' => 'info'],
                        ['time' => '27 Mar 2026, 16:45', 'action' => 'Draft proposal difinalisasi', 'type' => 'default'],
                        ['time' => '25 Mar 2026, 12:00', 'action' => 'Draft proposal dibuat oleh Ahmad Fauzi', 'type' => 'default'],
                    ] as $log)
                        <div class="flex items-start gap-4 pb-6 relative">
                            {{-- Line --}}
                            <div class="absolute left-[7px] top-5 bottom-0 w-0.5 bg-gray-100"></div>
                            {{-- Dot --}}
                            <div class="w-4 h-4 rounded-full flex-shrink-0 mt-0.5 relative z-10
                                {{ $log['type'] === 'success' ? 'bg-emerald-400' : '' }}
                                {{ $log['type'] === 'info' ? 'bg-[#2C3DA6]' : '' }}
                                {{ $log['type'] === 'default' ? 'bg-gray-300' : '' }}
                            "></div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">{{ $log['action'] }}</p>
                                <p class="text-[10px] text-gray-400 mt-0.5">{{ $log['time'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

</x-layouts.dashboard>
