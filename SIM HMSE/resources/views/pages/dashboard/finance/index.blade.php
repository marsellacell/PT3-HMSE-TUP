<x-layouts.dashboard title="Keuangan">

    {{-- Tabs: Internal / Per-Proker --}}
    <div x-data="{ tab: 'overview' }" class="space-y-6">

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
                    <button class="text-xs font-semibold text-[#2C3DA6] hover:text-[#00C4D8] flex items-center gap-1">
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
                            @foreach([
                                ['date' => '01 Mar', 'desc' => 'Iuran anggota Maret', 'debit' => 1600000, 'credit' => 0, 'method' => 'Transfer'],
                                ['date' => '05 Mar', 'desc' => 'Cetak sertifikat Bootcamp', 'debit' => 0, 'credit' => 150000, 'method' => 'Cash'],
                                ['date' => '10 Mar', 'desc' => 'Sponsor Tech Week', 'debit' => 3000000, 'credit' => 0, 'method' => 'Transfer'],
                                ['date' => '15 Mar', 'desc' => 'Sewa sound system', 'debit' => 0, 'credit' => 750000, 'method' => 'Transfer'],
                                ['date' => '20 Mar', 'desc' => 'Penjualan merchandise', 'debit' => 850000, 'credit' => 0, 'method' => 'Cash'],
                                ['date' => '25 Mar', 'desc' => 'Konsumsi rapat koordinasi', 'debit' => 0, 'credit' => 300000, 'method' => 'E-Wallet'],
                            ] as $tx)
                                @php $saldo += $tx['debit'] - $tx['credit']; @endphp
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-3 text-gray-500">{{ $tx['date'] }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-700">{{ $tx['desc'] }}</td>
                                    <td class="px-4 py-3 text-right {{ $tx['debit'] > 0 ? 'text-emerald-600 font-semibold' : 'text-gray-300' }}">
                                        {{ $tx['debit'] > 0 ? '+ Rp ' . number_format($tx['debit'], 0, ',', '.') : '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-right {{ $tx['credit'] > 0 ? 'text-red-500 font-semibold' : 'text-gray-300' }}">
                                        {{ $tx['credit'] > 0 ? '- Rp ' . number_format($tx['credit'], 0, ',', '.') : '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-right font-bold text-gray-700">Rp {{ number_format($saldo, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-center"><span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">{{ $tx['method'] }}</span></td>
                                    <td class="px-4 py-3 text-center">
                                        <button class="p-1.5 rounded-lg hover:bg-blue-50 text-gray-400 hover:text-[#2C3DA6] transition-colors" title="Upload bukti">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
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
                    <select class="px-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:border-[#2C3DA6] text-gray-600">
                        <option>Workshop UI/UX Design</option>
                        <option>Seminar Tech Week</option>
                        <option>Bazaar Kewirausahaan</option>
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

    </div>

</x-layouts.dashboard>
