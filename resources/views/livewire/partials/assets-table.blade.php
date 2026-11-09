<div id="assets-section" class="bg-white rounded-3xl border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] overflow-hidden">
    <!-- Header of the Table -->
    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between flex-wrap gap-4">
        <div>
            <h3 class="text-base font-extrabold text-slate-900 tracking-tight">Daftar Inventaris Terdaftar</h3>
            <p class="text-xs text-slate-400 font-medium mt-0.5">Semua data fisik, unit ruangan, dan kondisi operasional</p>
        </div>

        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                <span>Baris:</span>
                <select
                    wire:model.live="perPage"
                    class="bg-[#f8fafb] border border-slate-200/80 text-xs font-bold rounded-xl text-slate-700 py-1.5 px-3 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 cursor-pointer"
                >
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table Content -->
    <div class="overflow-x-auto">
        <table class="w-full min-w-[800px] text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100/90 text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/50">
                    <th class="px-6 py-4">Aset & Kode</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Ruangan</th>
                    <th class="px-6 py-4">Harga Pembelian</th>
                    <th class="px-6 py-4">Kondisi</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100/80 text-sm">
                @forelse ($assets as $asset)
                    <tr class="hover:bg-slate-50/70 transition-colors group">
                        <!-- Asset Name & Code -->
                        <td class="px-6 py-4.5">
                            <div class="flex items-center gap-3.5">
                                <div class="w-9 h-9 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs shrink-0 group-hover:scale-105 transition-transform">
                                    <i data-lucide="box" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 leading-snug">{{ $asset->name }}</p>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="font-mono text-[11px] font-semibold text-slate-500">
                                            {{ $asset->asset_code }}
                                        </span>
                                        @if($asset->brand)
                                            <span class="text-[11px] text-slate-400 font-medium">&bull; {{ $asset->brand }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Category -->
                        <td class="px-6 py-4.5">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                {{ $asset->category?->name ?? '-' }}
                            </span>
                        </td>

                        <!-- Room -->
                        <td class="px-6 py-4.5">
                            <span class="text-xs font-semibold text-slate-600 block">{{ $asset->room?->name ?? '-' }}</span>
                            <span class="text-[10px] text-slate-400 font-medium">{{ $asset->room?->code ?? '' }}</span>
                        </td>

                        <!-- Purchase Price -->
                        <td class="px-6 py-4.5 font-mono text-xs font-bold text-slate-800">
                            Rp {{ number_format($asset->purchase_price, 0, ',', '.') }}
                        </td>

                        <!-- Condition -->
                        <td class="px-6 py-4.5">
                            @php
                                $condMap = [
                                    'baik' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'dot' => 'bg-emerald-500'],
                                    'rusak_ringan' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'dot' => 'bg-amber-500'],
                                    'rusak_berat' => ['bg' => 'bg-rose-50', 'text' => 'text-rose-700', 'dot' => 'bg-rose-500'],
                                ];
                                $c = $condMap[$asset->condition] ?? ['bg' => 'bg-slate-50', 'text' => 'text-slate-600', 'dot' => 'bg-slate-400'];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $c['bg'] }} {{ $c['text'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $c['dot'] }}"></span>
                                {{ ucwords(str_replace('_', ' ', $asset->condition)) }}
                            </span>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4.5">
                            @php
                                $statusMap = [
                                    'tersedia' => ['bg' => 'bg-teal-50', 'text' => 'text-teal-700', 'dot' => 'bg-teal-500'],
                                    'sedang_digunakan' => ['bg' => 'bg-sky-50', 'text' => 'text-sky-700', 'dot' => 'bg-sky-500'],
                                    'dalam_perbaikan' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'dot' => 'bg-amber-500'],
                                    'afkir' => ['bg' => 'bg-rose-50', 'text' => 'text-rose-700', 'dot' => 'bg-rose-500'],
                                ];
                                $st = $statusMap[$asset->status] ?? ['bg' => 'bg-slate-50', 'text' => 'text-slate-600', 'dot' => 'bg-slate-400'];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $st['bg'] }} {{ $st['text'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $st['dot'] }}"></span>
                                {{ ucwords(str_replace('_', ' ', $asset->status)) }}
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4.5 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1">
                                <button
                                    wire:click="openDetailModal({{ $asset->id }})"
                                    title="Detail Lengkap"
                                    class="w-8 h-8 rounded-xl flex items-center justify-center text-slate-400 hover:text-emerald-700 hover:bg-emerald-50 transition-colors"
                                >
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </button>
                                <button
                                    wire:click="openEditModal({{ $asset->id }})"
                                    title="Edit Data"
                                    class="w-8 h-8 rounded-xl flex items-center justify-center text-slate-400 hover:text-emerald-700 hover:bg-emerald-50 transition-colors"
                                >
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </button>
                                <button
                                    wire:click="openTransferModal({{ $asset->id }})"
                                    title="Mutasi Ruangan"
                                    class="w-8 h-8 rounded-xl flex items-center justify-center text-slate-400 hover:text-emerald-700 hover:bg-emerald-50 transition-colors"
                                >
                                    <i data-lucide="arrow-left-right" class="w-4 h-4"></i>
                                </button>
                                <button
                                    wire:click="confirmDelete({{ $asset->id }})"
                                    title="Hapus"
                                    class="w-8 h-8 rounded-xl flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-colors"
                                >
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <div class="w-14 h-14 rounded-3xl bg-slate-100 flex items-center justify-center text-slate-400 mb-3">
                                    <i data-lucide="search-x" class="w-7 h-7"></i>
                                </div>
                                <h4 class="text-sm font-bold text-slate-700">Data Aset Tidak Ditemukan</h4>
                                <p class="text-xs text-slate-400 mt-1">Coba atur ulang kata kunci atau filter pencarian Anda</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Footer -->
    <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
        {{ $assets->links() }}
    </div>
</div>
