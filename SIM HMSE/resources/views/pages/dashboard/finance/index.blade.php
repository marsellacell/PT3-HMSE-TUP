<x-layouts.dashboard title="Keuangan">

    {{-- Tabs: Internal / Per-Proker --}}
    <div x-data="{ tab: 'overview', showAddModal: false, showDetailModal: false, selectedTx: null }" class="space-y-6">

        {{-- Success Alert --}}
        @if(session('success'))
            <div class="p-4 mb-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-emerald-700 font-semibold">{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl font-black text-gray-800">Manajemen Keuangan</h2>
                <p class="text-sm text-gray-400 mt-0.5">Kelola keuangan internal dan per-proker</p>
            </div>
            <div class="flex items-center gap-2">
                <button class="px-4 py-2.5 text-sm font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-xl hover:bg-emerald-100 flex items-center gap-2 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Ekspor Excel
                </button>
            </div>
        </div>

        {{-- Tab Buttons --}}
        <div class="flex gap-2">
            <button @click="tab = 'overview'" :class="tab === 'overview' ? 'bg-[#2C3DA6] text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50'" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition-all">Overview</button>
            <button @click="tab = 'internal'" :class="tab === 'internal' ? 'bg-[#2C3DA6] text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50'" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition-all">Kas Internal</button>
            <button @click="tab = 'proker'" :class="tab === 'proker' ? 'bg-[#2C3DA6] text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50'" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition-all">Per-Proker</button>
        </div>

        {{-- Overview --}}
        <div x-show="tab === 'overview'">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                @foreach([
                    ['label' => 'Total Pemasukan', 'value' => 'Rp 8.500.000', 'icon' => 'trending-up', 'color' => 'emerald', 'change' => '+15%'],
                    ['label' => 'Total Pengeluaran', 'value' => 'Rp 4.250.000', 'icon' => 'trending-down', 'color' => 'red', 'change' => '+8%'],
                    ['label' => 'Saldo Kas', 'value' => 'Rp 4.250.000', 'icon' => 'wallet', 'color' => 'blue', 'change' => 'Aktif'],
                    ['label' => 'Anggaran Proker', 'value' => 'Rp 12.800.000', 'icon' => 'chart', 'color' => 'purple', 'change' => '5 proker'],
                ] as $stat)
                    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl bg-{{ $stat['color'] }}-50 flex items-center justify-center">
                                <svg class="w-5 h-5 text-{{ $stat['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V7m0 1v8m0 0v1"/>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-{{ $stat['color'] }}-600 bg-{{ $stat['color'] }}-50 px-2 py-0.5 rounded-full">{{ $stat['change'] }}</span>
                        </div>
                        <p class="text-xl font-black text-gray-800">{{ $stat['value'] }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Simple Bar Chart --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-sm font-bold text-gray-800 mb-6">Ringkasan Keuangan 6 Bulan Terakhir</h3>
                <div class="flex items-end justify-between gap-2 h-48">
                    @foreach([
                        ['month' => 'Nov', 'in' => 60, 'out' => 30],
                        ['month' => 'Des', 'in' => 80, 'out' => 45],
                        ['month' => 'Jan', 'in' => 45, 'out' => 55],
                        ['month' => 'Feb', 'in' => 70, 'out' => 40],
                        ['month' => 'Mar', 'in' => 90, 'out' => 50],
                        ['month' => 'Apr', 'in' => 65, 'out' => 35],
                    ] as $bar)
                        <div class="flex-1 flex flex-col items-center gap-1">
                            <div class="w-full flex gap-0.5 items-end justify-center" style="height: 160px;">
                                <div class="w-5 bg-[#2C3DA6] rounded-t-md transition-all duration-500" style="height: {{ $bar['in'] }}%;"></div>
                                <div class="w-5 bg-red-400 rounded-t-md transition-all duration-500" style="height: {{ $bar['out'] }}%;"></div>
                            </div>
                            <span class="text-[10px] font-semibold text-gray-400">{{ $bar['month'] }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="flex items-center justify-center gap-6 mt-4">
                    <div class="flex items-center gap-2"><div class="w-3 h-3 rounded bg-[#2C3DA6]"></div><span class="text-xs text-gray-500">Pemasukan</span></div>
                    <div class="flex items-center gap-2"><div class="w-3 h-3 rounded bg-red-400"></div><span class="text-xs text-gray-500">Pengeluaran</span></div>
                </div>
            </div>
        </div>

        {{-- Kas Internal --}}
        <div x-show="tab === 'internal'" style="display: none;">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-gray-800">Catatan Kas Internal</h3>
                    <button @click="showAddModal = true" class="text-xs font-semibold text-[#2C3DA6] hover:text-[#00C4D8] flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Tambah Transaksi
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead><tr class="bg-gray-50 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            <th class="px-6 py-3 text-left">Tanggal</th>
                            <th class="px-4 py-3 text-left">Keterangan</th>
                            <th class="px-4 py-3 text-right">Debit (Masuk)</th>
                            <th class="px-4 py-3 text-right">Kredit (Keluar)</th>
                            <th class="px-4 py-3 text-right">Saldo</th>
                            <th class="px-4 py-3 text-center">Metode</th>
                            <th class="px-4 py-3 text-center">Bukti</th>
                        </tr></thead>
                        <tbody class="divide-y divide-gray-50">
                            @php $saldo = 0; @endphp
                            @forelse($transactions as $tx)
                                @php 
                                    if ($tx->type === 'pemasukan') $saldo += $tx->amount; 
                                    else $saldo -= $tx->amount; 
                                @endphp

                                <tr @click="selectedTx = {{ json_encode(['id' => $tx->id, 'date' => \Carbon\Carbon::parse($tx->date)->format('d M Y'), 'desc' => $tx->description, 'type' => $tx->type, 'amount' => number_format($tx->amount, 0, ',', '.'), 'method' => $tx->method, 'proof_url' => Storage::url($tx->proof_path), 'proker' => $tx->proposal ? $tx->proposal->proker : '-']) }}; showDetailModal = true" class="hover:bg-gray-50/50 transition-colors cursor-pointer">
                                    <td class="px-6 py-3 text-gray-500">{{ \Carbon\Carbon::parse($tx->date)->format('d M Y') }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-700">
                                        {{ $tx->description }}
                                        @if($tx->proposal)
                                            <div class="text-[10px] text-[#2C3DA6] mt-0.5 font-semibold">Proker: {{ $tx->proposal->proker }}</div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right {{ $tx->type === 'pemasukan' ? 'text-emerald-600 font-semibold' : 'text-gray-300' }}">
                                        {{ $tx->type === 'pemasukan' ? '+ Rp ' . number_format($tx->amount, 0, ',', '.') : '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-right {{ $tx->type === 'pengeluaran' ? 'text-red-500 font-semibold' : 'text-gray-300' }}">
                                        {{ $tx->type === 'pengeluaran' ? '- Rp ' . number_format($tx->amount, 0, ',', '.') : '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-right font-bold text-gray-700">Rp {{ number_format($saldo, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-center"><span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">{{ $tx->method }}</span></td>
                                    <td class="px-4 py-3 text-center">
                                        @if($tx->proof_path)
                                            <a href="{{ Storage::url($tx->proof_path) }}" target="_blank" class="p-1.5 rounded-lg hover:bg-blue-50 text-gray-400 hover:text-[#2C3DA6] transition-colors inline-block" title="Lihat bukti">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-300">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-gray-400 text-sm">
                                        Belum ada data transaksi. Silakan tambah transaksi baru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Per-Proker --}}
        <div x-show="tab === 'proker'" style="display: none;">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center gap-4 mb-6">
                    <label class="text-sm font-semibold text-gray-700">Pilih Proker:</label>
                    <select class="px-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:border-[#2C3DA6] text-gray-600 focus:outline-none focus:ring-2 focus:ring-[#2C3DA6]/20 min-w-[250px]">
                        <option value="">Pilih Program Kerja...</option>
                        @foreach($proposals as $p)
                            <option value="{{ $p->id }}">{{ $p->proker }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                    <div class="p-4 bg-emerald-50 rounded-xl"><p class="text-xs text-emerald-600 font-semibold">Anggaran</p><p class="text-lg font-black text-emerald-700">Rp 3.200.000</p></div>
                    <div class="p-4 bg-blue-50 rounded-xl"><p class="text-xs text-blue-600 font-semibold">Terpakai</p><p class="text-lg font-black text-blue-700">Rp 1.900.000</p></div>
                    <div class="p-4 bg-amber-50 rounded-xl"><p class="text-xs text-amber-600 font-semibold">Sisa</p><p class="text-lg font-black text-amber-700">Rp 1.300.000</p></div>
                </div>

                {{-- Proker finance table similar to internal --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead><tr class="bg-gray-50 text-xs font-semibold text-gray-400 uppercase"><th class="px-4 py-3 text-left">Item</th><th class="px-4 py-3 text-right">Anggaran</th><th class="px-4 py-3 text-right">Realisasi</th><th class="px-4 py-3 text-right">Selisih</th></tr></thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach([
                                ['item' => 'Sewa Ruangan', 'budget' => 500000, 'actual' => 500000],
                                ['item' => 'Snack & Makan Siang', 'budget' => 1250000, 'actual' => 1100000],
                                ['item' => 'Honor Pemateri', 'budget' => 1000000, 'actual' => 0],
                                ['item' => 'Sertifikat', 'budget' => 150000, 'actual' => 150000],
                                ['item' => 'Dekorasi & Publikasi', 'budget' => 300000, 'actual' => 150000],
                            ] as $b)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-4 py-3 font-medium text-gray-700">{{ $b['item'] }}</td>
                                    <td class="px-4 py-3 text-right text-gray-500">Rp {{ number_format($b['budget'], 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-right font-semibold text-gray-700">Rp {{ number_format($b['actual'], 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-right font-semibold {{ ($b['budget'] - $b['actual']) >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                                        Rp {{ number_format($b['budget'] - $b['actual'], 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Modal Tambah Transaksi --}}
        <div x-show="showAddModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm" style="display: none;">
            <div @click.away="showAddModal = false" x-transition.opacity.duration.300ms
                 class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                    <h3 class="text-base font-bold text-gray-800">Tambah Transaksi Baru</h3>
                    <button @click="showAddModal = false" class="text-gray-400 hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <form method="POST" action="{{ route('dashboard.finance.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Tanggal</label>
                            <input type="date" name="date" required class="w-full px-3 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:border-[#2C3DA6] focus:outline-none focus:ring-2 focus:ring-[#2C3DA6]/20">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Jenis Transaksi</label>
                            <select name="type" required class="w-full px-3 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:border-[#2C3DA6] focus:outline-none focus:ring-2 focus:ring-[#2C3DA6]/20">
                                <option value="pemasukan">Pemasukan (Debit)</option>
                                <option value="pengeluaran">Pengeluaran (Kredit)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Keterangan</label>
                        <input type="text" name="description" required placeholder="Contoh: Pembelian alat tulis" class="w-full px-3 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:border-[#2C3DA6] focus:outline-none focus:ring-2 focus:ring-[#2C3DA6]/20">
                    </div>

                    <div class="mt-4">
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Kaitkan dengan Proker (Opsional)</label>
                        <select name="proposal_id" class="w-full px-3 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:border-[#2C3DA6] focus:outline-none focus:ring-2 focus:ring-[#2C3DA6]/20">
                            <option value="">-- Tidak dikaitkan (Kas Internal Umum) --</option>
                            @foreach($proposals as $p)
                                <option value="{{ $p->id }}">{{ $p->proker }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nominal (Rp)</label>
                            <input type="number" name="amount" required min="0" placeholder="0" class="w-full px-3 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:border-[#2C3DA6] focus:outline-none focus:ring-2 focus:ring-[#2C3DA6]/20">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Metode</label>
                            <select name="method" required class="w-full px-3 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:border-[#2C3DA6] focus:outline-none focus:ring-2 focus:ring-[#2C3DA6]/20">
                                <option value="Transfer">Transfer</option>
                                <option value="Cash">Cash</option>
                                <option value="E-Wallet">E-Wallet</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Bukti Transaksi (Wajib: JPG/PNG/PDF)</label>
                        <input type="file" name="proof_file" required accept=".jpg,.jpeg,.png,.pdf" class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:border-[#2C3DA6] focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#2C3DA6]/10 file:text-[#2C3DA6] hover:file:bg-[#2C3DA6]/20">
                    </div>

                    <div class="mt-8 flex items-center justify-end gap-3">
                        <button type="button" @click="showAddModal = false" class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-[#2C3DA6] rounded-xl hover:bg-[#1E2D8F] shadow-lg shadow-[#2C3DA6]/20 transition-all">
                            Simpan Transaksi
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        {{-- Modal Detail Transaksi --}}
        <div x-show="showDetailModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm" style="display: none;">
            <div @click.away="showDetailModal = false" x-transition.opacity.duration.300ms
                 class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                    <h3 class="text-base font-bold text-gray-800">Detail Transaksi</h3>
                    <button @click="showDetailModal = false" class="text-gray-400 hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="p-6 space-y-4" x-show="selectedTx">
                    <div class="grid grid-cols-2 gap-y-4 text-sm">
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Tanggal</p>
                            <p class="font-semibold text-gray-800" x-text="selectedTx?.date"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Jenis</p>
                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold" 
                                  :class="selectedTx?.type === 'pemasukan' ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-500'"
                                  x-text="selectedTx?.type === 'pemasukan' ? 'Debit (Masuk)' : 'Kredit (Keluar)'"></span>
                        </div>
                        <div class="col-span-2">
                            <p class="text-xs text-gray-400 mb-1">Keterangan</p>
                            <p class="font-medium text-gray-800" x-text="selectedTx?.desc"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Nominal</p>
                            <p class="font-bold text-gray-800 text-lg">Rp <span x-text="selectedTx?.amount"></span></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Metode Pembayaran</p>
                            <p class="font-semibold text-gray-800" x-text="selectedTx?.method"></p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-xs text-gray-400 mb-1">Terkait Proker</p>
                            <p class="font-semibold text-[#2C3DA6]" x-text="selectedTx?.proker"></p>
                        </div>
                        <div class="col-span-2 pt-4 border-t border-gray-100">
                            <p class="text-xs text-gray-400 mb-2">Bukti Transaksi</p>
                            <a :href="selectedTx?.proof_url" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-[#2C3DA6] text-sm font-semibold rounded-lg hover:bg-blue-100 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Lihat Berkas Asli
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-layouts.dashboard>
