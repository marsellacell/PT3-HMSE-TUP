<x-layouts.dashboard title="Edit Program Kerja">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('dashboard.proker.show', $formState['id']) }}"
            class="p-2 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div>
            <h2 class="text-xl font-black text-gray-800">Edit Program Kerja</h2>
            <p class="text-sm text-gray-400">Ubah data program kerja yang sudah tersimpan</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50 text-red-700 text-sm">
            <p class="font-semibold mb-2">Validasi gagal, periksa input berikut:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $timelineItems = collect($formState['timeline'] ?? [])
            ->map(function ($item) {
                return [
                    'title' => $item['title'] ?? '',
                    'date' => $item['date'] ?? '',
                ];
            })
            ->values();

        if ($timelineItems->isEmpty()) {
            $timelineItems = collect([['title' => '', 'date' => '']]);
        }

        $budgetItems = collect($formState['budget_items'] ?? [])
            ->map(function ($item) {
                return [
                    'name' => $item['item'] ?? '',
                    'qty' => $item['qty'] ?? '',
                    'price' => $item['price'] ?? 0,
                ];
            })
            ->values();

        if ($budgetItems->isEmpty()) {
            $budgetItems = collect([['name' => '', 'qty' => '', 'price' => 0]]);
        }
    @endphp

    <form method="POST" action="{{ route('dashboard.proker.update', $formState['id']) }}" x-data="{
        step: 1,
        totalSteps: 4,
        stepLabels: ['Info Dasar', 'Jadwal', 'Anggaran', 'Review'],
        milestones: @js($timelineItems),
        items: @js($budgetItems),
    }"
        class="max-w-4xl">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 mb-6">
            <div class="flex items-center w-full">
                <template x-for="(label, i) in stepLabels" :key="i">
                    <div class="flex items-center" :class="i < stepLabels.length - 1 ? 'flex-1' : ''">
                        <div class="flex flex-col items-center">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-bold transition-all duration-300"
                                :class="i + 1 < step ? 'bg-emerald-500 text-white' : (i + 1 === step ?
                                    'bg-[#2C3DA6] text-white ring-4 ring-[#2C3DA6]/20' : 'bg-gray-200 text-gray-400'
                                    )">
                                <template x-if="i + 1 < step">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </template>
                                <template x-if="i + 1 >= step">
                                    <span x-text="i + 1"></span>
                                </template>
                            </div>
                            <span class="text-[10px] font-medium mt-1.5 text-center max-w-[80px] leading-tight"
                                :class="i + 1 <= step ? 'text-[#2C3DA6]' : 'text-gray-400'" x-text="label"></span>
                        </div>

                        <template x-if="i < stepLabels.length - 1">
                            <div class="flex-1 h-0.5 mx-2 mt-[-16px]"
                                :class="i + 1 < step ? 'bg-emerald-400' : 'bg-gray-200'"></div>
                        </template>
                    </div>
                </template>
            </div>
        </div>

        <div x-show="step === 1" class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 space-y-5">
            <h3 class="text-sm font-bold text-gray-800">Informasi Dasar</h3>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Program Kerja *</label>
                <input type="text" name="name" value="{{ old('name', $formState['name']) }}"
                    placeholder="Contoh: Workshop UI/UX Design"
                    class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:border-[#2C3DA6] focus:ring-2 focus:ring-[#2C3DA6]/20 transition-all">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Divisi *</label>
                    <select name="division"
                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:border-[#2C3DA6] text-gray-600">
                        <option value="">Pilih Divisi</option>
                        @foreach ($divisionOptions as $division)
                            <option value="{{ $division }}" @selected(old('division', $formState['division']) === $division)>{{ $division }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Penanggung Jawab *</label>
                    <select name="pj_user_id"
                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:border-[#2C3DA6] text-gray-600">
                        <option value="">Pilih Penanggung Jawab</option>
                        @foreach ($accounts as $account)
                            <option value="{{ $account['id'] }}" @selected((string) old('pj_user_id', $formState['pj_user_id']) === (string) $account['id'])>{{ $account['name'] }}
                                ({{ $account['division'] }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Status *</label>
                <select name="status"
                    class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:border-[#2C3DA6] text-gray-600">
                    @foreach (['draft' => 'Draft', 'preparation' => 'Persiapan', 'on-progress' => 'On Progress', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', $formState['status']) === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                <textarea rows="4" name="description" placeholder="Deskripsi singkat program kerja..."
                    class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:border-[#2C3DA6] focus:ring-2 focus:ring-[#2C3DA6]/20 transition-all resize-none">{{ old('description', $formState['description']) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
                    <input type="text" name="location" value="{{ old('location', $formState['location']) }}"
                        placeholder="Lokasi pelaksanaan"
                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:border-[#2C3DA6] focus:ring-2 focus:ring-[#2C3DA6]/20 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Target Peserta</label>
                    <input type="number" name="target_participants"
                        value="{{ old('target_participants', $formState['target_participants']) }}"
                        placeholder="Jumlah peserta"
                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:border-[#2C3DA6] focus:ring-2 focus:ring-[#2C3DA6]/20 transition-all">
                </div>
            </div>
        </div>

        <div x-show="step === 2" style="display:none;"
            class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 space-y-5">
            <h3 class="text-sm font-bold text-gray-800">Jadwal & Timeline</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Mulai *</label>
                    <input type="date" name="date_start" value="{{ old('date_start', $formState['date_start']) }}"
                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:border-[#2C3DA6] focus:ring-2 focus:ring-[#2C3DA6]/20 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Selesai *</label>
                    <input type="date" name="date_end" value="{{ old('date_end', $formState['date_end']) }}"
                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:border-[#2C3DA6] focus:ring-2 focus:ring-[#2C3DA6]/20 transition-all">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">Tahapan Kegiatan</label>
                <div class="space-y-3">
                    <template x-for="(m, i) in milestones" :key="i">
                        <div class="flex items-center gap-3">
                            <span
                                class="w-7 h-7 rounded-full bg-[#2C3DA6]/10 text-[#2C3DA6] text-xs font-bold flex items-center justify-center flex-shrink-0"
                                x-text="i + 1"></span>
                            <input type="text" :name="`timeline_titles[${i}]`" placeholder="Nama tahapan"
                                x-model="m.title"
                                class="flex-1 px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:border-[#2C3DA6]">
                            <input type="date" :name="`timeline_dates[${i}]`" x-model="m.date"
                                class="px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:border-[#2C3DA6]">
                            <button type="button" @click="milestones.splice(i, 1)" x-show="milestones.length > 1"
                                class="p-1.5 text-gray-400 hover:text-red-500 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </template>
                    <button type="button" @click="milestones.push({ title: '', date: '' })"
                        class="text-xs font-semibold text-[#2C3DA6] hover:text-[#00C4D8] transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Tahapan
                    </button>
                </div>
            </div>
        </div>

        <div x-show="step === 3" style="display:none;"
            class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 space-y-5">
            <h3 class="text-sm font-bold text-gray-800">Rencana Anggaran</h3>
            <div class="space-y-3">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr
                                class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider border-b border-gray-200">
                                <th class="pb-2 pr-3">Item</th>
                                <th class="pb-2 pr-3">Qty</th>
                                <th class="pb-2 pr-3">Harga (Rp)</th>
                                <th class="pb-2 text-right">Subtotal</th>
                                <th class="pb-2 w-10"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(item, i) in items" :key="i">
                                <tr class="border-b border-gray-50">
                                    <td class="py-2 pr-3"><input type="text" :name="`budget_item_names[${i}]`"
                                            x-model="item.name" placeholder="Nama item"
                                            class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-[#2C3DA6]">
                                    </td>
                                    <td class="py-2 pr-3"><input type="text" :name="`budget_qtys[${i}]`"
                                            x-model="item.qty" placeholder="1 pcs"
                                            class="w-24 px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-[#2C3DA6]">
                                    </td>
                                    <td class="py-2 pr-3"><input type="number" :name="`budget_prices[${i}]`"
                                            x-model.number="item.price" placeholder="0"
                                            class="w-36 px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-[#2C3DA6]">
                                    </td>
                                    <td class="py-2 text-right font-semibold text-gray-600"
                                        x-text="'Rp ' + (item.price || 0).toLocaleString('id-ID')"></td>
                                    <td class="py-2 text-center">
                                        <button type="button" @click="items.splice(i, 1)" x-show="items.length > 1"
                                            class="text-gray-400 hover:text-red-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-gray-200">
                                <td colspan="3" class="py-3 text-right font-bold text-gray-700">Total</td>
                                <td class="py-3 text-right font-black text-[#2C3DA6]"
                                    x-text="'Rp ' + items.reduce((s, i) => s + (i.price || 0), 0).toLocaleString('id-ID')">
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <button type="button" @click="items.push({ name: '', qty: '', price: 0 })"
                    class="text-xs font-semibold text-[#2C3DA6] hover:text-[#00C4D8] flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Item
                </button>
            </div>
        </div>

        <div x-show="step === 4" style="display:none;"
            class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <h3 class="text-sm font-bold text-gray-800 mb-4">Review & Kirim</h3>
            <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-sm text-emerald-700 mb-4">
                <p class="font-semibold mb-1">Semua data siap disimpan</p>
                <p class="text-xs text-emerald-600">Klik simpan untuk memperbarui program kerja.</p>
            </div>
            <p class="text-sm text-gray-500">Perubahan akan disimpan ke database.</p>
        </div>

        <div class="flex items-center justify-between mt-6">
            <button type="button" x-show="step > 1" @click="step--"
                class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                ← Sebelumnya
            </button>
            <div x-show="step === 1"></div>

            <div class="flex gap-3">
                <button type="button" x-show="step < totalSteps" @click="step++"
                    class="px-6 py-2.5 text-sm font-semibold text-white bg-[#2C3DA6] rounded-xl hover:bg-[#2C3DA6]/90 transition-colors shadow-md shadow-[#2C3DA6]/20">
                    Selanjutnya →
                </button>
                <button type="submit" x-show="step === totalSteps"
                    class="px-6 py-2.5 text-sm font-semibold text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition-colors shadow-md shadow-emerald-600/20">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>

</x-layouts.dashboard>
