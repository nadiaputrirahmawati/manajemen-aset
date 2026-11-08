<div class="fixed inset-0 z-50 overflow-y-auto">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs transition-opacity" wire:click="$set('isDetailOpen', false)"></div>

        <div class="relative w-full max-w-3xl bg-white rounded-xl shadow-xl border border-slate-100 p-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">{{ $selectedAsset->name }}</h3>
                    <span class="inline-block mt-1 font-mono text-xs font-semibold text-blue-700 bg-blue-50 border border-blue-200/60 px-2 py-0.5 rounded">
                        {{ $selectedAsset->asset_code }}
                    </span>
                </div>
                <button wire:click="$set('isDetailOpen', false)" type="button" class="text-slate-400 hover:text-slate-600 p-1 rounded-md hover:bg-slate-100">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="space-y-6 max-h-[65vh] overflow-y-auto pr-1">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</p>
                        <p class="text-sm text-slate-800 mt-1">{{ $selectedAsset->category?->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Ruangan</p>
                        <p class="text-sm text-slate-800 mt-1">{{ $selectedAsset->room?->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Vendor</p>
                        <p class="text-sm text-slate-800 mt-1">{{ $selectedAsset->vendor?->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Serial Number</p>
                        <p class="text-sm font-mono text-slate-800 mt-1">{{ $selectedAsset->serial_number ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Brand</p>
                        <p class="text-sm text-slate-800 mt-1">{{ $selectedAsset->brand ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Beli</p>
                        <p class="text-sm text-slate-800 mt-1">{{ $selectedAsset->purchase_date?->format('d M Y') ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Harga</p>
                        <p class="text-sm font-mono text-slate-800 mt-1">Rp {{ number_format((float) $selectedAsset->purchase_price, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Garansi Hingga</p>
                        <p class="text-sm text-slate-800 mt-1">{{ $selectedAsset->warranty_expiry?->format('d M Y') ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Kondisi / Status</p>
                        <p class="text-sm text-slate-800 mt-1">
                            {{ ucwords(str_replace('_', ' ', $selectedAsset->condition)) }} /
                            {{ ucwords(str_replace('_', ' ', $selectedAsset->status)) }}
                        </p>
                    </div>
                </div>

                @if ($selectedAsset->notes)
                    <div class="bg-slate-50 border border-slate-200 rounded-lg p-3.5">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Catatan</p>
                        <p class="text-sm text-slate-700 mt-1">{{ $selectedAsset->notes }}</p>
                    </div>
                @endif

                <div>
                    <h4 class="text-sm font-bold text-slate-900 flex items-center mb-3">
                        <i data-lucide="arrow-left-right" class="w-4 h-4 mr-1.5 text-blue-600"></i>
                        Riwayat Mutasi
                    </h4>
                    @if ($selectedAsset->transfers->isEmpty())
                        <p class="text-sm text-slate-500">Belum ada riwayat mutasi.</p>
                    @else
                        <ul class="space-y-2">
                            @foreach ($selectedAsset->transfers as $transfer)
                                <li class="border border-slate-200 rounded-lg px-3.5 py-2.5 text-sm flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 bg-white">
                                    <span class="text-slate-700">
                                        {{ $transfer->fromRoom?->name ?? '-' }}
                                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 inline-block mx-1 text-slate-400 align-[-1px]"></i>
                                        <span class="font-medium text-slate-900">{{ $transfer->toRoom?->name ?? '-' }}</span>
                                    </span>
                                    <span class="text-xs text-slate-500">
                                        {{ $transfer->transfer_date?->format('d M Y H:i') }} &middot; {{ $transfer->transferred_by }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div>
                    <h4 class="text-sm font-bold text-slate-900 flex items-center mb-3">
                        <i data-lucide="wrench" class="w-4 h-4 mr-1.5 text-blue-600"></i>
                        Riwayat Maintenance
                    </h4>
                    @if ($selectedAsset->maintenanceLogs->isEmpty())
                        <p class="text-sm text-slate-500">Belum ada catatan maintenance.</p>
                    @else
                        <ul class="space-y-2">
                            @foreach ($selectedAsset->maintenanceLogs as $log)
                                <li class="border border-slate-200 rounded-lg px-3.5 py-2.5 text-sm flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 bg-white">
                                    <div>
                                        <p class="font-medium text-slate-900">{{ $log->maintenance_type }}</p>
                                        <p class="text-xs text-slate-500 mt-0.5">{{ $log->description ?? '-' }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-slate-500">{{ $log->action_date?->format('d M Y') }}</p>
                                        <p class="text-xs font-medium {{ $log->status === 'selesai' ? 'text-emerald-700' : ($log->status === 'dibatalkan' ? 'text-slate-500' : 'text-amber-700') }}">
                                            {{ ucfirst($log->status) }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="flex items-center justify-end pt-4 mt-4 border-t border-slate-100">
                <button type="button" wire:click="$set('isDetailOpen', false)" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-sm font-medium px-4 py-2 rounded-lg">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
