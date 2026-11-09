<div class="space-y-7">
    <!-- Top Row: Main Account Card & Emerald Action Promo Card -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Main Asset Portfolio Card (7 cols) -->
        <div class="lg:col-span-7 bg-white rounded-3xl p-7 sm:p-8 border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between relative overflow-hidden">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Portofolio Aset Utama</span>
                    <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Manajemen Aset</h2>
                
                </div>

                <div class="text-right">
                    <span class="text-xs font-semibold text-slate-400 block mb-1">Total Nilai Inventaris</span>
                    <div class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-mono tracking-tight">
                        Rp {{ number_format($totalValue, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <!-- Action Buttons inside Main Card -->
            <div class="flex flex-wrap items-center gap-3 mt-8 pt-2">
                <a
                    href="{{ route('assets.index') }}"
                    class="inline-flex items-center gap-2.5 bg-emerald-700 hover:bg-emerald-800 text-white font-semibold text-sm px-5 py-3 rounded-2xl shadow-sm shadow-emerald-700/20 transition-all hover:shadow-md cursor-pointer"
                >
                    <i data-lucide="package" class="w-4 h-4"></i>
                    <span>Kelola Semua Aset</span>
                </a>

                <a
                    href="{{ route('vendors.index') }}"
                    class="inline-flex items-center gap-2 bg-[#f0f4f4] hover:bg-[#e4ebec] text-slate-700 font-semibold text-sm px-5 py-3 rounded-2xl transition-all cursor-pointer"
                >
                    <i data-lucide="truck" class="w-4 h-4 text-slate-500"></i>
                    <span>Daftar Vendor</span>
                </a>
            </div>
        </div>

        <!-- Emerald Feature / Standings Order Card (5 cols) -->
        <div class="lg:col-span-5 rounded-3xl p-7 sm:p-8 bg-gradient-to-br from-emerald-800 via-emerald-700 to-teal-800 text-white flex flex-col justify-between relative overflow-hidden shadow-[0_8px_30px_rgb(5,150,105,0.18)]">
            <div class="absolute -right-12 -top-12 w-64 h-64 rounded-full bg-emerald-500/10 pointer-events-none blur-2xl"></div>
            <div class="absolute right-0 bottom-0 opacity-15 pointer-events-none transform translate-x-4 translate-y-4">
                <i data-lucide="shield-check" class="w-48 h-48 stroke-1"></i>
            </div>

            <div class="relative z-10">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-bold tracking-tight text-white">Status Servis & Perbaikan</h3>
                    <div class="flex items-center gap-1.5 bg-white/20 px-2.5 py-1 rounded-full text-[10px] font-semibold tracking-wider uppercase text-emerald-100">
                        <span>Unit Sedang Ditangani</span>
                    </div>
                </div>
                <p class="text-xs text-emerald-100/90 leading-relaxed max-w-xs mt-2">
                    Pemeliharaan rutin dan perbaikan teknis alat elektromedis. Klik untuk melihat daftar unit yang saat ini dalam proses perbaikan.
                </p>
            </div>

            <div class="relative z-10 flex items-end justify-between mt-6 pt-2">
                <button
                    type="button"
                    wire:click="openRepairModal"
                    class="bg-white hover:bg-emerald-50 text-emerald-800 font-bold text-xs px-5 py-3 rounded-2xl shadow-sm transition-all cursor-pointer inline-flex items-center gap-2"
                >
                    <span>Buka Daftar Perbaikan ({{ $repairAssets }})</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </button>

                <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex flex-col items-center justify-center p-2 shadow-inner">
                    <div class="w-full flex justify-between px-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-300"></span>
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-300"></span>
                    </div>
                    <span class="text-lg font-black mt-0.5">{{ date('d') }}</span>
                    <span class="text-[9px] uppercase tracking-wider font-semibold text-emerald-200">{{ date('M') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Row: Bank Card-Style KPI Tiles (4 Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <!-- Card 1: Total Aset -->
        <a href="{{ route('assets.index') }}" class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between hover:border-emerald-300 hover:shadow-md transition-all group">
            <div class="flex items-start justify-between">
                <div>
                    <h4 class="font-bold text-sm text-slate-800 group-hover:text-emerald-700 transition-colors">Total Inventaris</h4>
                    <span class="text-[11px] font-mono text-slate-400 mt-0.5 block">Semua unit RS</span>
                </div>
                <div class="w-9 h-9 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="package" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="mt-6 flex items-baseline justify-between">
                <div class="text-2xl font-black text-slate-900 font-mono tracking-tight">{{ $totalAssets }} <span class="text-xs font-semibold text-slate-400 font-sans">Unit</span></div>
                <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">100%</span>
            </div>
        </a>

        <!-- Card 2: Siap Pakai -->
        <a href="{{ route('assets.index') }}?status=tersedia" class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between hover:border-teal-300 hover:shadow-md transition-all group">
            <div class="flex items-start justify-between">
                <div>
                    <h4 class="font-bold text-sm text-slate-800 group-hover:text-teal-700 transition-colors">Siap Operasional</h4>
                    <span class="text-[11px] font-mono text-slate-400 mt-0.5 block">Status: Tersedia</span>
                </div>
                <div class="w-9 h-9 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="mt-6 flex items-baseline justify-between">
                <div class="text-2xl font-black text-slate-900 font-mono tracking-tight">{{ $readyAssets }} <span class="text-xs font-semibold text-slate-400 font-sans">Unit</span></div>
                <span class="text-xs font-semibold text-teal-600 bg-teal-50 px-2 py-0.5 rounded-full">
                    {{ $totalAssets > 0 ? round(($readyAssets / $totalAssets) * 100) : 0 }}%
                </span>
            </div>
        </a>

        <!-- Card 3: Sedang Digunakan -->
        <a href="{{ route('assets.index') }}?status=sedang_digunakan" class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between hover:border-sky-300 hover:shadow-md transition-all group">
            <div class="flex items-start justify-between">
                <div>
                    <h4 class="font-bold text-sm text-slate-800 group-hover:text-sky-700 transition-colors">Sedang Digunakan</h4>
                    <span class="text-[11px] font-mono text-slate-400 mt-0.5 block">Di Ruang Rawat/Poli</span>
                </div>
                <div class="w-9 h-9 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="activity" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="mt-6 flex items-baseline justify-between">
                <div class="text-2xl font-black text-slate-900 font-mono tracking-tight">{{ $inUseAssets }} <span class="text-xs font-semibold text-slate-400 font-sans">Unit</span></div>
                <span class="text-xs font-semibold text-sky-600 bg-sky-50 px-2 py-0.5 rounded-full">
                    {{ $totalAssets > 0 ? round(($inUseAssets / $totalAssets) * 100) : 0 }}%
                </span>
            </div>
        </a>

        <!-- Card 4: Dalam Perbaikan (Click to open modal) -->
        <button
            type="button"
            wire:click="openRepairModal"
            class="bg-white text-left rounded-3xl p-5 sm:p-6 border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between hover:border-amber-400 hover:shadow-md transition-all group cursor-pointer"
        >
            <div class="flex items-start justify-between w-full">
                <div>
                    <h4 class="font-bold text-sm text-slate-800 group-hover:text-amber-600 transition-colors">Dalam Perbaikan</h4>
                    <span class="text-[11px] font-mono text-slate-400 mt-0.5 block">Klik lihat rincian &rarr;</span>
                </div>
                <div class="w-9 h-9 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="wrench" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="mt-6 flex items-baseline justify-between w-full">
                <div class="text-2xl font-black text-slate-900 font-mono tracking-tight">{{ $repairAssets }} <span class="text-xs font-semibold text-slate-400 font-sans">Unit</span></div>
                <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">
                    {{ $totalAssets > 0 ? round(($repairAssets / $totalAssets) * 100) : 0 }}%
                </span>
            </div>
        </button>
    </div>

    <!-- Analytics & Recent Registration (NevBank style) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Left: Recent Asset Registrations (7 cols) -->
        <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-7 border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-base font-extrabold text-slate-900 tracking-tight">Registrasi Aset Terbaru</h3>
                        <p class="text-xs text-slate-400 font-medium">Histori aset yang baru dimasukkan ke basis data RS</p>
                    </div>
                    <a href="{{ route('assets.index') }}" class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-700 hover:bg-emerald-100 flex items-center justify-center transition-colors">
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse ($recentAssets as $item)
                        <div class="py-3.5 flex items-center justify-between gap-3 group">
                            <div class="flex items-center gap-3.5 min-w-0">
                                <span class="text-xs font-semibold text-slate-400 w-16 shrink-0">
                                    {{ $item->created_at ? $item->created_at->format('d M') : 'Baru' }}
                                </span>
                                <div class="w-9 h-9 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-600 shrink-0 group-hover:bg-emerald-50 group-hover:text-emerald-700 transition-colors">
                                    <i data-lucide="activity" class="w-4 h-4"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-slate-800 truncate">{{ $item->name }}</p>
                                    <p class="text-[11px] text-slate-400 truncate">{{ $item->room?->name ?? 'Belum ada ruangan' }} &bull; {{ $item->brand ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 shrink-0">
                                <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    {{ $item->category?->name ?? 'Aset' }}
                                </span>
                                <div class="text-right font-mono text-xs font-bold text-slate-900">
                                    Rp {{ number_format($item->purchase_price, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 py-6 text-center">Belum ada inventaris tercatat.</p>
                    @endforelse
                </div>
            </div>

            <div class="pt-4 mt-2 border-t border-slate-100 flex justify-center">
                <a href="{{ route('assets.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 inline-flex items-center gap-1.5">
                    <span>Buka halaman Daftar Aset</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        </div>

        <!-- Right: Donut Category Distribution (5 cols) -->
        <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-7 border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base font-extrabold text-slate-900 tracking-tight">Distribusi Kategori</h3>
                        <p class="text-xs text-slate-400 font-medium">Alokasi alat berdasarkan jenis medis</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center">
                        <i data-lucide="pie-chart" class="w-4 h-4"></i>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-2 py-3 border-y border-slate-100 text-center mb-6">
                    <div>
                        <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Aset Aktif</span>
                        <span class="text-sm font-black text-slate-800 font-mono">{{ $readyAssets + $inUseAssets }}</span>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Siap Pakai</span>
                        <span class="text-sm font-black text-teal-600 font-mono">{{ $readyAssets }}</span>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Perbaikan</span>
                        <span class="text-sm font-black text-amber-600 font-mono">{{ $repairAssets }}</span>
                    </div>
                </div>

                <!-- Donut Visual -->
                <div class="flex flex-col sm:flex-row items-center justify-around gap-6">
                    <div class="relative w-40 h-40 flex items-center justify-center shrink-0">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="38" stroke="#f1f5f9" stroke-width="12" fill="transparent" />
                            @php
                                $pReady = $totalAssets > 0 ? ($readyAssets / $totalAssets) * 100 : 0;
                                $pInUse = $totalAssets > 0 ? ($inUseAssets / $totalAssets) * 100 : 0;
                                $pRepair = $totalAssets > 0 ? ($repairAssets / $totalAssets) * 100 : 0;
                                $circumference = 2 * pi() * 38;
                                $dashReady = ($pReady / 100) * $circumference;
                                $dashInUse = ($pInUse / 100) * $circumference;
                                $dashRepair = ($pRepair / 100) * $circumference;
                            @endphp
                            <circle
                                cx="50" cy="50" r="38"
                                stroke="#059669"
                                stroke-width="12"
                                stroke-dasharray="{{ $dashReady }} {{ $circumference }}"
                                stroke-dashoffset="0"
                                stroke-linecap="round"
                                fill="transparent"
                            />
                            <circle
                                cx="50" cy="50" r="38"
                                stroke="#0284c7"
                                stroke-width="12"
                                stroke-dasharray="{{ $dashInUse }} {{ $circumference }}"
                                stroke-dashoffset="-{{ $dashReady }}"
                                stroke-linecap="round"
                                fill="transparent"
                            />
                            <circle
                                cx="50" cy="50" r="38"
                                stroke="#d97706"
                                stroke-width="12"
                                stroke-dasharray="{{ $dashRepair }} {{ $circumference }}"
                                stroke-dashoffset="-{{ $dashReady + $dashInUse }}"
                                stroke-linecap="round"
                                fill="transparent"
                            />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                            <span class="text-[10px] font-semibold text-slate-400">Total Unit</span>
                            <span class="text-xl font-extrabold text-slate-900 font-mono">{{ $totalAssets }}</span>
                            <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.2 rounded-full">Unit RS</span>
                        </div>
                    </div>

                    <div class="space-y-2.5 w-full max-w-[200px]">
                        @php
                            $colors = ['bg-emerald-600', 'bg-sky-600', 'bg-amber-500', 'bg-rose-500', 'bg-purple-500'];
                        @endphp
                        @foreach ($categoryBreakdown as $idx => $cat)
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2 truncate">
                                    <span class="w-2.5 h-2.5 rounded-full {{ $colors[$idx % count($colors)] }} shrink-0"></span>
                                    <span class="font-bold text-slate-700 truncate">{{ $cat->name }}</span>
                                </div>
                                <span class="font-mono font-bold text-slate-900 shrink-0 ml-2">{{ $cat->assets_count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-3 border-t border-slate-100 text-center">
                <span class="text-[11px] text-slate-400">Data sinkronisasi sistem rumah sakit realtime</span>
            </div>
        </div>
    </div>

    <!-- Modal Daftar Aset Dalam Perbaikan -->
    @if ($isRepairModalOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" wire:click="closeRepairModal"></div>

                <div class="relative w-full max-w-3xl bg-white rounded-3xl shadow-2xl border border-slate-100 p-6 sm:p-8 overflow-hidden z-10">
                    <div class="flex items-start justify-between border-b border-slate-100 pb-4 mb-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center">
                                <i data-lucide="wrench" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-extrabold text-slate-900 tracking-tight">Daftar Aset Dalam Perbaikan</h3>
                                <p class="text-xs text-slate-400 font-medium">Terdapat {{ $repairingAssets->count() }} unit yang sedang dalam proses perbaikan/servis</p>
                            </div>
                        </div>
                        <button
                            type="button"
                            wire:click="closeRepairModal"
                            class="w-9 h-9 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition-colors cursor-pointer"
                        >
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>

                    <div class="max-h-[60vh] overflow-y-auto space-y-3 pr-1">
                        @forelse ($repairingAssets as $asset)
                            <div class="p-4 rounded-2xl border border-amber-100 bg-amber-50/30 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-slate-900 text-sm">{{ $asset->name }}</span>
                                        <span class="font-mono text-[10px] font-bold text-amber-800 bg-amber-100 px-2 py-0.5 rounded-md">
                                            {{ $asset->asset_code }}
                                        </span>
                                    </div>
                                    <div class="text-xs text-slate-500 mt-1 flex flex-wrap items-center gap-x-3 gap-y-1">
                                        <span>Ruangan: <strong class="text-slate-700">{{ $asset->room?->name ?? '-' }}</strong></span>
                                        <span>&bull;</span>
                                        <span>Vendor: <strong class="text-slate-700">{{ $asset->vendor?->name ?? 'Internal / Tidak ada' }}</strong></span>
                                        <span>&bull;</span>
                                        <span>Kondisi: <strong class="text-amber-700">{{ ucwords(str_replace('_', ' ', $asset->condition)) }}</strong></span>
                                    </div>
                                    @if ($asset->notes)
                                        <p class="text-xs text-slate-600 mt-2 bg-white/70 p-2 rounded-xl border border-amber-100/50">
                                            <span class="font-semibold text-slate-700">Catatan Kerusakan:</span> {{ $asset->notes }}
                                        </p>
                                    @endif
                                </div>

                                <div class="shrink-0 text-right sm:self-center">
                                    <a
                                        href="{{ route('assets.index') }}?search={{ urlencode($asset->asset_code) }}"
                                        class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 hover:text-emerald-800 bg-white hover:bg-emerald-50 px-3 py-2 rounded-xl border border-slate-200 shadow-2xs transition-colors"
                                    >
                                        <span>Buka di Aset</span>
                                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 text-slate-400">
                                <i data-lucide="check-circle" class="w-10 h-10 mx-auto text-emerald-500 mb-2"></i>
                                <p class="text-sm font-bold text-slate-700">Tidak ada aset dalam perbaikan!</p>
                                <p class="text-xs text-slate-400 mt-0.5">Semua inventaris medis dalam kondisi operasional optimal.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs text-slate-400">Klik 'Buka di Aset' untuk memperbarui status dan kondisi aset</span>
                        <button
                            type="button"
                            wire:click="closeRepairModal"
                            class="bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-5 py-2.5 rounded-2xl transition-colors cursor-pointer"
                        >
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
