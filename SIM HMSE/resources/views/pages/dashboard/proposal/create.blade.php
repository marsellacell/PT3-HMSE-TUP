<x-layouts.dashboard title="Buat Proposal">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('dashboard.proposal.index') }}" class="p-2 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h2 class="text-xl font-black text-gray-800">Isi Proposal Kegiatan</h2>
            <p class="text-sm text-gray-400">Isi bagian-bagian proposal sesuai template standar HMSE</p>
        </div>
    </div>

    <div x-data="{
        activeSection: 'info',
        sections: [
            { id: 'info', label: 'Informasi Umum', icon: 'info' },
            { id: 'pendahuluan', label: 'Pendahuluan', icon: 'book' },
            { id: 'kegiatan', label: 'Detail Kegiatan', icon: 'calendar' },
            { id: 'anggaran', label: 'Anggaran', icon: 'money' },
            { id: 'penutup', label: 'Penutup & Lampiran', icon: 'flag' },
        ],
        completedSections: [],

        markComplete(id) {
            if (!this.completedSections.includes(id)) this.completedSections.push(id);
        },
        isComplete(id) {
            return this.completedSections.includes(id);
        },
        get progress() {
            return Math.round((this.completedSections.length / this.sections.length) * 100);
        }
    }" class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        {{-- Left: Section Navigation --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 sticky top-24">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Template Proposal</h3>
                    <span class="text-xs font-bold text-[#2C3DA6]" x-text="progress + '%'"></span>
                </div>

                {{-- Progress Bar --}}
                <div class="w-full h-1.5 bg-gray-100 rounded-full mb-4 overflow-hidden">
                    <div class="h-full bg-[#2C3DA6] rounded-full transition-all duration-500" :style="'width:' + progress + '%'"></div>
                </div>

                <nav class="space-y-1">
                    <template x-for="(s, i) in sections" :key="s.id">
                        <button @click="activeSection = s.id"
                                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 text-left"
                                :class="activeSection === s.id
                                    ? 'bg-[#2C3DA6]/10 text-[#2C3DA6]'
                                    : (isComplete(s.id) ? 'text-emerald-600 hover:bg-emerald-50' : 'text-gray-500 hover:bg-gray-50')">
                            {{-- Number/Check --}}
                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-bold flex-shrink-0"
                                 :class="isComplete(s.id)
                                     ? 'bg-emerald-100 text-emerald-600'
                                     : (activeSection === s.id ? 'bg-[#2C3DA6] text-white' : 'bg-gray-100 text-gray-400')">
                                <template x-if="isComplete(s.id)">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                </template>
                                <template x-if="!isComplete(s.id)">
                                    <span x-text="i + 1"></span>
                                </template>
                            </div>
                            <span x-text="s.label" class="truncate"></span>
                        </button>
                    </template>
                </nav>

                {{-- Action Buttons --}}
                <div class="mt-6 pt-4 border-t border-gray-100 space-y-2">
                    <a href="{{ route('dashboard.proposal.preview', 'new') }}"
                       class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-[#2C3DA6] bg-blue-50 border border-blue-200 rounded-xl hover:bg-blue-100 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Preview Proposal
                    </a>
                    <button class="w-full px-4 py-2.5 text-sm font-semibold text-gray-500 bg-gray-50 border border-gray-200 rounded-xl hover:bg-gray-100 transition-colors">
                        💾 Simpan Draft
                    </button>
                </div>
            </div>
        </div>

        {{-- Right: Form Content --}}
        <div class="lg:col-span-3 space-y-6">

            {{-- Template Header Info --}}
            <div class="bg-gradient-to-r from-[#2C3DA6]/5 to-[#00C4D8]/5 rounded-xl border border-[#2C3DA6]/10 p-4 flex items-start gap-3">
                <svg class="w-5 h-5 text-[#2C3DA6] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="text-sm font-semibold text-[#2C3DA6]">Template Standar HMSE</p>
                    <p class="text-xs text-gray-500 mt-0.5">Isi setiap bagian sesuai kebutuhan. Sistem akan otomatis menyusun proposal sesuai format resmi. Klik "Preview" untuk melihat hasilnya.</p>
                </div>
            </div>

            {{-- Section 1: Info Umum --}}
            <div x-show="activeSection === 'info'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 space-y-5">
                    <div class="flex items-center justify-between">
                        <h3 class="text-base font-bold text-gray-800">📋 Informasi Umum</h3>
                        <button @click="markComplete('info'); activeSection = 'pendahuluan'"
                                class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-lg hover:bg-emerald-100 transition-colors">
                            ✓ Tandai Selesai & Lanjut
                        </button>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kegiatan *</label>
                        <input type="text" placeholder="Contoh: Workshop UI/UX Design 2026" class="w-full px-4 py-3 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#2C3DA6] focus:ring-2 focus:ring-[#2C3DA6]/10 transition-all">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Tema Kegiatan</label>
                            <input type="text" placeholder="Tema kegiatan" class="w-full px-4 py-3 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#2C3DA6] focus:ring-2 focus:ring-[#2C3DA6]/10 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Kegiatan</label>
                            <select class="w-full px-4 py-3 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#2C3DA6] text-gray-600">
                                <option value="">Pilih Jenis</option>
                                <option>Seminar</option>
                                <option>Workshop</option>
                                <option>Kompetisi</option>
                                <option>Webinar</option>
                                <option>Pelatihan</option>
                                <option>Kunjungan</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Pelaksanaan *</label>
                            <input type="date" class="w-full px-4 py-3 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#2C3DA6]">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Waktu</label>
                            <input type="time" class="w-full px-4 py-3 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#2C3DA6]">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Tempat *</label>
                            <input type="text" placeholder="Lokasi" class="w-full px-4 py-3 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#2C3DA6]">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Ketua Panitia *</label>
                            <input type="text" placeholder="Nama ketua panitia" class="w-full px-4 py-3 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#2C3DA6]">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Divisi / Bidang</label>
                            <select class="w-full px-4 py-3 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#2C3DA6] text-gray-600">
                                <option value="">Pilih Divisi</option>
                                <option>Divisi Akademik</option>
                                <option>Divisi Kreatif</option>
                                <option>Divisi Eksternal</option>
                                <option>Divisi Kewirausahaan</option>
                                <option>Divisi Olahraga & Seni</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 2: Pendahuluan --}}
            <div x-show="activeSection === 'pendahuluan'" style="display:none" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 space-y-5">
                    <div class="flex items-center justify-between">
                        <h3 class="text-base font-bold text-gray-800">📖 Pendahuluan</h3>
                        <button @click="markComplete('pendahuluan'); activeSection = 'kegiatan'"
                                class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-lg hover:bg-emerald-100 transition-colors">
                            ✓ Tandai Selesai & Lanjut
                        </button>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Latar Belakang *</label>
                        <p class="text-xs text-gray-400 mb-2">Jelaskan alasan dan konteks mengapa kegiatan ini perlu dilaksanakan.</p>
                        <textarea rows="6" placeholder="Tuliskan latar belakang kegiatan di sini..." class="w-full px-4 py-3 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#2C3DA6] focus:ring-2 focus:ring-[#2C3DA6]/10 resize-none transition-all"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tujuan Kegiatan *</label>
                        <p class="text-xs text-gray-400 mb-2">Sebutkan tujuan yang ingin dicapai dari kegiatan ini.</p>
                        <div x-data="{ items: [''] }" class="space-y-2">
                            <template x-for="(item, i) in items" :key="i">
                                <div class="flex items-center gap-2">
                                    <span class="w-6 h-6 rounded-full bg-[#2C3DA6]/10 text-[#2C3DA6] text-[10px] font-bold flex items-center justify-center flex-shrink-0" x-text="i+1"></span>
                                    <input type="text" x-model="items[i]" placeholder="Tujuan kegiatan" class="flex-1 px-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-[#2C3DA6]">
                                    <button @click="items.splice(i,1)" x-show="items.length > 1" class="text-gray-400 hover:text-red-500 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            </template>
                            <button @click="items.push('')" class="text-xs font-semibold text-[#2C3DA6] flex items-center gap-1 hover:text-[#00C4D8]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                Tambah Tujuan
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Manfaat Kegiatan</label>
                        <textarea rows="4" placeholder="Manfaat yang diharapkan..." class="w-full px-4 py-3 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#2C3DA6] resize-none transition-all"></textarea>
                    </div>
                </div>
            </div>

            {{-- Section 3: Detail Kegiatan --}}
            <div x-show="activeSection === 'kegiatan'" style="display:none" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 space-y-5">
                    <div class="flex items-center justify-between">
                        <h3 class="text-base font-bold text-gray-800">📅 Detail Kegiatan</h3>
                        <button @click="markComplete('kegiatan'); activeSection = 'anggaran'"
                                class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-lg hover:bg-emerald-100 transition-colors">
                            ✓ Tandai Selesai & Lanjut
                        </button>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Bentuk Kegiatan *</label>
                        <textarea rows="3" placeholder="Contoh: Kegiatan berbentuk workshop satu hari penuh dengan sesi teori dan praktik langsung..." class="w-full px-4 py-3 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#2C3DA6] resize-none transition-all"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Sasaran Peserta</label>
                        <textarea rows="2" placeholder="Contoh: Mahasiswa Prodi RPL semester 2–6..." class="w-full px-4 py-3 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#2C3DA6] resize-none transition-all"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Susunan Acara / Rundown</label>
                        <div x-data="{ rows: [{waktu:'08:00', durasi:'30 menit', kegiatan:'Registrasi'}, {waktu:'08:30', durasi:'60 menit', kegiatan:''}, {waktu:'', durasi:'', kegiatan:''}] }" class="space-y-2">
                            <div class="grid grid-cols-12 gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider px-1">
                                <div class="col-span-2">Waktu</div>
                                <div class="col-span-2">Durasi</div>
                                <div class="col-span-7">Kegiatan</div>
                                <div class="col-span-1"></div>
                            </div>
                            <template x-for="(r, i) in rows" :key="i">
                                <div class="grid grid-cols-12 gap-2">
                                    <input type="time" x-model="r.waktu" class="col-span-2 px-3 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:border-[#2C3DA6]">
                                    <input type="text" x-model="r.durasi" placeholder="30 menit" class="col-span-2 px-3 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:border-[#2C3DA6]">
                                    <input type="text" x-model="r.kegiatan" placeholder="Nama kegiatan/sesi" class="col-span-7 px-3 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:border-[#2C3DA6]">
                                    <div class="col-span-1 flex items-center justify-center">
                                        <button @click="rows.splice(i,1)" x-show="rows.length > 1" class="text-gray-400 hover:text-red-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                                    </div>
                                </div>
                            </template>
                            <button @click="rows.push({waktu:'',durasi:'',kegiatan:''})" class="text-xs font-semibold text-[#2C3DA6] flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                Tambah Baris
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Susunan Panitia</label>
                        <div x-data="{ panitia: [{nama:'', jabatan:'Ketua Panitia'},{nama:'', jabatan:'Sekretaris'},{nama:'', jabatan:'Bendahara'}] }" class="space-y-2">
                            <template x-for="(p, i) in panitia" :key="i">
                                <div class="flex gap-2">
                                    <input type="text" x-model="p.jabatan" placeholder="Jabatan" class="w-40 px-3 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:border-[#2C3DA6]">
                                    <input type="text" x-model="p.nama" placeholder="Nama lengkap" class="flex-1 px-3 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:border-[#2C3DA6]">
                                    <button @click="panitia.splice(i,1)" x-show="panitia.length > 1" class="text-gray-400 hover:text-red-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                                </div>
                            </template>
                            <button @click="panitia.push({nama:'', jabatan:''})" class="text-xs font-semibold text-[#2C3DA6] flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                Tambah Panitia
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 4: Anggaran --}}
            <div x-show="activeSection === 'anggaran'" style="display:none" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 space-y-5">
                    <div class="flex items-center justify-between">
                        <h3 class="text-base font-bold text-gray-800">💰 Rencana Anggaran Biaya</h3>
                        <button @click="markComplete('anggaran'); activeSection = 'penutup'"
                                class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-lg hover:bg-emerald-100 transition-colors">
                            ✓ Tandai Selesai & Lanjut
                        </button>
                    </div>

                    <div x-data="{ items: [
                        {no:1, item:'Sewa Ruangan', vol:1, satuan:'Ruangan', harga:500000},
                        {no:2, item:'Snack & Makan Siang', vol:50, satuan:'Pax', harga:25000},
                        {no:3, item:'', vol:1, satuan:'', harga:0}
                    ] }">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b-2 border-gray-200">
                                        <th class="pb-3 text-left w-10">No</th>
                                        <th class="pb-3 text-left">Uraian</th>
                                        <th class="pb-3 text-center w-20">Vol</th>
                                        <th class="pb-3 text-left w-24">Satuan</th>
                                        <th class="pb-3 text-right w-36">Harga Satuan (Rp)</th>
                                        <th class="pb-3 text-right w-36">Jumlah (Rp)</th>
                                        <th class="pb-3 w-10"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="(row, i) in items" :key="i">
                                        <tr class="border-b border-gray-50">
                                            <td class="py-2 text-gray-400 font-semibold" x-text="i + 1"></td>
                                            <td class="py-2 pr-2"><input type="text" x-model="row.item" placeholder="Nama item" class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:border-[#2C3DA6]"></td>
                                            <td class="py-2 pr-2"><input type="number" x-model.number="row.vol" class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:border-[#2C3DA6] text-center"></td>
                                            <td class="py-2 pr-2"><input type="text" x-model="row.satuan" placeholder="Pcs" class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:border-[#2C3DA6]"></td>
                                            <td class="py-2 pr-2"><input type="number" x-model.number="row.harga" placeholder="0" class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:border-[#2C3DA6] text-right"></td>
                                            <td class="py-2 text-right font-semibold text-gray-700" x-text="'Rp ' + ((row.vol || 0) * (row.harga || 0)).toLocaleString('id-ID')"></td>
                                            <td class="py-2"><button @click="items.splice(i,1)" x-show="items.length > 1" class="text-gray-400 hover:text-red-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button></td>
                                        </tr>
                                    </template>
                                </tbody>
                                <tfoot>
                                    <tr class="border-t-2 border-gray-200">
                                        <td colspan="5" class="py-3 text-right text-sm font-bold text-gray-700">Total Anggaran</td>
                                        <td class="py-3 text-right text-base font-black text-[#2C3DA6]" x-text="'Rp ' + items.reduce((s,r) => s + ((r.vol||0)*(r.harga||0)), 0).toLocaleString('id-ID')"></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <button @click="items.push({no:items.length+1, item:'', vol:1, satuan:'', harga:0})" class="mt-3 text-xs font-semibold text-[#2C3DA6] flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            Tambah Item Anggaran
                        </button>
                    </div>
                </div>
            </div>

            {{-- Section 5: Penutup --}}
            <div x-show="activeSection === 'penutup'" style="display:none" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 space-y-5">
                    <div class="flex items-center justify-between">
                        <h3 class="text-base font-bold text-gray-800">🏁 Penutup</h3>
                        <button @click="markComplete('penutup')"
                                class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-lg hover:bg-emerald-100 transition-colors">
                            ✓ Tandai Selesai
                        </button>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Penutup</label>
                        <textarea rows="4" placeholder="Contoh: Demikian proposal ini kami susun dengan harapan kegiatan Workshop UI/UX Design 2026 dapat terlaksana dengan baik..." class="w-full px-4 py-3 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#2C3DA6] resize-none transition-all"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Lampiran (opsional)</label>
                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer">
                            <svg class="w-8 h-8 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            <p class="text-xs text-gray-400">Klik untuk upload atau drag & drop (PDF, JPG, PNG)</p>
                        </div>
                    </div>
                </div>

                {{-- Final Actions --}}
                <div class="mt-6 bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('dashboard.proposal.preview', 'new') }}"
                           class="flex-1 flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold text-white bg-[#2C3DA6] rounded-xl hover:bg-[#2C3DA6]/90 shadow-lg shadow-[#2C3DA6]/20 transition-all hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Preview Proposal
                        </a>
                        <button class="px-6 py-3 text-sm font-semibold text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">
                            💾 Simpan Draft
                        </button>
                        <button class="px-6 py-3 text-sm font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-xl hover:bg-emerald-100 transition-colors">
                            📨 Submit untuk Persetujuan
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-layouts.dashboard>
