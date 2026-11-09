<div id="analytics-section" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <!-- Left: Latest Activity / Recent Assets (7 cols) -->
    <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-7 border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-base font-extrabold text-slate-900 tracking-tight">Registrasi & Mutasi Terbaru</h3>
                    <p class="text-xs text-slate-400 font-medium">Histori aset terbaru yang ditambahkan ke sistem</p>
                </div>
                <a href="#assets-section" class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-700 hover:bg-emerald-100 flex items-center justify-center transition-colors">
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- List rows resembling transactions list in NevBank -->
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
                    <p class="text-xs text-slate-400 py-6 text-center">Belum ada aktivitas mutasi aset.</p>
                @endforelse
            </div>
        </div>

        <div class="pt-4 mt-2 border-t border-slate-100 flex justify-center">
            <a href="#assets-section" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 inline-flex items-center gap-1.5">
                <span>Lihat semua aset inventaris</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>
    </div>

    <!-- Right: Distribution & Expenses Donut Breakdown (5 cols) -->
    <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-7 border border-slate-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-extrabold text-slate-900 tracking-tight">Distribusi Kategori</h3>
                    <p class="text-xs text-slate-400 font-medium">Alokasi nilai investasi alat rumah sakit</p>
                </div>
                <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center">
                    <i data-lucide="pie-chart" class="w-4 h-4"></i>
                </div>
            </div>

            <!-- Mini stats: Total, Rata-rata, Aktif -->
            <div class="grid grid-cols-3 gap-2 py-3 border-y border-slate-100 text-center mb-6">
                <div>
                    <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Aset Aktif</span>
                    <span class="text-sm font-black text-slate-800 font-mono">{{ $readyAssets + $inUseAssets }}</span>
                </div>
                <div>
                    <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Kategori</span>
                    <span class="text-sm font-black text-slate-800 font-mono">{{ $categories->count() }}</span>
                </div>
                <div>
                    <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Perbaikan</span>
                    <span class="text-sm font-black text-amber-600 font-mono">{{ $repairAssets }}</span>
                </div>
            </div>

            <!-- Visual Donut & Category legend -->
            <div class="flex flex-col sm:flex-row items-center justify-around gap-6">
                <!-- SVG Modern Donut Chart -->
                <div class="relative w-40 h-40 flex items-center justify-center shrink-0">
                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                        <!-- Background Circle -->
                        <circle cx="50" cy="50" r="38" stroke="#f1f5f9" stroke-width="12" fill="transparent" />
                        <!-- Segment 1: Emerald (Ready) -->
                        @php
                            $pReady = $totalAssets > 0 ? ($readyAssets / $totalAssets) * 100 : 0;
                            $pInUse = $totalAssets > 0 ? ($inUseAssets / $totalAssets) * 100 : 0;
                            $pRepair = $totalAssets > 0 ? ($repairAssets / $totalAssets) * 100 : 0;
                            $circumference = 2 * pi() * 38; // approx 238.76
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
                    <!-- Center Metric -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                        <span class="text-[10px] font-semibold text-slate-400">Total Unit</span>
                        <span class="text-xl font-extrabold text-slate-900 font-mono">{{ $totalAssets }}</span>
                        <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.2 rounded-full">Unit RS</span>
                    </div>
                </div>

                <!-- Legend Breakdown -->
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
            <span class="text-[11px] text-slate-400">Terakhir diperbarui secara otomatis hari ini</span>
        </div>
    </div>
</div>
