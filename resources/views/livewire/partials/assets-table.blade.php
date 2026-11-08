<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xs">
    <div class="px-5 py-4 border-b border-slate-200 flex items-center justify-between">
        <h2 class="text-sm font-semibold text-slate-700">Daftar Aset</h2>
        <div class="flex items-center space-x-2 text-xs text-slate-500">
            <span>Tampilkan</span>
            <select
                wire:model.live="perPage"
                class="bg-white border-slate-200 text-sm rounded-lg text-slate-700 py-1.5 px-2 focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 shadow-xs"
            >
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <span>data</span>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[760px]">
            <thead class="bg-slate-50/90 border-b border-slate-200 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                <tr>
                    <th class="px-5 py-3.5 whitespace-nowrap">Aset</th>
                    <th class="px-5 py-3.5 whitespace-nowrap">Kategori</th>
                    <th class="px-5 py-3.5 whitespace-nowrap">Ruangan</th>
                    <th class="px-5 py-3.5 whitespace-nowrap">Kondisi</th>
                    <th class="px-5 py-3.5 whitespace-nowrap">Status</th>
                    <th class="px-5 py-3.5 text-right whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($assets as $asset)
                    <tr class="border-b border-slate-100 hover:bg-blue-50/30 transition-colors text-sm text-slate-700 align-top">
                        <td class="px-5 py-3.5 min-w-[200px]">
                            <p class="font-medium text-slate-900">{{ $asset->name }}</p>
                            <span class="inline-block mt-1 font-mono text-xs font-semibold text-blue-700 bg-blue-50 border border-blue-200/60 px-2 py-0.5 rounded">
                                {{ $asset->asset_code }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 whitespace-nowrap">{{ $asset->category?->name ?? '-' }}</td>
                        <td class="px-5 py-3.5 whitespace-nowrap">{{ $asset->room?->name ?? '-' }}</td>
                        <td class="px-5 py-3.5">
                            @php
                                $conditionStyles = [
                                    'baik' => 'bg-emerald-50 text-emerald-700 border border-emerald-200/60',
                                    'rusak_ringan' => 'bg-amber-50 text-amber-700 border border-amber-200/60',
                                    'rusak_berat' => 'bg-rose-50 text-rose-700 border border-rose-200/60',
                                ];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $conditionStyles[$asset->condition] ?? 'bg-slate-50 text-slate-600 border border-slate-200' }}">
                                {{ ucwords(str_replace('_', ' ', $asset->condition)) }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            @php
                                $statusStyles = [
                                    'tersedia' => 'bg-emerald-50 text-emerald-700 border border-emerald-200/60',
                                    'sedang_digunakan' => 'bg-sky-50 text-sky-700 border border-sky-200/60',
                                    'dalam_perbaikan' => 'bg-amber-50 text-amber-700 border border-amber-200/60',
                                    'afkir' => 'bg-rose-50 text-rose-700 border border-rose-200/60',
                                ];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusStyles[$asset->status] ?? 'bg-slate-50 text-slate-600 border border-slate-200' }}">
                                {{ ucwords(str_replace('_', ' ', $asset->status)) }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 whitespace-nowrap">
                            <div class="flex items-center justify-end space-x-1">
                                <button wire:click="openDetailModal({{ $asset->id }})" title="Detail" class="text-slate-500 hover:text-blue-600 p-1.5 rounded-md hover:bg-slate-100 transition-colors">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </button>
                                <button wire:click="openEditModal({{ $asset->id }})" title="Edit" class="text-slate-500 hover:text-blue-600 p-1.5 rounded-md hover:bg-slate-100 transition-colors">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </button>
                                <button wire:click="openTransferModal({{ $asset->id }})" title="Mutasi" class="text-slate-500 hover:text-blue-600 p-1.5 rounded-md hover:bg-slate-100 transition-colors">
                                    <i data-lucide="arrow-left-right" class="w-4 h-4"></i>
                                </button>
                                <button wire:click="confirmDelete({{ $asset->id }})" title="Hapus" class="text-slate-500 hover:text-rose-600 p-1.5 rounded-md hover:bg-slate-100 transition-colors">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-14 text-center">
                            <div class="flex flex-col items-center text-slate-400">
                                <i data-lucide="package-search" class="w-10 h-10 mb-3"></i>
                                <p class="text-sm font-medium text-slate-600">Aset tidak ditemukan</p>
                                <p class="text-xs mt-1 text-slate-500">Coba ubah kata kunci atau filter pencarian.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 bg-white border-t border-slate-200">
        {{ $assets->links() }}
    </div>
</div>
